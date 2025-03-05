jQuery(document).ready(function ($) {
  const swiperMainService = new Swiper(".block-mainServices .swiper", {
    watchSlidesProgress: true,
    effect: "fade",
    slidesPerView: 1,
    navigation: {
      nextEl: ".block-mainServices .swiper-button-next",
      prevEl: ".block-mainServices .swiper-button-prev",
    },
    pagination: {
      el: ".block-mainServices .swiper-pagination",
      type: "custom",
      renderCustom: (swiper, current, total) =>
        `<span class="current-number">${formatNumber(
          current
        )}</span> / <span class="total-number">${formatNumber(total)}</span>`,
    },
    breakpoints: {
      1: { autoHeight: true },
      992: { autoHeight: false },
    },
  });

  function formatNumber(number) {
    return number < 10 ? `0${number}` : number;
  }

  if (!window.sm_controller) {
    window.sm_controller = new ScrollMagic.Controller();
  }

  const servicesBlock = document.querySelector(".block-mainServices");
  const scrollableBlocks = document.querySelectorAll(
    ".block-mainServices__body .mainService-item__bg"
  );
  const minWidth = 992;

  function setHeightAndTranslate() {
    const hws = window.innerWidth / 1.5;

    scrollableBlocks.forEach((element) => {
      if (servicesBlock && element) {
        const scrollLength = element.scrollWidth - window.innerWidth + 50;
        const scrollHeight = window.innerHeight + scrollLength;
        servicesBlock.style.height = `${scrollHeight}px`;

        const shiftSlider = () => {
          const top = servicesBlock.getBoundingClientRect().top;
          const shift = Math.max(
            Math.min(Math.round(top), window.innerHeight - hws),
            -scrollHeight + hws
          );
          element.style.transform = `translate3d(${shift}px, 0, 0)`;
        };

        const calculateSlider = () => {
          const scrollLength = element.scrollWidth - window.innerWidth + 50;
          const scrollHeight = window.innerHeight + scrollLength;
          servicesBlock.style.height = `${scrollHeight}px`;
          shiftSlider();
        };

        if (window.innerWidth > minWidth) {
          calculateSlider();
          setTimeout(calculateSlider, 500);
          shiftSlider();
        } else {
          resetStyles(servicesBlock, element);
        }

        const resizeAndShiftHandler = () => {
          if (window.innerWidth > minWidth) {
            calculateSlider();
            shiftSlider();
          } else {
            resetStyles(servicesBlock, element);
          }
        };

        window.addEventListener("resize", resizeAndShiftHandler);
        window.addEventListener("orientationchange", resizeAndShiftHandler);
        document.addEventListener("scroll", shiftSlider);
      }
    });
  }

  function resetStyles(...elements) {
    elements.forEach((element) => $(element).attr("style", ""));
  }

  setHeightAndTranslate();
});
