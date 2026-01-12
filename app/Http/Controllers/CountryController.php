<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{

    public function showChannels(Request $request)
    {
        $path = public_path('countries_metadata.json');
        $countries = json_decode(file_get_contents($path), true);

        $m3uUrl = "https://iptv-org.github.io/iptv/index.m3u";
        $response = Http::timeout(15)->get($m3uUrl);

        if (!$response->ok()) {
            abort(500, 'Failed to fetch M3U playlist');
        }

        $channels = $this->parseM3u($response->body(), $countries);

        // Apply search if provided
        $search = $request->query('search');
        if ($search) {
            $search = strtoupper($search);
            $channels = array_filter($channels, function($channel) use ($search) {
                return str_contains(strtoupper($channel['name']), $search);
            });
        }

        return view('show', compact('channels', 'countries', 'search'));
    }

    public function player(Request $request)
    {
        $url = $request->query('url');
        $name = $request->query('name');

        return view('watch', compact('url', 'name'));
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

                // Default values
                $countryCode = null;
                $flag = "🏳️";
                $countryName = "Unknown";

                // Attempt to get country code
                if (str_contains($line, 'tvg-country="')) {
                    $countryCode = strtolower(explode('"', explode('tvg-country="', $line)[1])[0]);
                }

                // Get metadata from countries JSON if exists
                if ($countryCode && isset($countries[strtoupper($countryCode)])) {
                    $country = $countries[strtoupper($countryCode)];
                    $flag = $country['flag'] ?? "🏳️";
                    $countryName = $country['country'] ?? "Unknown";
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

    private $blockedChannels = [
        '00s Replay'
    ];

    public function allChannels(Request $request)
    {
        $q = $request->query('q', '');

        $m3uUrl = "https://iptv-org.github.io/iptv/index.m3u";
        $response = Http::timeout(15)->get($m3uUrl);

        $countries = json_decode(file_get_contents(public_path('countries_metadata.json')), true);

        $channels = $this->parseM3u($response->body(), $countries);

        $channels = array_filter($channels, function($channel) {
            return !in_array($channel['name'], $this->blockedChannels);
        });

        if ($q) {
            $channels = array_filter($channels, fn($c) => str_contains(strtolower($c['name']), strtolower($q)));
        }

        return view('channels', compact('channels'));
    }
}
