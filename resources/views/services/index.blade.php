<x-app-layout>

<div class="container mt-4">

    <h1 class="text-white mb-4">My Services</h1>

    <a href="{{ route('services.create') }}"
       class="btn btn-primary mb-3">
       Tambah Service
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($services as $service)

        <div class="card mb-3">
            <div class="card-body">

                <h3>{{ $service->title }}</h3>

                <p>{{ $service->description }}</p>

                <p>
                    <strong>Harga:</strong>
                    Rp {{ number_format($service->price) }}
                </p>

                <p>
                    <strong>Waktu Pengerjaan:</strong>
                    {{ $service->delivery_time }} hari
                </p>

                <a href="{{ route('services.edit', $service->id) }}"
                   class="btn btn-warning">
                    Edit
                </a>

                <form action="{{ route('services.destroy', $service->id) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger">
                        Delete
                    </button>
                </form>

            </div>
        </div>

    @endforeach

</div>

</x-app-layout>