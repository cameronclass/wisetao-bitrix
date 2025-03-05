let answersText = document.querySelectorAll(".accordion-js__item"),
  questionsText = document.querySelectorAll(".accordion-js__head");
let FAQItemsList = document.querySelector(".accordion-js__list");
let ajax_FAQ_inc;
let listenerInitializeFAQItems = [];
if (FAQItemsList) {
  ajax_FAQ_inc = FAQItemsList.dataset.ajax_FAQ_inc;
}

function initializeToggleFAQItems() {
  answersText = document.querySelectorAll(".accordion-js__item");
  questionsText = document.querySelectorAll(".accordion-js__head");
  function initializeFAQItems(questionText, key) {
    function initializeFAQItem() {
      answersText[key].classList.toggle("active");
    }
    let FAQItemsList = document.querySelector(".accordion-js__list");
    if (
      typeof listenerInitializeFAQItems[key] === "undefined" ||
      ajax_FAQ_inc < FAQItemsList.dataset.ajax_FAQ_inc
    ) {
      listenerInitializeFAQItems[key] = initializeFAQItem;
    }
    questionText.addEventListener("click", listenerInitializeFAQItems[key]);
  }
  questionsText.forEach(function (questionText, key) {
    initializeFAQItems(questionText, key);
  });

  let FAQItemsList = document.querySelector(".accordion-js__list");
  if (FAQItemsList) {
    if (ajax_FAQ_inc < FAQItemsList.dataset.ajax_FAQ_inc) {
      ajax_FAQ_inc = FAQItemsList.dataset.ajax_FAQ_inc;
    }
  }
}
