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
document.querySelectorAll('.favorite-icon').forEach(icon => {
  icon.addEventListener('click', function () {
    const universityId = this.getAttribute('data-id');

    fetch('{{ route("favoris.toggle") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ university_id: universityId })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'added') {
        this.classList.add('active');
      } else {
        this.classList.remove('active');
      }
    });
  });
});
