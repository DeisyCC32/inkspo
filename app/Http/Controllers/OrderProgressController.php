<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Http\Request;

class OrderProgressController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'image' => 'required|image',
            'artist_note' => 'nullable'
        ]);

        $lastApproved = $order->progresses()
            ->where('status', 'accepted')
            ->latest()
            ->first();

        $phase = 'sketch';

        if ($lastApproved) {

            if ($lastApproved->phase === 'sketch') {
                $phase = 'lineart';
            }

            elseif ($lastApproved->phase === 'lineart') {
                $phase = 'render';
            }

            elseif ($lastApproved->phase === 'render') {
                $phase = 'finish';
            }
        }

        $existingPending = $order->progresses()
            ->where('phase', $phase)
            ->where('status', 'pending')
            ->exists();

        if ($existingPending) {

            return back()->with(
                'error',
                'Waiting for customer review.'
            );
        }

        $imagePath = $request->file('image')
            ->store('progress', 'public');

        OrderProgress::create([
            'order_id' => $order->id,
            'phase' => $phase,
            'image' => $imagePath,
            'artist_note' => $request->artist_note,
            'status' => 'pending'
        ]);

        return back()->with(
            'success',
            ucfirst($phase) . ' submitted successfully!'
        );
    }

    public function accept(OrderProgress $progress)
    {
        $progress->update([
            'status' => 'accepted'
        ]);

        return back()->with(
            'success',
            'Progress approved.'
        );
    }

    public function reject(
        Request $request,
        OrderProgress $progress
    )
    {
        $progress->update([
            'status' => 'rejected',
            'customer_note' => $request->customer_note
        ]);

        return back()->with(
            'success',
            'Revision requested.'
        );
    }
}