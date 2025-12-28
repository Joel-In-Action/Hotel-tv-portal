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

        // Fetch M3U playlist
        $m3uUrl = "https://iptv-org.github.io/iptv/index.m3u";
        $response = Http::timeout(15)->get($m3uUrl);

        if (!$response->ok()) {
            abort(500, 'Failed to fetch M3U playlist');
        }

        // Parse all channels (like Flask)
        $channels = $this->parseM3u($response->body(), $countries);

        return view('show', compact('channels', 'country_code', 'countries'));
    }

    private function parseM3u($m3uText, $countries = [])
    {
        $lines = explode("\n", $m3uText);
        $channels = [];

        for ($i = 0; $i < count($lines); $i++) {
            $line = trim($lines[$i]);

            if (str_starts_with($line, "#EXTINF:")) {
                $name = trim(explode(",", $line)[1] ?? "");
                $url = trim($lines[$i + 1] ?? "");

                $countryCode = null;
                $flag = "🏳️";

                if (str_contains($line, 'tvg-country="')) {
                    $countryCode = strtolower(explode('"', explode('tvg-country="', $line)[1])[0]);
                }

                if ($countryCode && isset($countries[strtoupper($countryCode)])) {
                    $country = $countries[strtoupper($countryCode)];
                    $flag = $country['flag'] ?? "🏳️";
                    $countryName = $country['country'] ?? "Unknown";
                } else {
                    $countryName = "Unknown";
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
