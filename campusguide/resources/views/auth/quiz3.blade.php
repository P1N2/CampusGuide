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

            <!-- <form method="POST" action="{{ route('quiz.step3') }}"> -->
    @csrf
    <div class="quiz-content">
        <h2 class="quiz-title">Quel est votre domaine d’intérêt principal ?</h2>

        <div class="options">
            <label>
                <input type="radio" name="interest_area" value="sciences" required>
                Sciences
            </label>
            <label>
                <input type="radio" name="interest_area" value="arts">
                Arts
            </label>
            <label>
                <input type="radio" name="interest_area" value="commerce">
                Commerce
            </label>
            <label>
                <input type="radio" name="interest_area" value="ingenierie">
                Ingénierie
            </label>
            <!-- Ajoute d'autres domaines si nécessaire -->
        </div>

        <div class="next">
            <!-- <button type="submit">Terminer</button> -->
             <span>suivant</span>
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
