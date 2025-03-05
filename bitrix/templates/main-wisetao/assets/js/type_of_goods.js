let reviewFormListsDropdowns = document.querySelectorAll(
  ".review-form-lists-dropdown"
);
let ajax_form_inc;
let listenerInitializeToggle = [];
let listenerInitializeTypeOfGoodsValues = [];
let listenerInitializeTypeOfGoodsItems = [];
let listenerInitializeDropdownList = [];
let listenerInitializeDocument = [];
let reviewDropdownToggle = document.querySelector(
  ".review-form-lists-dropdown-toggle"
);
if (reviewDropdownToggle) {
  ajax_form_inc = reviewDropdownToggle.dataset.ajax_form_inc;
}
function initializeDropDownLists() {
  reviewFormListsDropdowns = document.querySelectorAll(
    ".review-form-lists-dropdown"
  );

  function initializeDropdownList(dropdown, key) {
    const reviewDropdownToggle = dropdown.querySelector(
      ".review-form-lists-dropdown-toggle"
    );
    const dropdownList = dropdown.querySelector(
      ".review-form-lists-dropdown-list"
    );
    const typeOfGoodsValues = dropdown.querySelectorAll(
      ".review-form-lists-values"
    );
    const typeOfGoodsItems = dropdown.querySelectorAll(
      ".review-form-lists-dropdown-list li"
    );

    function updateCurrency(sign) {
      reviewDropdownToggle.textContent =
        reviewDropdownToggle.dataset.typelist + sign.textContent;
      document.querySelector(
        `input[name="${reviewDropdownToggle.dataset.input_name}"]`
      ).value = sign.dataset.id_topic;
      if (reviewDropdownToggle.dataset.input_name_additionaly) {
        document.querySelector(
          `input[name="${reviewDropdownToggle.dataset.input_name_additionaly}"]`
        ).value = sign.textContent;
      }
      dropdownList.classList.remove("active");
      reviewDropdownToggle.style.borderBottomRightRadius = "10px";
      reviewDropdownToggle.style.borderBottomLeftRadius = "10px";
      dropdown.style.borderBottomRightRadius = "10px";
      dropdown.style.borderBottomLeftRadius = "10px";
    }

    //Инициализация элемента с выбранным значением
    function initializeToggle() {
      dropdownList.classList.toggle("active");
      if (dropdownList.classList.contains("active")) {
        reviewDropdownToggle.style.borderBottomRightRadius = 0;
        reviewDropdownToggle.style.borderBottomLeftRadius = 0;
        dropdown.style.borderBottomRightRadius = 0;
        dropdown.style.borderBottomLeftRadius = 0;
      } else {
        reviewDropdownToggle.style.borderBottomRightRadius = "10px";
        reviewDropdownToggle.style.borderBottomLeftRadius = "10px";
        dropdown.style.borderBottomRightRadius = "10px";
        dropdown.style.borderBottomLeftRadius = "10px";
      }
    }
    if (
      typeof listenerInitializeToggle[key] === "undefined" ||
      ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc
    ) {
      listenerInitializeToggle[key] = initializeToggle;
    }
    reviewDropdownToggle.addEventListener(
      "click",
      listenerInitializeToggle[key]
    );

    //Инициализация span'ов со значениями списка
    function initializeTypeOfGoodsValues(event) {
      event.stopPropagation();
      updateCurrency(event.target);
    }
    if (
      typeof listenerInitializeTypeOfGoodsValues[key] === "undefined" ||
      ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc
    ) {
      listenerInitializeTypeOfGoodsValues[key] = initializeTypeOfGoodsValues;
    }
    typeOfGoodsValues.forEach(function (value) {
      value.addEventListener("click", listenerInitializeTypeOfGoodsValues[key]);
    });

    //Инициализация элементов списка
    function initializeTypeOfGoodsItems(event) {
      event.stopPropagation();
      let value;
      const item = event.currentTarget;
      if (!item.closest("ul").classList.contains("delivery-types-list")) {
        value = item.querySelector(".review-form-lists-values");
      }
      updateCurrency(value);
    }
    if (
      typeof listenerInitializeTypeOfGoodsItems[key] === "undefined" ||
      ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc
    ) {
      listenerInitializeTypeOfGoodsItems[key] = initializeTypeOfGoodsItems;
    }
    typeOfGoodsItems.forEach(function (item) {
      item.addEventListener("click", listenerInitializeTypeOfGoodsItems[key]);
    });

    //Инициализация списка
    function InitializeList(event) {
      event.stopPropagation();
      reviewDropdownToggle.style.borderBottomRightRadius = "10px";
      reviewDropdownToggle.style.borderBottomLeftRadius = "10px";
      dropdown.style.borderBottomRightRadius = "10px";
      dropdown.style.borderBottomLeftRadius = "10px";
    }
    if (
      typeof listenerInitializeDropdownList[key] === "undefined" ||
      ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc
    ) {
      listenerInitializeDropdownList[key] = InitializeList;
    }
    dropdownList.addEventListener("click", listenerInitializeDropdownList[key]);

    //Инициализация документа
    function initializeDocument(event) {
      if (
        !dropdown.contains(event.target) &&
        !reviewDropdownToggle.contains(event.target)
      ) {
        dropdownList.classList.remove("active");
        reviewDropdownToggle.style.borderBottomRightRadius = "10px";
        reviewDropdownToggle.style.borderBottomLeftRadius = "10px";
        dropdown.style.borderBottomRightRadius = "10px";
        dropdown.style.borderBottomLeftRadius = "10px";
      }
    }
    if (
      typeof listenerInitializeDocument[key] === "undefined" ||
      ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc
    ) {
      listenerInitializeDocument[key] = initializeDocument;
    }
    document.addEventListener("click", listenerInitializeDocument[key]);
  }

  reviewFormListsDropdowns.forEach(function (dropdown, key) {
    initializeDropdownList(dropdown, key);
  });

  let reviewDropdownToggle = document.querySelector(
    ".review-form-lists-dropdown-toggle"
  );
  if (reviewDropdownToggle) {
    if (ajax_form_inc < reviewDropdownToggle.dataset.ajax_form_inc) {
      ajax_form_inc = reviewDropdownToggle.dataset.ajax_form_inc;
    }
  }
}
