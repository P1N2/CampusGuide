<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Universités - CampusGuide</title>
    <link rel="icon" href="{{ asset('assets/favicon1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .search-bar {
            /* margin-top: 120px; */
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
            background-color: #E5B300;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover{
          background-color: #36384E;
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

     /* Responsive Styles */
        @media (max-width: 768px) {
            input[type="text"] {
                width: 90%;
                font-size: 14px;
                margin: 10px;
            }

            button {
                width: 90%;
                font-size: 14px;
                margin-left: 0;
            }

            .search-bar {
                margin-top: 20px;
            }

            .university-item h3 {
                font-size: 16px;
            }

            .university-item p {
                font-size: 13px;
            }

            .back-button {
                font-size: 13px;
                margin-bottom: 20px;
            }
        }
        .university-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 5px;
}

.university-logo {
    width: 45px;
    height: 45px;
    object-fit: contain;
    border-radius: 6px;
}

/* Responsive */
@media (max-width: 768px) {
    .university-logo {
        width: 35px;
        height: 35px;
    }

    .university-header h3 {
        font-size: 16px;
    }

    .university-item p {
        font-size: 14px;
    }
}

    </style>

</head>
<body>
  <a href="{{ route('home') }}" class="back-button">← Retour à l’accueil</a>
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Rechercher une université...">
    <button onclick="searchUniversity()">Rechercher</button>
</div>

<div class="university-list" id="universityList">
    @foreach($universities as $university)
        <div class="university-item" onclick="window.location.href='/universities/{{ $university->id }}'">
    <div class="university-header">
         <img src="{{ asset(optional($university->logo)->image_path ?? 'assets/login.jpg') }}" alt="Logo {{ $university->name }}"class="university-logo">
        <h3>{{ $university->name }}</h3>
        <!-- <img src="{{ asset($university->media_url) }}" alt="Logo {{ $university->name }}" class="university-logo"> -->
    </div>
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
