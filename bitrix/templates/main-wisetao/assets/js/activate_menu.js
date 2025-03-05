document.addEventListener("DOMContentLoaded", () => {
  let categoryItems = document.querySelectorAll(".page-menu__menu_category");
  let menuGroups = document.querySelectorAll(".page-menu__menu_group_items");
  categoryItems.forEach((item) => {
    item.addEventListener("click", (event) => {
      categoryItems.forEach((compareItem) => {
        if (compareItem !== event.currentTarget) {
          compareItem.classList.remove("active");
        }
      });
      event.currentTarget.classList.add("active");
      menuGroups.forEach((menuGroup) => {
        if (menuGroup.dataset.page === event.currentTarget.dataset.page) {
          menuGroup.classList.add("active");
        } else {
          menuGroup.classList.remove("active");
        }
      });
      initMenu();
    });
  });

  document.querySelectorAll(".page-menu__menu_drop_link").forEach((item) => {
    if (
      item.nextElementSibling &&
      item.nextElementSibling.classList.contains("page-menu__inside")
    ) {
      if (
        item.getAttribute("href") !== "/from-china/logistic/" &&
        item.getAttribute("href") !== "/in-china/logistic/"
      ) {
        item.setAttribute("href", updateURL(item.getAttribute("href")));
      }
      item.nextElementSibling.querySelector(
        ".page-menu__inside_block"
      ).style.marginTop = "0";
      item.nextElementSibling.querySelector(
        ".page-menu__inside_block"
      ).style.display = "block";
      item.nextElementSibling.parentElement.style.flexDirection = "unset";
    }
    if (
      item.nextElementSibling &&
      !item.nextElementSibling.classList.contains("page-menu__inside")
    ) {
      item.classList.add("page-menu__menu_drop_link-without-tail");
    }
  });
  // Создаем функции для добавления и удаления обработчиков событий
  // Создаем Map для хранения обработчиков событий
  const clickHandlers = new Map();
  document.querySelectorAll(".page-menu__menu_link").forEach((item) => {
    const clickHandler = (event) => {
      event.stopImmediatePropagation();
    };
    item.addEventListener("click", clickHandler, true);
    // Сохраняем обработчик в Map
    clickHandlers.set(item, clickHandler);
  });

  // Добавляем обработчики для .page-menu__menu_drop_link
  document.querySelectorAll(".page-menu__menu_drop_link").forEach((item) => {
    const clickHandler = (event) => {
      event.stopImmediatePropagation();
    };
    item.addEventListener("click", clickHandler, true);
    // Сохраняем обработчик в Map
    clickHandlers.set(item, clickHandler);
  });
  // Функция для добавления обработчиков событий
  const links = document.querySelectorAll(".page-menu__menu_link");
  const addEventHandlers = () => {
    document.querySelector(".page-menu")?.classList.add("hovered");

    const links = document.querySelectorAll(".page-menu__menu_link");
    links.forEach((link) => {
      if (
        (link.getAttribute("href") === "/hash-left-about/" ||
          link.getAttribute("href") === "/hash-right-about/") &&
        link.textContent !== "О нас"
      ) {
        link.parentNode.removeChild(link);
      }
    });

    clickHandlers.forEach((handler, item) => {
      item.removeEventListener("click", handler, true);
    });
    clickHandlers.clear();

    // Добавляем обработчики для .page-menu__menu_link
    document.querySelectorAll(".page-menu__menu_link").forEach((item) => {
      if (
        item.getAttribute("href") !== "/from-china/logistic/" &&
        item.getAttribute("href") !== "/in-china/logistic/"
      ) {
        const clickHandler = (event) => {
          event.preventDefault();
        };
        item.addEventListener("click", clickHandler, true);
        // Сохраняем обработчик в Map
        clickHandlers.set(item, clickHandler);
      }
    });

    // Добавляем обработчики для .page-menu__menu_drop_link
    document.querySelectorAll(".page-menu__menu_drop_link").forEach((item) => {
      if (
        item.nextElementSibling &&
        item.nextElementSibling.classList.contains("page-menu__inside")
      ) {
        const clickHandler = (event) => {
          event.preventDefault();
        };
        item.addEventListener("click", clickHandler, true);
        // Сохраняем обработчик в Map
        clickHandlers.set(item, clickHandler);
      }
    });
  };

  // Функция для удаления обработчиков событий
  const removeEventHandlers = () => {
    let pageMenuActive = document
      .querySelector(".page-menu")
      ?.classList.contains("active");
    // Удаляем обработчики для .page-menu__menu_link
    if (!pageMenuActive) {
      clickHandlers.forEach((handler, item) => {
        item.removeEventListener("click", handler, true);
      });
      // Очищаем Map после удаления обработчиков
      clickHandlers.clear();

      document.querySelectorAll(".page-menu__menu_link").forEach((item) => {
        const clickHandler = (event) => {
          event.stopImmediatePropagation();
        };
        item.addEventListener("click", clickHandler, true);
        // Сохраняем обработчик в Map
        clickHandlers.set(item, clickHandler);
      });

      // Добавляем обработчики для .page-menu__menu_drop_link
      document
        .querySelectorAll(".page-menu__menu_drop_link")
        .forEach((item) => {
          const clickHandler = (event) => {
            event.stopImmediatePropagation();
          };
          item.addEventListener("click", clickHandler, true);
          // Сохраняем обработчик в Map
          clickHandlers.set(item, clickHandler);
        });
    }
  };

  // Добавляем обработчики при наведении на .page-menu
  //     document.querySelector('.hover-for-menu')?.addEventListener('mouseenter', () => {
  //         document.querySelectorAll('.page-menu__menu_drop_link').forEach((item) => {
  //             if (item.nextElementSibling && !item.nextElementSibling.classList.contains('page-menu__inside')) {
  //                 item.style.marginBottom = '5px';
  //             }
  //         });
  //         addEventHandlers();
  //     });

  // Функция для добавления стиля к элементам
  function applyMenuStyles() {
    document.querySelectorAll(".page-menu__menu_drop_link").forEach((item) => {
      if (
        item.nextElementSibling &&
        !item.nextElementSibling.classList.contains("page-menu__inside")
      ) {
        item.classList.remove("page-menu__menu_drop_link-without-tail");
      }
      if (
        item.nextElementSibling &&
        item.nextElementSibling.classList.contains("page-menu__inside")
      ) {
        item.nextElementSibling.querySelector(
          ".page-menu__inside_block"
        ).style.marginTop = "10px";
        item.nextElementSibling.parentElement.style.flexDirection = "column";
      }
    });
    addEventHandlers();
    removeEllipsis();
  }

  // Обработчик события mouseenter для элемента с классом .hover-for-menu
  document
    .querySelector(".hover-for-menu")
    ?.addEventListener("mouseenter", applyMenuStyles);

  // Обработчик события click для кнопки с классом .mobile-menu-open
  document
    .querySelector(".mobile-menu-open")
    ?.addEventListener("click", applyMenuStyles);

  if (
    document.querySelector(".page-menu") &&
    !document.querySelector(".page-menu").classList.contains("hovered")
  ) {
    addLinks();
  }
  // Убираем обработчики при уходе курсора с .page-menu
  //     document.querySelector('.hover-for-menu').addEventListener('mouseleave', removeEventHandlers);
  document
    .querySelector(".page-menu")
    ?.addEventListener("mouseleave", (event) => {
      if (event.currentTarget.classList.contains("hovered")) {
        removeEventHandlers();
        if (!event.currentTarget.classList.contains("active")) {
          document
            .querySelectorAll(".page-menu__menu_drop_link")
            .forEach((item) => {
              if (
                item.nextElementSibling &&
                !item.nextElementSibling.classList.contains("page-menu__inside")
              ) {
                item.classList.add("page-menu__menu_drop_link-without-tail");
              }
              if (
                item.nextElementSibling &&
                item.nextElementSibling.classList.contains("page-menu__inside")
              ) {
                item.nextElementSibling.querySelector(
                  ".page-menu__inside_block"
                ).style.marginTop = "0";
                item.nextElementSibling.querySelector(
                  ".page-menu__inside_block"
                ).style.display = "block";
                item.nextElementSibling.parentElement.style.flexDirection =
                  "unset";
              }
            });
          addLinks();
        }
        event.currentTarget.classList.remove("hovered");
        fitVerticalBreadCrumbs();
      }
    });
  if (window.location.pathname.includes("data-in-level-")) {
    document.querySelectorAll(".main-menu-item__card").forEach((item) => {
      if (
        item.dataset.drop ===
        window.location.pathname.split("data-in-level-")[1].split("/")[0]
      ) {
        item.click();
      }
    });
  }
  fitVerticalBreadCrumbs();

  window.addEventListener("mouseout", function (event) {
    if (event.relatedTarget === null) {
      if (document.querySelector(".page-menu")?.classList.contains("hovered")) {
        removeEventHandlers();
        document
          .querySelectorAll(".page-menu__menu_drop_link")
          .forEach((item) => {
            if (
              item.nextElementSibling &&
              !item.nextElementSibling.classList.contains("page-menu__inside")
            ) {
              item.classList.add("page-menu__menu_drop_link-without-tail");
            }
            if (
              item.nextElementSibling &&
              item.nextElementSibling.classList.contains("page-menu__inside")
            ) {
              item.nextElementSibling.querySelector(
                ".page-menu__inside_block"
              ).style.marginTop = "0";
              item.nextElementSibling.querySelector(
                ".page-menu__inside_block"
              ).style.display = "block";
              item.nextElementSibling.parentElement.style.flexDirection =
                "unset";
            }
          });
        addLinks();
        document.querySelector(".page-menu").classList.remove("hovered");
        fitVerticalBreadCrumbs();
      }
    }
  });
});

