import './bootstrap';
import emailjs from '@emailjs/browser';
// Swiper bundle with all modules
import Swiper from 'swiper/bundle';
// import styles bundle
import 'swiper/css/bundle';


// EmailJS
emailjs.init({
  publicKey: "QTujNYOJChXbqMu3A",
});

window.onload = function () {
  document.getElementById('contact').addEventListener('submit', function (event) {
    event.preventDefault();

    // Privacy checkbox validation
    if (!document.getElementById('privacy').checked) {
      // alert('Vous devez accepter la politique de confidentialité.');
      window.dispatchEvent(new CustomEvent('custom-alert', { detail: { message: 'Veuillez accepter la politique de confidentialité.' } }));
      return;
    }

    emailjs.sendForm('service_8ob6mvb', 'contact', this)
      .then((response) => {
        console.log('SUCCESS!', response.status, response.text);
        // alert('Votre message a bien été envoyé !');

        window.dispatchEvent(new CustomEvent('custom-alert', { detail: { message: 'Votre message a bien été envoyé !' } }));

      }, (error) => {
        console.log('FAILED...', error);

        window.dispatchEvent(new CustomEvent('custom-alert', { detail: { message: 'Échec de l\'envoi du message.' } }));
      });
  });
};

// Swiper

const customSliders = document.querySelectorAll('.swiper');
const customThumbs = document.querySelectorAll('.mySwiper');

for (let i = 0; i < customSliders.length; i++) {

  customSliders[i].classList.add('swiper-' + i);
  customThumbs[i].classList.add('mySwiper-' + i);

  const swiperThumb = new Swiper(".mySwiper-" + i, {
    spaceBetween: 2,
    slidesPerView: 'auto',
    freeMode: true,
    watchSlidesProgress: true,
  });

  const swiper = new Swiper('.swiper-' + i, {
    // Optional parameters
    direction: 'horizontal',

    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiperThumb,
    },

  });

};

// Handle opacity changes on thumbnails using MutationObserver

// const observer = new MutationObserver((mutationsList) => {
//   for (const mutation of mutationsList) {
//     if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
//       const target = mutation.target;
//       if (target.classList.contains('swiper-slide-thumb-active')) {
//         target.classList.add('opacity-100');
//         target.classList.remove('opacity-40');
//       } else {
//         target.classList.add('opacity-40');
//         target.classList.remove('opacity-100');
//       }
//     }
//   }
// });

// const thumbs = document.querySelectorAll('.swiper-slide');
// thumbs.forEach(thumb => {
//   observer.observe(thumb, { attributes: true });
// });