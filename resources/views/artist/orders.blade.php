<x-app-layout>

<div class="max-w-7xl mx-auto pt-32 pb-20 px-8">
    {{-- ORDER QUEUE --}}
    <h2
        style="
            font-size:70px;
            font-weight:900;
            color:white;
            text-align:center;
            margin-bottom:50px;
        ">
        Order Queue
    </h2>

    <div
        style="
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:40px;
            max-width:1600px;
            margin:auto;
            margin-bottom:40px;
        ">

    @forelse($queueOrders as $order)

        <div
            style="
                background:white;
                padding:50px;
                border-radius:40px;
                box-shadow:0 10px 40px rgba(0,0,0,.25);
                width:100%;
            ">

            <h3
                style="
                    font-size:42px;
                    font-weight:900;
                    margin-bottom:15px;
                    color:#111827;
                ">
                {{ $order->customer->name }}
            </h3>

            <p
                style="
                    color:#6b7280;
                    font-size:22px;
                    margin-bottom:10px;
                ">
                Commission Request
            </p>

            <p
                style="
                    font-size:24px;
                    margin-bottom:25px;
                ">
                {{ $order->description }}
            </p>

            @if($order->reference_image)

                <img
                    src="{{ asset('storage/' . $order->reference_image) }}"
                    style="
                        width:100%;
                        max-height:500px;
                        object-fit:contain;
                        border-radius:30px;
                        box-shadow:0 10px 30px rgba(0,0,0,.15);
                        margin-bottom:30px;
                    ">

            @endif

            <div
                style="
                    display:flex;
                    gap:15px;
                ">

                <form
                    action="{{ route('orders.accept', $order->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        style="
                            background:#10b981;
                            color:white;
                            font-size:22px;
                            font-weight:900;
                            padding:15px 30px;
                            border:none;
                            border-radius:18px;
                            cursor:pointer;
                            box-shadow:0 5px 15px rgba(0,0,0,.2);
                        ">

                        ✓ ACCEPT

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
                            font-size:22px;
                            font-weight:900;
                            padding:15px 30px;
                            border:none;
                            border-radius:18px;
                            cursor:pointer;
                            box-shadow:0 5px 15px rgba(0,0,0,.2);
                        ">

                        ✕ REJECT

                    </button>

                </form>

            </div>

        </div>

    @empty

        <div
            style="
                grid-column:1 / -1;
                text-align:center;
                color:white;
                font-size:28px;
            ">
            No queued orders.
        </div>

    @endforelse

    </div>


    <hr class="my-20 border-gray-500">


    {{-- ACTIVE ORDERS --}}
    <h2 class="text-6xl font-black text-white text-center mb-14">
        Active Orders
    </h2>

    @forelse($activeOrders as $order)

        <div class="bg-white p-12 rounded-3xl shadow-2xl mb-12 max-w-5xl mx-auto">

            <h3 class="text-5xl font-black mb-4">
                {{ $order->customer->name }}
            </h3>

            <p class="text-xl mb-2">
                <strong>Service:</strong>
                {{ $order->service->title }}
            </p>

            <p class="text-xl mb-6">
                <strong>Due Date:</strong>
                {{ $order->due_date }}
            </p>

            @if($order->reference_image)

                <img
                    src="{{ asset('storage/' . $order->reference_image) }}"
                    class="max-h-96 rounded-3xl shadow-2xl mb-8">

            @endif

            @if($order->revision_requested)

                <div class="bg-yellow-100 border border-yellow-300 p-6 rounded-2xl mb-8">

                    <strong class="text-xl">
                        Revision Requested
                    </strong>

                    <p class="mt-2 text-lg">
                        {{ $order->revision_note }}
                    </p>

                </div>

            @endif

            <form
                action="{{ route('orders.uploadResult', $order->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <input
                    type="file"
                    name="result_image"
                    required
                    class="mb-4 text-lg">

                <br>

                <button
                    type="submit"
                    class="
                    bg-blue-600
                    hover:bg-blue-700
                    text-white
                    font-black
                    text-xl
                    px-10
                    py-4
                    rounded-2xl
                    shadow-xl">

                    Upload Artwork

                </button>

            </form>

        </div>

    @empty

        <p class="text-center text-gray-300 text-2xl mb-16">
            No active orders.
        </p>

    @endforelse


    <hr class="my-20 border-gray-500">


    {{-- COMPLETED ORDERS --}}
    <h2 class="text-6xl font-black text-white text-center mb-14">
        Completed Orders
    </h2>

    @forelse($completedOrders as $order)

        <div class="bg-white p-12 rounded-3xl shadow-2xl mb-12 max-w-6xl mx-auto">

            <h3 class="text-5xl font-black mb-10">
                {{ $order->customer->name }}
            </h3>

            <div class="grid md:grid-cols-2 gap-10">

                <div>

                    <p class="font-bold text-2xl mb-5">
                        Reference Image
                    </p>

                    @if($order->reference_image)

                        <img
                            src="{{ asset('storage/' . $order->reference_image) }}"
                            class="max-h-96 rounded-3xl shadow-2xl">

                    @endif

                </div>

                <div>

                    <p class="font-bold text-2xl mb-5">
                        Final Artwork
                    </p>

                    @if($order->result_image)

                        <img
                            src="{{ asset('storage/' . $order->result_image) }}"
                            class="max-h-96 rounded-3xl shadow-2xl">

                    @else

                        <p class="text-gray-500 text-lg">
                            Artwork not uploaded yet.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    @empty

        <p class="text-center text-gray-300 text-2xl mb-16">
            No completed orders.
        </p>

    @endforelse


    <hr class="my-20 border-gray-500">


    {{-- CUSTOMER REVIEWS --}}
    <h2 class="text-6xl font-black text-white text-center mb-14">
        Customer Reviews
    </h2>

    @forelse($reviews as $review)

        <div class="bg-white p-12 rounded-3xl shadow-2xl mb-12 max-w-5xl mx-auto">

            <h3 class="text-5xl font-black mb-4">
                {{ $review->customer->name }}
            </h3>

            <p class="text-yellow-500 text-3xl mb-5">
                ⭐ {{ $review->rating }}/5
            </p>

            <p class="text-2xl mb-8">
                {{ $review->review }}
            </p>

            @if($review->result_image)

                <img
                    src="{{ asset('storage/' . $review->result_image) }}"
                    class="max-h-96 rounded-3xl shadow-2xl">

            @endif

        </div>

    @empty

        <p class="text-center text-gray-300 text-2xl">
            No reviews yet.
        </p>

    @endforelse

</div>

</x-app-layout>