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
        <li><a href="#University">Universités</a></li>
        <li><a href="#field">Filières</a></li>
        <li><a href="/profile">Mon Espace</a></li>
      </ul>
    </nav>
    <form action="" class="search-form" method="GET">
      <input type="text" name="query" placeholder="Rechercher..." required>
      <button type="submit">Rechercher</button>
    </form>
    <div class="profile">
      <img src="{{ asset('assets/login.jpg') }}" alt="Profil">
      <span class="profile-text">Penouel<br><small>Baccalaureat A</small></span>
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
    <a href="#" class="btn-start">Débuter</a>
  </section>
  <!-- Bloc de recherche rapide -->
<section class="quick-search">
  <div class="cards">
    <div class="card">
      <div class="icon">🔍</div>
      <h3>Trouver une université</h3>
      <p>Search by subject, course or region to find the right course for you.</p>
      <a href="#">Voir &rarr;</a>
    </div>
    <div class="card">
      <div class="icon">📚</div>
      <h3>Chercher une Filière</h3>
      <p>Search for universities to find out about courses and more.</p>
      <a href="#">Voir &rarr;</a>
    </div>
    <div class="card">
      <div class="icon">🏠</div>
      <h3>Nouvelles opportunités</h3>
      <p>Search and book open days to help you make the right choice.</p>
      <a href="#">Voir &rarr;</a>
    </div>
  </div>
</section>

<!-- Classement universités -->
<section class="ranking-section" id="University">
  <h2>Classements des meilleurs universités du pays</h2>
  <div class="underline"></div>
  <div class="universities">
    <div class="university-card">
      <a href="/University"><img src="{{ asset('assets/uni1.jpg') }}" alt="Université X"></a>
      <h4>Université X</h4>
      <a href="/University">Voir université &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/uni2.jpg') }}" alt="Université Y">
      <h4>Université Y</h4>
      <a href="#">Voir université &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/uni3.jpg') }}" alt="Université Z">
      <h4>Université Z</h4>
      <a href="#">Voir université &rarr;</a>
    </div>
  </div>
  <div id="extra-universities" class="extra-universities">
    <!-- D'autres universités cachées -->
    <div class="university-card">
      <img src="{{ asset('assets/uni2.jpg') }}" alt="Université A">
      <h4>Université A</h4>
      <a href="#">Voir université &rarr;</a>
    </div>
    <div class="university-card">
      <img src="{{ asset('assets/uni3.jpg') }}" alt="Université B">
      <h4>Université B</h4>
      <a href="#">Voir université &rarr;</a>
    </div>
    <!-- Ajouter autant d'universités que nécessaire -->
  </div>
  <a href="javascript:void(0)" id="view-all-universities" class="btn-view-all">Voir Tous</a>
</section>

<!-- Filières populaires -->
<section class="popular-fields" id="field">
  <h2>Les filières les plus populaires</h2>
  <div class="underline"></div>
  <div class="fields">
    <div class="field-card">
      <img src="{{ asset('assets/field1.jpeg') }}" alt="UX Design">
      <h4>User experience design</h4>
      <a href="#">SEE COURSE GUIDE &rarr;</a>
    </div>
    <div class="field-card">
      <img src="{{ asset('assets/field2.jpeg') }}" alt="Computer science">
      <h4>Computer science</h4>
      <a href="#">SEE COURSE GUIDE &rarr;</a>
    </div>
    <div class="field-card">
      <img src="{{ asset('assets/field3.jpeg') }}" alt="Business management">
      <h4>Business management</h4>
      <a href="#">SEE COURSE GUIDE &rarr;</a>
    </div>
  </div>
  <div id="extra-fields" class="extra-fields">
    <!-- D'autres filières cachées -->
    <div class="field-card">
      <img src="{{ asset('assets/field2.jpeg') }}" alt="Data Science">
      <h4>Data Science</h4>
      <a href="#">SEE COURSE GUIDE &rarr;</a>
    </div>
    <div class="field-card">
      <img src="{{ asset('assets/field3.jpeg') }}" alt="Engineering">
      <h4>Engineering</h4>
      <a href="#">SEE COURSE GUIDE &rarr;</a>
    </div>
  </div>
  <a href="javascript:void(0)" id="view-all-fields" class="btn-view-all">Voir Tous</a>
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
      <a href="#">Accueil</a>
      <a href="#">Universités</a>
      <a href="#">Filières</a>
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

</body>
</html>
