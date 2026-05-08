<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Gestion Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'DM Sans', sans-serif;
        }

        .font-display {
            font-family: 'Syne', sans-serif;
        }

        :root {
            --accent: #6C63FF;
            --accent-light: #EEF0FF;
            --accent-dark: #4B44CC;
            --success: #22C55E;
            --danger: #EF4444;
            --bg: #F5F6FA;
            --card: #FFFFFF;
            --text: #1A1A2E;
            --muted: #8A8FA8;
        }

        body {
            background: var(--bg);
            color: var(--text);
        }

        /* Navbar */
        .navbar {
            background: var(--card);
            border-bottom: 1px solid #EBEBF0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Cards */
        .stat-card {
            background: var(--card);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #EBEBF0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(108, 99, 255, 0.10);
        }

        .stat-card.accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            border: none;
            color: white;
        }

        /* Icon bubbles */
        .icon-bubble {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Progress bar */
        .progress-bar {
            height: 6px;
            border-radius: 99px;
            background: #EBEBF0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--accent), #A78BFA);
            transition: width 1s ease;
        }

        /* Buttons */
        .btn-primary {
            background: var(--accent);
            color: white;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: background 0.2s, transform 0.1s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: #DDE0FF;
        }

        /* Bottom nav mobile */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--card);
            border-top: 1px solid #EBEBF0;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-around;
            z-index: 50;
        }

        .bottom-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            font-size: 0.65rem;
            color: var(--muted);
            font-weight: 500;
            transition: color 0.2s;
        }

        .bottom-nav a.active {
            color: var(--accent);
        }

        .bottom-nav a span.icon {
            font-size: 1.3rem;
        }

        /* Avatar */
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #A78BFA);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
        }

        /* Fade-in animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.45s ease both;
        }

        .delay-1 {
            animation-delay: 0.08s;
        }

        .delay-2 {
            animation-delay: 0.16s;
        }

        .delay-3 {
            animation-delay: 0.24s;
        }

        .delay-4 {
            animation-delay: 0.32s;
        }

        /* Hide bottom nav on desktop */
        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }

            .mobile-pb {
                padding-bottom: 0;
            }
        }
    </style>
</head>

<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar px-5 py-3 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#6C63FF,#A78BFA);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <span style="color:white;font-size:1rem;">✦</span>
            </div>
            <span class="font-display font-bold text-lg" style="color:var(--text);">Gestion<span style="color:var(--accent);">.</span></span>
        </div>

        <div class="flex items-center gap-3">
            {{-- Desktop links --}}
            <a href="{{ route('users.index') }}" class="hidden md:flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl hover:bg-gray-100 transition" style="color:var(--muted);">
                <span>👥</span> Utilisateurs
            </a>
            <a href="{{ route('profile.edit') }}" class="hidden md:flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl hover:bg-gray-100 transition" style="color:var(--muted);">
                <span>👤</span> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                @csrf
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-xl transition" style="background:#FEE2E2;color:#EF4444;">
                    Déconnexion
                </button>
            </form>

            {{-- Avatar --}}
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="max-w-2xl mx-auto px-4 pt-6 pb-28 md:pb-10">

        {{-- Welcome --}}
        <div class="fade-up mb-6">
            <p class="text-sm font-medium mb-1" style="color:var(--accent);">
                {{ now()->locale('fr')->isoFormat('dddd D MMMM') }}
            </p>
            <h1 class="font-display font-bold text-2xl md:text-3xl" style="color:var(--text);">
                Bonjour, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-sm mt-1" style="color:var(--muted);">Voici un aperçu de votre application.</p>
        </div>

        {{-- Stats --}}
        @php
        $total = \App\Models\User::count();
        $verified = \App\Models\User::whereNotNull('email_verified_at')->count();
        $unverified = $total - $verified;
        $pct = $total > 0 ? round($verified / $total * 100) : 0;
        @endphp

        {{-- Hero card --}}
        <div class="stat-card accent fade-up delay-1 mb-4">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm font-medium opacity-80">Total utilisateurs</p>
                    <p class="font-display font-bold text-4xl mt-1">{{ $total }}</p>
                </div>
                <div style="background:rgba(255,255,255,0.2);border-radius:14px;padding:0.75rem;font-size:1.5rem;">👥</div>
            </div>
            <div class="progress-bar" style="background:rgba(255,255,255,0.25);">
                <div class="progress-fill" style="width:{{ $pct }}%;background:white;"></div>
            </div>
            <p class="text-xs mt-2 opacity-70">{{ $pct }}% d'emails vérifiés</p>
        </div>

        {{-- Two small cards --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="stat-card fade-up delay-2">
                <div class="icon-bubble mb-3" style="background:#DCFCE7;">✅</div>
                <p class="text-xs font-medium mb-1" style="color:var(--muted);">Vérifiés</p>
                <p class="font-display font-bold text-2xl" style="color:#16A34A;">{{ $verified }}</p>
            </div>
            <div class="stat-card fade-up delay-3">
                <div class="icon-bubble mb-3" style="background:#FEE2E2;">❌</div>
                <p class="text-xs font-medium mb-1" style="color:var(--muted);">Non vérifiés</p>
                <p class="font-display font-bold text-2xl" style="color:#DC2626;">{{ $unverified }}</p>
            </div>
        </div>

        {{-- Quick access --}}
        <div class="stat-card fade-up delay-4">
            <p class="font-display font-semibold text-base mb-4" style="color:var(--text);">⚡ Accès rapide</p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('users.index') }}" class="btn-primary w-full justify-center">
                    <span>👥</span> Gérer les utilisateurs
                </a>
                <a href="{{ route('profile.edit') }}" class="btn-secondary w-full justify-center">
                    <span>👤</span> Mon profil
                </a>
                <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl text-sm font-medium transition" style="background:#FEE2E2;color:#EF4444;">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- ===== BOTTOM NAV (mobile only) ===== --}}
    <nav class="bottom-nav">
        <a href="{{ route('dashboard') }}" class="active">
            <span class="icon">🏠</span> Accueil
        </a>
        <a href="{{ route('users.index') }}">
            <span class="icon">👥</span> Utilisateurs
        </a>
        <a href="{{ route('profile.edit') }}">
            <span class="icon">👤</span> Profil
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display:contents;">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;" class="flex flex-col items-center gap-0.5">
                <span class="icon" style="font-size:1.3rem;">🚪</span>
                <span style="font-size:0.65rem;color:var(--muted);font-weight:500;">Quitter</span>
            </button>
        </form>
    </nav>

</body>

</html>