<x-app-layout>

<div
    style="
        max-width:900px;
        margin:120px auto 50px auto;
        padding:40px;
        background:white;
        border-radius:30px;
        box-shadow:0 10px 30px rgba(0,0,0,.15);
    "
>

    <h1
        style="
            font-size:42px;
            font-weight:900;
            margin-bottom:35px;
        "
    >
        Add New Service
    </h1>

    <form
        action="{{ route('services.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        {{-- TITLE --}}
        <div style="margin-bottom:25px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Service Title
            </p>

            <input
                type="text"
                name="title"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

        </div>

        {{-- DESCRIPTION --}}
        <div style="margin-bottom:25px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Description
            </p>

            <textarea
                name="description"
                rows="6"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            ></textarea>

        </div>

        {{-- PRICE --}}
        <div style="margin-bottom:25px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Price
            </p>

            <input
                type="number"
                name="price"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

        </div>

        {{-- DELIVERY TIME --}}
        <div style="margin-bottom:25px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Delivery Time (Days)
            </p>

            <input
                type="number"
                name="delivery_time"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

        </div>

        {{-- IMAGE --}}
        <div style="margin-bottom:25px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Service Thumbnail
            </p>

            <input
                type="file"
                name="image"
                id="imageInput"
                accept="image/*"
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

            <p
                style="
                    margin-top:10px;
                    color:#6b7280;
                "
            >
                Upload one thumbnail image for this service.
            </p>

        </div>

        {{-- PREVIEW --}}
        <div
            id="previewContainer"
            style="
                margin-bottom:30px;
            "
        ></div>

        <button
            type="submit"
            style="
                background:black;
                color:white;
                border:3px solid black;
                padding:12px 30px;
                border-radius:15px;
                font-weight:800;
                cursor:pointer;
            "
        >
            Save Service
        </button>

    </form>

</div>

<script>

document
.getElementById('imageInput')
.addEventListener('change', function(e)
{
    const preview =
        document.getElementById(
            'previewContainer'
        );

    preview.innerHTML = '';

    const file =
        e.target.files[0];

    if(!file)
    {
        return;
    }

    const reader =
        new FileReader();

    reader.onload = function(event)
    {
        const img =
            document.createElement('img');

        img.src =
            event.target.result;

        img.style.width =
            '100%';

        img.style.maxHeight =
            '400px';

        img.style.objectFit =
            'contain';

        img.style.background =
            '#f1f5f9';

        img.style.borderRadius =
            '20px';

        img.style.border =
            '2px solid #ddd';

        img.style.padding =
            '10px';

        preview.appendChild(img);
    };

    reader.readAsDataURL(file);
});

</script>

</x-app-layout>