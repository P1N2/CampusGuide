<!-- resources/views/auth/passwords/reset.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Changer le mot de passe</title>
</head>
<body>
    <h2>Changer le mot de passe pour : {{ $email }}</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="password" name="password" placeholder="Nouveau mot de passe" required>
        <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required>
        <button type="submit">Changer le mot de passe</button>
    </form>
</body>
</html>
