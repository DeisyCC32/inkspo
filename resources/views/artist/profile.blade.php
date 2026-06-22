<x-app-layout>

<div class="p-6">

    <div class="bg-white rounded shadow p-6 mb-6">

        <h1 class="text-3xl font-bold">
            {{ $artist->name }}
        </h1>

        <p class="mt-3">
            ⭐ Rating:
            {{ number_format($averageRating ?? 0, 1) }}
        </p>

        <p>
            Total Review:
            {{ $totalReviews }}
        </p>

        <p>
            Total Service:
            {{ $services->count() }}
        </p>

    </div>

    <h2 class="text-2xl font-bold text-white mb-4">
        Services
    </h2>

    @foreach($services as $service)

        <div class="bg-white rounded shadow p-4 mb-4">

            <h3 class="text-xl font-bold">
                {{ $service->title }}
            </h3>

            <p class="mt-2">
                {{ $service->description }}
            </p>

            <p class="mt-2">
                Rp {{ number_format($service->price,0,',','.') }}
            </p>

        </div>

    @endforeach

</div>

</x-app-layout>