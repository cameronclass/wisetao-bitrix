// UiPrepare.js
export default class UiPrepare {
  constructor() {
    this.root = document;
    this.texts = {
      deliveryPlaceholder: {
        calcCustoms: {
          fromWhere: "Китай - Хейхе",
          fromTo: "Россия - Благовещенск",
          tooltipTitle: "Склад временного хранение",
          tooltipText:
            "Доставка осуществляется только до г.Благовещенск СВХ...",
        },
        calcCargo: {
          fromWhere: "Китай - Фошань",
          fromTo: "Россия - Москва",
          tooltipTitle: "Южные ворота",
          tooltipText:
            "Доставка осуществляется только до г.Москва «Южные ворота»...",
        },
      },
    };
    /* this._init(); */
  }

  _init() {
    this._initAddClassButtons();
    this._initChangeClass();
    this._initIncrement();
    this._initSelectCategory();
    this._initCustomSelect();
    this._initAllPriceRadios();
    this._initCalcTypeRadios();
    this._initAddressCheckbox();
    this._initDeliveryOptionRadios();
  }

  _initDeliveryOptionRadios() {
    const radioButtons = document.querySelectorAll(
      'input[name="delivery-option"]'
    );

    const deliveryOptionHandler = () => {
      const targetElements = document.querySelectorAll(
        ".сlient-data, .client-redeem-data"
      );

      // Проверяем, какая радиокнопка активна
      const isDeliveryAndPickup = Array.from(radioButtons).some(
        (radio) => radio.value === "delivery-and-pickup" && radio.checked
      );

      targetElements.forEach((element) => {
        if (isDeliveryAndPickup) {
          element.classList.add("active");
        } else {
          element.classList.remove("active");
        }
      });
    };

    // Добавляем обработчик события для всех радиокнопок
    radioButtons.forEach((radio) => {
      radio.addEventListener("change", deliveryOptionHandler);
    });

    // Вызываем обработчик один раз при инициализации
    deliveryOptionHandler();
  }

  _initAddClassButtons() {
    document.querySelectorAll(".js-add-class-packing").forEach((button) => {
      button.addEventListener("click", function () {
        const className = "active";
        const targetElement = document.querySelector(
          ".main-calc-packing__content"
        );
        if (targetElement) {
          targetElement.classList.toggle(className);
          this.classList.toggle("clicked");
        }
      });
    });
  }

  _initChangeClass() {
    document.querySelectorAll("[data-changeclass-class]").forEach((input) => {
      const handleClassChange = () => {
        const className = input.getAttribute("data-changeclass-class");
        const targets = input
          .getAttribute("data-changeclass-targets")
          .split(",")
          .map((selector) => document.querySelector(selector.trim()))
          .filter((el) => el !== null);

        if (targets.length === 2) {
          const [first, second] = targets;
          if (input.checked) {
            first.classList.add(className);
            second.classList.remove(className);
          } else {
            first.classList.remove(className);
            second.classList.add(className);
          }
        }
      };

      input.addEventListener("change", handleClassChange);
      handleClassChange();
    });
  }

