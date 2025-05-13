<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>{{ $university->nom }} - CampusGuide</title>
  <link rel="stylesheet" href="{{ asset('css/university.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
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
  <div class="profile" id= "profile">
    <img src="{{ asset('assets/login.jpg') }}" alt="Profil">
    <span class="profile-text">Penouel<br><small>Baccalauréat A</small></span>
  </div>
  <div class="dropdown-menu" id="dropdownMenu">
      <a href="/profile">Mon espace personnel</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
      </form>
    </div>
</header>

<!-- Bannière défilante -->
<section class="banner">
  <div class="carousel">
    @foreach($bannerImages as $index => $image)
      <div class="slide {{ $index === 0 ? 'active' : '' }}">
      <img src="{{ asset($image->image_path) }}" alt="Bannière {{ $index + 1 }}">
        <div class="overlay">
          <h1>{{ $university->nom }}</h1>
          <p>{{ $university->slogan ?? 'Excellence, Innovation, Réussite' }}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- Présentation -->
<section class="presentation animated-section">
  <h2>Présentation de l’Université</h2>
  <p>
    {{ $university->description ?? 'Bienvenue à notre université, un établissement d’enseignement supérieur de renom, offrant des formations de qualité.' }}
  </p>
</section>



<!-- Galerie d’images -->
<section class="gallery">
  <h2>Galerie</h2>
  <div class="gallery-preview">
    @foreach($galleryImages->take(4) as $image)
      <img src="{{ asset($image->image_path) }}" alt="Image galerie">
    @endforeach
    <button id="viewAll">Voir tout</button>
  </div>
</section>

<!-- Modal Galerie -->
<div id="galleryModal" class="modal">
  <span class="close">&times;</span>
  <div class="modal-content">
  @foreach($galleryImages->take(10) as $image)
      <img src="{{ asset($image->image_path) }}" alt="Image galerie">
    @endforeach
  </div>
</div>
@php use Illuminate\Support\Str; @endphp
<section class="ranking-section" id="field">
  <h2>Filières proposées</h2>
  <div class="underline"></div>

  <div class="field-carousel-wrapper">
    <button class="carousel-btn left" id="prevBtn"><i class="fas fa-chevron-left"></i></button>

    <div class="field-carousel" id="fieldCarousel">
      @forelse($fields as $field)
        <div class="field-card">
          <img src="{{ asset($field->image) }}" alt="{{ $field->name }}">
          <h4>{{ $field->name }}</h4>
          <p>{{ $field->description }}</p>
        </div>
      @empty
        <p>Aucune filière disponible pour cette université.</p>
      @endforelse
    </div>

    <button class="carousel-btn right" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
  </div>
</section>



<!-- Coordonnées + Contact -->
<section class="contact-section">
  <div class="contact-container">
    <img src="{{ asset('assets/login.jpg') }}" alt="Campus">
    <div class="contact-info">
      <h3>Coordonnées</h3>
      <p><strong>Adresse :</strong> {{ $university->adresse }}</p>
      <p><strong>Téléphone :</strong> {{ $university->telephone }}</p>
      <p><strong>Email :</strong> {{ $university->email }}</p>
      <button>Contactez-nous</button>
      <button>S'inscrire</button>
    </div>
  </div>
</section>

<script src="{{ asset('js/university.js') }}"></script>
</body>
</html>
