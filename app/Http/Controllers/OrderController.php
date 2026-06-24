<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, Service $service)
    {
        $imagePath = null;

        if ($request->hasFile('reference_image')) {
            $imagePath = $request
                ->file('reference_image')
                ->store('references', 'public');
        }

        Order::create([
            'customer_id' => Auth::id(),
            'service_id' => $service->id,
            'description' => $request->description,
            'reference_image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('marketplace')
            ->with('success', 'Order berhasil dibuat!');
    }
    public function create(Service $service)
    {
        return view('orders.create', compact('service'));
    }
    public function myOrders(Request $request)
    {
        $query = Order::where(
            'customer_id',
            Auth::id()
        );

        if ($request->status)
        {
            $query->where(
                'status',
                $request->status
            );
        }

        $orders = $query
            ->with([
                'service.user',
                'progresses'
            ])
            ->latest()
            ->get();

        return view(
            'orders.my',
            compact('orders')
        );
    }
    public function submitReview(Request $request, Order $order)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required'
        ]);

        $order->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with(
            'success',
            'Review berhasil dikirim!'
        );
    }
    public function pay(Order $order)
    {
        $order->update([
            'status' => 'in_progress',
            'due_date' => now()->addDays(
                $order->service->delivery_time
            )
        ]);

        return back()->with(
            'success',
            'Payment successful!'
        );
    }
}