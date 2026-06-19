<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistDashboardController extends Controller
{
    public function index()
    {
        return view('artist.dashboard');
    }
}