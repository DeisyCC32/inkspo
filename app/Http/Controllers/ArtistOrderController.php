<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ArtistOrderController extends Controller
{
    public function index()
    {
        $orders = Order::whereHas('service', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('artist.orders', compact('orders'));
    }
    public function accept(Order $order)
    {
        $order->update([
            'status' => 'in_progress'
        ]);

        return back();
    }

    public function reject(Order $order)
    {
        $order->update([
            'status' => 'cancelled'
        ]);

        return back();
    }
}