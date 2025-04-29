<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
        <h1 class="logo"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></h1> 
    </header>
    <section class="container">
        <div class="bloc bloc-left bloc-1">
            <h2>Laissez CampusGuide <br>vous guidez vers votre Avenir</h2>
            <div class="bloc-txt-left">
                <form action="#" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label>Don't have Account? <a href="/register">Register</a></label>
                        <a href="#" class="Forgot">Forgot your Password?</a>
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form>
            </div> 
        </div>
        <img src="{{ asset('assets/login2.jpg') }}" alt="chapeau etudiant" class="image">
    </section>
</body>
</html>
