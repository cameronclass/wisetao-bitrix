document.addEventListener("DOMContentLoaded", () => {
  const e = document.querySelectorAll(".header__menu_item");
  e.forEach(function (t) {
    t.addEventListener("click", function () {
      e.forEach(function (e) {
        e !== t &&
          e.classList.contains("menu-item__active") &&
          e.classList.remove("menu-item__active");
      }),
        this.classList.toggle("menu-item__active");
    });
  });
  const t = document.querySelectorAll(".menu-item__cards_item");
  function i(e) {
    e.stopPropagation(), this.classList.toggle("menu-item__cards_item_active");
    var i = this.closest(".menu-item__cards");
    i &&
      i.classList.toggle(
        "menu-item__cards_active",
        null !== i.querySelector(".menu-item__cards_item_active")
      ),
      t.forEach(function (e) {
        e !== this && e.classList.toggle("d-none");
      }, this);
    var c = this.querySelector(".menu-item__card");
    c && c.classList.toggle("d-none");
    var n = this.querySelector(".menu-item__cards");
    n && n.classList.toggle("d-none");
  }
  t.forEach(function (e) {
    e.addEventListener("click", i);
  });
});
