document.getElementById('view-all-universities').addEventListener('click', function (e) {
  if (!window.isAuthenticated) {
    window.location.href = '/register'; // ou utilise une route générée dynamiquement
    return;
  }

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
  
  document.getElementById('view-all-fields').addEventListener('click', function (e) {
    if (!window.isAuthenticated) {
      window.location.href = '/register'; // ou utilise une route générée dynamiquement
      return;
    }

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
  let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    dots[i].classList.remove('active');
  });
  slides[index].classList.add('active');
  dots[index].classList.add('active');
  currentSlide = index;
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

function setSlide(index) {
  showSlide(index);
}
function openModal() {
    document.getElementById('modal-gallery').style.display = 'flex';
  }
  
  function closeModal() {
    document.getElementById('modal-gallery').style.display = 'none';
  }
  
setInterval(nextSlide, 5000); // Défilement automatique toutes les 5s


  const profile = document.getElementById('profile');
  const dropdown = document.getElementById('dropdownMenu');

  profile.addEventListener('click', () => {
    dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
  });

  // Ferme le menu si on clique ailleurs
  document.addEventListener('click', function(event) {
    if (!profile.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.style.display = 'none';
    }
  });