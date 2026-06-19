<x-app-layout>

<div class="p-6 text-white">

    <h1 class="text-3xl font-bold mb-6">
        Request Commission
    </h1>

    <h2 class="text-xl mb-4">
        {{ $service->title }}
    </h2>

    <form
        action="{{ route('orders.store', $service->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label class="block mb-2">
                Deskripsi Commission
            </label>

            <textarea
                name="description"
                rows="5"
                class="w-full text-black rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-2">
                Upload Referensi Gambar
            </label>

            <input
                type="file"
                name="reference_image"
                class="block">
        </div>

        <button
            type="submit"
            class="bg-blue-600 px-4 py-2 rounded">

            Kirim Request

        </button>

    </form>

</div>

</x-app-layout>