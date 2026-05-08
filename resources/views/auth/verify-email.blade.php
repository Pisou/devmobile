<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vérification de l'email</title>
</head>

<body>

    <h2>Vérifiez votre adresse email 📧</h2>

    {{-- Message de succès si renvoi --}}
    @if (session('message'))
    <div style="color: green;">
        ✅ {{ session('message') }}
    </div>
    @endif

    <p>
        Un lien de vérification a été envoyé à votre adresse email.<br>
        Cliquez sur ce lien pour activer votre compte.
    </p>

    <p>Vous n'avez pas reçu l'email ?</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Renvoyer l'email</button>
    </form>

</body>

</html>