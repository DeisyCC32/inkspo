<x-app-layout>
<div class="p-6">

    {{-- TITLE --}}
    <h1
        style="
            font-size:60px;
            font-weight:900;
            color:white;
            text-align:center;
            margin-top:100px;
            margin-bottom:80px;
        "
    >
        Artist Dashboard
    </h1>

    {{-- TOP BUTTONS --}}
    <div
        style="
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            gap:25px;
            margin-bottom:50px;
        "
    >

        {{-- SERVICES --}}
        <button onclick="showSection('services')" class="dashboard-card">

            <img src="{{ asset('images/commission.png') }}" class="dashboard-icon">

            <div>
                <div class="dashboard-label">Services</div>
                <div class="dashboard-number" style="color:#362417;">
                    {{ $totalServices }}
                </div>
            </div>

        </button>

        {{-- COMPLETED --}}
        <button onclick="showSection('completed')" class="dashboard-card">

            <img src="{{ asset('images/completed.png') }}" class="dashboard-icon">

            <div>
                <div class="dashboard-label">Completed</div>
                <div class="dashboard-number" style="color:#362417;">
                    {{ $completedOrders }}
                </div>
            </div>

        </button>

        {{-- ACTIVE --}}
        <button onclick="showSection('active')" class="dashboard-card">

            <img src="{{ asset('images/pending.png') }}" class="dashboard-icon">

            <div>
                <div class="dashboard-label">Active</div>
                <div class="dashboard-number" style="color:#362417;">
                    {{ $activeOrders }}
                </div>
            </div>

        </button>

        {{-- QUEUE --}}
        <button onclick="showSection('queue')" class="dashboard-card">

            <img src="{{ asset('images/queue.png') }}" class="dashboard-icon">

            <div>
                <div class="dashboard-label">Queue</div>
                <div class="dashboard-number" style="color:#362417;">
                    {{ $queueOrders }}
                </div>
            </div>

        </button>

        {{-- REVIEWS --}}
        <button onclick="showSection('reviews')" class="dashboard-card">

            <img src="{{ asset('images/review.png') }}" class="dashboard-icon">

            <div>
                <div class="dashboard-label">Reviews</div>
                <div class="dashboard-number" style="color:#362417;">
                    {{ number_format($averageRating ?? 0, 1) }}
                </div>
            </div>

        </button>

    </div>

    {{-- SERVICES SECTION --}}
    <div id="services" class="dashboard-section">

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:30px;
            "
        >

            <h2
                class="section-title"
                style="
                    margin:0;
                    color:white;
                "
            >
                My Services
            </h2>

            <a
                href="{{ route('services.create') }}"
                style="
                    background:white;
                    border-radius:22px;
                    padding:16px 28px;
                    display:flex;
                    align-items:center;
                    gap:10px;
                    text-decoration:none;
                    box-shadow:0 10px 25px rgba(0,0,0,.15);
                    font-weight:800;
                    color:#111827;
                    min-width:180px;
                    justify-content:center;
                "
            >

                <span
                    style="
                        font-size:24px;
                        font-weight:900;
                        
                    "
                >
                    
                </span>

                Add Service

            </a>

        </div>

        <div class="service-grid">

            @forelse($services as $service)

                <div class="service-card">

                    @if($service->image)

                        <img
                            src="{{ asset('storage/'.$service->image) }}"
                            class="service-image"
                        >

                    @else

                        <div class="service-placeholder">
                            No Image
                        </div>

                    @endif

                    <div style="padding:20px;">

                        <h3 class="service-title">
                            {{ $service->title }}
                        </h3>

                        <p class="service-description">
                            {{ $service->description }}
                        </p>

                        <div
                            style="
                                display:flex;
                                justify-content:space-between;
                                align-items:center;
                                margin-top:15px;
                                margin-bottom:15px;
                            "
                        >

                            <div
                                style="
                                    display:flex;
                                    justify-content:space-between;
                                    align-items:center;
                                    margin-top:15px;
                                    margin-bottom:15px;
                                "
                            >

                                <div
                                    style="
                                        display:flex;
                                        justify-content:space-between;
                                        align-items:center;
                                        margin-top:10px;
                                        margin-bottom:15px;
                                    "
                                >

                                    <p
                                        class="service-price"
                                        style="
                                            margin:0;
                                            color:#000500;
                                        "
                                    >
                                        Rp {{ number_format($service->price,0,',','.') }}
                                    </p>


                                </div>


                            </div>

                            <div
                                style="
                                    font-weight:800;
                                    color:#000500;
                                    font-size:18px;
                                "
                            >
                                ★ {{ number_format($service->orders_avg_rating ?? 0, 1) }}
                            </div>

                        </div>

                        {{-- BUTTONS --}}
                        <div
                            style="
                                display:flex;
                                gap:10px;
                                margin-top:20px;
                            "
                        >

                        <a
                            href="{{ route('services.show', $service->id) }}"
                            style="
                                background:white;
                                color:black;
                                border:2px solid #000500;
                                padding:8px 18px;
                                border-radius:10px;
                                text-decoration:none;
                                font-weight:700;
                            "
                        >
                            View
                        </a>

                        <a
                            href="{{ route('services.edit', $service->id) }}"
                            style="
                                background:#3e3f40;
                                color:white;
                                border:2px solid #000500;
                                padding:8px 18px;
                                border-radius:10px;
                                text-decoration:none;
                                font-weight:700;
                            "
                        >
                            Edit
                        </a>

                    <form
                        action="{{ route('services.destroy', $service->id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this service?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                                background:black;
                                color:white;
                                border:2px solid #374151;
                                padding:8px 18px;
                                border-radius:10px;
                                font-weight:700;
                                cursor:pointer;
                            "
                        >
                            Delete
                        </button>

                    </form>

                    

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <p style="color:white;">
                    Belum ada service.
                </p>

            @endforelse

        </div>

    </div>

    {{-- COMPLETED --}}
    <div id="completed" class="dashboard-section hidden">

        <h2 class="section-title" style="color:white;">
            Completed Orders
        </h2>

        <div
            style="
                display:grid;
                grid-template-columns:repeat(2,1fr);
                gap:30px;
                width:100%;
            ">

            @forelse($completedOrderList as $order)

                <div
                    style="
                        background:#f8fafc;
                        padding:30px;
                        border-radius:25px;
                        box-shadow:0 5px 20px rgba(0,0,0,.08);
                    ">

                    {{-- CUSTOMER --}}
                    <div
                        style="
                            display:flex;
                            align-items:center;
                            gap:15px;
                            margin-bottom:20px;
                        ">

                        @if($order->customer->profile_picture)

                            <img
                                src="{{ asset('storage/'.$order->customer->profile_picture) }}"
                                style="
                                    width:60px;
                                    height:60px;
                                    border-radius:999px;
                                    object-fit:cover;
                                ">

                        @else

                            <div
                                style="
                                    width:60px;
                                    height:60px;
                                    border-radius:999px;
                                    background:#ddd;
                                ">
                            </div>

                        @endif

                        <h3
                            style="
                                font-size:24px;
                                font-weight:900;
                                margin:0;
                            ">
                            {{ $order->customer->name }}
                        </h3>

                    </div>

                    {{-- SERVICE --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin-bottom:5px;
                        ">
                        Service
                    </p>

                    <p style="margin-bottom:15px;">
                        {{ $order->service->title }}
                    </p>

                    {{-- PRICE --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin-bottom:5px;
                        ">
                        Price
                    </p>

                    <p style="margin-bottom:20px;">
                        Rp {{ number_format($order->service->price,0,',','.') }}
                    </p>

                    {{-- DESCRIPTION --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin-bottom:10px;
                        ">
                        Description
                    </p>

                    <p
                        style="
                            margin-bottom:20px;
                            line-height:1.6;
                        ">
                        {{ $order->description }}
                    </p>

                    {{-- REFERENCE --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:200;
                            margin-bottom:10px;
                        ">
                        Reference
                    </p>

                    @if($order->reference_image)

                        <img
                            src="{{ asset('storage/'.$order->reference_image) }}"
                            style="
                                width:100%;
                                max-height:500px;
                                object-fit:contain;
                                background:#f1f5f9;
                                border-radius:20px;
                                margin-bottom:20px;
                            ">

                    @endif

                    {{-- FINAL ARTWORK --}}
                    <p
                        style="
                            font-weight:700;
                            margin-bottom:10px;
                        ">
                        Final Artwork
                    </p>

                    @if($order->progresses->count())

                    <hr style="margin:30px 0;">

                    <h3
                        style="
                            font-size:24px;
                            font-weight:900;
                            margin-bottom:20px;
                        ">
                        Progress History
                    </h3>

                    @foreach(
                        $order->progresses
                            ->sortBy('created_at')
                        as $progress
                    )

                    <div
                        style="
                            border:1px solid #e5e7eb;
                            border-radius:20px;
                            padding:20px;
                            margin-bottom:20px;
                            background:#fafafa;
                        ">

                        <div
                            style="
                                display:flex;
                                justify-content:space-between;
                                align-items:center;
                                margin-bottom:15px;
                            ">

                            <strong>
                                {{ ucfirst($progress->phase) }}
                            </strong>

                            @if($progress->status == 'pending')

                                <span
                                    style="
                                        color:#ca8a04;
                                        font-weight:800;
                                    ">
                                    Pending Review
                                </span>

                            @elseif($progress->status == 'accepted')

                                <span
                                    style="
                                        color:#16a34a;
                                        font-weight:800;
                                    ">
                                    Approved
                                </span>

                            @else

                                <span
                                    style="
                                        color:#dc2626;
                                        font-weight:800;
                                    ">
                                    Revision Requested
                                </span>

                            @endif

                        </div>

                        <img
                            src="{{ asset('storage/'.$progress->image) }}"
                            style="
                                width:100%;
                                max-width:700px;
                                max-height:450px;
                                object-fit:contain;
                                border-radius:15px;
                                background:#fff;
                                border:1px solid #ddd;
                                margin-bottom:15px;
                            ">

                        @if($progress->artist_note)

                            <p>
                                <strong>Artist Note:</strong>
                            </p>

                            <p>
                                {{ $progress->artist_note }}
                            </p>

                        @endif

                    </div>

                    @endforeach

                    @endif

                    @if($order->result_image)

                        <img
                            src="{{ asset('storage/'.$order->result_image) }}"
                            style="
                                width:100%;
                                max-height:600px;
                                object-fit:contain;
                                background:#f1f5f9;
                                border-radius:20px;
                                margin-bottom:20px;
                            ">

                    @else

                        <p
                            style="
                                color:#6b7280;
                                font-style:italic;
                            ">
                            Artwork not uploaded yet.
                        </p>

                    @endif
                

                </div>

            @empty

                <p style="color:white;">
                    No completed orders.
                </p>

            @endforelse

        </div>
    </div>

    {{-- ACTIVE --}}
    <div id="active" class="dashboard-section hidden">

        <h2 class="section-title"
            style="color:white;">
            Active Orders
        </h2>

        <div
            style="
                display:grid;
                grid-template-columns:repeat(2,1fr);
                gap:30px;
                width:100%;
            ">

            @forelse($activeOrderList as $order)

                <div
                    style="
                        background:#f8fafc;
                        padding:30px;
                        border-radius:25px;
                        box-shadow:0 5px 20px rgba(0,0,0,.08);
                    ">

                    {{-- CUSTOMER --}}
                    <div
                        style="
                            display:flex;
                            align-items:center;
                            gap:15px;
                            margin-bottom:20px;
                        ">

                        @if($order->customer->profile_picture)

                            <img
                                src="{{ asset('storage/'.$order->customer->profile_picture) }}"
                                style="
                                    width:60px;
                                    height:60px;
                                    border-radius:999px;
                                    object-fit:cover;
                                ">

                        @else

                            <div
                                style="
                                    width:60px;
                                    height:60px;
                                    border-radius:999px;
                                    background:#ddd;
                                ">
                            </div>

                        @endif

                        <h3
                            style="
                                font-size:24px;
                                font-weight:900;
                                margin:0;
                            ">
                            {{ $order->customer->name }}
                        </h3>

                    </div>

                    {{-- SERVICE --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin-bottom:5px;
                        ">
                        Service
                    </p>

                    <p style="margin-bottom:15px;">
                        {{ $order->service->title }}
                    </p>

                    {{-- PRICE --}}
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin-bottom:5px;
                        ">
                        Price
                    </p>

                    <p style="margin-bottom:15px;">
                        Rp {{ number_format($order->service->price,0,',','.') }}
                    </p>

                    <div

                        @php

                        $approvedCount =
                            $order->progresses
                                ->where('status','accepted')
                                ->count();

                        @endphp

                        
                        <div 
                        onclick="document.getElementById('progressModal{{ $order->id }}').style.display='flex'"
                        style="
                            margin:20px 0;
                            cursor:pointer;
                        ">

                        <p
                            style="
                                color:#000500;
                                font-weight:700;
                                margin-bottom:15px;
                            ">
                            Progress (Click here to submit your progress)
                        </p>

                        <div
                            style="
                                width:100%;
                                padding:0 10px;
                            ">

                            <div
                                style="
                                    display:flex;
                                    justify-content:space-between;
                                    align-items:center;
                                    position:relative;
                                    margin-bottom:10px;
                                ">

                                <div
                                    style="
                                        position:absolute;
                                        left:0;
                                        right:0;
                                        height:4px;
                                        background:#d1d5db;
                                        top:50%;
                                        transform:translateY(-50%);
                                        z-index:1;
                                    ">
                                </div>

                                <div
                                    style="
                                        position:absolute;
                                        left:0;
                                        top:50%;
                                        transform:translateY(-50%);
                                        height:4px;
                                        background:#2c7efa;
                                        z-index:1;

                                        width:
                                        {{
                                            $approvedCount == 0 ? '0%' :
                                            ($approvedCount == 1 ? '33%' :
                                            ($approvedCount == 2 ? '66%' :
                                            '100%'))
                                        }};
                                    ">
                                </div>
        

                                @php

                                $currentStep = $approvedCount + 1;

                                if($currentStep > 4)
                                {
                                    $currentStep = 4;
                                }

                                @endphp

                                @for($i = 1; $i <= 4; $i++)

                                <div
                                    style="
                                        width:24px;
                                        height:24px;
                                        border-radius:999px;
                                        z-index:2;

                                        {{ $i <= $currentStep
                                            ? 'background:#2c7efa;'
                                            : 'border:4px solid #9ca3af;background:white;' }}
                                    ">
                                </div>

                                @endfor
                            </div>

                            <div
                                style="
                                    display:flex;
                                    justify-content:space-between;
                                    font-size:13px;
                                    font-weight:700;
                                    color:#374151;
                                ">

                                <span>Sketch</span>
                                <span>Lineart</span>
                                <span>Render</span>
                                <span>Finish</span>

                            </div>

                        </div>

                    </div>
                    
                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin:15px 0 5px 0;
                        ">
                        Due Date
                    </p>

                    <p>
                        {{ \Carbon\Carbon::parse($order->due_date)->format('d M Y H:i') }}
                    </p>

                    <p
                        id="countdown-{{ $order->id }}"
                        style="
                            color:#de4141;
                            font-weight:800;
                            font-size:20px;
                            margin-top:10px;
                        ">
                    </p>

                    <script>

                    (function(){

                        const countdownElement =
                            document.getElementById(
                                "countdown-{{ $order->id }}"
                            );

                        const dueDate =
                            new Date(
                                "{{ \Carbon\Carbon::parse($order->due_date)->format('Y-m-d H:i:s') }}"
                            ).getTime();

                        function updateCountdown()
                        {
                            const now = new Date().getTime();

                            const distance = dueDate - now;

                            if(distance <= 0)
                            {
                                countdownElement.innerHTML =
                                    "Deadline Reached";

                                return;
                            }

                            const days =
                                Math.floor(
                                    distance /
                                    (1000 * 60 * 60 * 24)
                                );

                            const hours =
                                Math.floor(
                                    (distance %
                                    (1000 * 60 * 60 * 24))
                                    /
                                    (1000 * 60 * 60)
                                );

                            const minutes =
                                Math.floor(
                                    (distance %
                                    (1000 * 60 * 60))
                                    /
                                    (1000 * 60)
                                );

                            const seconds =
                                Math.floor(
                                    (distance %
                                    (1000 * 60))
                                    /
                                    1000
                                );

                            countdownElement.innerHTML =
                                days + "d "
                                + hours + "h "
                                + minutes + "m "
                                + seconds + "s remaining";
                        }

                        updateCountdown();

                        setInterval(
                            updateCountdown,
                            1000
                        );

                    })();

                    </script>


                    {{-- DESCRIPTION --}}
                    <p
                        style="
                            font-weight:700;
                            margin-bottom:10px;
                        ">
                        Description
                    </p>

                    <p
                        style="
                            margin-bottom:20px;
                            line-height:1.6;
                        ">
                        {{ $order->description }}
                    </p>

                    {{-- REFERENCE --}}
                    <p
                        style="
                            font-weight:700;
                            margin-bottom:10px;
                        ">
                        Reference
                    </p>

                    @if($order->reference_image)

                        <img
                            src="{{ asset('storage/'.$order->reference_image) }}"
                            style="
                                width:100%;
                                max-height:700px;
                                object-fit:contain;
                                background:#f1f5f9;
                                border-radius:20px;
                                margin-bottom:25px;
                            ">

                    @endif

                    {{-- UPLOAD ARTWORK --}}
                    <p
                        style="
                            font-weight:700;
                            margin-bottom:10px;
                        ">
                        Upload Final Artwork
                    </p>

                    <form
                        action="{{ route('orders.uploadResult',$order->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input
                            type="file"
                            name="result_image"
                            required
                            style="
                                width:100%;
                                padding:10px;
                                margin-bottom:15px;
                            ">
                     
                        <button
                            type="submit"
                            style="
                                background:#ffffff;
                                color:#000500;
                                border:3px solid #000500;
                                border-radius:15px;
                                padding:12px 25px;
                                font-weight:800;
                                cursor:pointer;
                            ">

                            Submit Artwork

                        </button>

</form>

{{-- PROGRESS MODAL --}}
<div
    id="progressModal{{ $order->id }}"
    style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.75);
        z-index:99999;
        justify-content:center;
        align-items:center;
    ">

    <div
        style="
            width:850px;
            max-width:95%;
            background:white;
            border-radius:30px;
            padding:40px;
            max-height:90vh;
            overflow-y:auto;
        ">

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:25px;
            ">

            <h2
                style="
                    font-size:32px;
                    font-weight:900;
                ">
                Progress Tracking
            </h2>

            <button
                type="button"
                onclick="document.getElementById('progressModal{{ $order->id }}').style.display='none'"
                style="
                    border:none;
                    background:none;
                    font-size:28px;
                    cursor:pointer;
                ">
                ✕
            </button>

        </div>

        @if($order->progresses->count())

        <hr style="margin:20px 0;">

        <h3
            style="
                font-size:22px;
                font-weight:900;
                margin-bottom:20px;
            "
        >
            Progress History
        </h3>

        @php
        $groupedProgress =
            $order->progresses
                ->sortBy('created_at')
                ->groupBy('phase');
        @endphp

        @foreach($groupedProgress as $phase => $phaseProgresses)

        <details
            style="
                border:1px solid #e5e7eb;
                border-radius:15px;
                margin-bottom:15px;
                overflow:hidden;
            "
        >
            <summary
                style="
                    padding:15px;
                    cursor:pointer;
                    font-weight:800;
                    background:#f8fafc;
                "
            >
                {{ ucfirst($phase) }}
            </summary>

            <div style="padding:15px;">

                @foreach($phaseProgresses as $progress)

                <details
                    style="
                        border:1px solid #e5e7eb;
                        border-radius:12px;
                        margin-bottom:10px;
                    "
                >
                    <summary
                        style="
                            padding:12px;
                            cursor:pointer;
                            font-weight:700;
                        "
                    >

                        {{ ucfirst($phase) }}

                        @if($progress->status == 'accepted')
                            <span style="color:#16a34a;">
                                (Approved)
                            </span>
                        @elseif($progress->status == 'rejected')
                            <span style="color:#dc2626;">
                                (Revision Requested)
                            </span>
                        @else
                            <span style="color:#ca8a04;">
                                (Pending Review)
                            </span>
                        @endif

                    </summary>

                    <div style="padding:15px;">

                        <img
                            src="{{ asset('storage/'.$progress->image) }}"
                            style="
                                width:100%;
                                max-height:350px;
                                object-fit:contain;
                                border-radius:12px;
                                margin-bottom:10px;
                            "
                        >

                        @if($progress->artist_note)
                        <div
                            style="
                                background:#f9fafb;
                                padding:10px;
                                border-radius:10px;
                                margin-bottom:10px;
                            "
                        >
                            <strong>Artist Note:</strong><br>
                            {{ $progress->artist_note }}
                        </div>
                        @endif

                        @if($progress->customer_note)
                        <div
                            style="
                                background:#fef2f2;
                                padding:10px;
                                border-radius:10px;
                            "
                        >
                            <strong>Revision Note:</strong><br>
                            {{ $progress->customer_note }}
                        </div>
                        @endif

                    </div>

                </details>

                @endforeach

            </div>

        </details>

        @endforeach

        @endif


        <form
            action="{{ route('progress.store',$order->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <label
                style="
                    display:block;
                    font-weight:700;
                    margin-bottom:10px;
                ">
                Phase
            </label>

            @php

                $lastApproved =
                    $order->progresses
                        ->where('status', 'accepted')
                        ->sortByDesc('created_at')
                        ->first();

                $currentPhase = 'Sketch';

                if ($lastApproved)
                {
                    if ($lastApproved->phase === 'sketch')
                    {
                        $currentPhase = 'Lineart';
                    }
                    elseif ($lastApproved->phase === 'lineart')
                    {
                        $currentPhase = 'Render';
                    }
                    elseif ($lastApproved->phase === 'render')
                    {
                        $currentPhase = 'Finish';
                    }
                }

            @endphp

            <div
                style="
                    background:#f3f4f6;
                    padding:15px;
                    border-radius:15px;
                    margin-bottom:20px;
                ">

                <p
                    style="
                        font-size:12px;
                        color:#6b7280;
                        margin-bottom:5px;
                    ">
                    Current Phase
                </p>

                <p
                    style="
                        font-size:24px;
                        font-weight:900;
                    ">
                    {{ $currentPhase }}
                </p>

            </div>

            <label
                style="
                    display:block;
                    font-weight:700;
                    margin-bottom:10px;
                ">
                Upload Progress Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/*"
                required
                onchange="previewProgressImage(event, {{ $order->id }})"
                style="
                    margin-bottom:20px;
                ">

            <img
                id="preview{{ $order->id }}"
                style="
                    display:none;
                    width:100%;
                    max-height:500px;
                    object-fit:contain;
                    background:#f8fafc;
                    border-radius:20px;
                    margin-bottom:20px;
                ">

            <label
                style="
                    display:block;
                    font-weight:700;
                    margin-bottom:10px;
                ">
                Artist Note
            </label>

            <textarea
                name="artist_note"
                rows="5"
                style="
                    width:100%;
                    border:1px solid #ddd;
                    border-radius:15px;
                    padding:15px;
                    margin-bottom:20px;
                "
                placeholder="Write progress note..."></textarea>

            <button
                type="submit"
                style="
                    background:#2563eb;
                    color:white;
                    border:none;
                    padding:14px 30px;
                    border-radius:15px;
                    font-weight:700;
                    cursor:pointer;
                ">

                Send {{ $currentPhase }}

            </button>

        </form>

    </div>

</div>

</div>

@empty

                <p style="color:white;">
                    No active orders.
                </p>

            @endforelse

        </div>

    </div>

    {{-- QUEUE --}}

<div id="queue" class="dashboard-section hidden">

    <h2 class="section-title"
    style=color:white;
    >
        Order Queue
    </h2>

    <div
        style="
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:30px;
            width:100%;
        ">

        @forelse($latestQueueOrders as $order)

        <div
            style="
                background:#f8fafc;
                padding:30px;
                border-radius:25px;
                box-shadow:0 5px 20px rgba(0,0,0,.08);
                width:100%;
                min-width:0;
                overflow:hidden;
            ">

            <div
                style="
                    display:flex;
                    align-items:center;
                    gap:15px;
                    margin-bottom:20px;
                ">

                @if($order->customer->profile_picture)

                    <img
                        src="{{ asset('storage/'.$order->customer->profile_picture) }}"
                        style="
                            width:60px;
                            height:60px;
                            border-radius:999px;
                            object-fit:cover;
                        ">

                @else

                    <div
                        style="
                            width:60px;
                            height:60px;
                            border-radius:999px;
                            background:#ddd;
                        ">
                    </div>

                @endif

                <h3
                    style="
                        font-size:24px;
                        font-weight:900;
                        margin:0;
                    ">
                    {{ $order->customer->name }}
                </h3>

            </div>

            <div
                style="
                    display:flex;
                    gap:50px;
                    flex-wrap:wrap;
                    margin-bottom:25px;
                ">

                <div>

                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin:0 0 5px 0;
                            font-size:18px;
                        ">
                        Service
                    </p>

                    <p style="margin:0;">
                        {{ $order->service->title }}
                    </p>

                    @if($order->status == 'awaiting_payment')

                        <div
                            style="
                                background:#dc2626;
                                color:white;
                                padding:6px 14px;
                                border-radius:999px;
                                display:inline-block;
                                font-weight:800;
                                margin-top:10px;
                            ">
                            Waiting Payment
                        </div>

                    @endif

                    @if($order->status == 'pending')

                        <div
                            style="
                                background:#f59e0b;
                                color:white;
                                padding:6px 14px;
                                border-radius:999px;
                                display:inline-block;
                                font-weight:800;
                                margin-top:10px;
                            ">
                            Pending
                        </div>

                    @endif

                </div>

                <div>

                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin:0 0 5px 0;
                            font-size:18px;
                        ">
                        Price
                    </p>

                    <p style="margin:0;">
                        Rp {{ number_format($order->service->price,0,',','.') }}
                    </p>

                </div>

                <div>

                    <p
                        style="
                            color:#000500;
                            font-weight:700;
                            margin:0 0 5px 0;
                            font-size:18px;
                        ">
                        Due Date
                    </p>

                    <p style="margin:0;">
                        {{ $order->due_date ?? '-' }}
                    </p>

                </div>

            </div>

            <p
                style="
                    color:#000500;
                    font-weight:700;
                    margin-bottom:8px;
                ">
                Description
            </p>

            <p
                style="
                    margin-bottom:20px;
                    line-height:1.6;
                ">
                {{ $order->description }}
            </p>

            <p
                style="
                    color:#000500;
                    font-weight:700;
                    margin-bottom:10px;
                ">
                Reference
            </p>

            @if($order->reference_image)

                <img
                    src="{{ asset('storage/'.$order->reference_image) }}"
                    style="
                        width:100%;
                        height:600px;
                        object-fit:contain;
                        border-radius:20px;
                        margin-bottom:20px;
                        background:#f1f5f9;
                    "
                >

            @else

                <p>No reference image</p>

            @endif

            @if($order->status == 'pending')

                <div
                    style="
                        display:flex;
                        gap:10px;
                        margin-top:10px;
                    ">

                    <form
                        action="{{ route('orders.accept',$order->id) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            style="
                                background:#ffffff;
                                color:#000500;
                                border:3px solid #000500;
                                border-radius:15px;
                                padding:10px 25px;
                                font-weight:800;
                                cursor:pointer;
                            ">
                            Accept
                        </button>

                    </form>

                    <form
                        action="{{ route('orders.reject',$order->id) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            style="
                                background:#000500;
                                color:white;
                                border:3px solid #000500;
                                border-radius:15px;
                                padding:10px 25px;
                                font-weight:800;
                                cursor:pointer;
                            ">
                            Reject
                        </button>

                    </form>

                </div>

            @endif

        </div>

    @empty

        <p
            style="
                color:#ffffff;
                margin-bottom:8px;
            ">
            Tidak ada request baru.
        </p>

    @endforelse

    </div>


    </div>


</div>

{{-- STYLE --}}
<style>

.dashboard-card{
    width:260px;
    height:90px;
    border:none;
    border-radius:24px;
    background:white;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
    display:flex;
    align-items:center;
    padding:15px;
    cursor:pointer;
}

.dashboard-icon{
    width:40px;
    height:40px;
    object-fit:contain;
    margin-right:12px;
}

.dashboard-label{
    font-weight:700;
    color:#666;
}

.dashboard-number{
    font-size:28px;
    font-weight:900;
}

.dashboard-section{
    max-width:1800px;
    margin:auto;
    background:rgba(0, 0, 0, 0.659);
    border-radius:24px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.section-title{
    font-size:32px;
    font-weight:900;
    margin-bottom:25px;
}

.service-grid{
    display:grid;
    grid-template-columns:repeat(3,minmax(0,1fr));
    gap:25px;
}

.service-card{
    background:#f8fafc;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.service-image{
    width:100%;
    height:220px;
    object-fit:cover;
}

.service-placeholder{
    width:100%;
    height:220px;
    background:#ddd;
    display:flex;
    align-items:center;
    justify-content:center;
}

.service-title{
    font-size:22px;
    font-weight:800;
    margin-bottom:10px;
}

.service-description{
    color:#555;
    margin-bottom:15px;
}

.service-price{
    font-size:20px;
    font-weight:800;
    color:#362417;
}

.list-card{
    border-bottom:1px solid #ddd;
    padding:20px 0;
}

.hidden{
    display:none;
}

</style>

{{-- SCRIPT --}}
<script>

function previewProgressImage(event, orderId)
{
    const image =
        document.getElementById(
            'preview' + orderId
        );

    image.src =
        URL.createObjectURL(
            event.target.files[0]
        );

    image.style.display = 'block';
}

function showSection(id)
{
    document
        .querySelectorAll('.dashboard-section')
        .forEach(section =>
        {
            section.classList.add('hidden');
        });

    document
        .getElementById(id)
        .classList.remove('hidden');
}

</script>

</x-app-layout>

