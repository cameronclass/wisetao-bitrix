document.addEventListener("DOMContentLoaded", () => {
  /* Main Selection */
  const mainSelectLinksRight = document.querySelectorAll(
    ".main-select__menu_right .main-select__menu_link"
  );
  const mainSelectLinksLeft = document.querySelectorAll(
    ".main-select__menu_left .main-select__menu_link"
  );
  const jsGoIndex = document.querySelectorAll(".js-go-index");
  const mainMenuJs = document.querySelector(".js-main-menu");
  const leftMenuJs = document.querySelector(".js-left-menu");
  const rightMenuJS = document.querySelector(".js-right-menu");

  const mobileFirstLayerLinks = document.querySelectorAll(
    ".js-right-menu .main-menu__main_link"
  );
  const rightMenuSecondLayer = document.querySelector(
    ".js-right-menu .main-menu__second"
  );
  const rightMenuSecondLayerBack = document.querySelector(
    ".js-right-menu .mobile-back-1"
  );

  const mobileFirstLayerLinksLeft = document.querySelectorAll(
    ".js-left-menu .main-menu__main_link"
  );
  const leftMenuSecondLayer = document.querySelector(
    ".js-left-menu .main-menu__second"
  );
  const leftMenuSecondLayerBack = document.querySelector(
    ".js-left-menu .mobile-back-1"
  );

  if (mainSelectLinksRight)
    mainSelectLinksRight.forEach((item) => {
      item.addEventListener("click", (e) => {
        mainMenuJs.classList.remove("active");
        leftMenuJs.classList.remove("active");
        rightMenuJS.classList.add("active");
      });
    });

  if (mainSelectLinksLeft)
    mainSelectLinksLeft.forEach((item) => {
      item.addEventListener("click", (e) => {
        mainMenuJs.classList.remove("active");
        leftMenuJs.classList.add("active");
        rightMenuJS.classList.remove("active");
      });
    });

  if (jsGoIndex)
    jsGoIndex.forEach((item) => {
      item.addEventListener("click", () => {
        mainMenuJs.classList.add("active");
        leftMenuJs.classList.remove("active");
        rightMenuJS.classList.remove("active");
        rightMenuSecondLayer.classList.remove("active");
        leftMenuSecondLayer.classList.remove("active");
      });
    });

  if (mobileFirstLayerLinks)
    mobileFirstLayerLinks.forEach((button) => {
      button.addEventListener("click", () => {
        rightMenuSecondLayer.classList.add("active");
      });
    });

  if (rightMenuSecondLayerBack)
    rightMenuSecondLayerBack.addEventListener("click", () => {
      rightMenuSecondLayer.classList.remove("active");
    });

  if (mobileFirstLayerLinksLeft)
    mobileFirstLayerLinksLeft.forEach((button) => {
      button.addEventListener("click", () => {
        leftMenuSecondLayer.classList.add("active");
      });
    });

  if (leftMenuSecondLayerBack)
    leftMenuSecondLayerBack.addEventListener("click", () => {
      leftMenuSecondLayer.classList.remove("active");
    });

  //
  let mobileBack1 = document.querySelectorAll(".mobile-back-1");
  let mobileBack2 = document.querySelectorAll(".mobile-back-2");
  let dropContentElements = document.querySelectorAll(
    ".main-menu-item__dropdown_block"
  );

  function updateMobileBack2() {
    let hasActiveClass = false;

    dropContentElements.forEach(function (element) {
      if (element.classList.contains("active")) {
        hasActiveClass = true;
      }
    });

    if (hasActiveClass) {
      mobileBack2.forEach((item) => {
        item.classList.add("active");
      });
      mobileBack1.forEach((item) => {
        item.classList.add("active");
      });
    } else {
      mobileBack2.forEach((item) => {
        item.classList.remove("active");
      });
      mobileBack1.forEach((item) => {
        item.classList.remove("active");
      });
    }
  }

  document.querySelectorAll(".main-menu").forEach((item) => {
    item.addEventListener("click", function () {
      updateMobileBack2();
    });
  });

  mobileBack2.forEach((item) => {
    item.addEventListener("click", () => {
      dropContentElements.forEach((drop) => {
        drop.classList.remove("active");
      });
    });
  });

  //

  /* Tablet */
  const mainSelectFrom = document.querySelector(".main-select__from");
  const mainSelectTo = document.querySelector(".main-select__to");

  if (mainSelectFrom)
    mainSelectFrom.addEventListener("click", (e) => {
      mainMenuJs.classList.remove("active");
      leftMenuJs.classList.add("active");
      rightMenuJS.classList.remove("active");
    });
  if (mainSelectTo)
    mainSelectTo.addEventListener("click", (e) => {
      mainMenuJs.classList.remove("active");
      leftMenuJs.classList.remove("active");
      rightMenuJS.classList.add("active");
    });

  /* Второй уровень */
  function updateMenuState() {
    let hashMenu = window.location.hash.substring(1);
    let buttonsMenu = document.querySelectorAll("[data-menu]");
    let contentsMenu = document.querySelectorAll("[data-menu-content]");

    buttonsMenu.forEach((button) => {
      let dataMenu = button.getAttribute("data-menu");
      if (
        window.location.pathname === "/" ||
        window.location.pathname.split("-")[0] === "/bitrix_include_areas" ||
        window.location.pathname.includes("hash-")
      ) {
        if (hashMenu === dataMenu) {
          button.classList.add("active");
        } else {
          button.classList.remove("active");
        }
      }
    });

    contentsMenu.forEach((content) => {
      let dataMenuContent = content.getAttribute("data-menu-content");
      if (
        window.location.pathname === "/" ||
        window.location.pathname.split("-")[0] === "/bitrix_include_areas" ||
        window.location.pathname.includes("hash-")
      ) {
        if (hashMenu === dataMenuContent) {
          content.classList.add("active");
        } else {
          content.classList.remove("active");
        }
      }
    });
  }

  window.addEventListener("hashchange", updateMenuState);

  document.querySelectorAll("[data-menu]").forEach(function (button) {
    button.addEventListener("click", function () {
      let dataMenu = button.getAttribute("data-menu");
      window.location.hash = dataMenu;
      updateMenuState();
      // contentsLayer.classList.remove("active");
    });
  });

  if (!window.location.pathname.includes("hash-")) {
    updateMenuState();
  }

  /* Третий уровень */
  function updateDropState() {
    let buttonsLayer = document.querySelectorAll("[data-drop]");
    let contentsLayer = document.querySelectorAll("[data-drop-content]");
    buttonsLayer.forEach(function (button) {
      button.addEventListener("click", function () {
        let dropValue = button.getAttribute("data-drop");

        contentsLayer.forEach(function (content) {
          let dropContentValue = content.getAttribute("data-drop-content");
          if (dropValue === dropContentValue) {
            content.classList.add("active");
          } else {
            content.classList.remove("active");
          }
        });
      });
    });
  }

  updateDropState();

  function removeClassOnPopstate(className) {
    window.addEventListener("popstate", function () {
      let elementsData = document.querySelectorAll("[data-drop-content]");

      elementsData.forEach(function (element) {
        element.classList.remove("active");
      });
    });
  }

  removeClassOnPopstate();

  initMenu();

  // Mobile Page Menu
  let jsMenuHamburger = document.querySelector(".js-menu-hamburger");
  if (jsMenuHamburger) {
    jsMenuHamburger.addEventListener("click", function () {
      this.classList.toggle("is-active");

      let pageMenu = document.querySelector(".page-menu");
      let pageMenuBlock = document.querySelector(".page-menu__block");

      if (pageMenu) {
        pageMenu.classList.toggle("active");
      }

      if (pageMenu && pageMenu.classList.contains("active")) {
        pageMenuBlock.classList.add("active");
      } else {
        pageMenuBlock.classList.remove("active");
      }
    });
  }

  // Если ссылки имею # то ничего не происходит
  const allLinksA = document.querySelectorAll("a");
  allLinksA.forEach((link) => {
    link.addEventListener("click", function (event) {
      // Если href равен "#", предотвращаем дефолтное поведение
      if (link.getAttribute("href") === "#") {
        event.preventDefault();
      }
    });
  });

  // Функция для наблюдения за изменениями классов в каждом контейнере
  function observeClassChanges(container) {
    const secondaryMenu = container;
    const mainMenuSecond = container.querySelector(".main-menu__second");
    const backButton = container.querySelector(".mobile-back-1");

    if (!mainMenuSecond || !backButton) return;

    // Callback функция, выполняемая при обнаружении изменений
    const callback = function (mutationsList) {
      for (let mutation of mutationsList) {
        if (
          mutation.type === "attributes" &&
          mutation.attributeName === "class"
        ) {
          // Если у .js-secondary-menu есть класс active, добавляем класс _active к кнопке
          if (secondaryMenu.classList.contains("active")) {
            backButton.classList.add("_active");
          } else {
            backButton.classList.remove("_active");
          }

          // Если у .main-menu__second есть класс active, убираем класс _active с кнопки
          if (mainMenuSecond.classList.contains("active")) {
            backButton.classList.remove("_active");
          } else if (secondaryMenu.classList.contains("active")) {
            // Если .main-menu__second не имеет класса active и .js-secondary-menu активен, добавляем класс _active кнопке
            backButton.classList.add("_active");
          }
        }
      }
    };

    // Создаем экземпляр наблюдателя, связанный с callback-функцией
    const observer = new MutationObserver(callback);

    // Начинаем наблюдение за целевым узлом для настроенных изменений
    observer.observe(secondaryMenu, { attributes: true });
    observer.observe(mainMenuSecond, { attributes: true });
  }

  // Итерация по каждому контейнеру .js-secondary-menu и наблюдение за изменениями классов
  document.querySelectorAll(".js-secondary-menu").forEach((container) => {
    observeClassChanges(container);
  });
});

