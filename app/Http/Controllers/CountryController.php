<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{

    public function showChannels(Request $request)
    {
        $path = public_path('countries_metadata.json');
        $path1 = public_path('index.m3u');
        $countries = json_decode(file_get_contents($path), true);
        $m3uUrl = json_decode(file_get_contents($path1), true);

        // $m3uUrl = "https://iptv-org.github.io/iptv/index.m3u";

        if (!file_exists($path1)) {
            abort(500, 'index.m3u not found');
        }

        // ✅ Read as plain text
        $m3uText = file_get_contents($path1);

        $countries = json_decode(
            file_get_contents(public_path('countries_metadata.json')),
            true
        );

        // ✅ Parse directly
        $channels = $this->parseM3u($m3uText, $countries);


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
        // france
        '00s Replay', 'like Gecko Chrome/76.0.3809.25 Safari/537.36" group-title="News"', 'France 2 (1080p)', 'France 2 HD (720p)', 'France 3 HD (720p)', 
        'France 4 HD (720p)', 'France 5 (1080p)', 'France 5 HD (720p)', 'France Inter', 'Franceinfo', 'Motorracing France', 'Rakuten TV Trailers France (720p)',
        'TV5Monde France Belgique Suisse Monaco (1080p) [Geo-blocked]', 

        // italy
        '16 Anni e Incinta Italy (720p)', 'Andromeda Italy (720p)', 'Avatar La Leggenda di Aang Italy (720p)', 'BBC Doctor Who Italy (1080p)', 'Catfish TV Show Italy (720p)',
        'Due Fantagenitori Italy (720p)', 'FailArmy Italy (720p)', 'Geordie Shore Italy (720p)', 'Il Banco dei Pugni Italy (720p)', 'Il Testimone Italy (720p)',
        'Just for Laughs Italy (720p)', 'Le Sorelle McLeod Italy (720p)', 'Le Sorelle McLeod Italy (720p)', 'MacGyver Italy (720p)', 'Mai Dire Sì Italy (720p)', 
        'Pimp My Ride Italy (720p)', 'Pluto TV Anime Italy (720p)', 'Pluto TV Cinema Italiano Italy (720p)', 'Pluto TV Cinema Italiano Italy (720p)', 'Pluto TV Crime Italy (720p)', 
        'Pluto TV Documentary Italy (720p)', 'Pluto TV Film Azione Italy (720p)', 'Pluto TV Film Azione Italy (720p)', 'Pluto TV Film Classici Italy (720p)', 
        'Pluto TV Film Commedia Italy (720p)', 'Pluto TV Film Drama Italy (720p)', 'Pluto TV Film Italy (720p)', 'Pluto TV Film Romantici Italy (720p)', 
        'Pluto TV Film Thriller Italy (720p)', 'Pluto TV Horror Italy (720p)', 

        // random guesses
        'ABC 9 Orlando FL (WFTV) (720p)', 'Andorra TV (1080p)', 'Corporation de Télévision Brandon (CTB TV)', 'Kino Barrandov (720p)', 'MBC Andong (안동 MBC) (360p) [Not 24/7]',
        'Resplandor TV (720p)', 'Shandong Education TV', 'SuperChannel Orlando (WACX-DT1) (720p)','Anytime TV (1080p)', 'Class CNBC', 'CNBC (720p)', 'CNBC Africa (480p)',
        'CNBC Indonesia (720p)', 'CNBC TV18 Prime HD (1080p)', 'GNF TV (576p)', 'GOD TV Africa (576p)', 'Hilaal TV (576p)', 'Homebase TV (576p) [Not 24/7]', 'Hope4Life TV (720p)',
        'Hope Channel Australia (1080p)', 'Hope Channel Bulgaria', 'Hope Channel Ghana (480p)', 'Hope Channel Norge (720p)', 'LN24SA (1080p)', 'LN247 (1080p)',

        // another italy
        'Alkarma TV Praise (720p) [Not 24/7]', 'Channel 7 Ukraine (720p)', 'Charlotte aux Fraises', 'Little House on the Prairie', 'Praise Jesus Tower TV (480p)', 'Rai 1 HD (720p)', 
        'Rai 2 (576p) [Geo-blocked]', 'Rai 2 HD', 'Rai 4 (576p) [Geo-blocked]', 'RAI 4K [Geo-blocked]', 'Rai 5 (576p) [Geo-blocked]', 'Rai Gulp (1080p)', 'Rai Gulp HD', 'RAI Italia Asia (576p)', 
        'Rai Movie (576p) [Geo-blocked]', 'Rai News 24 (720p)', 'Rai News 24 HD', 'Rai Premium (1080p)', 'Rai Scuola (576p) [Geo-blocked]', 'Rai Scuola HD', 'Rai Sport 2', 'Rai Sport HD',
        'Rai Storia (576p) [Geo-blocked]', 'Rai Storia HD', 'Rai Yoyo (1080p)', 'Raia TV (720p) [Not 24/7]', 'Rakuten TV Trailers Germany (1080p)', 'Rakuten TV Trailers Italy (1080p)',
        'Rakuten TV Trailers Spain (1080p)', 'Rakuten TV Trailers UK (1080p)', 'TVR Craiova (1080p) [Geo-blocked]', 'Rakuten TV Family Movies Italy (1080p)', 'Rakuten TV Asian Cinema Italy (1080p)',
        'Renegade Italy (720p)', 'Scherzi e risate Italy (720p)', 'Settimo Cielo Italy (720p)', 'South Park Italy (720p)', 'Squadra Speciale Cobra 11 Italy (720p)',
        'Super! Brothers and Sisters Italy (720p)', 'Super! iCarly Italy (720p)', 'Super! Pop Italy (720p)', 'Super! Rugrats Italy (720p)', 'Super! Star Italy (720p)', 
        'Super! Victorious Italy (720p)', 'Teen Mom Italy (720p)', 'Teenage Mutant Ninja Turtles Italy (720p)', 'VH1+ Music Legends Italy (720p)', 'VH1+ Rock Italy (720p)', 
        'World Poker Tour Italy (720p)', 

        // german
        'Comedy & Shows Germany (1080p)', 'Germany Shore', 'Hope Channel German (1080p)', 'MyTime Movie Network Germany (1080p)', 'Nick Germany (1080p) [Geo-blocked]',
        'QVC 2 Germany (540p)', 'QVC Style Germany (540p)', ''
    ];

    public function allChannels(Request $request)
    {
        $q = $request->query('q', '');

       $path1 = public_path('index.m3u');

        if (!file_exists($path1)) {
            abort(500, 'index.m3u not found');
        }

        // ✅ Read as plain text
        $m3uText = file_get_contents($path1);

        $countries = json_decode(
            file_get_contents(public_path('countries_metadata.json')),
            true
        );

        // ✅ Parse directly
        $channels = $this->parseM3u($m3uText, $countries);

        // ❌ Block channels starting with "Pluto"
        $channels = array_filter($channels, function ($channel) {
            return !str_starts_with(
                strtolower($channel['name']),
                'pluto'
            );
        });

        $channels = array_filter($channels, function($channel) {
            return !in_array($channel['name'], $this->blockedChannels);
        });

        if ($q) {
            $channels = array_filter($channels, fn($c) => str_contains(strtolower($c['name']), strtolower($q)));
        }

        return view('channels', compact('channels'));
    }
}
