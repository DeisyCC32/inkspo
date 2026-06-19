<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">
        Incoming Orders
    </h1>

    @foreach($orders as $order)

        <div class="bg-white p-4 rounded shadow mb-4">

            <p>
                <strong>Customer:</strong>
                {{ $order->customer->name }}
            </p>

            <p>
                <strong>Service:</strong>
                {{ $order->service->title }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $order->status }}
            </p>
            
           @if($order->status == 'pending')

            <div class="mt-4 flex gap-2">

                <form
                    action="{{ route('orders.accept', $order->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        style="
                            background:#16a34a;
                            color:white;
                            padding:10px 18px;
                            border:none;
                            border-radius:6px;
                            font-weight:bold;
                            cursor:pointer;
                        ">
                        Accept
                    </button>

                </form>

                <form
                    action="{{ route('orders.reject', $order->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        style="
                            background:#dc2626;
                            color:white;
                            padding:10px 18px;
                            border:none;
                            border-radius:6px;
                            font-weight:bold;
                            cursor:pointer;
                        ">
                        Reject
                    </button>

                </form>

            </div>

            @endif

            <p class="mt-2">
                <strong>Deskripsi Request:</strong>
            </p>

            <p class="mb-3">
                {{ $order->description }}
            </p>
            @if($order->reference_image)

                <p class="font-bold mb-2">
                    Reference Image
                </p>

                <img
                    src="{{ asset('storage/' . $order->reference_image) }}"
                    alt="Reference Image"
                    class="w-64 rounded shadow">

            @endif
        </div>

    @endforeach

</div>

</x-app-layout>