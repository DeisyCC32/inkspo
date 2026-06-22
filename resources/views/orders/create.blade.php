<x-app-layout>

<div
    style="
        max-width:1000px;
        margin:120px auto 50px auto;
        background:rgba(255,255,255,.95);
        border-radius:25px;
        padding:40px;
        box-shadow:0 10px 30px rgba(0,0,0,.15);
    "
>

    <h1
        style="
            font-size:42px;
            font-weight:900;
            margin-bottom:10px;
            color:#111827;
        "
    >
        Request Commission
    </h1>

    <h2
        style="
            font-size:24px;
            font-weight:700;
            margin-bottom:30px;
            color:#362417;
        "
    >
        {{ $service->title }}
    </h2>

    <form
        action="{{ route('orders.store', $service->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        {{-- DESCRIPTION --}}
        <div style="margin-bottom:30px;">

            <label
                style="
                    display:block;
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                    color:#111827;
                "
            >
                Commission Description
            </label>

            <textarea
                name="description"
                rows="8"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:15px;
                    resize:none;
                    color:black;
                "
            ></textarea>

        </div>

        {{-- IMAGE --}}
        <div style="margin-bottom:30px;">

            <label
                style="
                    display:block;
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                    color:#111827;
                "
            >
                Upload Reference Image
            </label>

            <input
                type="file"
                name="reference_image"
                id="imageInput"
                accept="image/*"
                style="
                    margin-bottom:20px;
                "
            >

            {{-- PREVIEW --}}
            <div
                id="previewContainer"
                style="
                    display:none;
                "
            >
            </div>

        </div>

        {{-- BUTTON --}}
        <button
            type="submit"
            style="
                background:#000500;
                color:white;
                border:none;
                padding:15px 30px;
                border-radius:15px;
                font-weight:800;
                cursor:pointer;
            "
        >
            Send Request
        </button>

    </form>

</div>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function()
    {
        const imageInput =
            document.getElementById(
                'imageInput'
            );

        const previewContainer =
            document.getElementById(
                'previewContainer'
            );

        imageInput.addEventListener(
            'change',
            function(e)
            {
                previewContainer.innerHTML = '';

                const file =
                    e.target.files[0];

                if(!file)
                {
                    previewContainer.style.display =
                        'none';

                    return;
                }

                const reader =
                    new FileReader();

                reader.onload =
                    function(event)
                    {
                        previewContainer.style.display =
                            'block';

                        previewContainer.innerHTML =
                        `
                            <p
                                style="
                                    font-weight:800;
                                    margin-bottom:10px;
                                    color:#111827;
                                "
                            >
                                Preview
                            </p>

                            <img
                                src="${event.target.result}"
                                style="
                                    width:100%;
                                    max-width:500px;
                                    max-height:350px;
                                    object-fit:contain;
                                    border-radius:20px;
                                    border:2px solid #d1d5db;
                                    padding:10px;
                                    background:white;
                                "
                            >
                        `;
                    };

                reader.readAsDataURL(file);
            }
        );
    }
);

</script>

</x-app-layout>