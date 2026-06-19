<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('user_id', Auth::id())->get();

        return view('services.index', compact('services'));
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
        ]);

        Service::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'status' => 'active',
        ]);

        return redirect()->route('services.index');
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
        ]);

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil diupdate');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service berhasil dihapus');
    }
}