<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        return redirect()->route('artist.dashboard');
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'delivery_time' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image'))
        {
            $imagePath = $request
                ->file('image')
                ->store('services', 'public');
        }

        Service::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'image' => $imagePath,
            'status' => 'active',
        ]);

        return redirect()
            ->route('artist.dashboard')
            ->with(
                'success',
                'Service created successfully.'
            );
    }


    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'delivery_time' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $service->image;

        if ($request->hasFile('image')) {

            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $imagePath = $request->file('image')
                ->store('services', 'public');
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('artist.dashboard')
            ->with('success', 'Service berhasil diupdate');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('artist.dashboard')
            ->with('success', 'Service deleted successfully.');
    }
}