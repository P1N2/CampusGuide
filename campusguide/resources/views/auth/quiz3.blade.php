<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz de Recommandation</title>
    <link rel="stylesheet" href="{{ asset('css/quiz.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
    <div class="main-container">
        <div class="left-side">
            <img src="{{ asset('assets/quiz3.jpg') }}" alt="Image Étudiant">
        </div>
        <div class="right-side">
            <header class="header">
                <img src="{{ asset('assets/logo.png') }}" alt="CampusGuide Logo" class="logo">
            </header>

         @auth
<form method="POST" action="{{ route('quiz.step3') }}">
    @csrf
    <h2>Quel est ton domaine d’intérêt principal ?</h2>

    <label>
        <input type="radio" name="interest_domain" value="Sciences">
        <span class="checkmark"></span>
        Sciences
    </label><br>

    <label>
        <input type="radio" name="interest_domain" value="Littérature">
        <span class="checkmark"></span>
        Littérature
    </label><br>

    <label>
        <input type="radio" name="interest_domain" value="Technologie">
        <span class="checkmark"></span>
        Technologie
    </label><br>

    <label>
        <input type="radio" name="interest_domain" value="Économie">
        <span class="checkmark"></span>
        Économie
    </label><br>

    <label>
        <input type="radio" name="interest_domain" value="Art">
        <span class="checkmark"></span>
        Art
    </label><br>

    <button type="submit">Terminer</button>
</form>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endauth

        </div>
    </div>
    <ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>
</body>
</html>
