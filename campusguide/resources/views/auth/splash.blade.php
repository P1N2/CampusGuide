<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CampusGuide | Chargement...</title>
    <link rel="stylesheet" href="{{ asset('css/splash.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="splash-container">
        <img src="{{ asset('assets/logo.png') }}" alt="CampusGuide Logo" class="logo">
        <div class="loader"></div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('home') }}";
        }, 5000); // 15 secondes
    </script>
</body>
</html>
