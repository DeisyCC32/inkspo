<?php

namespace App\Http\Controllers;

use App\Models\Service;

class MarketplaceController extends Controller
{
    public function index()
    {
        $services = Service::with('user')
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('marketplace.index', compact('services'));
    }
}