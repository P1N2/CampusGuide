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

            <div class="quiz-content">
                <h2 class="quiz-title">Quiz de Recommandation</h2>
                
                <div class="options">
                    <div class="option"></div>
                    <div class="option"></div>
                    <div class="option"></div>
                    <div class="option"></div>
                </div>

                <div class="next">
                    <span>suivant</span> ➔
                </div>
            </div>
        </div>
    </div>
    <ul class="background-bubbles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>
</body>
</html>
