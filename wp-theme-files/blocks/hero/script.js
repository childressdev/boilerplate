const heroSlider = new Swiper('#hero .swiper', {
  //autoplay: false,
  autoplay: {
    disableOnInteraction: false,
    pauseOnMouseEnter: true
  },
  speed: parseInt(document.querySelector('#hero .swiper').getAttribute('data-speed')) || 300,
  loop: true,
  pagination: {
    el: '.hero-pagination',
    clickable: true
  },
  autoHeight: true,
  navigation: {
    prevEl: '.hero-slider-nav.swiper-button-prev',
    nextEl: '.hero-slider-nav.swiper-button-next'
  }
});