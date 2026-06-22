<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArtistOrderController extends Controller
{
    public function index()
    {
        $queueOrders = Order::with(['customer', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('status', 'pending')
            ->get();

        $activeOrders = Order::with(['customer', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('status', 'in_progress')
            ->get();

        $completedOrders = Order::with(['customer', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('status', 'completed')
            ->get();

        $reviews = Order::with(['customer', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereNotNull('review')
            ->get();

        return view(
            'artist.orders',
            compact(
                'queueOrders',
                'activeOrders',
                'completedOrders',
                'reviews'
            )
        );
    }
    public function accept(Order $order)
    {
        $order->update([
            'status' => 'awaiting_payment'
        ]);

        return back()->with(
            'success',
            'Waiting for customer payment.'
        );
    }
    public function reject(Order $order)
    {
        $order->update([
            'status' => 'cancelled'
        ]);

        return back();
    }
    public function uploadResult(
        Request $request,
        Order $order
    )
    {
        $request->validate([
            'result_image' => 'required|file'
        ]);

        $path = $request
            ->file('result_image')
            ->store('results', 'public');

        $order->update([
            'result_image' => $path,
            'status' => 'completed'
        ]);

        return back()->with(
            'success',
            'Artwork berhasil diupload!'
        );
    }
}