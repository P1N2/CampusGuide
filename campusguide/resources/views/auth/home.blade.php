<!-- resources/views/welcome.blade.php par exemple -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CampusGuide</title>
  <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>

 <!-- Navigation -->
<header class="navbar">
  <h1 class="logo"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></h1> 
  <nav>
    <ul class="nav-links">
      <li><a href="/home">Accueil</a></li>
        <li><a href="{{ route('universities.search') }}">Universités</a></li>
        <li><a href="{{ route('fields.search') }}">Filières</a></li>
    </ul>
  </nav>
  
  <div class="navbar-right">
  <!-- <form action="" class="search-form" method="GET">
    <input type="text" name="query" placeholder="Rechercher..." required>
    <button type="submit">Rechercher</button>
  </form> -->

  @auth
    <div class="profile" id="profile">
      <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/login.jpg') }}" alt="Profil">
      <span class="profile-text">
        {{ Auth::user()->name }}<br>
        <small>{{ Auth::user()->bac_type ?? 'Étudiant' }}</small>
      </span>
    </div>

    <div class="dropdown-menu" id="dropdownMenu">
      <a href="/student">Mon espace personnel</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
      </form>
    </div>
  @endauth

  @guest
    <div class="auth-buttons">
      <a href="{{ route('login') }}" class="btn-start">Se connecter</a>
      <a href="{{ route('register') }}" class="btn-start">S’inscrire</a>
    </div>
  @endguest
</div>

</header>


  <!-- Hero Section -->
  <section class="hero">
    <div class="overlay">
      <h1><span class="highlight-yellow">Etudie</span> Local , <span class="highlight-blue">Reussis</span> global!</h1>
      <p class="subtitle">La carte des meilleurs universités locales pour toi</p>
    </div>
  </section>

  <!-- Description -->
  <section class="intro">
    <p>
      Découvrez les universités du Niger en un clin d'œil ! Comparez programmes, coûts et débouchés pour identifier la formation qui vous correspond.
      Accédez à toutes les informations clés en un seul endroit, sans intermédiaire. Trouvez l’établissement parfait pour votre projet d’études.
      Votre avenir commence par le bon choix – faites-le en toute autonomie !
    </p>
    <a href="#University" class="btn-start">Débuter</a>
  </section>
  <!-- Bloc de recherche rapide -->
<section class="quick-search">
  <div class="cards">
    <div class="card"  onclick="window.location.href='{{ route('universities.search') }}'">
      <div class="icon">🔍</div>
      <h3>Trouver une université</h3>
      <p>Search by subject, course or region to find the right course for you.</p>
    </div>
    <div class="card"  onclick="window.location.href='{{ route('fields.search') }}'">
      <div class="icon">📚</div>
      <h3>Chercher une Filière</h3>
      <p>Search for universities to find out about courses and more.</p>
    </div>
    <div class="card">
      <div class="icon">🏠</div>
      <h3>Nouvelles opportunités</h3>
      <p>Search and book open days to help you make the right choice.</p>
      <a href="#">Voir &rarr;</a>
    </div>
  </div>
</section>


<section class="ranking-section" id="University">
  <h2>Classements des meilleures universités du pays</h2>
  <div class="underline"></div>

  <div class="universities">
    @foreach ($universities->take(3) as $university)
      <div class="university-card">
        <a href="{{ Auth::check() ? route('university.show', $university->id) : route('register') }}">
          <img src="{{ asset($university->media_url) }}" alt="{{ $university->name }}">
        </a>
        <h4>{{ $university->name }}</h4>
      </div>
    @endforeach
  </div>

  @if ($universities->count() > 3)
    <div class="extra-universities" id="extra-universities">
      @foreach ($universities->skip(3) as $university)
        <div class="university-card">
          <a href="{{ Auth::check() ? route('university.show', $university->id) : route('register') }}">
            <img src="{{ asset($university->media_url) }}" alt="{{ $university->name }}">
          </a>
          <h4>{{ $university->name }}</h4>
        </div>
      @endforeach
    </div>

    <div style="text-align: center; margin-top: 20px;">
      <button id="view-all-universities" class="btn-view-all">Voir Tous</button>
    </div>
  @endif
</section>



<section class="popular-fields" id="field">
  <h2>Les filières les plus populaires</h2>
  <div class="underline"></div>
  <div class="fields">
    @foreach ($fields->take(3) as $field)
      <div class="field-card">
        <img src="{{ asset($field->image) }}" alt="{{ $field->name }}">
        <h4>{{ $field->name }}</h4>
        <a href="{{ Auth::check() ? '#' : route('register') }}">SEE COURSE GUIDE &rarr;</a>
      </div>
    @endforeach
  </div>

  @if ($fields->count() > 3)
    <div id="extra-fields" class="extra-fields">
      @foreach ($fields->skip(3) as $field)
        <div class="field-card">
          <img src="{{ asset($field->image) }}" alt="{{ $field->name }}">
          <h4>{{ $field->name }}</h4>
          <a href="{{ Auth::check() ? '#' : route('register') }}">SEE COURSE GUIDE &rarr;</a>
        </div>
      @endforeach
    </div>
    <a href="#field" id="view-all-fields" class="btn-view-all">Voir Tous</a>
  @endif
</section>


<!-- Footer -->
<footer class="main-footer">
  <div class="footer-content">
    <div class="footer-left">
      <h3>
        <img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo" style="height: 50px;">
      </h3>
      <p class="footer-desc">Votre passerelle vers l’université idéale au Niger.</p>
    </div>

    <div class="footer-links">
      <h4>Navigation</h4>
      <a href="/home">Accueil</a>
      <a href="{{ route('universities.search') }}">Universités</a>
      <a href="{{ route('fields.search') }}">Filières</a>
      <a href="#">Contact</a>
    </div>

    <div class="footer-social">
      <h4>Suivez-nous</h4>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>

  <p class="footer-bottom">© 2025 CampusGuide. Tous droits réservés.</p>
</footer>
<script src="{{ asset('js/home.js') }}" defer></script>
<script>
  window.isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
</script>

</body>
</html>
