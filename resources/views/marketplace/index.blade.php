<x-app-layout>

<div>

    {{-- HERO SECTION --}}
    <section
        style="
        position:relative;
        min-height:70vh;
        display:flex;
        align-items:center;
        justify-content:center;
        ">

        <div
            style="
            width:100%;
            text-align:center;
            padding:0 20px;
            ">

            <h1
                style="
                font-size:90px;
                font-weight:900;
                color:white;
                margin-bottom:20px;
                line-height:1;
                ">

                Temukan Artist Favoritmu

            </h1>

            <p
                style="
                font-size:32px;
                font-weight:700;
                color:white;
                margin-bottom:40px;
                ">

                Commission artwork dengan mudah dan aman di Inkspo

            </p>

            <form
                method="GET"
                action="{{ route('marketplace') }}"
                style="
                max-width:900px;
                margin:auto;
                ">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari artist atau commission..."
                    style="
                    width:100%;
                    padding:22px 30px;
                    border:none;
                    border-radius:999px;
                    font-size:20px;
                    ">

            </form>

        </div>

    </section>

    {{-- COMMISSION SERVICES --}}
    <div
        style="
        width:90%;
        max-width:1400px;
        margin:80px auto;
        padding:50px;
        background:rgba(255,255,255,.92);
        backdrop-filter:blur(10px);
        border-radius:30px;
        box-shadow:0 10px 40px rgba(0,0,0,.15);
        ">

        <h2
            style="
            font-size:48px;
            font-weight:900;
            margin-bottom:15px;
            ">

            Commission Services

        </h2>

        <p
            style="
            font-size:22px;
            color:#404040;
            margin-bottom:40px;
            ">

            Jelajahi berbagai layanan ilustrasi dari artist terbaik di Inkspo.

        </p>

        <div
            style="
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:24px;
            ">

            @foreach($services as $service)

            <div
                style="
                width:100%;
                background:white;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 5px 20px rgba(0,0,0,.08);
                ">

                @if($service->image)

                    <img
                        src="{{ asset('storage/'.$service->image) }}"
                        alt="{{ $service->title }}"
                        style="
                        width:100%;
                        height:260px;
                        object-fit:cover;
                        ">

                @else

                    <div
                        style="
                        height:260px;
                        background:#d9d9d9;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        color:#888;
                        ">

                        No Image

                    </div>

                @endif

                <div style="padding:18px;">

                    <div
                        style="
                        display:flex;
                        align-items:center;
                        gap:10px;
                        margin-bottom:15px;
                        ">

                        <div
                            style="
                            width:42px;
                            height:42px;
                            border-radius:50%;
                            background:#dddddd;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-weight:bold;
                            ">

                            {{ strtoupper(substr($service->user->name,0,1)) }}

                        </div>

                        <div>

                            <div
                                style="
                                font-size:15px;
                                font-weight:700;
                                ">

                                {{ $service->user->name }}

                            </div>

                        </div>

                    </div>

                    <h3
                        style="
                        font-size:24px;
                        font-weight:800;
                        margin-bottom:15px;
                        ">

                        {{ $service->title }}

                    </h3>

                    <div
                        style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        margin-bottom:20px;
                        ">

                        <div>

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

                        <div
                            style="
                            font-size:24px;
                            font-weight:900;
                            color:#1f1f20;
                            ">

                            Rp {{ number_format($service->price,0,',','.') }}

                        </div>

                    </div>

                    <a
                        href="{{ route('services.show',$service->id) }}"
                        style="
                        display:block;
                        text-align:center;
                        padding:12px;
                        border-radius:10px;
                        background:#2b2b2c;
                        color:white;
                        text-decoration:none;
                        font-weight:700;
                        ">

                        View Commission

                    </a>

                </div>

            </div>

            @endforeach

        </div>

        <div style="margin-top:50px;">
            {{ $services->links() }}
        </div>

    </div>

</div>

</x-app-layout>