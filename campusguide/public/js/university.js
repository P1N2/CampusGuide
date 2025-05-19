// Carousel
let slides = document.querySelectorAll(".slide");
let currentIndex = 0;

setInterval(() => {
  slides[currentIndex].classList.remove("active");
  currentIndex = (currentIndex + 1) % slides.length;
  slides[currentIndex].classList.add("active");
}, 5000);

// Modal galerie
const modal = document.getElementById("galleryModal");
const btn = document.getElementById("viewAll");
const span = document.querySelector(".close");

btn.onclick = () => modal.style.display = "block";
span.onclick = () => modal.style.display = "none";
window.onclick = (e) => {
  if (e.target == modal) modal.style.display = "none";
};
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

  document.getElementById('prevBtn').addEventListener('click', () => {
  document.getElementById('fieldCarousel').scrollBy({
    left: -300,
    behavior: 'smooth'
  });
});
document.getElementById('nextBtn').addEventListener('click', () => {
  document.getElementById('fieldCarousel').scrollBy({
    left: 300,
    behavior: 'smooth'
  });
});
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const universityId = this.dataset.id;
            const icon = this.querySelector('i');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/favorites/toggle/${universityId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                if (!response.ok) {
                    throw new Error('Erreur lors de la requête');
                }

                const data = await response.json();

                this.classList.toggle('active');
                this.classList.add('pulsing');

                icon.classList.toggle('fas');
                icon.classList.toggle('far');

                setTimeout(() => {
                    this.classList.remove('pulsing');
                }, 400);

            } catch (error) {
                console.error('Erreur AJAX:', error);
                alert("Une erreur s'est produite. Veuillez réessayer.");
            }
        });
    });
});
