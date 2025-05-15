<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Universités - CampusGuide</title>
    <link rel="icon" href="{{ asset('assets/favicon1.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .search-bar {
            margin-bottom: 30px;
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
    </style>
</head>
<body>

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
</script>
</body>
</html>
