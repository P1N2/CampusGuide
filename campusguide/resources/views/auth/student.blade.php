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
      <h2>Bienvenue{{ Auth::user()->name }}</h2>
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
        <p>Liste à venir avec les universités que tu as ajoutées en favori.</p>
      </section>

      <section id="history" class="content-section" style="display: none;">
        <h1>Historique de recherche</h1>
        <p>Retrouve ici les universités et filières que tu as consultées récemment.</p>
      </section>

      <section id="profile" class="content-section" style="display: none;">
        <h1>Mon Profil</h1>
        <p>Informations personnelles, préférences, et gestion de ton compte.</p>
      </section>

      <section id="settings" class="content-section" style="display: none;">
        <h1>Paramètres</h1>
        <p>Modifier les préférences de ton compte (thème, notifications...)</p>
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
