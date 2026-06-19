<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold text-white mb-6">
        Marketplace
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($services as $service)

        <div class="bg-white p-4 rounded shadow">

            <h2 class="text-xl font-bold">
                {{ $service->title }}
            </h2>

            <p class="text-gray-600 mt-2">
                {{ Str::limit($service->description, 100) }}
            </p>

            <p class="mt-3">
                <strong>Artist:</strong>
                {{ $service->user->name }}
            </p>

            <p>
                <strong>Harga:</strong>
                Rp {{ number_format($service->price, 0, ',', '.') }}
            </p>

            <p>
                <strong>Waktu:</strong>
                {{ $service->delivery_time }} hari
            </p>

            <a
                href="/services/{{ $service->id }}"
                class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">

                Lihat Detail

            </a>

        </div>

        @endforeach

    </div>

</div>

</x-app-layout>