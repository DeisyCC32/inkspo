<x-app-layout>
    <div class="p-6 text-white">
        <h1 class="text-3xl font-bold text-white">
            Customer Dashboard
        </h1>

        <p class="mt-4 text-gray-300">
            Selamat datang di Inkspo.
        </p>

        <div class="mt-6">
            <ul class="space-y-2 text-gray-200">
                <li>My Orders</li>
                <li>
                    <a href="{{ route('marketplace') }}">
                        Marketplace
                    </a>
                </li>
                <li>Favorites</li>
                <li>Reviews</li>
                <li>Chats</li>
            </ul>
        </div>
    </div>
</x-app-layout>