  _initSelectCategory() {
    this.root.querySelectorAll(".calc-select").forEach((selectBlock) => {
      const selectedOption = selectBlock.querySelector(
        ".calc-select__selected"
      );
      const optionsContainer = selectBlock.querySelector(
        ".calc-select__options"
      );
      const options = selectBlock.querySelectorAll(".calc-select__input");
      const overflowTooltip = selectBlock.querySelector(".overflow-tooltip");
      const overflowTitle = overflowTooltip.querySelector(
        ".calc-tooltip__title"
      );
      const overflowText = overflowTooltip.querySelector(".calc-tooltip__text");

      selectedOption.addEventListener("click", () => {
        optionsContainer.style.display =
          optionsContainer.style.display === "flex" ? "none" : "flex";
      });

      options.forEach((option) => {
        option.addEventListener("change", (e) => {
          const label = e.target.closest(".calc-select__label");
          const optionName =
            label.querySelector(".calc-select__name").textContent;
          const tooltipTitle = label.querySelector(
            ".calc-tooltip__title"
          ).textContent;
          const tooltipText = label.querySelector(
            ".calc-tooltip__text"
          ).textContent;

          selectedOption.innerHTML = `
            <span>${optionName}</span>
            <span class="tooltip selected-tooltip">
              <span class="tooltip-icon">?</span>
              <span class="calc-select__selected_icon">
                  <svg class="dropdown-list-currency-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32.38141722065728" height="22.59489123485507" viewBox="110.22394056737565 250.64901537709036 32.38141722065728 22.59489123485507" xml:space="preserve">
                      <desc>Created with Fabric.js 5.3.0</desc>
                      <g transform="matrix(0 0.979842546 0.979842546 0 126.4146491777 261.9464609945)" id="DLgAgrXuFMXOEYFpJSRZM">
                          <path class="svg-arrow active" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill-rule: nonzero; opacity: 1;" transform=" translate(0, 0)" d="M 8.536 -3.5215 L -3.183 -14.8535 C -3.9269999999999996 -15.5975 -4.931 -16.0135 -5.999 -16.0135 C -7.068 -16.0135 -8.072 -15.5975 -8.827 -14.8415 C -9.583 -14.0855 -9.999 -13.0815 -9.999 -12.0135 C -9.999 -10.945500000000001 -9.583 -9.9405 -8.827 -9.185500000000001 L -0.29100000000000037 -0.6915000000000013 C -0.10300000000000037 -0.5035000000000014 -3.885780586188048e-16 -0.25350000000000134 -3.885780586188048e-16 0.013499999999998624 C -3.885780586188048e-16 0.28049999999999864 -0.10400000000000038 0.5314999999999986 -0.29300000000000037 0.7204999999999986 L -8.824000000000002 9.1815 C -9.583000000000002 9.9415 -9.999000000000002 10.9465 -9.999000000000002 12.0135 C -9.999000000000002 13.0805 -9.583000000000002 14.0855 -8.827000000000002 14.8415 C -8.072000000000001 15.5975 -7.067000000000002 16.0135 -5.999000000000002 16.0135 C -4.931000000000003 16.0135 -3.9260000000000024 15.5975 -3.170000000000002 14.8415 L -1.564000000000002 13.2355 L 8.519999999999998 3.5645000000000007 C 9.478999999999997 2.6055000000000006 9.998999999999999 1.3495000000000008 9.998999999999999 0.013500000000000512 C 9.998999999999999 -1.3224999999999996 9.479 -2.5774999999999997 8.535999999999998 -3.5214999999999996 z" stroke-linecap="round"></path>
                      </g>
                  </svg>
              </span>
              <span class="calc-tooltip">
                <span class="calc-tooltip__title">${tooltipTitle}</span>
                <span class="calc-tooltip__text">${tooltipText}</span>
              </span>
            </span>
          `;

          optionsContainer.style.display = "none";
        });
      });

      selectBlock.querySelectorAll(".calc-select__label").forEach((label) => {
        label.addEventListener("mouseenter", () => {
          const tooltipTitle = label.querySelector(
            ".calc-tooltip__title"
          ).textContent;
          const tooltipText = label.querySelector(
            ".calc-tooltip__text"
          ).textContent;

          overflowTitle.textContent = tooltipTitle;
          overflowText.textContent = tooltipText;
          overflowTooltip.classList.add("active");
        });

        label.addEventListener("mouseleave", () => {
          overflowTooltip.classList.remove("active");
        });
      });

      this.root.addEventListener("click", (e) => {
        if (!selectBlock.contains(e.target)) {
          optionsContainer.style.display = "none";
        }
      });
    });
  }

  _initIncrement() {
    this.root.querySelectorAll(".group-input-increment").forEach((element) => {
      const minusButton = element.querySelector(
        ".group-input-increment__minus"
      );
      const plusButton = element.querySelector(".group-input-increment__plus");
      const inputField = element.querySelector(".group-input-increment input");

      if (minusButton && !minusButton.dataset.incrementBound) {
        minusButton.addEventListener("click", () => {
          let currentValue = parseInt(inputField.value) || 1;
          if (currentValue > 1) {
            inputField.value = currentValue - 1;
            inputField.dispatchEvent(new Event("input"));
          }
        });
        minusButton.dataset.incrementBound = "true";
      }

      if (plusButton && !plusButton.dataset.incrementBound) {
        plusButton.addEventListener("click", () => {
          let currentValue = parseInt(inputField.value) || 1;
          inputField.value = currentValue + 1;
          inputField.dispatchEvent(new Event("input"));
        });
        plusButton.dataset.incrementBound = "true";
      }
    });
  }

