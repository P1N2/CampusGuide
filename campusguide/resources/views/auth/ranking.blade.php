<!-- resources/views/auth/ranking.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Classement des Universités - CampusGuide</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: #f3f4f6;
    }

    header {
      background-color: #1f2937;
      color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      animation: slideDown 1s ease-in-out;
    }

    @keyframes slideDown {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    h1 {
      font-size: 2.5rem;
      margin: 0;
    }

    .ranking-list {
      max-width: 800px;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      animation: fadeInUp 0.8s ease-in-out;
    }

    @keyframes fadeInUp {
      from {
        transform: translateY(40px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .university-item {
      display: flex;
      align-items: center;
      padding: 15px 10px;
      border-bottom: 1px solid #e5e7eb;
      transition: background 0.3s, transform 0.3s;
      text-decoration: none;
      color: inherit;
    }

    .university-item:hover {
      background-color: #f9fafb;
      transform: scale(1.01);
      cursor: pointer;
    }

    .university-item:last-child {
      border-bottom: none;
    }

    .rank-number {
      font-size: 1.8rem;
      font-weight: bold;
      margin-right: 20px;
      color: #3b82f6;
      width: 40px;
      text-align: center;
    }

    .university-details {
      flex-grow: 1;
    }

    .university-name {
      font-size: 1.2rem;
      font-weight: 600;
      color: #111827;
    }

    .university-slogan {
      font-size: 0.95rem;
      color: #6b7280;
    }

    .note {
      font-size: 1rem;
      color: #f59e0b;
      white-space: nowrap;
    }

    .note i {
      color: #fbbf24;
    }
    .back-button {
      display: block;
      text-align: center;
      padding: 10px 20px;
      background-color: #E5B300;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      width: fit-content;
     
    }

    .back-button:hover {
      background-color:rgb(255, 255, 255);
      color: #1f2937;
    }
  </style>
</head>
<body>
  <header>
    <a href="{{ route('home') }}" class="back-button">← Retour à l’accueil</a>
    <h1><i class="fas fa-trophy"></i> Classement des Universités</h1>
  </header>

  <div class="ranking-list">
    @foreach($universities as $index => $university)
      <a href="{{ route('university.show', $university->id) }}" class="university-item">
        <div class="rank-number">#{{ $index + 1 }}</div>
        <div class="university-details">
          <div class="university-name">
            <i class="fas fa-university"></i> {{ $university->name }}
          </div>
          <div class="university-slogan">
            {{ $university->slogan ?? 'Excellence, Innovation, Réussite' }}
          </div>
        </div>
        <div class="note">
          @php
            $note = $university->note ?? 0;
          @endphp
          @for ($i = 1; $i <= 10; $i++)
            <i class="fa{{ $i <= $note ? 's' : 'r' }} fa-star"></i>
          @endfor
          ({{ $note }}/10)
        </div>
      </a>
    @endforeach
  </div>
</body>
</html>
