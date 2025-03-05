window.addEventListener("resize", function () {
  updateMoreContentPosition();
});

function updateMoreContentPosition() {
  var pageElement = document.querySelector(".content-page__page");
  var moreElement = document.querySelector(".content-page__more");
  if (pageElement) {
    var pageRect = pageElement.getBoundingClientRect();
    if (moreElement !== null) {
      moreElement.style.left = pageRect.left + pageRect.width + 29 + "px";
      moreElement.style.display = "block";
    }
  }
}

window.addEventListener("load", function () {
  updateMoreContentPosition();
});
