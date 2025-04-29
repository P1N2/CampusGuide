<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
    <h1 class="logo"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></h1>  
    </header>
    <section class="container">
        <div class="bloc bloc-left bloc-1">
            <h2>Laissez CampusGuide <br>vous guidez vers votre Avenir</h2>
            <div class= "bloc-txt-left">
                <form action="#" method="post">
                        @csrf
                        <div class="input-box">
                            <input type="text" required>
                            <label>Nom et Prenom</label>
                        </div>
                        <div class="input-box">
                            <input type="email" required>
                            <label>Email</label>
                        </div>
                        <div class="input-box">
                            <input type="password" required>
                            <label>password</label>
                        </div>
                        <div class="input-box">
                            <input type="password" required>
                            <label>Confirm Password</label>
                        </div>
                        <div class="remember-forgot">
                            <span>Already have account? <a href="/login">Login</a></span>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                </div> 
            </div>
        </div>
        <img src="{{ asset('assets/login.jpg') }}" alt="chapeau etudiant" class="image">
    </section>
</body>
</html>