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
            <img src="{{ asset('assets/quiz2.jpg') }}" alt="Image Étudiant">
        </div>
        <div class="right-side">
            <header class="header">
                <img src="{{ asset('assets/logo.png') }}" alt="CampusGuide Logo" class="logo">
            </header>

           @auth
<form method="POST" action="{{ route('quiz.step2') }}">
    @csrf
    <h2>Quelle est ta matière préférée ?</h2>

    <label>
        <input type="radio" name="favorite_subject" value="Maths">
        <span class="checkmark"></span>
        Maths
    </label><br>

    <label>
        <input type="radio" name="favorite_subject" value="Physique">
        <span class="checkmark"></span>
        Physique
    </label><br>

    <label>
        <input type="radio" name="favorite_subject" value="SVT">
        <span class="checkmark"></span>
        SVT
    </label><br>

    <label>
        <input type="radio" name="favorite_subject" value="Philosophie">
        <span class="checkmark"></span>
        Philosophie
    </label><br>

    <label>
        <input type="radio" name="favorite_subject" value="Économie">
        <span class="checkmark"></span>
        Économie
    </label><br>

    <button type="submit">Suivant</button>
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
