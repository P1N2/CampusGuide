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
            @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
            @endif


            <!-- <form method="POST" action="{{ route('quiz.step1') }}"> -->
   @auth
<form method="POST" action="{{ route('quiz.step1') }}">
    @csrf
    <h2>Quel est ton type de bac ?</h2>

    <label>
        <input type="radio" name="bac_type" value="Scientifique">
        <span class="checkmark"></span>
        Scientifique
    </label><br>

    <label>
        <input type="radio" name="bac_type" value="Littéraire">
        <span class="checkmark"></span>
        Littéraire
    </label><br>

    <label>
        <input type="radio" name="bac_type" value="Technique">
        <span class="checkmark"></span>
        Technique
    </label><br>

    <button type="submit">Suivant</button>
</form>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endauth

        </div>
    </div>
</body>
</html>
