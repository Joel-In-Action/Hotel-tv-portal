<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index()
    {
        $path = public_path('countries_metadata.json');

        if (!file_exists($path)) {
            abort(404, 'Country metadata not found');
        }

        $data = file_get_contents($path);
        $countries = json_decode($data, true);

        return view('country', ['countries' => $countries]);
    }

    public function showChannels($country_code)
{
    $path = public_path('countries_metadata.json');
    $countries = json_decode(file_get_contents($path), true);

    $m3uUrl = "https://iptv-org.github.io/iptv/index.m3u";
    $response = Http::timeout(15)->get($m3uUrl);

    if (!$response->ok()) {
        abort(500, 'Failed to fetch M3U playlist');
    }

    // Pass the country code to filter
    $channels = $this->parseM3u($response->body(), $countries, $country_code);

    return view('show', compact('channels', 'country_code', 'countries'));
}


    private function parseM3u($m3uText, $countries = [], $filterCountryCode = null)
{
    $lines = explode("\n", $m3uText);
    $channels = [];

    // Normalize filter to uppercase for JSON keys
    $filterCountryCode = $filterCountryCode ? strtoupper($filterCountryCode) : null;

    for ($i = 0; $i < count($lines); $i++) {
        $line = trim($lines[$i]);

        if (str_starts_with($line, "#EXTINF:")) {
            $name = trim(explode(",", $line)[1] ?? "");
            $url = trim($lines[$i + 1] ?? "");

            // Try to get tvg-country
            $countryCode = null;
            if (str_contains($line, 'tvg-country="')) {
                $countryCode = strtoupper(explode('"', explode('tvg-country="', $line)[1])[0]);
            }

            // Determine country info
            $flag = "🏳️";
            $countryName = "Unknown";

            if ($countryCode && isset($countries[$countryCode])) {
                $countryName = $countries[$countryCode]['country'] ?? "Unknown";
                $flag = $countries[$countryCode]['flag'] ?? "🏳️";
            }
            // Fallback: match country by name in channel title
            elseif ($filterCountryCode && isset($countries[$filterCountryCode])) {
                $filterCountryName = strtoupper($countries[$filterCountryCode]['country']);
                if (str_contains(strtoupper($name), $filterCountryName)) {
                    $countryCode = $filterCountryCode;
                    $countryName = $countries[$filterCountryCode]['country'];
                    $flag = $countries[$filterCountryCode]['flag'] ?? "🏳️";
                }
            }

            // Skip if filtering by country and no match
            if ($filterCountryCode && $countryCode !== $filterCountryCode) {
                continue;
            }

            $channels[] = [
                'name' => $name,
                'url' => $url,
                'country_code' => $countryCode,
                'country_name' => $countryName,
                'flag' => $flag,
            ];
        }
    }

    return $channels;
}


    public function player(Request $request)
    {
        $url = $request->query('url');
        $name = $request->query('name');

        return view('watch', compact('url', 'name'));
    }

}
