document.addEventListener("DOMContentLoaded", () => {
  // const linkClickedBlock = document.querySelector('div.link-clicked');
  //
  // if (linkClickedBlock) {
  //     // Находим все ссылки, которые ведут на внутренние страницы сайта, исключая якорные ссылки (#)
  //     const links = document.querySelectorAll('a[href^="/"], a[href^="./"], a[href^="../"], a:not([href^="http"])');
  //
  //     // Фильтруем ссылки, исключая те, которые содержат класс 'page-menu__menu_link' или 'not-clickable'
  //     const filteredLinks = Array.from(links).filter(link => {
  //         // Исключаем ссылки с классом 'page-menu__menu_link' или 'not-clickable', и ссылки, которые начинаются с '#'
  //         return !link.classList.contains('page-menu__menu_link') &&
  //             !link.classList.contains('not-clickable') &&
  //             !link.getAttribute('href').startsWith('#');
  //     });
  //
  //     // Добавляем обработчик события клика на отфильтрованные ссылки
  //     filteredLinks.forEach(link => {
  //         link.addEventListener('click', function() {
  //             linkClickedBlock.classList.add('active'); // Добавляем класс 'active' к блоку
  //         });
  //     });
  // }

  // // Получаем все элементы с классом .main-select__menu_link
  // const firstMenuLinks1 = document.querySelectorAll('.main-select__menu_link');

  // // Получаем элемент <div class="link-clicked">
  //     const linkClickedElement = document.querySelector('.link-clicked');
  //
  // // Добавляем обработчик события клика для каждой ссылки
  //     firstMenuLinks1.forEach(link => {
  //         link.addEventListener('click', (event) => {
  //             const href = link.getAttribute('href');
  //
  //             // Проверяем, начинается ли ссылка с '/'
  //             if (href.startsWith('/')) {
  //                 // Добавляем класс active к элементу <div class="link-clicked">
  //                 linkClickedElement.classList.add('active');
  //             } else if (href.startsWith('#')) {
  //                 // Если ссылка начинается с '#', ничего не делаем
  //                 event.preventDefault(); // предотвращаем переход по ссылке, если это необходимо
  //             }
  //         });
  //     });
  //
  //
  //     // Получаем все элементы с классом .activate-preloader
  //     const preloaderElements = document.querySelectorAll('.activate-preloader');
  //
  //
  // // Добавляем обработчик события клика для каждого элемента .activate-preloader
  //     if (preloaderElements){
  //         preloaderElements.forEach(element => {
  //             element.addEventListener('click', () => {
  //                 // Добавляем класс active к элементу <div class="link-clicked">
  //                 linkClickedElement.classList.add('active');
  //             });
  //         });
  //     }

  // Анимация главного меню
  const circle1 = document.querySelector(".main-select__circle_1");
  const circleLine = document.querySelector(".main-select__circle_line");
  const circleFrom = document.querySelector(".main-select__from");
  const circleTo = document.querySelector(".main-select__to");

  if (circle1) {
    circle1.classList.add("scale-up-center");
  }

  if (circleLine) {
    circleLine.classList.add("scale-up-center");
  }

  if (circleFrom) {
    circleFrom.classList.add("scale-up-center-nt-500");
  }

  if (circleTo) {
    circleTo.classList.add("scale-up-center-nt-500");
  }

  // Preloader
  const preloader = document.getElementById("preloader");

  // Функция для скрытия прелоадера
  const hidePreloader = () => {
    if (preloader) {
      preloader.classList.add("hidden-opacity");
    }
  };

  // Устанавливаем таймер на 1.5 секунды
  const timeoutId = setTimeout(hidePreloader, 1000);

  // Если страница загрузится раньше, чем пройдет 1.5 секунды, прелоадер скроется при загрузке
  window.addEventListener("load", () => {
    clearTimeout(timeoutId); // Очищаем таймер, если сайт загрузился быстрее
    hidePreloader(); // Скрываем прелоадер
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const reviewMoreBtn = document.querySelectorAll(".marketing-review__more");
  const reviewMoreText = document.querySelector(".marketing-review__text");

  if (reviewMoreBtn) {
    reviewMoreBtn.forEach((item) => {
      item.addEventListener("click", () => {
        item.classList.toggle("active");
        item.closest(reviewMoreText).classList.toggle("active");
      });
    });
  }

  /* Главный экран меню svg cover */
  let menuLeft = document.querySelector(".main-select__menu_left");
  let menuRight = document.querySelector(".main-select__menu_right");
  let svgLeft = document.querySelector(".svg-left");
  let svgRight = document.querySelector(".svg-right");

  if (menuLeft)
    menuLeft.addEventListener("mouseenter", function () {
      svgLeft.classList.add("active");
    });
  if (menuLeft)
    menuLeft.addEventListener("mouseleave", function () {
      svgLeft.classList.remove("active");
    });
  if (menuRight)
    menuRight.addEventListener("mouseenter", function () {
      svgRight.classList.add("active");
    });
  if (menuRight)
    menuRight.addEventListener("mouseleave", function () {
      svgRight.classList.remove("active");
    });

  /* Tabs */

  const caseBlock = document.querySelectorAll(".case-block");

  caseBlock.forEach((item) => {
    item.addEventListener("click", function (event) {
      let target = event.target;

      // Проверяем, имеет ли элемент класс "tab-btn" или его родительские элементы
      while (target !== item && !target.classList.contains("tab-btn")) {
        target = target.parentElement;
      }

      if (target.classList.contains("tab-btn")) {
        // Удаляем класс "active" со всех .tab-btn внутри текущего .case-block
        item.querySelectorAll(".tab-btn").forEach((tabBtn) => {
          tabBtn.classList.remove("active");
        });

        target.classList.add("active");

        let tabId = target.getAttribute("content-id");

        let tabContent = item.querySelectorAll(".content");

        tabContent.forEach((content) => {
          content.classList.remove("show");

          let contentID = content.getAttribute("id");
          if (tabId === contentID) {
            content.classList.add("show");
          }
        });
      }
    });
  });

  // Init JS
  const ReadSmore = window.readSmore;

  const readMoreEls = document.querySelectorAll(".js-read-smore");

  ReadSmore(readMoreEls).init();

  Fancybox.bind("[data-fancybox]", {});

  let askButton = document.querySelectorAll(".js-ask-open");
  let askPanel = document.querySelector(".ask-panel");
  let askPanelClose = document.querySelector(".js-ask-close");

  if (askButton)
    askButton.forEach((item) => {
      item.addEventListener("click", () => {
        askPanel.classList.toggle("active");
      });
    });

  if (askPanelClose)
    askPanelClose.addEventListener("click", function () {
      askPanel.classList.remove("active");
    });

  Splitting();

  const cookieBtn = document.querySelector(".block-cookie__btn");
  const cookieBlock = document.querySelector(".block-cookie");

  if (cookieBlock)
    if (localStorage.getItem("cookiesAccepted")) {
      cookieBlock.classList.remove("active");
    } else {
      cookieBlock.classList.add("active");
    }

  if (cookieBtn)
    cookieBtn.addEventListener("click", function () {
      localStorage.setItem("cookiesAccepted", "true");
      cookieBlock.style.display = "none";
    });

  /* Анимация */
  AOS.init({
    duration: 600,
    anchorPlacement: "top-center",
    once: true,
    mirror: true,
  });

  // logistic-check
  if (document.querySelector(".logistic-check__status_more")) {
    document
      .querySelector(".logistic-check__status_more")
      .addEventListener("click", function () {
        const hiddenItems = document.querySelectorAll(
          ".logistic-check__status_item.hidden"
        );
        hiddenItems.forEach((item) => {
          item.classList.toggle("show");
        });

        // Меняем текст кнопки в зависимости от состояния
        const isVisible = hiddenItems[0].classList.contains("show");
        this.querySelector("span").textContent = isVisible ? "скрыть" : "еще";

        // Тоглим класс active для кнопки
        this.classList.toggle("_active");
      });
  }

  if (document.querySelector(".js-slide-to-calc")) {
    document
      .querySelector(".js-slide-to-calc")
      .addEventListener("click", function () {
        const target = document.querySelector(".logistic-page");
        if (target) {
          target.scrollIntoView({ behavior: "smooth" });
        }
      });
  }
  if (document.querySelectorAll("[data-scroll-to]")) {
    document.querySelectorAll("[data-scroll-to]").forEach((button) => {
      button.addEventListener("click", function () {
        const targetId = this.getAttribute("data-scroll-to");
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      });
    });
  }

  const phoneInputs = document.querySelectorAll(".phone");

  phoneInputs.forEach((input) => {
    input.addEventListener("input", onPhoneInput);
    input.addEventListener("blur", onPhoneBlur);
    input.addEventListener("focus", onPhoneFocus);
  });

  function onPhoneInput(e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, ""); // Удаляем всё, кроме цифр
    let formattedValue = "";

    if (value.startsWith("7")) {
      // Маска для России +7 (XXX) XXX-XX-XX
      formattedValue = "+7 (";
      if (value.length > 1) formattedValue += value.substring(1, 4); // XXX
      if (value.length >= 5) formattedValue += ") " + value.substring(4, 7); // XXX
      if (value.length >= 8) formattedValue += "-" + value.substring(7, 9); // XX
      if (value.length >= 10) formattedValue += "-" + value.substring(9, 11); // XX
    } else if (value.startsWith("86")) {
      // Маска для Китая +86 (XXX) XXXX-XXXX
      formattedValue = "+86 (";
      if (value.length > 2) formattedValue += value.substring(2, 5); // XXX
      if (value.length >= 6) formattedValue += ") " + value.substring(5, 9); // XXXX
      if (value.length >= 10) formattedValue += "-" + value.substring(9, 13); // XXXX
    } else {
      // Если формат не соответствует, просто показываем как есть
      formattedValue = value;
    }

    input.value = formattedValue;
  }

  function onPhoneBlur(e) {
    let input = e.target;
    if (input.value.length < 10) {
      input.value = ""; // Если длина номера меньше нужной, очищаем поле
    }
  }

  function onPhoneFocus(e) {
    let input = e.target;
    if (!input.value) {
      input.value = "+ "; // По умолчанию подставляем +
    }
  }

  const dataButtons = document.querySelectorAll("button[data-target]");

  dataButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const targetSelector = this.getAttribute("data-target");
      const className = this.getAttribute("data-class");

      const targetElement = document.querySelector(targetSelector);
      if (targetElement) {
        targetElement.classList.toggle(className);
      }
    });
  });
});
