<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
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
        <li><a href="#" class="menu-link" data-section="history"><i class="fas fa-history"></i> Historique</a></li>
        <li><a href="#" class="menu-link" data-section="profile"><i class="fas fa-user"></i> Profil</a></li>
        <li><a href="#" class="menu-link" data-section="settings"><i class="fas fa-cog"></i> Paramètres</a></li>
      </ul>
    </aside>

    <!-- Main content -->
    <main class="main-content">
      <section id="home" class="content-section">
        <h1>Bienvenue sur ton espace étudiant</h1>
        <p>Découvre les universités, consulte les filières et construis ton avenir avec CampusGuide.</p>
      </section>

      <section id="favorites" class="content-section" style="display: none;">
        <h1>Mes Universités Favorites</h1>

        @if ($favorites->isEmpty())
          <p>Tu n'as pas encore ajouté d'université en favori.</p>
        @else
          <ul>
            @foreach ($favorites as $favorite)
              <li>
                <a href="{{ route('university.show', $favorite->university->id) }}">
                  {{ $favorite->university->name }}
                </a>
                <form method="POST" action="{{ route('student.deleteFavorite', $favorite->university->id) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="background:none; border:none; color:red; cursor:pointer;" title="Supprimer des favoris">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </li>
            @endforeach
          </ul>
        @endif
      </section>

      <!-- Onglets non encore implémentés -->
      <section id="history" class="content-section" style="display: none;">
        <h1>Historique de recherche</h1>
        <p><em>À venir...</em></p>
      </section>

      <section id="profile" class="content-section" style="display: none;">
        <h1>Mon Profil</h1>
        <p><em>À venir...</em></p>
      </section>

      <section id="settings" class="content-section" style="display: none;">
        <h1>Paramètres</h1>
        <p><em>À venir...</em></p>
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
  </script>
</body>
</html>
