<h1>Tambah Service</h1>

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <p>
        Judul Service
        <br>
        <input type="text" name="title">
    </p>

    <p>
        Deskripsi
        <br>
        <textarea name="description"></textarea>
    </p>

    <p>
        Harga
        <br>
        <input type="number" name="price">
    </p>

    <p>
        Lama Pengerjaan (Hari)
        <br>
        <input type="number" name="delivery_time">
    </p>

    <button type="submit">
        Simpan Service
    </button>
</form>