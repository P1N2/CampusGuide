document.getElementById('view-all-universities').addEventListener('click', function () {
    var extraUniversities = document.getElementById('extra-universities');
    if (extraUniversities.style.display === 'none' || extraUniversities.style.display === '') {
      extraUniversities.style.display = 'flex';
      extraUniversities.style.flexWrap = 'wrap';
      extraUniversities.style.justifyContent = 'center';
      extraUniversities.style.gap = '30px';
      this.textContent = 'Voir Moins';
    } else {
      extraUniversities.style.display = 'none';
      this.textContent = 'Voir Tous';
    }
  });
  
  document.getElementById('view-all-fields').addEventListener('click', function () {
    var extraFields = document.getElementById('extra-fields');
    if (extraFields.style.display === 'none' || extraFields.style.display === '') {
      extraFields.style.display = 'flex';
      extraFields.style.flexWrap = 'wrap';
      extraFields.style.justifyContent = 'center';
      extraFields.style.gap = '30px';
      this.textContent = 'Voir moins';
    } else {
      extraFields.style.display = 'none';
      this.textContent = 'Voir Tous';
    }
  });
  