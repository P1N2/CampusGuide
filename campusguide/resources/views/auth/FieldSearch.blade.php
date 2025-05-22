<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Filières - CampusGuide</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/favicon1.png') }}">
    <style>
        body { font-family: Arial, sans-serif;padding: 20px;}
        .search-bar { text-align: center;}
        input[type="text"] {width: 50%;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;}
        button { padding: 10px 20px;
            font-size: 16px;
            margin-left: 10px;
            border-radius: 8px;
            background-color: #E5B300;
            color: white;
            border: none;
            cursor: pointer; }
        button:hover{background-color: #36384E}
        .field-list { max-width: 800px;
            margin: auto;
        }
        .field-item {padding: 15px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
            transition: background-color 0.2s;}
        .field-item:hover { background-color: #f1f1f1; }
        .field-item h3 { margin: 0;}
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
     /* Responsive */
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

            .field-item h3 {
                font-size: 16px;
            }

            .field-item p {
                font-size: 13px;
            }

            .back-button {
                font-size: 13px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
  <a href="{{ route('home') }}" class="back-button">← Retour à l’accueil</a>
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Rechercher une filière...">
    <button onclick="searchField()">Rechercher</button>
</div>

<div class="field-list" id="fieldList">
    @foreach($fields as $field)
        <div class="field-item" onclick="window.location.href='/filiere/{{ $field->id }}'">
            <h3>{{ $field->name }}</h3>
            <p>{{ Str::limit($field->description, 80) }}</p>
        </div>
    @endforeach
</div>

<script>
    const input = document.getElementById('searchInput');
    const list = document.getElementById('fieldList');

    input.addEventListener('input', function () {
        const query = this.value.trim();
        if (query.length === 0) return;

        fetch(`/ajax-search-fields?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                list.innerHTML = '';

                if (!Array.isArray(data) || data.length === 0) {
                    list.innerHTML = '<p>Aucune filière trouvée.</p>';
                    return;
                }

                data.forEach(field => {
                    const card = document.createElement('div');
                    card.classList.add('field-item');
                    card.onclick = () => window.location.href = `/filiere/${field.id}`;
                    card.innerHTML = `
                        <h3>${field.name}</h3>
                        <p>${(field.description ?? '').substring(0, 80)}</p>
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
</script>
</body>
</html>
