document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById('view-all-universities');
  
  if (btn) {
    btn.addEventListener('click', function () {
      if (!window.isAuthenticated) {
        window.location.href = '/register'; // Redirige si non authentifié
        return;
      }

      const extra = document.getElementById('extra-universities');
      if (extra.style.display === 'none' || extra.style.display === '') {
        extra.style.display = 'flex';
        extra.style.flexWrap = 'wrap';
        extra.style.justifyContent = 'center';
        extra.style.gap = '30px';
        this.textContent = 'Voir Moins'; // Change le texte du bouton
      } else {
        extra.style.display = 'none';
        this.textContent = 'Voir Tous'; // Change le texte du bouton
      }
    });
  }
});

  document.getElementById('view-all-fields').addEventListener('click', function (e) {
    if (!window.isAuthenticated) {
      window.location.href = '/register';
      return;
    }

    var extraFields = document.getElementById('extra-fields');
    if (extraFields.style.display === 'none' || extraFields.style.display === '') {
      extraFields.style.display = 'flex';
      extraFields.style.flexWrap = 'wrap';
      extraFields.style.justifyContent = 'center';
      extraFields.style.gap = '30px';
      this.textContent = 'Voir Moins';
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

  profile.addEventListener('click', (e) => {
    e.stopPropagation(); // Empêche de déclencher le document click
    dropdown.classList.toggle('show');
  });

  document.addEventListener('click', function(event) {
    if (!profile.contains(event.target) && !dropdown.contains(event.target)) {
      dropdown.classList.remove('show');
    }
  });
document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".burger");
  const navLinks = document.querySelector(".nav-links");

  if (burger && navLinks) {
    burger.addEventListener("click", function () {
      navLinks.classList.toggle("active");
      burger.classList.toggle("active"); // pour animer la croix
    });
  }
});
 let lastScrollTop = 0;
  const navbar = document.getElementById("navbar");

  window.addEventListener("scroll", function () {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
      // Scroll vers le bas
      navbar.classList.add("hidden");
    } else {
      // Scroll vers le haut
      navbar.classList.remove("hidden");
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Correction pour éviter les valeurs négatives
  });
