<x-app-layout>
    <style>

    .star-rating{
        display:flex;
        flex-direction:row-reverse;
        justify-content:flex-end;
        gap:5px;
    }

    .star-rating input{
        display:none;
    }

    .star-rating label{
        font-size:32px;
        color:#d1d5db;
        cursor:pointer;
        transition:0.2s;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label{
        color:#facc15;
    }

    .star-rating input:checked ~ label{
        color:#facc15;
    }

    </style>

<div
    style="
        max-width:1000px;
        margin:120px auto 50px auto;
        padding:20px;
    "
>

<div
    style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:40px;
        flex-wrap:wrap;
    "
>

    <h1
        style="
            font-size:60px;
            font-weight:900;
            color:white;
            margin:0;
        "
    >
        My Orders
    </h1>

    <div
        style="
            display:flex;
            gap:12px;
        "
    >

        <a
            href="{{ route('orders.my') }}"
            style="
                background:white;
                color:black;
                padding:12px 24px;
                border-radius:999px;
                text-decoration:none;
                font-weight:800;
            "
        >
            All
        </a>

        <a
            href="{{ route('orders.my',['status'=>'in_progress']) }}"
            style="
                background:white;
                color:black;
                padding:12px 24px;
                border-radius:999px;
                text-decoration:none;
                font-weight:800;
            "
        >
            In Progress
        </a>

        <a
            href="{{ route('orders.my',['status'=>'completed']) }}"
            style="
                background:white;
                color:black;
                padding:12px 24px;
                border-radius:999px;
                text-decoration:none;
                font-weight:800;
            "
        >
            Completed
        </a>

        <a
            href="{{ route('orders.my',['status'=>'pending']) }}"
            style="
                background:white;
                color:black;
                padding:12px 24px;
                border-radius:999px;
                text-decoration:none;
                font-weight:800;
            "
        >
            Pending
        </a>

    </div>

</div>

    @foreach($orders as $order)
        <div
            style="
                background:white;
                border-radius:25px;
                padding:30px;
                margin-bottom:30px;
                box-shadow:0 10px 25px rgba(0,0,0,.12);
            "
        >

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:25px;
                "
            >

                <div>

                    <h2
                        style="
                            font-size:32px;
                            font-weight:900;
                            margin:0;
                        "
                    >
                        {{ $order->service->title }}
                    </h2>

                    <p
                        style="
                            margin-top:8px;
                            color:#000500;
                        "
                    >
                        Artist:

                        <a
                            href="{{ route('artist.profile', $order->service->user->id) }}"
                            style="
                                color:#29292d;
                                text-decoration:none;
                                font-weight:700;
                            "
                        >
                            {{ $order->service->user->name }}
                        </a>

                    </p>

                </div>

            <div
                style="
                    display:flex;
                    flex-direction:column;
                    align-items:flex-end;
                    gap:10px;
                "
            >

                <div
                    style="
                        background:#f3f4f6;
                        padding:10px 18px;
                        border-radius:999px;
                        font-weight:800;
                    "
                >
                    {{ ucfirst(str_replace('_',' ',$order->status)) }}
                </div>

                @if($order->status == 'awaiting_payment')

                    <form
                        action="{{ route('orders.pay',$order->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            style="
                                background:#070228;
                                color:white;
                                border:none;
                                padding:10px 20px;
                                border-radius:25px;
                                font-weight:800;
                                cursor:pointer;
                            "
                        >
                            Pay Now
                        </button>

                    </form>

                @endif

            </div>

            </div>

            @if($order->description)

                <p class="mt-3">
                    <strong>Request:</strong>
                </p>

                <p>
                    {{ $order->description }}
                </p>

            @endif

            @if($order->reference_image)

                <div class="mt-4">

                    <p>
                        <strong>Reference Image:</strong>
                    </p>

                    <img
                        src="{{ asset('storage/'.$order->reference_image) }}"
                        style="
                            width:100%;
                            max-width:700px;
                            max-height:450px;
                            object-fit:contain;
                            border-radius:20px;
                            border:1px solid #e5e7eb;
                            background:#f8fafc;
                            padding:10px;
                            margin-top:10px;
                        "
                    >

                </div>

            @endif

            @if($order->result_image)

            <div style="margin-top:25px;">

                <p
                    style="
                        font-weight:800;
                        margin-bottom:10px;
                    "
                >
                    Final Artwork
                </p>

                <img
                    src="{{ asset('storage/'.$order->result_image) }}"
                    style="
                        width:100%;
                        max-width:700px;
                        max-height:450px;
                        object-fit:contain;
                        border-radius:20px;
                        border:1px solid #e5e7eb;
                        background:#f8fafc;
                        padding:10px;
                        margin-bottom:15px;
                    "
                >

                <a
                    href="{{ asset('storage/'.$order->result_image) }}"
                    target="_blank"
                    style="
                        display:inline-block;
                        background:#111827;
                        color:white;
                        padding:12px 20px;
                        border-radius:12px;
                        text-decoration:none;
                        font-weight:700;
                    "
                >
                    Download Artwork
                </a>

            </div>

            @endif

            @if(
                $order->status == 'completed'
                && !$order->rating
            )

                <hr class="my-4">

                <form
                    action="{{ route('orders.review', $order->id) }}"
                    method="POST">

                    @csrf

                    <p class="mb-2">
                        <strong>Rating:</strong>
                    </p>

                    <div class="star-rating">

                        <input
                            type="radio"
                            id="star5-{{ $order->id }}"
                            name="rating"
                            value="5"
                            required>

                        <label for="star5-{{ $order->id }}">★</label>

                        <input
                            type="radio"
                            id="star4-{{ $order->id }}"
                            name="rating"
                            value="4">

                        <label for="star4-{{ $order->id }}">★</label>

                        <input
                            type="radio"
                            id="star3-{{ $order->id }}"
                            name="rating"
                            value="3">

                        <label for="star3-{{ $order->id }}">★</label>

                        <input
                            type="radio"
                            id="star2-{{ $order->id }}"
                            name="rating"
                            value="2">

                        <label for="star2-{{ $order->id }}">★</label>

                        <input
                            type="radio"
                            id="star1-{{ $order->id }}"
                            name="rating"
                            value="1">

                        <label for="star1-{{ $order->id }}">★</label>

                    </div>

                    <div class="mt-3">

                        <textarea
                            name="review"
                            required
                            placeholder="Write your review..."
                            style="
                                width:100%;
                                border:1px solid #d1d5db;
                                border-radius:15px;
                                padding:15px;
                                margin-top:10px;
                            "
                        ></textarea>

                    </div>

                    <button
                        type="submit"
                        style="
                            background:#111827;
                            color:white;
                            padding:10px 18px;
                            border:none;
                            border-radius:6px;
                            margin-top:10px;
                            font-weight:bold;
                        ">

                        Kirim Review

                    </button>

                </form>

            @endif

            @if($order->rating)

                <hr class="my-4">

                <p>
                    <strong>Rating:</strong>
                    ★ {{ $order->rating }} 
                </p>

                <p class="mt-2">
                    {{ $order->review }}
                </p>

            @endif
        </div>

    @endforeach

</div>

</x-app-layout>