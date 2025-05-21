<!-- resources/views/auth/passwords/email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
    <h2>Entrez votre email pour réinitialiser le mot de passe</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Votre email" required>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
