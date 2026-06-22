{{-- REVIEW MODAL --}}
<div
    id="reviewModal"
    style="
        display:none;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,.6);
        z-index:99999;
        justify-content:center;
        align-items:center;
    "
>

    <div
        style="
            width:700px;
            max-width:90%;
            max-height:80vh;
            overflow-y:auto;
            background:white;
            border-radius:25px;
            padding:30px;
            position:relative;
        "
    >

        <button
            onclick="closeReviewModal()"
            style="
                position:absolute;
                right:20px;
                top:15px;
                border:none;
                background:none;
                font-size:32px;
                cursor:pointer;
                font-weight:900;
            "
        >
            ×
        </button>

        <h2
            style="
                font-size:32px;
                font-weight:900;
                margin-bottom:25px;
            "
        >
            Customer Reviews
        </h2>

        @forelse(
            $service->orders()
                ->whereNotNull('rating')
                ->whereNotNull('review')
                ->get()
            as $order
        )

            <div
                style="
                    border-bottom:1px solid #e5e7eb;
                    padding:20px 0;
                "
            >

                <div
                    style="
                        font-weight:800;
                        font-size:18px;
                    "
                >
                    {{ $order->customer->name }}
                </div>

                <div
                    style="
                        color:#f59e0b;
                        font-size:20px;
                        margin:5px 0;
                    "
                >
                    {{ str_repeat('★', $order->rating) }}
                </div>

                <p
                    style="
                        color:#374151;
                        line-height:1.7;
                        margin-bottom:15px;
                    "
                >
                    {{ $order->review }}
                </p>

                @if($order->result_image)

                    <img
                        src="{{ asset('storage/'.$order->result_image) }}"
                        style="
                            width:100%;
                            max-height:300px;
                            object-fit:contain;
                            background:#f8fafc;
                            border-radius:15px;
                            border:1px solid #e5e7eb;
                            padding:10px;
                        "
                    >

                @endif

            </div>

        @empty

            <p
                style="
                    color:#6b7280;
                "
            >
                No reviews yet.
            </p>

        @endforelse

    </div>

</div>

<script>

function openReviewModal()
{
    document
        .getElementById('reviewModal')
        .style.display = 'flex';
}

function closeReviewModal()
{
    document
        .getElementById('reviewModal')
        .style.display = 'none';
}

window.onclick = function(event)
{
    const modal =
        document.getElementById(
            'reviewModal'
        );

    if(event.target === modal)
    {
        closeReviewModal();
    }
}

</script>
<x-app-layout>

<div
    style="
        max-width:1200px;
        margin:120px auto 50px auto;
        padding:30px;
    "
>

    <div
        style="
            max-width:1200px;
            margin:auto;
            background:white;
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,.15);

            display:grid;
            grid-template-columns:1.2fr 1fr;
        "
    >

        {{-- IMAGE --}}
        <div
            style="
                background:#f5f5f5;
                display:flex;
                justify-content:center;
                align-items:center;
                padding:20px;
            "
        >

            @if($service->image)

                <img
                    src="{{ asset('storage/'.$service->image) }}"
                    style="
                        width:100%;
                        max-height:650px;
                        object-fit:contain;
                    "
                >

            @endif

        </div>

        {{-- RIGHT SIDE --}}
        <div
            style="
                padding:50px;
                display:flex;
                flex-direction:column;
                justify-content:center;
            "
        >

            <h1
                style="
                    font-size:48px;
                    font-weight:900;
                    margin-bottom:15px;
                "
            >
                {{ $service->title }}
            </h1>

            <div
                onclick="openReviewModal()"
                style="
                    font-size:22px;
                    font-weight:700;
                    margin-bottom:25px;
                    cursor:pointer;
                "
            >
                <div
                    onclick="openReviewModal()"
                    style="
                        font-size:22px;
                        font-weight:700;
                        margin-bottom:25px;
                        cursor:pointer;
                    "
                >
                    ★
                    {{
                        number_format(
                            $service->orders()
                                ->whereNotNull('rating')
                                ->avg('rating') ?? 0,
                            1
                        )
                    }}
                </div>
            </div>

            <p
                style="
                    color:#444;
                    line-height:1.8;
                    margin-bottom:30px;
                "
            >
                {{ $service->description }}
            </p>

            <hr style="margin-bottom:30px;">

            <p
                style="
                    font-size:18px;
                    color:#666;
                "
            >
                Artist
            </p>

            <h3
                style="
                    font-size:28px;
                    font-weight:800;
                    margin-bottom:25px;
                "
            >
                {{ $service->user->name }}
            </h3>

            <p
                style="
                    font-size:42px;
                    font-weight:900;
                    color:#000500;
                    margin-bottom:20px;
                "
            >
                Rp {{ number_format($service->price,0,',','.') }}
            </p>

            <p
                style="
                    font-size:20px;
                    margin-bottom:40px;
                "
            >
                Delivery Time:
                {{ $service->delivery_time }} Days
            </p>

            @auth

                @if(auth()->user()->role === 'customer')

                    <a
                        href="{{ route('orders.create',$service->id) }}"
                        style="
                            background:#000500;
                            color:white;
                            text-decoration:none;
                            text-align:center;
                            padding:18px;
                            border-radius:15px;
                            font-weight:800;
                            font-size:18px;
                            display:block;
                        "
                    >
                        Commission Now
                    </a>

                @endif

            @endauth

        </div>

    </div>

</x-app-layout>