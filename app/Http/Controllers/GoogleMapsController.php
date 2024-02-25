<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleMapsController extends Controller
{
    public function getKey()
    {
        return response()->json(['key' => config('services.google_maps.key')]);
    }
}
