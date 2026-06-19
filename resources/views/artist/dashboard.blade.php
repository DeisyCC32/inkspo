<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">
            Artist Dashboard
        </h1>

        <p class="mt-4">
            Selamat datang di Dashboard Artist Inkspo.
        </p>

        <div class="mt-6">
            <ul>
                <li>Analytics</li>
                <li>
                    <a href="{{ route('orders.my') }}">
                        My Orders
                    </a>
                </li>
                <li>Service Management</li>
                <li>Portfolio Management</li>
                <li>Reviews</li>
                <li>Chats</li>
            </ul>
        </div>
    </div>
</x-app-layout>