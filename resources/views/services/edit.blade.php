<h1>Edit Service</h1>

<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Judul Service
        <br>
        <input type="text"
               name="title"
               value="{{ $service->title }}">
    </p>

    <p>
        Deskripsi
        <br>
        <textarea name="description">{{ $service->description }}</textarea>
    </p>

    <p>
        Harga
        <br>
        <input type="number"
               name="price"
               value="{{ $service->price }}">
    </p>

    <p>
        Lama Pengerjaan
        <br>
        <input type="number"
               name="delivery_time"
               value="{{ $service->delivery_time }}">
    </p>

    <button type="submit">
        Update Service
    </button>
</form>