  _initIncrementForElement(element) {
    const minusButton = element.querySelector(".group-input-increment__minus");
    const plusButton = element.querySelector(".group-input-increment__plus");
    const inputField = element.querySelector(".group-input-increment input");

    if (minusButton) {
      minusButton.addEventListener("click", () => {
        let currentValue = parseInt(inputField.value) || 1;
        if (currentValue > 1) {
          inputField.value = currentValue - 1;
          inputField.dispatchEvent(new Event("input"));
        }
      });
    }

    if (plusButton) {
      plusButton.addEventListener("click", () => {
        let currentValue = parseInt(inputField.value) || 1;
        inputField.value = currentValue + 1;
        inputField.dispatchEvent(new Event("input"));
      });
    }
  }

  _initCustomSelectForElement(element) {
    const selectBlock = element.querySelector(".currency-select");
    if (!selectBlock) return;

    const selectedNameElement = selectBlock.querySelector(
      ".currency-select__selected_name"
    );
    const optionsList = selectBlock.querySelector(".currency-select__list");
    const radioButtons = selectBlock.querySelectorAll(".custom-select__input");

    const toggleList = () => {
      optionsList.style.display =
        optionsList.style.display === "block" ? "none" : "block";
    };

    if (selectedNameElement) {
      selectedNameElement.parentElement.addEventListener("click", toggleList);
    }

    radioButtons.forEach((radio) => {
      radio.addEventListener("change", (e) => {
        const label = e.target.closest(".custom-select__label");
        const optionName = label.querySelector(
          ".custom-select__name"
        ).textContent;
        const selectedName = selectBlock.querySelector(
          ".currency-select__selected_name"
        );
        if (selectedName) {
          selectedName.textContent = optionName;
        }
        optionsList.style.display = "none";
      });
    });
  }

  _initCustomSelect() {
    document.querySelectorAll(".currency-select").forEach((selectBlock) => {
      const selectedNameElement = selectBlock.querySelector(
        ".currency-select__selected_name"
      );
      const optionsList = selectBlock.querySelector(".currency-select__list");
      const radioButtons = selectBlock.querySelectorAll(
        ".custom-select__input"
      );

      const toggleList = () => {
        optionsList.style.display =
          optionsList.style.display === "block" ? "none" : "block";
      };

      // Проверяем, не повешен ли уже:
      if (selectedNameElement && !selectedNameElement.dataset.selectBound) {
        selectedNameElement.parentElement.addEventListener("click", toggleList);
        selectedNameElement.dataset.selectBound = "true";
      }

      radioButtons.forEach((radio) => {
        if (!radio.dataset.selectBound) {
          radio.addEventListener("change", (e) => {
            const label = e.target.closest(".custom-select__label");
            const optionName = label.querySelector(
              ".custom-select__name"
            ).textContent;
            selectedNameElement.textContent = optionName;
            optionsList.style.display = "none";
          });
          radio.dataset.selectBound = "true";
        }
      });

      document.addEventListener("click", (e) => {
        if (!selectBlock.contains(e.target)) {
          optionsList.style.display = "none";
        }
      });
    });
  }

  _initAllPriceRadios() {
    const radioButtonsAllPrice = document.querySelectorAll(
      'input[name="all-price"]'
    );
    const pdfButtonAllPrice = document.querySelector(".js-get-pdf");

    const updateButtonState = () => {
      const isChecked = Array.from(radioButtonsAllPrice).some(
        (radio) => radio.checked
      );
      if (pdfButtonAllPrice) {
        pdfButtonAllPrice.disabled = !isChecked;
      }
    };
    radioButtonsAllPrice.forEach((radio) => {
      radio.addEventListener("change", updateButtonState);
    });
    updateButtonState();
  }

