<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Étudiant</title>
  <link rel="stylesheet" href="{{ asset('css/student.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
  <div class="student-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Bienvenue {{ Auth::user()->name }}</h2>
     

      <ul>
        <li><a href="#" class="menu-link active" data-section="home"><i class="fas fa-home"></i> Accueil</a></li>
        <li><a href="#" class="menu-link" data-section="favorites"><i class="fas fa-star"></i> Mes favoris</a></li>
        <li><a href="#" class="menu-link" data-section="profile"><i class="fas fa-user"></i> Profil</a></li>
        <li><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Retour à l’accueil</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
              @csrf
              <button type="submit" style="background: none; border: none; color: #fff; padding: 0; font: inherit; cursor: pointer;">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
              </button>
            </form>
          </li>
      </ul>
    </aside>

    <!-- Main content -->
    <main class="main-content">
      <section id="home" class="content-section">
   <div style="display: flex; justify-content: space-between; align-items: center;">
  <h1 style="margin: 0;">Bienvenue {{ Auth::user()->name }} <i class="fas fa-hand"></i></h1>
  <div class="notification-wrapper" id="notificationIcon">
    <i class="fas fa-bell notif-icon"></i>

    <div id="notifDropdown" class="notif-dropdown">
      <div class="notif-title">Nouvelles universités</div>
      <div id="notifContent" class="notif-content">
      <p class="no-notif">Chargement...</p>
      </div>
    </div>

    <span id="notifCount" class="notif-count">0</span>
  </div>
</div>
<p>Heureux de te revoir sur CampusGuide. Explore, découvre et construis ton avenir !</p>
    <!-- Carte de stats -->
    <div class="stat-card-container">
        <div class="stat-card">
            <h2>{{ $favorites->count() }}</h2>
            <p>Universités en favori</p>
        </div>
    </div>

    <!-- Boutons d'actions rapides -->
    <div class="quick-actions">
        <a href="{{ route('universities.search') }}" class="btn-action"><i class="fas fa-school"></i> Trouver une université</a>
        <a href="{{ route('fields.search') }}" class="btn-action"><i class="fas fa-book"></i> Chercher une filière</a>
    </div>

    <!-- Bande d'annonce : universités aléatoires -->
    <h2 style="margin-top: 30px;">Découvre aussi...</h2>
    <div class="university-banner">
        @foreach ($randomUniversities as $university)
            <div class="banner-card">
                <img src="{{ asset($university->media_url) }}" alt="{{ $university->name }}">
                <div class="banner-info">
                    <h3>{{ $university->name }}</h3>
                    <p>{{ Str::limit($university->description, 80) }}</p>
                    <a href="{{ route('university.show', $university->id) }}" class="btn-see-more">Voir plus</a>
                </div>
            </div>
        @endforeach
    </div>
</section>


    <section id="favorites" class="content-section" style="display: none;">
  <h1 style="text-align: center; font-size: 2rem; margin-bottom: 1.5rem;"><i class="fas fa-heart"></i>  Mes Universités Favorites</h1>

  @if ($favorites->isEmpty())
    <p style="text-align: center; font-size: 1.1rem; color: gray;">Tu n'as pas encore ajouté d'université en favori.</p>
  @else
    <div class="favorite-cards-container">
      @foreach ($favorites as $favorite)
        <div class="favorite-card">
          <div class="favorite-info">
            <h3>{{ $favorite->university->name }}</h3>
            <p>{{ Str::limit($favorite->university->description, 100) }}</p>
          </div>
          <div class="favorite-actions">
            <a href="{{ route('university.show', $favorite->university->id) }}" class="view-link" title="Voir l'université">
              <i class="fa-solid fa-eye"></i>
            </a>
            <form method="POST" action="{{ route('student.deleteFavorite', $favorite->university->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete-btn" title="Supprimer des favoris">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</section>

    <section id="profile" class="content-section" style="display: none;">
  <div class="logo">
    <img src="{{ asset('assets/logo.png') }}" alt="CampusGuide Logo">
  </div>

  <h1>Mon Profil</h1>

  @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
  @endif

  <form method="POST" action="{{ route('student.updateProfile') }}">
    @csrf
    @method('PUT')

    <div class="input-group">
      <label>Nom :</label>
      <input type="text" name="name" value="{{ $user->name }}" required>
      <i class="fas fa-user"></i>
    </div>

    <div class="input-group">
      <label>Email :</label>
      <input type="email" name="email" value="{{ $user->email }}" required>
      <i class="fas fa-envelope"></i>
    </div>

    <div class="input-group">
      <label>Type de Bac :</label>
      <input type="text" name="bac_type" value="{{ $user->bac_type }}">
      <i class="fas fa-graduation-cap"></i>
    </div>

    <div class="input-group">
      <label>Matière Préférée :</label>
      <input type="text" name="favorite_subject" value="{{ $user->favorite_subject }}">
      <i class="fas fa-book"></i>
    </div>

    <div class="input-group">
      <label>Domaine d’Intérêt :</label>
      <input type="text" name="interest_area" value="{{ $user->interest_area }}">
      <i class="fas fa-lightbulb"></i>
    </div>

    <button type="submit">Mettre à jour</button>
  </form>
</section>

    </main>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const links = document.querySelectorAll('.menu-link');
      const sections = document.querySelectorAll('.content-section');

      links.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();

          links.forEach(l => l.classList.remove('active'));
          link.classList.add('active');

          const target = link.getAttribute('data-section');
          sections.forEach(section => {
            section.style.display = section.id === target ? 'block' : 'none';
          });
        });
      });
    });
    document.addEventListener('DOMContentLoaded', function () {
    fetch('/student/new-universities') // Tu peux aussi utiliser une route nommée
      .then(response => response.json())
      .then(data => {
        const count = data.length;
        if (count > 0) {
          const badge = document.getElementById('notifCount');
          badge.innerText = count;
          badge.style.display = 'flex';
        }
      });
  });
  const notifIcon = document.getElementById('notificationIcon');
const notifDropdown = document.getElementById('notifDropdown');
const notifContent = document.getElementById('notifContent');
const universityShowBase = "{{ url('universities') }}/";
notifIcon.addEventListener('click', function () {
  // Toggle dropdown visibility
  const isVisible = notifDropdown.style.display === 'block';
  notifDropdown.style.display = isVisible ? 'none' : 'block';

  if (!isVisible && notifContent.dataset.loaded !== 'true') {
    // Affichage de chargement
    notifContent.innerHTML = '<p class="no-notif">Chargement...</p>';

    fetch('/student/new-universities')
      .then(response => response.json())
      .then(data => {
        if (data.length === 0) {
          notifContent.innerHTML = '<p class="no-notif">Aucune nouveauté.</p>';
        } else {
          notifContent.innerHTML = data.map(u => `
            <div class="notif-item">
              <strong>${u.name}</strong><br>
              <small>${u.description}</small><br>
              <a href="${universityShowBase}${u.id}" class="btn-see-more">Voir</a>
            </div>
          `).join('');
        }

        notifContent.dataset.loaded = 'true'; // Évite de recharger à chaque clic
      })
      .catch(() => {
        notifContent.innerHTML = '<p class="no-notif">Erreur lors du chargement.</p>';
      });
  }
});

// Fermer le dropdown si on clique ailleurs
document.addEventListener('click', function (e) {
  if (!notifIcon.contains(e.target) && !notifDropdown.contains(e.target)) {
    notifDropdown.style.display = 'none';
  }
});
  </script>
</body>
</html>
