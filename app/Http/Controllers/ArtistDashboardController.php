<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArtistDashboardController extends Controller
{
    public function index()
    {
        $artistId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | SERVICES
        |--------------------------------------------------------------------------
        */

        $services = Service::withAvg(
            'orders',
            'rating'
        )
        ->where(
            'user_id',
            Auth::id()
        )
        ->get();

        $totalServices = $services->count();

        /*
        |--------------------------------------------------------------------------
        | BASE ORDER QUERY
        |--------------------------------------------------------------------------
        */

        $artistOrders = Order::with([
            'customer',
            'service'
        ])
        ->whereHas(
            'service',
            fn ($query) =>
            $query->where('user_id', $artistId)
        );

        /*
        |--------------------------------------------------------------------------
        | COMPLETED
        |--------------------------------------------------------------------------
        */

        $completedOrderList = (clone $artistOrders)
            ->where('status', 'completed')
            ->latest()
            ->get();

        $completedOrders = $completedOrderList->count();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE
        |--------------------------------------------------------------------------
        */

        $activeOrderList = (clone $artistOrders)
            ->where('status', 'in_progress')
            ->latest()
            ->get();

        $activeOrders = $activeOrderList->count();

        /*
        |--------------------------------------------------------------------------
        | QUEUE
        |--------------------------------------------------------------------------
        */

        $latestQueueOrders = (clone $artistOrders)
            ->whereIn(
                'status',
                [
                    'pending',
                    'awaiting_payment'
                ]
            )
            ->latest()
            ->get();

        $queueOrders = $latestQueueOrders->count();

        /*
        |--------------------------------------------------------------------------
        | REVIEWS
        |--------------------------------------------------------------------------
        */

        $reviews = (clone $artistOrders)
            ->whereNotNull('rating')
            ->latest()
            ->get();

        $averageRating = $reviews->avg('rating');

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'artist.dashboard',
            compact(
                'services',
                'totalServices',

                'completedOrders',
                'completedOrderList',

                'activeOrders',
                'activeOrderList',

                'queueOrders',
                'latestQueueOrders',

                'reviews',
                'averageRating'
            )
        );
    }

    public function profile($userId)
    {
        /*
        |--------------------------------------------------------------------------
        | ARTIST
        |--------------------------------------------------------------------------
        */

        $artist = User::findOrFail($userId);

        /*
        |--------------------------------------------------------------------------
        | SERVICES
        |--------------------------------------------------------------------------
        */

        $services = Service::withAvg(
            'orders',
            'rating'
        )
        ->where(
            'user_id',
            Auth::id()
        )
        ->get();

        /*
        |--------------------------------------------------------------------------
        | REVIEWS
        |--------------------------------------------------------------------------
        */

        $reviewOrders = Order::whereHas(
            'service',
            function ($query) use ($artist)
            {
                $query->where(
                    'user_id',
                    $artist->id
                );
            }
        )
        ->whereNotNull('rating')
        ->get();

        $averageRating = $reviewOrders->avg('rating');

        $totalReviews = $reviewOrders->count();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'artist.profile',
            compact(
                'artist',
                'services',
                'averageRating',
                'totalReviews'
            )
        );
    }
}
