function showLineCardsForMenuItem(menuItem) {
  const menuItemRect = menuItem.getBoundingClientRect();
  let cardsClass = menuItem.classList.contains("menu-item__active")
    ? menuItem.classList[menuItem.classList.length - 2].split("__menu_item")
    : menuItem.classList[menuItem.classList.length - 1].split("__menu_item");
  const cardsLine = document.querySelector(`.${cardsClass[0]}__cards`);
  setPositionCardsLine(cardsLine, menuItemRect, cardsClass[0]);
}

function setPositionCardsLine(cardsLine, menuItemRect, cardsClass) {
  cardsLine.classList.toggle(`${cardsClass}__fix_cards_active`);
  cardsLine.style.top = `${
    menuItemRect.top +
    menuItemRect.height / 2 -
    cardsLine.getBoundingClientRect().height / 2
  }px`;
  cardsLine.style.left = `${menuItemRect.left + menuItemRect.width}px`;
}

function hideLineCardsForMenuItem(menuItem) {
  let cardsClass =
    menuItem.classList[menuItem.classList.length - 1].split("__menu_item");
  const cardsLine = document.querySelector(`.${cardsClass[0]}__cards`);
  cardsLine.classList.remove(`${cardsClass[0]}__fix_cards_active`);
}

window.addEventListener("resize", function () {
  updateFixCardsPosition();
});

window.addEventListener("scroll", function () {
  updateFixCardsPosition();
});

function updateFixCardsPosition() {
  let fixCards = document.querySelector('[class*="fix_cards_active"]');
  if (fixCards) {
    let menuItemClass = !fixCards.classList.contains("menu-item__cards_active")
      ? fixCards.classList[fixCards.classList.length - 1].split(
          "__fix_cards_active"
        )
      : fixCards.classList[fixCards.classList.length - 2].split(
          "__fix_cards_active"
        );
    const menuItem = document.querySelector(`.${menuItemClass[0]}__menu_item`);
    const menuItemRect = menuItem.getBoundingClientRect();
    fixCards.style.top = `${
      menuItemRect.top +
      menuItemRect.height / 2 -
      fixCards.getBoundingClientRect().height / 2
    }px`;
    fixCards.style.left = `${menuItemRect.left + menuItemRect.width}px`;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const menuItemsCard = document.querySelectorAll(".menu-item__card");
  const prevItems = document.querySelectorAll(".menu-item__card_prev");
  if (menuItemsCard) {
    updateCardsForClickCard(menuItemsCard);
  }
  if (prevItems) {
    updateCardsForClickCard(prevItems);
  }
});

function updateCardsForClickCard(items) {
  items.forEach((item) => {
    item.addEventListener("click", (event) => {
      item.parentElement.click();
      updateFixCardsPosition();
      event.stopPropagation();
    });
  });
}
