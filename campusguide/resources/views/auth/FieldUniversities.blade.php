<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Universités pour la filière {{ $field->name }}</title>
</head>
<body>
    <h1>Universités qui enseignent : {{ $field->name }}</h1>

    @if($field->universities->isEmpty())
        <p>Aucune université n’enseigne cette filière pour le moment.</p>
    @else
        <ul>
            @foreach($field->universities as $university)
                <li>
                    <a href="{{ route('university.show', $university->id) }}">
                        {{ $university->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
