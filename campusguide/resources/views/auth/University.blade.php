<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Université X - CampusGuide</title>
  <link rel="stylesheet" href="{{ asset('css/university.css') }}">
</head>
<body>
<header class="navbar">
  <h1 class="logo"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></h1> 
  <nav>
    <ul class="nav-links">
      <li><a href="/home">Accueil</a></li>
      <li><a href="#University">Universités</a></li>
      <li><a href="#field">Filières</a></li>
      <li><a href="/profile">Mon Espace</a></li>
    </ul>
  </nav>
  <div class="profile">
    <img src="{{ asset('assets/login.jpg') }}" alt="Profil">
    <span class="profile-text">Penouel<br><small>Baccalauréat A</small></span>
  </div>
</header>

<!-- Bannière défilante -->
<section class="banner">
  <div class="carousel">
    <div class="slide active">
      <img src="{{ asset('assets/uni1.jpg') }}" alt="Slide 1">
      <div class="overlay">
        <h1>Université X</h1>
        <p>Excellence, Innovation, Réussite</p>
      </div>
    </div>
    <div class="slide">
      <img src="{{ asset('assets/uni2.jpg') }}" alt="Slide 2">
      <div class="overlay">
        <h1>Formations de qualité</h1>
        <p>Des domaines variés et modernes</p>
      </div>
    </div>
    <div class="slide">
      <img src="{{ asset('assets/uni3.jpg') }}" alt="Slide 3">
      <div class="overlay">
        <h1>Un avenir prometteur</h1>
        <p>Rejoignez-nous pour construire demain</p>
      </div>
    </div>
  </div>
</section>

<!-- Présentation -->
<section class="presentation animated-section">
  <h2>Présentation de l’Université</h2>
  <p>
    Bienvenue à l’Université X, un établissement d’enseignement supérieur de renom situé au cœur de Niamey.
    Notre université propose un environnement moderne, des enseignants expérimentés et une pédagogie axée sur l’innovation. 
    Nous accompagnons les étudiants vers l’excellence, avec des filières variées et des opportunités internationales.
  </p>
</section>

<!-- Infos Clés -->
<section class="info-cle">
  <div class="info-box"><strong>Localisation:</strong> Niamey</div>
  <div class="info-box"><strong>Frais moyens:</strong> 250 000 FCFA/an</div>
  <div class="info-box"><strong>Type:</strong> Privée</div>
  <div class="info-box"><strong>Filières:</strong> 12</div>
</section>

<!-- Galerie d’images -->
<section class="gallery">
  <h2>Galerie</h2>
  <div class="gallery-preview">
    <img src="{{ asset('assets/uni1.jpg') }}" alt="Image 1">
    <img src="{{ asset('assets/uni2.jpg') }}" alt="Image 2">
    <img src="{{ asset('assets/uni3.jpg') }}" alt="Image 3">
    <button id="viewAll">Voir tout</button>
  </div>
</section>

<!-- Modal Galerie -->
<div id="galleryModal" class="modal">
  <span class="close">&times;</span>
  <div class="modal-content">
    <img src="{{ asset('assets/uni1.jpg') }}" alt="Image 1">
    <img src="{{ asset('assets/uni2.jpg') }}" alt="Image 2">
    <img src="{{ asset('assets/uni3.jpg') }}" alt="Image 3">
    <img src="{{ asset('assets/quiz4.jpg') }}" alt="Image 4">
  </div>
</div>

<!-- Filières sous forme de cards -->
<section class="ranking-section" id="field">
  <h2>Filières proposées</h2>
  <div class="underline"></div>
  <div class="universities">
    <div class="university-card">
      <img src="{{ asset('assets/field1.jpeg') }}" alt="Informatique">
      <h4>Informatique de Gestion</h4>
      <a href="#">Voir plus &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/field2.jpeg') }}" alt="Economie">
      <h4>Sciences Économiques</h4>
      <a href="#">Voir plus &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/field3.jpeg') }}" alt="Design">
      <h4>Design Graphique</h4>
      <a href="#">Voir plus &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/field2.jpeg') }}" alt="Génie Civil">
      <h4>Génie Civil</h4>
      <a href="#">Voir plus &rarr;</a>
    </div>
  </div>
</section>

<!-- Coordonnées + Contact -->
<section class="contact-section">
  <div class="contact-container">
    <img src="{{ asset('assets/login.jpg') }}" alt="Campus">
    <div class="contact-info">
      <h3>Coordonnées</h3>
      <p><strong>Adresse :</strong> Quartier Plateau, Niamey</p>
      <p><strong>Téléphone :</strong> +227 90 00 00 00</p>
      <p><strong>Email :</strong> contact@univx.edu.ne</p>
      <button>Contactez-nous</button>
      <button>S'inscrire</button>
    </div>
  </div>
</section>

<script src="{{ asset('js/university.js') }}"></script>
</body>
</html>
