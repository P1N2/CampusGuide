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
        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Retour à l’accueil</a></li>
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
        <!-- Graphique des inscriptions -->
            <div style="margin-top: 40px;">
              <h2 style="margin-bottom: 10px;">Inscriptions mensuelles</h2>
              <canvas id="registrationChart" height="100"></canvas>
            </div>
      </section>
                <section id="users" class="content-section" style="display: none;">
  <h1>Gestion des Utilisateurs</h1>

  @if(session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
  @endif

  <table class="user-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach(\App\Models\User::all() as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->is_admin ? 'Admin' : 'Utilisateur' }}</td>
          <td>
            <form method="POST" action="{{ route('admin.user.toggleRole', $user->id) }}" style="display:inline;">
              @csrf
              @method('PUT')
              <button type="submit" class="action-btn">
                {{ $user->is_admin ? 'Rendre Utilisateur' : 'Rendre Admin' }}
              </button>
            </form>

            <form method="POST" action="{{ route('admin.user.delete', $user->id) }}" style="display:inline;" onsubmit="return confirm('Supprimer cet utilisateur ?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="action-btn red">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
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
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-disc pl-4 text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-red-600">
        {{ session('error') }}
    </div>
@endif

@if (session('good'))
    <div class="alert alert-success text-green-600">
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
            <label>Slogan</label>
            <textarea name="slogan" rows="3"></textarea>
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
            <input type="url" name="pdf_url" id="pdf_url" placeholder="https://..." pattern="https://.*\.pdf">
          </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}">
            </div>

            <!-- Téléphone -->
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
  const ctx = document.getElementById('registrationChart').getContext('2d');
  const registrationChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin',
        'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'
      ],
      datasets: [{
        label: 'Inscriptions en {{ now()->year }}',
        data: @json($registrationsByMonth),
        fill: true,
        borderColor: '#4CAF50',
        backgroundColor: 'rgba(76, 175, 80, 0.2)',
        tension: 0.3,
        pointRadius: 4,
        pointBackgroundColor: '#388E3C'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });
</script>
</body>
</html>