function addLinks() {
  const links = document.querySelectorAll(".page-menu__menu_link");
  links.forEach((link) => {
    const clone = link.cloneNode(true);

    if (
      link.getAttribute("href").includes("hash-left") ||
      link.getAttribute("href").includes("from-china/logistic")
    ) {
      clone.textContent = "ИЗ КИТАЯ";
      clone.setAttribute("href", "/hash-left-about/");
      clone.dataset.inMenu = "about";
    } else if (
      link.getAttribute("href").includes("hash-right") ||
      link.getAttribute("href").includes("in-china/logistic")
    ) {
      clone.textContent = "В КИТАЙ";
      clone.setAttribute("href", "/hash-right-about/");
      clone.dataset.inMenu = "about";
    }
    clone.style.marginRight = "8px";
    link.parentNode.insertBefore(clone, link);
  });
}

const updateURL = (url) => {
  const urlObj = new URL("https://wisetao.com" + url);
  const pathSegments = urlObj.pathname
    .split("/")
    .filter((segment) => segment !== "");

  let hashPrefix = "";
  if (pathSegments.includes("from-china")) {
    hashPrefix = "hash-left-";
  } else if (pathSegments.includes("in-china")) {
    hashPrefix = "hash-right-";
  }

  if (hashPrefix) {
    const newPathSegments = [];
    let prefixAdded = false;

    pathSegments.forEach((segment, index) => {
      if (
        (segment === "from-china" || segment === "in-china") &&
        index + 1 < pathSegments.length &&
        !prefixAdded
      ) {
        newPathSegments.push(hashPrefix + pathSegments[index + 1]);
        newPathSegments.push("data-in-level-" + pathSegments[index + 2]);
        prefixAdded = true;
      }
    });

    // Преобразование нового пути обратно в строку
    const newPath = "/" + newPathSegments.join("/") + "/";
    // Обновление URL
    return `${urlObj.origin}${newPath}${urlObj.search}${urlObj.hash}`;
  }

  // Если не нашлись сегменты 'from-china' или 'in-china', возвращаем оригинальный URL
  return url;
};

