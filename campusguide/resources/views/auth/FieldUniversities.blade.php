<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Universités pour la filière {{ $field->name }}</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      color: #222;
    }

    header {
      text-align: center;
      background-color: #36384E;
      color: white;
      padding: 40px 20px;
      font-size: 24px;
      font-weight: bold;
    }

    .underline {
      width: 60px;
      height: 5px;
      background-color: #f0b400;
      margin: 10px auto 30px auto;
      border-radius: 5px;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
    }

    .universities {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
    }

    .university-card {
      background: white;
      width: 280px;
      text-align: center;
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      overflow: hidden;
      text-decoration: none;
    }

    .university-card:hover {
      transform: translateY(-6px);
    }

    .university-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-bottom: 1px solid #eee;
    }

    .university-card h4 {
      margin: 15px 0;
      font-size: 18px;
      color: #333;
    }

    .back-button {
      display: block;
      text-align: center;
      margin-top: 50px;
      padding: 10px 20px;
      background-color: #36384E;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      width: fit-content;
      margin-left: auto;
      margin-right: auto;
    }

    .back-button:hover {
      background-color: #E5B300;
    }
    @media (max-width: 600px) {
      .university-card {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <header>
    Universités qui enseignent : {{ $field->name }}
  </header>
  <div class="underline"></div>

  <div class="container">
    @if($field->universities->isEmpty())
      <p style="text-align:center;">Aucune université n’enseigne cette filière pour le moment.</p>
    @else
      <div class="universities">
        @foreach($field->universities as $university)
          <a href="{{ route('university.show', $university->id) }}" class="university-card">
            <img src="{{ asset($university->media_url) }}" alt="{{ $university->name }}">
            <h4>{{ $university->name }}</h4>
          </a>
        @endforeach
      </div>
    @endif

    <a href="{{ route('home') }}" class="back-button">← Retour à l’accueil</a>
  </div>
</body>
</html>
