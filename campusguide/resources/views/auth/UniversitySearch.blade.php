<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Universités - CampusGuide</title>
    <link rel="icon" href="{{ asset('assets/favicon1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .search-bar {
            margin-top: 120px;
            text-align: center;
        }
        input[type="text"] {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin-left: 10px;
            border-radius: 8px;
            background-color: #3490dc;
            color: white;
            border: none;
            cursor: pointer;
        }
        .university-list {
            max-width: 800px;
            margin: auto;
        }
        .university-item {
            padding: 15px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .university-item:hover {
            background-color: #f1f1f1;
        }
        .university-item h3 {
            margin: 0;
        }
       .back-button {
      display: block;
      text-align: center;
      padding: 10px 20px;
      background-color: #E5B300;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      width: fit-content;
     
    }

    .back-button:hover {
      background-color: #36384E;
      color:rgb(250, 250, 250);
    }
    /* Navigation */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: white;
  border-bottom: 1px solid #ddd;
  box-sizing: border-box;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
}

.logo img {
  max-width: 150px; /* Gère la taille du logo */
  height: auto;
}

/* Navigation links */
.nav-links {
  list-style: none;
  display: flex;
  gap: 30px;
}

.nav-links a {
  position: relative;
  text-decoration: none;
  color: black;
  font-weight: 500;
  transition: all 0.3s ease;
  font-size: 16px;
}

.nav-links a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0%;
  height: 3px;
  background-color: #E5B300;
  transition: width 0.3s ease;
}

.nav-links a:hover {
  color: #E5B300;
  transform: translateY(3px);
}

.nav-links a:hover::after {
  width: 100%;
}
.navbar-right {
  display: flex;
  align-items: center;
  gap: 25px;
}

/* Amélioration pour le profil */
.profile {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
}

.profile img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

.profile-text {
  font-size: 12px;
  line-height: 1.2;
  text-align: right;
}
/* Dropdown menu sous le profil */
.dropdown-menu {
  position: absolute;
  top: 70px;
  right: 50px;
  background: rgba(255, 255, 255, 0.616);
 -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.2);
  padding: 10px;
  min-width: 180px;
  opacity: 0;
  transform: translateY(-10px);
  pointer-events: none;
  transition: opacity 0.3s ease, transform 0.3s ease;
  z-index: 1000;
}

.dropdown-menu.show {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.dropdown-menu a,
.dropdown-menu button {
  padding: 10px 14px;
  text-align: left;
  text-decoration: none;
  color:#E5B300;
  font-size: 14px;
  background: none;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 8px;
  transition: background 0.3s ease;
}

.dropdown-menu a:hover,
.dropdown-menu button:hover {
  color: #36384E;
}
@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px 15px;
  }

  .logo {
    width: 100%;
    text-align: left;
    margin-bottom: 10px;
  }

  .logo img {
    max-width: 120px;
  }

  .nav-links {
    flex-direction: column;
    width: 100%;
    gap: 10px;
  }

  .nav-links a {
    font-size: 14px;
    padding: 5px 0;
  }

  .navbar-right {
    width: 100%;
    justify-content: space-between;
    margin-top: 10px;
  }

  .profile {
    flex: 1;
    justify-content: flex-end;
  }

  .search-bar {
    margin-top: 150px; /* pour éviter que la recherche soit cachée sous la nav fixe */
    padding: 0 10px;
  }

  input[type="text"] {
    width: 100%;
    margin-bottom: 10px;
  }

  button {
    width: 100%;
    margin-left: 0;
  }

  .university-list {
    padding: 0 10px;
  }

  .university-item {
    padding: 12px 10px;
  }

  .dropdown-menu {
    right: 15px;
    top: 120px;
  }
}
.burger {
  display: none;
  font-size: 24px;
  cursor: pointer;
  color: #36384E;
}

@media (max-width: 768px) {
  .burger {
    display: block;
    margin-left: auto;
  }

  nav {
    display: none;
    width: 100%;
  }

  nav.active {
    display: block;
    margin-top: 10px;
  }

  .nav-links {
    flex-direction: column;
    gap: 15px;
    padding: 10px 0;
  }

  .search-bar {
    margin-top: 180px; /* ↑ suffisant pour navbar fixe + liens */
    padding: 0 10px;
  }

  input[type="text"] {
    width: 100%;
  }

  button {
    width: 100%;
    margin-top: 10px;
  }

  .navbar-right {
    flex-direction: column;
    align-items: flex-end;
    margin-top: 10px;
  }

  .dropdown-menu {
    right: 20px;
    top: 200px;
  }
}

    </style>

</head>
<body>
  <!-- Navigation -->
<header class="navbar">
  <h1 class="logo"> <a href="/home"><img src="{{ asset('assets/logo.png') }}" alt="CampusGuideLogo"></a></h1> 
  <div class="burger" id="burger">
  <i class="fa-solid fa-bars"></i>
</div>
<nav>
  <ul class="nav-links">
    <li>
      <a href="/home">
        <i class="fa-solid fa-house"></i> Accueil
      </a>
    </li>
    <!-- <li>
      <a href="{{ route('universities.search') }}">
        <i class="fa-solid fa-university"></i> Universités
      </a>
    </li> -->
    <li>
      <a href="{{ route('fields.search') }}">
        <i class="fa-solid fa-book"></i> Filières
      </a>
    </li>
  </ul>
</nav>
  
  <div class="navbar-right">
  @auth
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
</div>

</header>

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Rechercher une université...">
    <button onclick="searchUniversity()">Rechercher</button>
</div>

<div class="university-list" id="universityList">
    @foreach($universities as $university)
        <div class="university-item" onclick="window.location.href='/universities/{{ $university->id }}'">
            <h3>{{ $university->name }}</h3>
            <p>{{ Str::limit($university->description, 80) }}</p>
        </div>
    @endforeach
</div>

<script>
    const input = document.getElementById('searchInput');
    const list = document.getElementById('universityList');

    input.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length === 0) {
            return;
        }

        fetch(`/ajax-search-universities?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                list.innerHTML = '';

                if (data.error) {
                    list.innerHTML = '<p style="color:red;">Erreur serveur : ' + data.error + '</p>';
                    return;
                }

                if (!Array.isArray(data) || data.length === 0) {
                    list.innerHTML = '<p>Aucune université trouvée.</p>';
                    return;
                }

                data.forEach(univ => {
                    const card = document.createElement('div');
                   card.classList.add('university-item');
                    card.onclick = () => window.location.href = `/universities/${univ.id}`;
                    card.innerHTML = `
                        <h3>${univ.name}</h3>
                        <p>${(univ.description ?? '').substring(0, 80)}</p>
                    `;
                    list.appendChild(card);
                });
            })
            .catch(error => {
                console.error('Erreur JS :', error);
                list.innerHTML = '<p style="color:red;">Erreur de chargement.</p>';
            });
    });
    
  const profile = document.getElementById('profile');
  const dropdown = document.getElementById('dropdownMenu');

  profile.addEventListener('click', (e) => {
    e.stopPropagation(); // Empêche de déclencher le document click
    dropdown.classList.toggle('show');
  });

  document.addEventListener('click', function(event) {
    if (!profile.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.classList.remove('show');
    }
  });
  // Menu burger
const burger = document.getElementById('burger');
const nav = document.querySelector('nav');

burger.addEventListener('click', () => {
  nav.classList.toggle('active');
});

</script>
</body>
</html>
