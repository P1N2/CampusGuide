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
            <img src="{{ asset('assets/quiz1.jpg') }}" alt="Image Étudiant">
        </div>
        <div class="right-side">
            <header class="header">
                <img src="{{ asset('assets/logo.png') }}" alt="CampusGuide Logo" class="logo">
            </header>

            <!-- <form method="POST" action="{{ route('quiz.step1') }}"> -->
    @csrf
    <div class="quiz-content">
        <h2 class="quiz-title">Quel type de bac avez-vous ?</h2>

        <div class="options">
            <label>
                <input type="radio" name="bac_type" value="scientifique" required>
                Scientifique
            </label>
            <label>
                <input type="radio" name="bac_type" value="litteraire">
                Littéraire
            </label>
            <label>
                <input type="radio" name="bac_type" value="economique">
                Economique
            </label>
            <!-- Ajoute d'autres options si nécessaire -->
        </div>

        <div class="next">
            <!-- <button type="submit">Suivant</button> -->
             <span><a href="{{ route('quiz.step2') }}">suivant</a></span> 
        </div>
    </div>
</form>

        </div>
    </div>
</body>
</html>
