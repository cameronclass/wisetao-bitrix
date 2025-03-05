window.addEventListener("DOMContentLoaded", () => {
  let element = document.querySelector(
    ".bx-panel-toggle-off, .bx-panel-toggle-on"
  );
  if (element) {
    let url = new URL(element.getAttribute("href"), window.location.origin);
    let bitrixIncludeAreas = url.searchParams.get("bitrix_include_areas");
    // Удалить все параметры
    url.search = "";

    let pathname = url.pathname.replace(/\/bitrix_include_areas-[YN]\//g, "/");

    let newHref = pathname + "bitrix_include_areas-" + bitrixIncludeAreas + "/";
    element.setAttribute("href", newHref);
  }
});
