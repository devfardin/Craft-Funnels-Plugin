
let cfSliderSwiper = new Swiper('.cf-slider-swiper', {
    spaceBetween: 40,
    slidesPerView: 1,
    direction: getDirection(),
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
    pagination: {
        el: ".cf-slider-swiper .swiper-pagination",
        type: "fraction",
      },
    on: {
      resize: function () {
        this.changeDirection(getDirection());
      },
    },


  });

  function getDirection() {
    var windowWidth = window.innerWidth;
    var direction = window.innerWidth <= 0 ? 'vertical' : 'horizontal';

    return direction;
  }