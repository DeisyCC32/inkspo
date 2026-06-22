<script>

document
.getElementById('imageInput')
?.addEventListener('change', function(e)
{
    const preview =
        document.getElementById(
            'previewContainer'
        );

    preview.innerHTML = '';

    const file =
        e.target.files[0];

    if(!file) return;

    const reader =
        new FileReader();

    reader.onload =
        function(event)
        {
            preview.innerHTML =
            `
                <img
                    src="${event.target.result}"
                    style="
                        width:250px;
                        height:250px;
                        object-fit:cover;
                        border-radius:20px;
                        border:2px solid #ddd;
                    "
                >
            `;
        };

    reader.readAsDataURL(file);
});

</script>

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
        Edit Service
    </h1>

    <form
        action="{{ route('services.update', $service->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        {{-- CURRENT IMAGE --}}
        @if($service->image)

            <div style="margin-bottom:30px;">

                <p
                    style="
                        font-size:18px;
                        font-weight:800;
                        margin-bottom:15px;
                    "
                >
                    Current Image
                </p>

                <img
                    src="{{ asset('storage/'.$service->image) }}"
                    style="
                        width:100%;
                        max-height:400px;
                        object-fit:contain;
                        background:#f1f5f9;
                        border-radius:20px;
                        padding:10px;
                    "
                >

            </div>

            <label
                style="
                    display:flex;
                    align-items:center;
                    gap:10px;
                    margin-bottom:25px;
                    font-weight:700;
                "
            >

                <input
                    type="checkbox"
                    name="remove_image"
                    value="1"
                >

                Remove Current Image

            </label>

        @endif

        {{-- NEW IMAGE --}}
        <div style="margin-bottom:30px;">

            <p
                style="
                    font-size:18px;
                    font-weight:800;
                    margin-bottom:10px;
                "
            >
                Upload New Image
            </p>

            <input
                type="file"
                name="reference_image"
                id="imageInput"
                accept="image/*"
                style="
                    width:100%;
                    padding:12px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

            <div
                id="previewContainer"
                style="
                    display:flex;
                    gap:15px;
                    flex-wrap:wrap;
                    margin-top:20px;
                "
            ></div>

        </div>

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
                value="{{ $service->title }}"
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
            >{{ $service->description }}</textarea>

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
                value="{{ $service->price }}"
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
        <div style="margin-bottom:35px;">

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
                value="{{ $service->delivery_time }}"
                required
                style="
                    width:100%;
                    padding:15px;
                    border:2px solid #d1d5db;
                    border-radius:12px;
                "
            >

        </div>

        {{-- BUTTONS --}}
        <div
            style="
                display:flex;
                gap:15px;
            "
        >

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
                Save Changes
            </button>

            <a
                href="{{ route('artist.dashboard') }}"
                style="
                    background:white;
                    color:black;
                    border:3px solid black;
                    padding:12px 30px;
                    border-radius:15px;
                    text-decoration:none;
                    font-weight:800;
                "
            >
                Cancel
            </a>

        </div>

    </form>

</div>

<script>

document
.getElementById('imageInput')
?.addEventListener('change', function(e)
{
    const preview =
        document.getElementById(
            'previewContainer'
        );

    preview.innerHTML = '';

    const file =
        e.target.files[0];

    if(!file) return;

    const reader =
        new FileReader();

    reader.onload =
        function(event)
        {
            preview.innerHTML =
            `
                <img
                    src="${event.target.result}"
                    style="
                        width:250px;
                        height:250px;
                        object-fit:cover;
                        border-radius:20px;
                        border:2px solid #ddd;
                    "
                >
            `;
        };

    reader.readAsDataURL(file);
});

</script>

</x-app-layout>