<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @PwaHead
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-800">
                Gestion Utilisateur
            </h1>
            <p class="text-gray-600 mt-2">Système d'authentification sécurisé</p>
        </div>

        <div class="w-full max-w-md px-6">
            {{ $slot }}
        </div>
    </div>
    @RegisterServiceWorkerScript
</body>

</html>
