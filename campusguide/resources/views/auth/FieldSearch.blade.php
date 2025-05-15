<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche Filières - CampusGuide</title>
    <link rel="icon" href="{{ asset('assets/favicon1.png') }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .search-bar { text-align: center; margin-bottom: 30px; }
        input[type="text"] { width: 50%; padding: 10px; font-size: 16px; border-radius: 8px; border: 1px solid #ccc; }
        button { padding: 10px 20px; font-size: 16px; margin-left: 10px; border-radius: 8px; background-color: #38c172; color: white; border: none; cursor: pointer; }
        .field-list { max-width: 800px; margin: auto; }
        .field-item { padding: 15px; border-bottom: 1px solid #ccc; cursor: pointer; transition: background-color 0.2s; }
        .field-item:hover { background-color: #f1f1f1; }
        .field-item h3 { margin: 0; }
    </style>
</head>
<body>

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
</script>
</body>
</html>