  _initCalcTypeRadios() {
    const calcTypeRadios = document.querySelectorAll('input[name="calc-type"]');
    const fromWhereInput = document.querySelector('input[name="from_where"]');
    const fromToInput = document.querySelector('input[name="from_to"]');
    const fromToContainer = document.querySelector(".main-calc__from-to_to");
    const tooltipTitle = fromToContainer.querySelector(".calc-tooltip__title");
    const tooltipText = fromToContainer.querySelector(".calc-tooltip__text");
    const insuranceCheckbox = document.querySelector('input[name="insurance"]');
    const insuranceCheckboxBlock = document.querySelector(
      ".main-calc__from-to_check"
    );
    const insuranceTooltip = document.querySelectorAll("._insurance-tooltip");
    const packingTypeRadios = document.querySelectorAll(
      'input[name="packing-type"]'
    );

    calcTypeRadios.forEach((radio) => {
      radio.addEventListener("change", () => {
        if (radio.value === "calc-customs" && radio.checked) {
          document.querySelector(".white-cargo").classList.add("active");
          document
            .querySelectorAll(".js-calc-category, .js-calc-brand")
            .forEach((elem) => elem.classList.add("hidden"));

          fromWhereInput.placeholder =
            this.texts.deliveryPlaceholder.calcCustoms.fromWhere;
          fromToInput.placeholder =
            this.texts.deliveryPlaceholder.calcCustoms.fromTo;
          tooltipTitle.textContent =
            this.texts.deliveryPlaceholder.calcCustoms.tooltipTitle;
          tooltipText.textContent =
            this.texts.deliveryPlaceholder.calcCustoms.tooltipText;

          if (insuranceCheckbox) {
            insuranceCheckboxBlock.classList.add("hidden");
            insuranceTooltip.forEach((elem) => elem.classList.add("hidden"));
            insuranceCheckbox.checked = false;
            insuranceCheckbox.disabled = true;
          }
          // Убираем checked у всех packing-type
          packingTypeRadios.forEach((packingRadio) => {
            packingRadio.checked = false;
          });
        } else if (radio.value === "calc-cargo" && radio.checked) {
          document.querySelector(".white-cargo").classList.remove("active");
          document
            .querySelectorAll(".js-calc-category, .js-calc-brand")
            .forEach((elem) => elem.classList.remove("hidden"));

          fromWhereInput.placeholder =
            this.texts.deliveryPlaceholder.calcCargo.fromWhere;
          fromToInput.placeholder =
            this.texts.deliveryPlaceholder.calcCargo.fromTo;
          tooltipTitle.textContent =
            this.texts.deliveryPlaceholder.calcCargo.tooltipTitle;
          tooltipText.textContent =
            this.texts.deliveryPlaceholder.calcCargo.tooltipText;

          if (insuranceCheckbox) {
            insuranceCheckboxBlock.classList.remove("hidden");
            insuranceTooltip.forEach((elem) => elem.classList.remove("hidden"));
            insuranceCheckbox.checked = true;
            insuranceCheckbox.disabled = false;
          }
          // Устанавливаем checked у первой packing-type (или можно выбрать по другому критерию)
          packingTypeRadios.forEach((packingRadio) => {
            packingRadio.checked = packingRadio.value === "std_pack"; // Замените "std_pack" на нужное значение
          });
        } else {
          document.querySelector(".white-cargo").classList.remove("active");
          document
            .querySelectorAll(".js-calc-category, .js-calc-brand")
            .forEach((elem) => elem.classList.remove("hidden"));

          fromWhereInput.placeholder = "";
          fromToInput.placeholder = "";
          tooltipTitle.textContent = "";
          tooltipText.textContent = "";

          if (insuranceCheckbox) {
            insuranceCheckboxBlock.classList.remove("hidden", "active");
            insuranceCheckbox.checked = false;
            insuranceCheckbox.disabled = false;
          }
        }
      });
    });
  }

  _initAddressCheckbox() {
    const addressInput = document.querySelector('input[name="address"]');
    const addressCheckbox = document.querySelector(
      'input[name="address_checkbox"]'
    );
    const addressIcon = document.querySelector(
      ".main-calc__from-to_adress .group-input__input_svg"
    );

    if (addressCheckbox) {
      addressCheckbox.addEventListener("change", () => {
        if (addressCheckbox.checked) {
          addressInput.disabled = false;
          if (addressIcon) addressIcon.style.display = "none";
        } else {
          addressInput.disabled = true;
          if (addressIcon) addressIcon.style.display = "block";
        }
      });
    }
  }
}
