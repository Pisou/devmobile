<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="text-center">
        <div class="text-6xl mb-4">🚀</div>
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Bienvenue sur MonApp</h1>
        <p class="text-gray-500 mb-8">Gérez vos utilisateurs facilement.</p>

        <div class="flex gap-4 justify-center">
            <a href="{{ route('login') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg transition font-medium text-lg">
                🔑 Connexion
            </a>
            <a href="{{ route('register') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-lg transition font-medium text-lg">
                📝 Inscription
            </a>
        </div>
    </div>

</body>
</html>
