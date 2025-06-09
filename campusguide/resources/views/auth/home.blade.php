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
<header class="navbar" id="navbar">
  <h1 class="logo"> <a href="/home"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></a></h1> 
  
<nav>
 @auth 
  <!-- Le menu burger (mobile uniquement) -->
  <div class="burger">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <ul class="nav-links">
    <li>
      <a href="/home">
        <i class="fa-solid fa-house"></i> Accueil
      </a>
    </li>
    <li>
      <a href="{{ route('universities.search') }}">
        <i class="fa-solid fa-university"></i> Universités
      </a>
    </li>
    <li>
      <a href="{{ route('fields.search') }}">
        <i class="fa-solid fa-book"></i> Filières
      </a>
    </li>
  </ul>
</nav>
  @endauth
  <div class="navbar-right">
  @auth
    <div class="notif-wrapper">
  <div class="notification-icon" id="notificationIcon">
    <i class="fa-solid fa-bell"></i>
    <span id="notifCount" class="notif-count" style="display: none;">0</span>
  </div>

  <div class="notif-dropdown" id="notifDropdown" style="display: none;">
    <div class="notif-content" id="notifContent" data-loaded="false">
      <p class="no-notif">Chargement...</p>
    </div>
  </div>
</div>
    <div class="profile" id="profile">
      <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/login.jpg') }}" alt="Profil">
      <span class="profile-text">
        {{ Auth::user()->name }}<br>
        <small>{{ Auth::user()->bac_type ?? 'Étudiant' }}</small>
      </span>
    </div>

    <div class="dropdown-menu" id="dropdownMenu">
      <a href="{{ route('student.dashboard') }}">Mon espace personnel</a>
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

    <div class="card" onclick="window.location.href='{{ route('universities.search') }}'">
      <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
      <h3>Trouver une université</h3>
      <p>Explorez les établissements et découvrez celui qui correspond à votre avenir académique.</p>
    </div>

    <div class="card" onclick="window.location.href='{{ route('fields.search') }}'">
      <div class="icon"><i class="fa-solid fa-book-open"></i></div>
      <h3>Chercher une Filière</h3>
        <p>Identifiez la filière idéale selon vos intérêts et explorez les options disponibles.</p>
    </div>

    <a href="{{ route('universities.ranking') }}" class="card" style="text-decoration: none; color: inherit;">
      <div class="icon"><i class="fa-solid fa-trophy"></i></div>
      <h3>Classement des universités</h3>
      <p>Découvrez les universités les mieux notées selon les utilisateurs.</p>
    </a>

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
      @php
  $universities = $field->universities;
@endphp

<a href="{{ $universities->count() === 1 
              ? route('university.show', $universities->first()->id) 
              : route('field.universities', $field->id) 
          }}" class="field-card">
        <img src="{{ asset($field->image) }}" alt="{{ $field->name }}">
        <h4>{{ $field->name }}</h4>
      </a>
    @endforeach
  </div>

  @if ($fields->count() > 3)
    <div id="extra-fields" class="extra-fields">
      @foreach ($fields->skip(3) as $field)
       @php
  $universities = $field->universities;
@endphp

<a href="{{ $universities->count() === 1 
              ? route('university.show', $universities->first()->id) 
              : route('field.universities', $field->id) 
          }}" class="field-card">
          <img src="{{ asset($field->image) }}" alt="{{ $field->name }}">
          <h4>{{ $field->name }}</h4>
          <!-- <span>SEE COURSE GUIDE &rarr;</span> -->
        </a>
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
    </div>

    <div class="footer-social">
      <h4>Contactez-Nous</h4>
      <p><i class="fas fa-envelope"></i> <a href="mailto:aogapenouel@gmail.com">aogapenouel@gmail.com</a></p>
      <p><i class="fas fa-phone"></i> <a href="tel:+22793843135">+227 74 25 72 86</a></p>
    </div>
  </div>

  <p class="footer-bottom">© 2025 CampusGuide. Tous droits réservés.</p>
</footer>
<script src="{{ asset('js/home.js') }}" defer></script>
<script>
  window.isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
  document.addEventListener('DOMContentLoaded', function () {
  // Charger le nombre de nouvelles universités
  fetch('/student/new-universities')
    .then(response => response.json())
    .then(data => {
      const count = data.length;
      const badge = document.getElementById('notifCount');
      if (count > 0) {
        badge.textContent = count;
        badge.style.display = 'inline-block';
      } else {
        badge.textContent = '0';
        badge.style.display = 'inline-block';
      }
    });

  // Dropdown logic
  const notifIcon = document.getElementById('notificationIcon');
  const notifDropdown = document.getElementById('notifDropdown');
  const notifContent = document.getElementById('notifContent');

  notifIcon.addEventListener('click', function () {
    const isVisible = notifDropdown.style.display === 'block';
    notifDropdown.style.display = isVisible ? 'none' : 'block';

    if (!isVisible && notifContent.dataset.loaded !== 'true') {
      notifContent.innerHTML = '<p class="no-notif">Chargement...</p>';

      fetch('/student/new-universities')
        .then(response => response.json())
        .then(data => {
          if (data.length === 0) {
            notifContent.innerHTML = '<p class="no-notif">Aucune nouveauté.</p>';
          } else {
            notifContent.innerHTML = data.map(u => `
              <div class="notif-item">
                <strong>${u.name}</strong>
                <small>Ajoutée le ${new Date(u.created_at).toLocaleDateString()}</small><br>
                <a href="/university/${u.id}" class="btn-see-more">Voir</a>
              </div>
            `).join('');
          }

          notifContent.dataset.loaded = 'true';
        })
        .catch(() => {
          notifContent.innerHTML = '<p class="no-notif">Erreur lors du chargement.</p>';
        });
    }
  });

  document.addEventListener('click', function (e) {
    const icon = document.getElementById('notificationIcon');
    const dropdown = document.getElementById('notifDropdown');
    if (!icon.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });
});
</script>

</body>
</html>
