<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs — Gestion</title>
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

        .navbar {
            background: var(--card);
            border-bottom: 1px solid #EBEBF0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

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

        .search-bar {
            background: var(--card);
            border: 1.5px solid #EBEBF0;
            border-radius: 14px;
            padding: 0.75rem 1rem;
            width: 100%;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .search-bar:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.10);
        }

        .user-card {
            background: var(--card);
            border-radius: 18px;
            border: 1px solid #EBEBF0;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(108, 99, 255, 0.08);
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            flex-shrink: 0;
            color: white;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 0.72rem;
            font-weight: 500;
        }

        .badge-verified {
            background: #DCFCE7;
            color: #16A34A;
        }

        .badge-unverified {
            background: #FEE2E2;
            color: #DC2626;
        }

        .btn-edit {
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 10px;
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 500;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-edit:hover {
            background: #DDE0FF;
        }

        .btn-delete {
            background: #FEE2E2;
            color: #EF4444;
            border-radius: 10px;
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 500;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-delete:hover {
            background: #FECACA;
        }

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

        .bottom-nav a,
        .bottom-nav button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            font-size: 0.65rem;
            color: var(--muted);
            font-weight: 500;
            background: none;
            border: none;
            cursor: pointer;
        }

        .bottom-nav a.active {
            color: var(--accent);
        }

        .bottom-nav .icon {
            font-size: 1.3rem;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.4s ease both;
        }

        .alert-success {
            background: #DCFCE7;
            border: 1px solid #BBF7D0;
            color: #15803D;
            border-radius: 14px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }

        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar px-5 py-3 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#6C63FF,#A78BFA);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <span style="color:white;font-size:1rem;">✦</span>
            </div>
            <span class="font-display font-bold text-lg" style="color:var(--text);">Gestion<span style="color:var(--accent);">.</span></span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="hidden md:flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl hover:bg-gray-100 transition" style="color:var(--muted);">
                🏠 Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                @csrf
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-xl transition" style="background:#FEE2E2;color:#EF4444;">
                    Déconnexion
                </button>
            </form>
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </nav>

    {{-- MAIN --}}
    <div class="max-w-2xl mx-auto px-4 pt-6 pb-28 md:pb-10">

        {{-- Header --}}
        <div class="fade-up mb-5">
            <h1 class="font-display font-bold text-2xl md:text-3xl" style="color:var(--text);">
                👥 Utilisateurs
            </h1>
            <p class="text-sm mt-1" style="color:var(--muted);">
                {{ \App\Models\User::count() }} compte(s) enregistré(s)
            </p>
        </div>

        {{-- Success message --}}
        @if(session('success'))
        <div class="alert-success fade-up mb-4">
            ✅ {{ session('success') }}
        </div>
        @endif

        {{-- Search bar --}}
        <div class="fade-up mb-5 relative">
            <span style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);font-size:1rem;">🔍</span>
            <input
                type="text"
                id="searchInput"
                placeholder="Rechercher par nom ou email…"
                class="search-bar"
                style="padding-left:2.5rem;"
                onkeyup="filterUsers()" />
        </div>

        {{-- User list --}}
        <div id="userList" class="flex flex-col gap-3">
            @forelse($users as $index => $user)
            @php
            $colors = ['#6C63FF','#22C55E','#F59E0B','#EF4444','#3B82F6','#EC4899','#14B8A6'];
            $color = $colors[$user->id % count($colors)];
            $initials = strtoupper(substr($user->name, 0, 2));
            @endphp
            <div class="user-card fade-up" style="animation-delay:{{ $index * 0.06 }}s;" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}">

                {{-- Avatar --}}
                <div class="user-avatar" style="background:{{ $color }}20;color:{{ $color }};">
                    {{ $initials }}
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="font-display font-semibold text-sm" style="color:var(--text);">{{ $user->name }}</p>
                        @if($user->email_verified_at)
                        <span class="badge badge-verified">✓ Vérifié</span>
                        @else
                        <span class="badge badge-unverified">✗ Non vérifié</span>
                        @endif
                    </div>
                    <p class="text-xs mt-0.5 truncate" style="color:var(--muted);">{{ $user->email }}</p>
                    <p class="text-xs mt-0.5" style="color:#C4C7D4;">ID #{{ $user->id }}</p>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-edit text-center">✏️ Modifier</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Supprimer {{ $user->name }} ?')"
                            class="btn-delete w-full">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="empty-state">
                <p style="font-size:2.5rem;">👤</p>
                <p class="font-display font-semibold mt-2">Aucun utilisateur</p>
                <p class="text-sm mt-1">Il n'y a personne ici pour l'instant.</p>
            </div>
            @endforelse
        </div>

        {{-- No results message --}}
        <div id="noResults" class="empty-state hidden">
            <p style="font-size:2.5rem;">🔍</p>
            <p class="font-display font-semibold mt-2">Aucun résultat</p>
            <p class="text-sm mt-1">Essayez un autre nom ou email.</p>
        </div>

    </div>

    {{-- BOTTOM NAV --}}
    <nav class="bottom-nav">
        <a href="{{ route('dashboard') }}">
            <span class="icon">🏠</span> Accueil
        </a>
        <a href="{{ route('users.index') }}" class="active">
            <span class="icon">👥</span> Utilisateurs
        </a>
        <a href="{{ route('profile.edit') }}">
            <span class="icon">👤</span> Profil
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display:contents;">
            @csrf
            <button type="submit">
                <span class="icon">🚪</span>
                <span>Quitter</span>
            </button>
        </form>
    </nav>

    <script>
        function filterUsers() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('#userList .user-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const email = card.getAttribute('data-email');
                if (name.includes(query) || email.includes(query)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            noResults.classList.toggle('hidden', visibleCount > 0);
        }
    </script>

</body>

</html>