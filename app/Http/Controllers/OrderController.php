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
    public function myOrders()
    {
        $orders = Order::where('customer_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my', compact('orders'));
    }
}