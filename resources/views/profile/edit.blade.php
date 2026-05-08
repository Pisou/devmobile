<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil — Gestion</title>
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

        .avatar-large {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--accent), #A78BFA);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
        }

        .avatar-small {
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

        .section-card {
            background: var(--card);
            border-radius: 20px;
            border: 1px solid #EBEBF0;
            padding: 1.5rem;
            transition: box-shadow 0.2s;
        }

        .form-input {
            width: 100%;
            background: var(--bg);
            border: 1.5px solid #EBEBF0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.10);
            background: white;
        }

        .form-input:disabled {
            color: var(--muted);
            cursor: not-allowed;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
            display: block;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #FEE2E2;
            color: #EF4444;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-danger:hover {
            background: #FECACA;
        }

        .btn-secondary {
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #DDE0FF;
        }

        .alert-success {
            background: #DCFCE7;
            border: 1px solid #BBF7D0;
            color: #15803D;
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .error-msg {
            color: #EF4444;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            width: 100%;
            max-width: 420px;
        }

        /* Bottom nav */
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

        .delay-1 {
            animation-delay: 0.08s;
        }

        .delay-2 {
            animation-delay: 0.16s;
        }

        .delay-3 {
            animation-delay: 0.24s;
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
            <a href="{{ route('users.index') }}" class="hidden md:flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-xl hover:bg-gray-100 transition" style="color:var(--muted);">
                👥 Utilisateurs
            </a>
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                @csrf
                <button type="submit" class="text-sm font-medium px-4 py-2 rounded-xl transition" style="background:#FEE2E2;color:#EF4444;">
                    Déconnexion
                </button>
            </form>
            <div class="avatar-small">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </nav>

    {{-- MAIN --}}
    <div class="max-w-2xl mx-auto px-4 pt-6 pb-28 md:pb-10">

        {{-- Profile header --}}
        <div class="fade-up flex items-center gap-4 mb-6">
            <div class="avatar-large">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <h1 class="font-display font-bold text-2xl" style="color:var(--text);">{{ auth()->user()->name }}</h1>
                <p class="text-sm" style="color:var(--muted);">{{ auth()->user()->email }}</p>
                @if(auth()->user()->email_verified_at)
                <span style="background:#DCFCE7;color:#16A34A;font-size:0.72rem;font-weight:500;padding:2px 10px;border-radius:99px;">✓ Email vérifié</span>
                @else
                <span style="background:#FEE2E2;color:#DC2626;font-size:0.72rem;font-weight:500;padding:2px 10px;border-radius:99px;">✗ Non vérifié</span>
                @endif
            </div>
        </div>

        {{-- Section 1 : Informations --}}
        <div class="section-card fade-up delay-1 mb-4">
            <div class="flex items-center gap-2 mb-5">
                <div style="background:var(--accent-light);border-radius:10px;padding:0.5rem;font-size:1.1rem;">👤</div>
                <div>
                    <h2 class="font-display font-semibold text-base" style="color:var(--text);">Informations du profil</h2>
                    <p class="text-xs" style="color:var(--muted);">Modifiez votre nom et votre email.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name) }}" required autofocus />
                    @error('name')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email) }}" required />
                    @error('email')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-3 pt-1">
                    <button type="submit" class="btn-primary">💾 Sauvegarder</button>
                    @if(session('status') === 'profile-updated')
                    <span class="alert-success">✅ Sauvegardé !</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Section 2 : Mot de passe --}}
        <div class="section-card fade-up delay-2 mb-4">
            <div class="flex items-center gap-2 mb-5">
                <div style="background:#EEF0FF;border-radius:10px;padding:0.5rem;font-size:1.1rem;">🔒</div>
                <div>
                    <h2 class="font-display font-semibold text-base" style="color:var(--text);">Mot de passe</h2>
                    <p class="text-xs" style="color:var(--muted);">Utilisez un mot de passe long et aléatoire.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label class="form-label">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-input" autocomplete="current-password" />
                    @error('current_password', 'updatePassword')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-input" autocomplete="new-password" />
                    @error('password', 'updatePassword')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-input" autocomplete="new-password" />
                    @error('password_confirmation', 'updatePassword')<p class="error-msg">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-3 pt-1">
                    <button type="submit" class="btn-primary">🔑 Mettre à jour</button>
                    @if(session('status') === 'password-updated')
                    <span class="alert-success">✅ Mis à jour !</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- Section 3 : Supprimer le compte --}}
        <div class="section-card fade-up delay-3" style="border-color:#FEE2E2;">
            <div class="flex items-center gap-2 mb-4">
                <div style="background:#FEE2E2;border-radius:10px;padding:0.5rem;font-size:1.1rem;">⚠️</div>
                <div>
                    <h2 class="font-display font-semibold text-base" style="color:#EF4444;">Supprimer le compte</h2>
                    <p class="text-xs" style="color:var(--muted);">Cette action est irréversible.</p>
                </div>
            </div>
            <p class="text-sm mb-4" style="color:var(--muted);">
                Une fois supprimé, toutes vos données seront définitivement effacées.
            </p>
            <button onclick="document.getElementById('deleteModal').classList.add('active')" class="btn-danger">
                🗑️ Supprimer mon compte
            </button>
        </div>

    </div>

    {{-- MODAL SUPPRESSION --}}
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <h2 class="font-display font-bold text-lg mb-2" style="color:var(--text);">Confirmer la suppression</h2>
            <p class="text-sm mb-4" style="color:var(--muted);">
                Entrez votre mot de passe pour confirmer la suppression définitive de votre compte.
            </p>
            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')
                <div>
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-input" placeholder="Votre mot de passe" />
                    @error('password', 'userDeletion')<p class="error-msg">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-3 justify-end pt-1">
                    <button type="button" onclick="document.getElementById('deleteModal').classList.remove('active')" class="btn-secondary">
                        Annuler
                    </button>
                    <button type="submit" class="btn-danger">
                        🗑️ Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- BOTTOM NAV --}}
    <nav class="bottom-nav">
        <a href="{{ route('dashboard') }}">
            <span class="icon">🏠</span> Accueil
        </a>
        <a href="{{ route('users.index') }}">
            <span class="icon">👥</span> Utilisateurs
        </a>
        <a href="{{ route('profile.edit') }}" class="active">
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

</body>

</html>