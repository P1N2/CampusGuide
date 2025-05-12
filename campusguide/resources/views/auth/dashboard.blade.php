<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CampusGuide - Espace Personnel</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">📚</div>
      <nav>
        <ul>
          <li class="active">🏠</li>
          <li>❤️</li>
          <li>💬</li>
          <li>📄</li>
        </ul>
      </nav>
      <button class="logout">Déconnexion</button>
    </aside>

    <main>
      <header class="topbar">
        <div class="welcome">Welcome, Amanda</div>
        <div class="right-side">
          <input type="text" placeholder="Search..." />
          <div class="profile-icon">👤</div>
        </div>
      </header>

      <section class="profile-section">
        <div class="profile-info">
          <img src="https://via.placeholder.com/100" alt="avatar" class="avatar"/>
          <h2>Alexo Penouel</h2>
          <p>alexo@campusguide.com</p>

          <div class="info">
            <div>
              <label>Fullname</label>
              <p>Alexo Penouel</p>
            </div>
            <div>
              <label>Gender</label>
              <p>Male</p>
            </div>
            <div>
              <label>City</label>
              <p>Niamey</p>
            </div>
            <div>
              <label>Email</label>
              <p>alexo@campusguide.com</p>
            </div>
          </div>
          <button class="edit-btn">Edit</button>
        </div>

        <div class="logo-section">
        <img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo">
        </div>
      </section>
    </main>
  </div>
</body>
</html>
