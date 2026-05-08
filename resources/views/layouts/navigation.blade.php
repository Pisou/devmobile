<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-gray-800 font-bold text-xl">
                    🚀 MonApp
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition">
                    Utilisateurs
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>