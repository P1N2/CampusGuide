<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="{{ asset('assets/favicon1.png') }}">
</head>
<body>
  <div class="container">
    <h1>Ajouter une Université</h1>

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
        <input type="text" name="tuition_fee">
      </div>

      <div class="form-group">
        <label>Note (ex. 4.5/5)</label>
        <input type="text" name="note">
      </div>

      <div class="form-group">
        <label>URL vidéo / média</label>
        <input type="url" name="media_url">
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
        <label>Images (bannières ou galerie)</label>
        <input type="file" name="images[]" multiple>
      </div>

      <div class="form-group">
        <label>Type d'image</label>
        <select name="image_type" required>
          <option value="banner">Bannière</option>
          <option value="gallery">Galerie</option>
        </select>
      </div>

      <div class="form-group">
        <label>Filières associées</label>
        <select name="fields[]" multiple>
          @foreach($fields as $field)
            <option value="{{ $field->id }}">{{ $field->name }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="submit-btn">Enregistrer</button>
    </form>
  </div>
</body>
</html>