function removeEllipsis() {
  let pageMenu = document.querySelector(".page-menu.hovered");
  if (pageMenu) {
    let menuItemActive = pageMenu.querySelector(".page-menu__menu_item.active");
    if (menuItemActive) {
      let pageMenuMenuDropActive = menuItemActive.querySelector(
        ".page-menu__menu_drop.active"
      );
      if (pageMenuMenuDropActive) {
        let pageMenuMenuDropLinkActive = pageMenuMenuDropActive.querySelector(
          ".page-menu__menu_drop_link.active"
        );
        if (
          pageMenuMenuDropLinkActive &&
          pageMenuMenuDropLinkActive.nextElementSibling &&
          pageMenuMenuDropLinkActive.nextElementSibling.classList.contains(
            "page-menu__inside"
          )
        ) {
          const ellipsis = pageMenuMenuDropActive.querySelector(
            ".page-menu__menu_drop_ellipsis"
          );
          if (ellipsis) {
            pageMenuMenuDropActive.removeChild(ellipsis);
            pageMenuMenuDropActive.style.marginTop = "8px";
            pageMenuMenuDropLinkActive.classList.remove(
              "page-menu__menu_drop_link-to-fit"
            );
            pageMenuMenuDropLinkActive.nextElementSibling.querySelector(
              ".page-menu__inside_block"
            ).style.marginBottom = "10px";
            pageMenuMenuDropLinkActive.nextElementSibling.querySelector(
              ".page-menu__inside_block"
            ).style.paddingLeft = "20px";
          }
        }
        const ellipsis = pageMenuMenuDropActive.parentElement.querySelector(
          ".page-menu__menu_drop_ellipsis"
        );
        if (ellipsis) {
          pageMenuMenuDropActive.parentElement.removeChild(ellipsis);
          pageMenuMenuDropActive.previousElementSibling.classList.remove(
            "page-menu__menu_link-to-fit"
          );
        }
      }
    }
  }
}

