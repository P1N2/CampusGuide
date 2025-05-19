<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $university->nom }} - CampusGuide</title>
  <link rel="stylesheet" href="{{ asset('css/university.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
<header class="navbar">
  <h1 class="logo"> <a href="/home"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></a></h1> 
  <nav>
    <ul class="nav-links">
      <li><a href="/home">Accueil</a></li>
      <li><a href="{{ route('universities.search') }}">Universités</a></li>
      <li><a href="{{ route('fields.search') }}">Filières</a></li>
    </ul>
    </ul>
  </nav>
  <div class="profile" id= "profile">
    <img src="{{ asset('assets/login.jpg') }}" alt="Profil">
    <span class="profile-text">
        {{ Auth::user()->name }}<br>
        <small>{{ Auth::user()->bac_type ?? 'Étudiant' }}</small>
  </div>
  <div class="dropdown-menu" id="dropdownMenu">
      <a href="{{ route('student.dashboard') }}">Mon espace personnel</a>
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
          <h1>{{ $university->name }}</h1>
                @php
                      $isFavorited = auth()->user()->favorites->contains('university_id', $university->id);
                  @endphp

                  <button 
                      class="favorite-btn {{ $isFavorited ? 'active' : '' }}" 
                      data-id="{{ $university->id }}" 
                      title="{{ $isFavorited ? 'Retirer des favoris' : 'Ajouter aux favoris' }}">
                      <i class="fa{{ $isFavorited ? 's' : 'r' }} fa-heart"></i>
                  </button>
          <p>{{ $university->slogan ?? 'Excellence, Innovation, Réussite' }}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- Présentation -->
<!-- Présentation + Historique -->
<!-- Présentation simple -->
<section class="university-presentation animated-section">
  <h2>Présentation de l’Université</h2>
  <p class="presentation-text">
    {{ $university->description ?? 'Cette université offre un cadre d’apprentissage moderne et inclusif.' }}
  </p>
</section>

<!-- Historique avec image/logo à gauche -->
<section class="university-history-visual animated-section">
  <div class="history-container">
    <div class="history-image">
      <img src="{{ asset('assets/login.jpg') }}" alt="Logo Université">
    </div>
    <div class="history-text">
      <h2>Historique</h2>
      <p>
        {{ $university->history ?? 'L’historique de l’université n’est pas encore disponible.' }}
      </p>
    </div>
  </div>
</section>


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

<<section class="info-details-modern">
  <h2>Informations complémentaires</h2>
  <ul class="info-list">

    <!-- @if($university->history)
    <li>
      <i class="fas fa-landmark"></i>
      <strong>Historique :</strong>
      <p>{{ $university->history }}</p>
    </li>
    @endif -->

    @if($university->location)
    <li>
      <i class="fas fa-map-marker-alt"></i>
      <strong>Localisation :</strong>
      <span>{{ $university->location }}</span>
    </li>
    @endif

    @if($university->tuition_fee)
    <li class="glow-effect">
      <i class="fas fa-money-bill-wave"></i>
      <strong>Frais de scolarité :</strong>
      <span>{{ number_format($university->tuition_fee, 0, ',', ' ') }} FCFA</span>
    </li>
    @endif

    @if($university->note)
    <li>
      <i class="fas fa-star"></i>
      <strong>Note Moyenne :</strong>
      <span>
        @for($i = 1; $i <= 10; $i++)
          <i class="fas fa-star{{ $i <= $university->note ? '' : '-o' }}"></i>
        @endfor
        ({{ $university->note }}/10)
      </span>
    </li>
    @endif

    <!-- @if($university->media_url)
    <li>
      <i class="fas fa-video"></i>
      <strong>Vidéo de présentation :</strong>
      <a href="{{ $university->media_url }}" target="_blank">Voir la vidéo</a>
    </li>
    @endif -->

    @if($university->application_link)
    <li>
      <i class="fas fa-external-link-alt"></i>
      <strong>Lien d'inscription :</strong>
      <a href="{{ $university->application_link }}" target="_blank" class="link-button">S’inscrire maintenant</a>
    </li>
    @endif

    @if($university->pdf_url)
    <li>
      <i class="fas fa-file-pdf"></i>
      <strong>Brochure PDF :</strong>
      <a href="{{ $university->application_link }}" target="_blank" class="link-button">Télécharger</a>
    </li>
    @endif

  </ul>
</section>

@auth
<section class="rating-section" style="margin: 40px auto; text-align: center;">
    <h2>Notez cette université</h2>
    <div id="starRating" style="font-size: 2.5rem; color: #ccc; cursor: pointer;">
        @for ($i = 1; $i <= 5; $i++)
            <i class="fa-star fa{{ $i <= floor($university->note / 2) ? 's' : 'r' }} star" data-value="{{ $i }}"></i>
        @endfor
    </div>
    <div id="ratingMessage" style="margin-top: 10px;"></div>
</section>
@endauth



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
<script>
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function () {
        const note = this.getAttribute('data-value');
        const universityId = {{ $university->id }};
        const stars = document.querySelectorAll('.star');

        // Remplir les étoiles visuellement
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= note) {
                s.classList.remove('far');
                s.classList.add('fas');
                s.style.color = 'gold';
            } else {
                s.classList.remove('fas');
                s.classList.add('far');
                s.style.color = '#ccc';
            }
        });

        // Envoyer la note via AJAX
       fetch(`/universities/${universityId}/rate`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ note })
})
.then(async response => {
    const text = await response.text(); // récupère même si pas JSON
    try {
        const data = JSON.parse(text);
        document.getElementById('ratingMessage').innerText = data.message || 'Note enregistrée !';
    } catch (e) {
        console.error("Erreur JSON :", text);
        document.getElementById('ratingMessage').innerText = "Erreur serveur : " + text;
    }
})
.catch(error => {
    console.error('Erreur JS:', error);
    document.getElementById('ratingMessage').innerText = "Erreur lors de l'envoi.";
});

    });
});
</script>

</body>
</html>
