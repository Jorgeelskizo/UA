document.addEventListener('DOMContentLoaded', function() {
  const slide = document.querySelector('.carousel-slide');
  const images = document.querySelectorAll('.carousel-image');

  let counter = 1; // Empieza en 1 si tienes un clon al inicio del carrusel

  function getSlideWidth() {
      return slide.clientWidth; // Ancho actual del contenedor del carrusel
  }

  document.getElementById('nextBtn').addEventListener('click', () => {
      if (counter >= images.length - 1) return; // Si es el último, no hace nada
      slide.style.transition = "transform 0.4s ease-in-out";
      counter++;
      slide.style.transform = 'translateX(' + (-getSlideWidth() * counter) + 'px)';
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
      if (counter <= 0) return; // Si es el primero, no hace nada
      slide.style.transition = "transform 0.4s ease-in-out";
      counter--;
      slide.style.transform = 'translateX(' + (-getSlideWidth() * counter) + 'px)';
  });

  slide.addEventListener('transitionend', () => {
    if (images[counter].id === 'lastClone') {
      slide.style.transition = "none";
      counter = images.length - 2;
      slide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    }
    if (images[counter].id === 'firstClone') {
      slide.style.transition = "none";
      counter = images.length - counter;
      slide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    }
  });
});
