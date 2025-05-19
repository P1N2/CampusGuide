<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
    <header>
        <h1 class="logo"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></h1> 
    </header>
    <section class="container">
        <div class="bloc bloc-left bloc-1">
            <h2>Laissez CampusGuide <br>vous guidez vers votre Avenir</h2>
            <div class="bloc-txt-left">
                <form action="{{ route('login.submit') }}" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box password-wrapper">
                                    <input type="password" name="password" id="password" required>
                                    <label>Mot de passe</label>
                                    <span class="toggle-password" data-target="password" title="Afficher / masquer le mot de passe">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                        </div>
                    <div class="remember-forgot">
                        <label>Don't have Account? <a href="/register">Register</a></label>
                        <a href="#" class="Forgot">Forgot your Password?</a>
                    </div>
                    @if ($errors->any())
                                    <div class="error-messages" style="color:white;background-color:rgb(161, 12, 12);; padding: 10px 10px; width: 200%;height: 100%;border-radius: 7px;">
                                        <ul style="list-style: none; display: flex; text-align: center; justify-content: center">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                    <button type="submit" class="btn">Login</button>
                </form>
            </div> 
        </div>
        <img src="{{ asset('assets/login2.jpg') }}" alt="chapeau etudiant" class="image">
    </section>
    <script>
        document.querySelectorAll('.toggle-password').forEach(iconSpan => {
    iconSpan.addEventListener('click', () => {
        const targetId = iconSpan.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (!input) return;

        const icon = iconSpan.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});
    </script>
</body>
</html>
