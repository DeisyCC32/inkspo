<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::with('user')
            ->where('status', 'active')

            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {

                    $q->where(
                        'title',
                        'like',
                        '%' . $request->search . '%'
                    )

                    ->orWhere(
                        'description',
                        'like',
                        '%' . $request->search . '%'
                    );
                });
            })

            ->latest()
            ->paginate(9);

        return view(
            'marketplace.index',
            compact('services')
        );
    }
}