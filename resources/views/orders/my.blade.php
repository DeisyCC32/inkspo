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

            @if($order->progresses->count())

            <hr style="margin:30px 0;">

            <h3
                style="
                    font-size:24px;
                    font-weight:900;
                    margin-bottom:20px;
                "
            >
            @php

            $currentStep = 0;

            $latestProgress =
                $order->progresses()
                    ->latest()
                    ->first();

            if($latestProgress)
            {
                switch($latestProgress->phase)
                {
                    case 'sketch':
                        $currentStep = 1;
                        break;

                    case 'lineart':
                        $currentStep = 2;
                        break;

                    case 'render':
                        $currentStep = 3;
                        break;

                    case 'finish':
                        $currentStep = 4;
                        break;
                }
            }

            @endphp
            <div
                style="
                    margin-top:25px;
                    margin-bottom:25px;
                "
            >

                <p
                    style="
                        font-weight:700;
                        margin-bottom:15px;
                    "
                >
                    Progress
                </p>

                <div
                    style="
                        display:flex;
                        justify-content:space-between;
                        position:relative;
                    "
                >

                    <div
                        style="
                            position:absolute;
                            top:11px;
                            left:12%;
                            right:12%;
                            height:3px;
                            background:#d1d5db;
                            z-index:1;
                        "
                    ></div>

                    @foreach(['Sketch','Lineart','Render','Finish'] as $index => $label)

                        <div
                            style="
                                display:flex;
                                flex-direction:column;
                                align-items:center;
                                z-index:2;
                                flex:1;
                            "
                        >

                            <div
                                style="
                                    width:22px;
                                    height:22px;
                                    border-radius:999px;
                                    border:3px solid
                                    {{ $currentStep >= ($index + 1)
                                        ? '#2563eb'
                                        : '#9ca3af' }};
                                    background:
                                    {{ $currentStep >= ($index + 1)
                                        ? '#2563eb'
                                        : 'white' }};
                                "
                            ></div>

                            <span
                                style="
                                    margin-top:8px;
                                    font-size:12px;
                                    font-weight:600;
                                "
                            >
                                {{ $label }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>
                Progress History
            </h3>

            @foreach(
                $order->progresses
                    ->groupBy('phase')
                as $phase => $phaseProgresses
            )

            <div
                style="
                    border:1px solid #e5e7eb;
                    border-radius:15px;
                    margin-bottom:15px;
                    overflow:hidden;
                    background:white;
                "
            >

                <div
                    onclick="
                        const box =
                        document.getElementById('phase{{ $order->id }}{{ $phase }}');

                        const arrow =
                        document.getElementById('arrow{{ $order->id }}{{ $phase }}');

                        if(box.style.display === 'none')
                        {
                            box.style.display='block';
                            arrow.innerHTML='▽';
                        }
                        else
                        {
                            box.style.display='none';
                            arrow.innerHTML='▷';
                        }
                    "
                    style="
                        padding:15px 20px;
                        cursor:pointer;
                        font-weight:800;
                        background:#f9fafb;
                        display:flex;
                        align-items:center;
                        gap:10px;
                    "
                >

                    <span id="arrow{{ $order->id }}{{ $phase }}">
                        ▽
                    </span>

                    <span>
                        {{ ucfirst($phase) }}
                    </span>

                </div>

                <div
                    id="phase{{ $order->id }}{{ $phase }}"
                    style="display:block;"
                >

                    @foreach($phaseProgresses as $progress)

                    <div
                        style="
                            padding:20px;
                            border-top:1px solid #eee;
                        "
                    >

                        <div
                            style="
                                margin-bottom:10px;
                                font-weight:700;
                            "
                        >

                            @if($progress->status == 'accepted')

                                <span style="color:#16a34a;">
                                    Approved
                                </span>

                            @elseif($progress->status == 'pending')

                                <span style="color:#ca8a04;">
                                    Pending Review
                                </span>

                            @elseif($progress->status == 'rejected')

                                <span style="color:#dc2626;">
                                    Revision Requested
                                </span>

                            @endif

                        </div>

                        <img
                            src="{{ asset('storage/'.$progress->image) }}"
                            style="
                                width:100%;
                                max-width:700px;
                                border-radius:12px;
                                margin-bottom:15px;
                            "
                        >

                        @if($progress->artist_note)

                            <p>
                                <strong>Artist Note:</strong>
                            </p>

                            <p>
                                {{ $progress->artist_note }}
                            </p>

                        @endif

                        @if($progress->customer_note)

                            <div
                                style="
                                    margin-top:10px;
                                    padding:12px;
                                    background:#f3f4f6;
                                    border-radius:10px;
                                "
                            >

                                <strong>Revision Note:</strong><br>

                                {{ $progress->customer_note }}

                            </div>

                        @endif
                        @if($progress->status == 'pending')

                        <hr
                            style="
                                margin-top:15px;
                                margin-bottom:15px;
                                border:none;
                                border-top:1px solid #e5e7eb;
                            "
                        >

                            <div style="margin-top:15px;">

                                <textarea
                                    name="customer_note"
                                    form="revisionForm{{ $progress->id }}"
                                    placeholder="Revision note..."
                                    required
                                    style="
                                        width:100%;
                                        height:80px;
                                        padding:10px;
                                        border:1px solid #d1d5db;
                                        border-radius:10px;
                                        resize:none;
                                        margin-bottom:10px;
                                    "
                                ></textarea>

                                <div
                                    style="
                                        display:flex;
                                        gap:10px;
                                    "
                                >

                                    <form
                                        action="{{ route('progress.accept',$progress->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            style="
                                                background:#16a34a;
                                                color:white;
                                                border:none;
                                                padding:10px 20px;
                                                border-radius:10px;
                                                font-weight:700;
                                                cursor:pointer;
                                            "
                                        >
                                            Approve
                                        </button>

                                    </form>

                                    <form
                                        id="revisionForm{{ $progress->id }}"
                                        action="{{ route('progress.reject',$progress->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            style="
                                                background:#dc2626;
                                                color:white;
                                                border:none;
                                                padding:10px 20px;
                                                border-radius:10px;
                                                font-weight:700;
                                                cursor:pointer;
                                            "
                                        >
                                            Request Revision
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endif

                    </div>

                    @endforeach

                </div>

            </div>

            @endforeach

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