function fitVerticalBreadCrumbs() {
  let pageMenu = document.querySelector(".page-menu:not(.hovered)");
  if (pageMenu) {
    let menuItemActive = pageMenu.querySelector(".page-menu__menu_item.active");
    if (menuItemActive) {
      if (menuItemActive.offsetWidth > 600) {
        let pageMenuMenuDropActive = menuItemActive.querySelector(
          ".page-menu__menu_drop.active"
        );
        if (pageMenuMenuDropActive) {
          let pageMenuMenuDropLinkActive = pageMenuMenuDropActive.querySelector(
            ".page-menu__menu_drop_link.active"
          );
          if (
            pageMenuMenuDropLinkActive &&
            pageMenuMenuDropLinkActive.nextElementSibling &&
            pageMenuMenuDropLinkActive.nextElementSibling.classList.contains(
              "page-menu__inside"
            )
          ) {
            if (
              !pageMenuMenuDropLinkActive.parentElement.querySelector(
                ".page-menu__menu_drop_ellipsis"
              )
            ) {
              const ellipsis = document.createElement("span");
              ellipsis.classList.add("page-menu__menu_drop_ellipsis");
              ellipsis.innerText = "···";
              ellipsis.addEventListener("click", (event) => {
                showLink(
                  event.currentTarget,
                  "page-menu__menu_drop_link-to-fit"
                );
              });
              pageMenuMenuDropActive.insertBefore(
                ellipsis,
                pageMenuMenuDropLinkActive
              );
              pageMenuMenuDropActive.style.marginTop = "12px";
              pageMenuMenuDropLinkActive.classList.add(
                "page-menu__menu_drop_link-to-fit"
              );
              pageMenuMenuDropLinkActive.addEventListener("mouseleave", () => {
                if (
                  pageMenuMenuDropLinkActive.previousElementSibling.classList.contains(
                    "page-menu__menu_drop_ellipsis"
                  )
                ) {
                  hideLink(pageMenuMenuDropActive, pageMenuMenuDropLinkActive);
                }
              });
              pageMenuMenuDropLinkActive.nextElementSibling.querySelector(
                ".page-menu__inside_block"
              ).style.marginBottom = "5px";
              pageMenuMenuDropLinkActive.nextElementSibling.querySelector(
                ".page-menu__inside_block"
              ).style.paddingLeft = "0";
            }
          }
          if (menuItemActive.offsetWidth > 600) {
            if (
              !pageMenuMenuDropActive.parentElement.querySelector(
                ".page-menu__menu_drop_ellipsis"
              )
            ) {
              const ellipsis = document.createElement("span");
              ellipsis.classList.add("page-menu__menu_drop_ellipsis");
              ellipsis.innerText = "···";
              ellipsis.addEventListener("click", (event) => {
                showLink(event.currentTarget, "page-menu__menu_link-to-fit");
              });
              pageMenuMenuDropActive.parentElement.insertBefore(
                ellipsis,
                pageMenuMenuDropActive.previousElementSibling
              );
              pageMenuMenuDropActive.previousElementSibling.classList.add(
                "page-menu__menu_link-to-fit"
              );
              pageMenuMenuDropActive.previousElementSibling.addEventListener(
                "mouseleave",
                () => {
                  if (
                    pageMenuMenuDropActive.previousElementSibling.previousElementSibling.classList.contains(
                      "page-menu__menu_drop_ellipsis"
                    )
                  ) {
                    hideLinkTwo(
                      pageMenuMenuDropActive,
                      pageMenuMenuDropActive.previousElementSibling
                    );
                  }
                }
              );
            }
          }
        }
      }
    }
  }
  activateBreadCrumbs();
}

