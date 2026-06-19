<x-app-layout>

<div class="p-6 text-white">

    <h1 class="text-3xl font-bold mb-4">
        {{ $service->title }}
    </h1>

    <p class="mb-4">
        {{ $service->description }}
    </p>

    <p>
        <strong>Artist:</strong>
        {{ $service->user->name }}
    </p>

    <p>
        <strong>Harga:</strong>
        Rp {{ number_format($service->price, 0, ',', '.') }}
    </p>

    <p>
        <strong>Waktu Pengerjaan:</strong>
        {{ $service->delivery_time }} hari
    </p>

    <div class="mt-6">
        <a
            href="{{ route('orders.create', $service->id) }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block">

            Pesan Sekarang

        </a>
    </div>

</div>

</x-app-layout>