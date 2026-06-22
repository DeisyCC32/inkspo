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

```
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
            Welcome Back
        </h1>

        <p
            style="
                color:#6b7280;
            "
        >
            Login untuk menemukan artist favoritmu.
        </p>

    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom:15px;">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                style="
                    width:100%;
                    padding:14px;
                    border:1px solid #d1d5db;
                    border-radius:12px;
                    margin-top:5px;
                "
            >

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

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

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <div
            style="
                display:flex;
                align-items:center;
                margin-bottom:20px;
            "
        >

            <input
                type="checkbox"
                name="remember"
                style="margin-right:10px;"
            >

            <span>Remember Me</span>

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
            Login
        </button>

        <div
            style="
                text-align:center;
                margin-top:20px;
            "
        >

            Belum punya akun?

            <a
                href="{{ route('register') }}"
                style="
                    color:#0f172a;
                    font-weight:bold;
                "
            >
                Daftar
            </a>

        </div>

    </form>

</div>
```

</div>

</x-guest-layout>