function hideLink(pageMenuMenuDropActive, pageMenuMenuDropLinkActive) {
  pageMenuMenuDropActive.style.marginTop = "12px";
  pageMenuMenuDropLinkActive.classList.add("page-menu__menu_drop_link-to-fit");
  pageMenuMenuDropLinkActive.previousElementSibling.style.display = "flex";
}

function hideLinkTwo(pageMenuMenuDropActive, pageMenuMenuDropLinkActive) {
  pageMenuMenuDropLinkActive.classList.add("page-menu__menu_link-to-fit");
  pageMenuMenuDropLinkActive.previousElementSibling.style.display = "flex";
}

function showLink(ellipsis, linkClass) {
  ellipsis.nextElementSibling.classList.remove(linkClass);
  ellipsis.style.display = "none";
  ellipsis.nextElementSibling.style.marginTop = "0";
}

function activateBreadCrumbs() {
  let menuItemActive = document.querySelector(".page-menu__menu_item.active");
  let menuLinksActive = document.querySelectorAll(
    ".page-menu__menu_link.active"
  );
  let menuDropLinksActive = document.querySelectorAll(
    ".page-menu__menu_drop_link.active"
  );

  if (menuItemActive) {
    menuItemActive.setAttribute("itemscope", "");
    menuItemActive.setAttribute(
      "itemtype",
      "https://schema.org/BreadcrumbList"
    );
  }

  if (menuLinksActive) {
    menuLinksActive.forEach((item, index) => {
      addMicrodata(item, index);
    });
  }

  if (menuDropLinksActive) {
    menuDropLinksActive.forEach((item, index) => {
      addMicrodata(item, index);
    });
  }
}

function addMicrodata(item, index) {
  item.setAttribute("itemprop", "itemListElement");
  item.setAttribute("itemscope", "");
  item.setAttribute("itemtype", "https://schema.org/ListItem");

  let name = document.createElement("meta");
  name.setAttribute("itemprop", "name");
  name.setAttribute("content", item.textContent);

  let linkItem = document.createElement("meta");
  linkItem.setAttribute("itemprop", "item");
  linkItem.setAttribute(
    "content",
    new URL(item.getAttribute("href"), window.location.href).href
  );

  let position = document.createElement("meta");
  position.setAttribute("itemprop", "position");
  position.setAttribute("content", (index + 1).toString());

  item.appendChild(name);
  item.appendChild(linkItem);
  item.appendChild(position);
}
