<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
      public function index()
    {
        // Read the JSON file from public
        $path = public_path('countries_metadata.json');

        if (!file_exists($path)) {
            abort(404, 'Country metadata not found');
        }

        $data = file_get_contents($path);
        $countries = json_decode($data, true);

        return view('country', [
            'countries' => $countries
        ]);
    }
}
