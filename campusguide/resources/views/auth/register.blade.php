<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
            <h2>Construisez votre Avenir<br>avec CampusGuide</h2>
            <div class= "bloc-txt-left">
                <form action="{{ route('register.submit') }}" method="post">
                        @csrf
                        <div class="input-box">
                            <input type="text" required name='name' value="{{ old('name') }}">
                            <label>Nom et Prenom</label>
                        </div>
                        <div class="input-box">
                            <input type="email" required name='email' value="{{ old('email') }}">
                            <label>Email</label>
                        </div>
                        <div class="input-box password-wrapper">
                                    <input type="password" name="password" id="password" required>
                                    <label>Mot de passe</label>
                                    <span class="toggle-password" data-target="password" title="Afficher / masquer le mot de passe">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                        </div>

                        <div class="input-box password-wrapper">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                                    <label>Confirmer le mot de passe</label>
                                    <span class="toggle-password" data-target="password_confirmation" title="Afficher / masquer le mot de passe">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                         </div>
                            {{-- Affichage des erreurs (facultatif mais conseillé) --}}
                                @if ($errors->any())
                                    <div class="error-messages" style="color:red;">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                        <div class="remember-forgot">
                            <span>Already have account? <a href="/login">Login</a></span>
                        </div>
                        <button type="submit" class="btn">S'inscrire</button>
                    </form>
                </div> 
            </div>
        </div>
        <img src="{{ asset('assets/login.jpg') }}" alt="chapeau etudiant" class="image">
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