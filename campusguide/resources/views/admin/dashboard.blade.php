<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
  <div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Admin</h2>
      <ul>
        <li><a href="#" class="menu-link active" data-section="stats"><i class="fas fa-chart-bar"></i> Dashboard</a></li>
        <li><a href="#" class="menu-link" data-section="add"><i class="fas fa-university"></i> Ajouter Université</a></li>
        <li><a href="#" class="menu-link" data-section="manage"><i class="fas fa-cogs"></i> Gérer les Filières</a></li>
        <li><a href="#" class="menu-link" data-section="users"><i class="fas fa-user-graduate"></i> Utilisateurs</a></li>
        <li><a href="#" class="menu-link" data-section="settings"><i class="fas fa-sliders-h"></i> Paramètres</a></li>
        <li><a href="#" class="menu-link" data-section="analytics"><i class="fas fa-chart-line"></i> Statistiques avancées</a></li>

      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Statistiques -->
      <section id="stats" class="content-section">
        <h1>Statistiques Générales</h1>
        <div class="stats-cards">
          <div class="card">
            <i class="fas fa-university"></i>
            <h3>{{ $universitiesCount }}</h3>
            <p>Universités</p>
          </div>
          <div class="card">
            <i class="fas fa-book"></i>
            <h3>{{ $fieldsCount }}</h3>
            <p>Filières</p>
          </div>
          <div class="card">
            <i class="fas fa-users"></i>
            <h3>{{ $usersCount }}</h3>
            <p>Utilisateurs</p>
          </div>
        </div>
      </section>
                <!-- Section Utilisateurs -->
          <section id="users" class="content-section" style="display: none;">
            <h1>Gestion des Utilisateurs</h1>
            <p>Ici, tu pourras voir la liste des utilisateurs, leurs rôles, etc. (à implémenter plus tard)</p>
          </section>

          <!-- Section Paramètres -->
          <section id="settings" class="content-section" style="display: none;">
            <h1>Paramètres</h1>
            <p>Options de configuration générale à venir.</p>
          </section>

          <!-- Section Statistiques avancées -->
          <section id="analytics" class="content-section" style="display: none;">
            <h1>Statistiques Avancées</h1>
            <div class="stats-cards">
              <div class="card">
                <i class="fas fa-eye"></i>
                <h3>1200</h3>
                <p>Vues de page</p>
              </div>
              <div class="card">
                <i class="fas fa-user-plus"></i>
                <h3>320</h3>
                <p>Inscriptions ce mois</p>
              </div>
              <div class="card">
                <i class="fas fa-paper-plane"></i>
                <h3>85%</h3>
                <p>Taux de candidature</p>
              </div>
            </div>
          </section>


      <!-- Formulaire d'ajout d'université -->
      <section id="add" class="content-section" style="display:none;">
        <h1>Ajouter une Université</h1>
        @if(session('good'))
              <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                  {{ session('good') }}
              </div>
       @endif
        <form action="{{ route('admin.university.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label>Nom de l’université</label>
            <input type="text" name="name" required>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Histoire</label>
            <textarea name="history" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Localisation</label>
            <input type="text" name="location">
          </div>

          <div class="form-group">
            <label>Frais de scolarité</label>
            <input type="number" name="tuition_fee" step="0.01" max="99999999.99">
          </div>

          <div class="form-group">
            <label>Note (ex. 4.5/5)</label>
            <input type="number" name="note" step="0.1" max="5">
          </div>

          <div class="form-group">
            <label>URL vidéo / média</label>
            <input type="text" name="media_url">
          </div>

          <div class="form-group">
            <label>Lien d'inscription</label>
            <input type="url" name="application_link">
          </div>

          <div class="form-group">
            <label>Brochure (PDF)</label>
            <input type="file" name="pdf_url" accept="application/pdf">
          </div>
          <div class="form-group">
              <label>Filières proposées</label>
              <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                @foreach($fields as $field)
                  <label  class="flex-wrapper">
                    <input type="checkbox" name="fields[]" value="{{ $field->id }}" style="margin-right: 5px;">
                    {{ $field->name }}
                  </label>
                @endforeach
              </div>
            </div>
          <button type="submit" class="submit-btn">Enregistrer</button>
        </form>
      </section>

      <!-- Gérer les filières (pour plus tard) -->
      <!-- Gérer les filières -->
<section id="manage" class="content-section" style="display:none;">
  <h1>Ajouter une Filière</h1>

  @if(session('success'))
              <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                  {{ session('success') }}
              </div>
       @endif
  <form action="{{ route('admin.field.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Nom de la filière</label>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea name="description" rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
      <label>Image (URL ou chemin local)</label>
      <input type="text" name="image" value="{{ old('image') }}">
    </div>

    <button type="submit" class="submit-btn">Enregistrer la filière</button>
  </form>

  {{-- Optionnel : Liste des filières existantes --}}
  <h2>Filières existantes</h2>
  <ul>
    @foreach($fields as $field)
      <li><strong>{{ $field->name }}</strong> — {{ Str::limit($field->description, 60) }}</li>
    @endforeach
  </ul>
</section>

    </main>
  </div>

  <script >
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
        if (section.id === target) {
          section.style.display = 'block';
        } else {
          section.style.display = 'none';
        }
      });
    });
  });
});

</script>
</body>
</html>
