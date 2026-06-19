<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        My Orders
    </h1>

    @foreach($orders as $order)

        <div class="bg-white p-4 rounded shadow mb-4">

            <p>
                <strong>Service:</strong>
                {{ $order->service->title }}
            </p>

            <p>
                <strong>Artist:</strong>
                {{ $order->service->user->name }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $order->status }}
            </p>

        </div>

    @endforeach

</div>

</x-app-layout>