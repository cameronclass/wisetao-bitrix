let expandButtons = document.querySelectorAll(".reviews__item_more");
let ajax_reviews_inc;
let listenerInitializeExpandButtons = [];
let reviewsItem = document.querySelector(".reviews__items");
if (reviewsItem) {
  ajax_reviews_inc = reviewsItem.dataset.ajax_reviews_inc;
}
function initializeExpandButtons() {
  expandButtons = document.querySelectorAll(".reviews__item_more");
  function initializeButtons(button, key) {
    const reviewsText = button
      .closest(".reviews__item")
      .querySelector(".reviews__item_text");
    const reviewsTextHide = button
      .closest(".reviews__item")
      .querySelector(".hide-part-review");
    function initializeButton(event) {
      event.preventDefault();
      reviewsText.classList.toggle("active");
      if (reviewsText.classList.contains("active")) {
        reviewsText.textContent = reviewsText.textContent.replace(
          "...",
          reviewsTextHide.textContent
        );
        button.querySelector("span").textContent = "Свернуть";
        button.querySelector("img").style.transform = "rotate(180deg)";
      } else {
        reviewsText.textContent = reviewsText.textContent.replace(
          reviewsTextHide.textContent,
          "..."
        );
        button.querySelector("span").textContent = "Развернуть";
        button.querySelector("img").style.transform = "rotate(0deg)";
      }
    }
    const reviewsItem = document.querySelector(".reviews__items");
    if (
      typeof listenerInitializeExpandButtons[key] === "undefined" ||
      ajax_reviews_inc < reviewsItem.dataset.ajax_reviews_inc
    ) {
      listenerInitializeExpandButtons[key] = initializeButton;
    }
    button.addEventListener("click", listenerInitializeExpandButtons[key]);
  }
  expandButtons.forEach(function (button, key) {
    initializeButtons(button, key);
  });

  let reviewsItem = document.querySelector(".reviews__items");
  if (reviewsItem) {
    if (ajax_reviews_inc < reviewsItem.dataset.ajax_reviews_inc) {
      ajax_reviews_inc = reviewsItem.dataset.ajax_reviews_inc;
    }
  }
}
