document.addEventListener("DOMContentLoaded", () => {
  new Swiper(".caseSwiperUp", {
    loop: false,
    spaceBetween: 30,
    freeMode: true,
    watchSlidesProgress: true,
    pagination: {
      el: ".case .swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".case .swiper-button-next",
      prevEl: ".case .swiper-button-prev",
    },
  });

  new Swiper(".gallery-block__swiper .swiper", {
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".gallery-block__swiper .swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".gallery-block__swiper .swiper-button-next",
      prevEl: ".gallery-block__swiper .swiper-button-prev",
    },
  });

  new Swiper(".photo-studio .swiper", {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 20,
    navigation: {
      nextEl: ".photo-studio .swiper-button-next",
      prevEl: ".photo-studio .swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  new Swiper(".how-to-use-slider .swiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    loop: false,
    spaceBetween: 20,
    navigation: {
      nextEl: ".how-to-use-slider .swiper-button-next",
      prevEl: ".how-to-use-slider .swiper-button-prev",
    },
    pagination: {
      el: ".how-to-use-slider .swiper-pagination",
      clickable: true,
    },
  });

  new Swiper(".about-workers .swiper", {
    slidesPerView: 5,
    spaceBetween: 20,
    navigation: {
      nextEl: ".about-workers .swiper-button-next",
      prevEl: ".about-workers .swiper-button-prev",
    },
    pagination: {
      el: ".about-workers .swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      500: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 5,
      },
    },
  });
});
