document.addEventListener("DOMContentLoaded", function () {
  const cookieBtn = document.querySelector(".block-cookie__btn");
  const cookieBlock = document.querySelector(".block-cookie");

  if (cookieBlock)
    if (localStorage.getItem("cookiesAccepted")) {
      cookieBlock.classList.remove("active");
    } else {
      cookieBlock.classList.add("active");
    }

  if (cookieBtn) {
    cookieBtn.addEventListener("click", function () {
      localStorage.setItem("cookiesAccepted", "true");
      cookieBlock.style.display = "none";
    });
  }

  if (document.querySelectorAll(".marketing-review-card__more")) {
    document
      .querySelectorAll(".marketing-review-card__more")
      .forEach((button) => {
        button.addEventListener("click", () => {
          button.classList.toggle("_active");
          const textElement = button
            .closest(".marketing-review-card")
            .querySelector(".marketing-review-card__text");
          textElement.classList.toggle("_active");
        });
      });
  }
});

// Function to observe class changes for each container
function observeClassChanges(container) {
  const targetNode = container.querySelector(".main-menu__secondary");
  const backButton = container.querySelector(".mobile-back-1");

  if (!targetNode || !backButton) return;

  // Callback function to execute when mutations are observed
  const callback = function (mutationsList) {
    for (let mutation of mutationsList) {
      if (
        mutation.type === "attributes" &&
        mutation.attributeName === "class"
      ) {
        if (targetNode.classList.contains("active")) {
          backButton.classList.add("active");
        } else {
          backButton.classList.remove("active");
        }
      }
    }
  };

  // Create an observer instance linked to the callback function
  const observer = new MutationObserver(callback);

  // Start observing the target node for configured mutations
  observer.observe(targetNode, { attributes: true });
}

if (document.querySelectorAll(".js-main-menu, .js-secondary-menu")) {
  document
    .querySelectorAll(".js-main-menu, .js-secondary-menu")
    .forEach((container) => {
      observeClassChanges(container);
    });
}

jQuery(document).ready(function ($) {
  if (typeof ScrollMagic !== "undefined") {
    if (!("sm_controller" in window)) {
      window.sm_controller = new ScrollMagic.Controller();
    }
    var services_block = document.querySelector(".block-services");
    var scrollable_block = document.querySelector(".block-services__body");
    if (services_block && scrollable_block) {
      var hws = window.innerWidth / 2;
      var scroll_length = scrollable_block.scrollWidth - window.innerWidth + 50;
      var scroll_height = window.innerHeight + scroll_length;
      services_block.style.height = scroll_height + "px";

      function shift_slider() {
        var top = services_block.getBoundingClientRect().top;
        var shift = Math.round(top);
        var hl = window.innerHeight - hws;
        var ll = -scroll_height + hws;
        if (shift > hl) {
          shift = hl;
        }
        if (shift < ll) {
          shift = ll;
        }
        scrollable_block.style.transform = "translate3d(" + shift + "px, 0, 0)";
      }

      function calc_slider() {
        scroll_length = scrollable_block.scrollWidth - window.innerWidth + 50;
        scroll_height = window.innerHeight + scroll_length;
        services_block.style.height = scroll_height + "px";
        shift_slider();
      }

      window.addEventListener("resize", function () {
        if (window.innerWidth > 991) {
          calc_slider();
          shift_slider();
        } else {
          $(services_block).attr("style", "");
          $(scrollable_block).attr("style", "");
        }
      });

      window.addEventListener("orientationchange", function () {
        if (window.innerWidth > 991) {
          calc_slider();
          shift_slider();
        } else {
          $(services_block).attr("style", "");
          $(scrollable_block).attr("style", "");
        }
      });

      document.addEventListener("scroll", function () {
        if (window.innerWidth > 991) {
          shift_slider();
        } else {
          $(services_block).attr("style", "");
          $(scrollable_block).attr("style", "");
        }
      });

      if (window.innerWidth > 991) {
        calc_slider();
        setTimeout(calc_slider, 500);
        shift_slider();
      } else {
        $(services_block).attr("style", "");
        $(scrollable_block).attr("style", "");
      }
    }
  }
});
