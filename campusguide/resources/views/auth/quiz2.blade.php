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

           <form method="POST" action="{{ route('quiz.step2') }}">
    @csrf
    <div class="quiz-content">
        <h2 class="quiz-title">Quelle est votre matière préférée ?</h2>

        <div class="options">
            <label>
                <input type="radio" name="favorite_subject" value="mathématiques" required>
                Mathématiques
            </label>
            <label>
                <input type="radio" name="favorite_subject" value="physique">
                Physique
            </label>
            <label>
                <input type="radio" name="favorite_subject" value="informatique">
                Informatique
            </label>
            <!-- Ajoute d'autres matières selon ton choix -->
        </div>

        <div class="next">
            <!-- <button type="submit">Suivant</button> -->
            <span><a href="{{ route('quiz.step3') }}">suivant</a></span> 
        </div>
    </div>
</form>

        </div>
    </div>
    <ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>
</body>
</html>
