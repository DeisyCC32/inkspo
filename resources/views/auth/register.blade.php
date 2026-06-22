<x-guest-layout>

<div
    style="
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:40px 20px;
    "
>

    <div
        style="
            width:100%;
            max-width:500px;
            background:rgba(255,255,255,.96);
            border-radius:28px;
            padding:40px;
            box-shadow:0 20px 60px rgba(0,0,0,.4);
        "
    >

        <div style="text-align:center;margin-bottom:30px;">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Inkspo"
                style="
                    width:90px;
                    margin:auto;
                    margin-bottom:15px;
                "
            >

            <h1
                style="
                    font-size:42px;
                    font-weight:900;
                    color:#111827;
                    margin-bottom:10px;
                "
            >
                Join Inkspo
            </h1>

            <p
                style="
                    color:#6b7280;
                "
            >
                Temukan artist dan mulai commission artwork favoritmu.
            </p>

        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom:15px;">
                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    required
                    autofocus
                    value="{{ old('name') }}"
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        margin-top:5px;
                    "
                >
            </div>

            <div style="margin-bottom:15px;">
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                    value="{{ old('email') }}"
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        margin-top:5px;
                    "
                >
            </div>

            <div style="margin-bottom:15px;">
                <label>Register As</label>

                <select
                    name="role"
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        margin-top:5px;
                    "
                >
                    <option value="customer">Customer</option>
                    <option value="artist">Artist</option>
                </select>
            </div>

            <div style="margin-bottom:15px;">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        margin-top:5px;
                    "
                >
            </div>

            <div style="margin-bottom:25px;">
                <label>Confirm Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #d1d5db;
                        border-radius:12px;
                        margin-top:5px;
                    "
                >
            </div>

            <button
                type="submit"
                style="
                    width:100%;
                    background:#0f172a;
                    color:white;
                    border:none;
                    border-radius:12px;
                    padding:16px;
                    font-weight:bold;
                    cursor:pointer;
                "
            >
                Create Account
            </button>

            <div
                style="
                    text-align:center;
                    margin-top:20px;
                "
            >
                Sudah punya akun?

                <a
                    href="{{ route('login') }}"
                    style="
                        color:#0f172a;
                        font-weight:bold;
                    "
                >
                    Login
                </a>
            </div>

        </form>

    </div>

</div>

</x-guest-layout>