$(document).ready(function () {
  $("#page-preloader").fadeOut(1e3),
    AOS.init({ once: !0, anchorPlacement: "bottom-bottom", duration: 800 }),
    onElementHeightChange(document.body, function () {
      AOS.refresh();
    });
});
