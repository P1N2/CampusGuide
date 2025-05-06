<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
                        <div class="input-box">
                            <input type="password" name="password" id="password" required >
                            <label>password</label>
                            <!-- <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span> -->
                        </div>
                        <div class="input-box">
                            <input type="password" name="password_confirmation" required>
                            <label>Confirm Password</label>
                            <!-- <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span> cette partie sera ajouter a input oninput="showToggle(this)" -->
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
// function togglePassword(id, eyeIcon) {
//     const input = document.getElementById(id);
//     if (input.type === 'password') {
//         input.type = 'text';
//         eyeIcon.textContent = '🙈'; // change icône
//     } else {
//         input.type = 'password';
//         eyeIcon.textContent = '👁️';
//     }
// }

// function showToggle(input) {
//     const icon = input.parentElement.querySelector('.toggle-password');
//     if (input.value.length > 0) {
//         icon.style.display = 'block';
//     } else {
//         icon.style.display = 'none';
//     }
// }
// </script>
</body>
</html>