function initMenu() {
  /* Внутреннее меню */
  let dataInButton = document.querySelectorAll(
    ".page-menu__menu_group_items.active [data-in-menu]"
  );
  let dataInLevelButton = document.querySelectorAll(
    ".page-menu__menu_group_items.active [data-in-level]"
  );

  if (dataInButton)
    dataInButton.forEach(function (button) {
      button.addEventListener("click", function () {
        const dataInContent = document.querySelectorAll(
          ".page-menu__menu_group_items.active [data-in-content]"
        );
        dataInButton.forEach(function (btn) {
          btn.classList.remove("active");
          btn.parentElement.classList.remove("active");
        });
        dataInContent.forEach(function (div) {
          div.classList.remove("active");
        });

        let dataInLevelButton = document.querySelectorAll(
          ".page-menu__menu_group_items.active [data-in-level]"
        );
        let dataInLevelDrop = document.querySelectorAll(
          ".page-menu__menu_group_items.active [data-in-level-content]"
        );
        dataInLevelButton.forEach(function (div) {
          div.classList.remove("active");
        });
        dataInLevelDrop.forEach(function (div) {
          div.classList.remove("active");
        });

        let menuAttr = this.getAttribute("data-in-menu");

        dataInContent.forEach(function (div) {
          let contentAttr = div.getAttribute("data-in-content");

          if (menuAttr === contentAttr) {
            button.classList.toggle("active");
            button.parentElement.classList.toggle("active");
            div.classList.toggle("active");
          }
        });
      });
    });

  if (dataInLevelButton)
    // Перебираем каждую кнопку
    dataInLevelButton.forEach(function (button) {
      // Добавляем обработчик события клика
      button.addEventListener("click", function () {
        // Получаем все div'ы с классом page-menu__menu_drop
        const dataInLevelDrop = document.querySelectorAll(
          ".page-menu__menu_group_items.active [data-in-level-content]"
        );
        // Удаляем класс active у всех элементов с атрибутами data-in-menu и data-in-content
        dataInLevelButton.forEach(function (btn) {
          btn.classList.remove("active");
          btn.parentElement.classList.remove("active");
        });
        dataInLevelDrop.forEach(function (div) {
          div.classList.remove("active");
        });

        // Получаем значение data-in-menu для текущей кнопки
        let menuAttr = this.getAttribute("data-in-level");

        // Перебираем каждый div
        dataInLevelDrop.forEach(function (div) {
          let contentAttr = div.getAttribute("data-in-level-content");

          // Если значения совпадают, добавляем класс active обоим элементам
          if (menuAttr === contentAttr) {
            button.classList.toggle("active");
            button.parentElement.classList.toggle("active");
            div.classList.toggle("active");
          }
        });
      });
    });
}
