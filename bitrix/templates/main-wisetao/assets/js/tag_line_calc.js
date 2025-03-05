document.fonts.ready.then(function () {
  calcLineTags();
});

function calcLineTags() {
  let inputSearch = document.querySelector(".blog-page__search");
  if (inputSearch.dataset.ajax_from_blog === "1") {
    inputSearch.dataset.ajax_from_blog = "0";
    let blogPage = document.querySelector(".blog-page");
    let blogPage__menu_more = document.querySelector(".blog-page__menu_more");
    let blogPage__menu_list = document.querySelector(".blog-page__menu_list");
    let blogPage__menu_more_link;
    let li;
    let blogPage__menu_listRect;
    let blogPageWidth = blogPage.offsetWidth - 34;
    let blogPage__menu_listWidth =
      blogPage__menu_list.getBoundingClientRect().width;
    let children = blogPage__menu_more.childNodes;
    let j = 2;
    for (let i = children.length - 1; i >= 2; i--) {
      blogPage__menu_more.insertBefore(
        children[children.length - 1],
        blogPage__menu_more.childNodes[j]
      );
      j++;
    }

    while (
      blogPageWidth > blogPage__menu_listWidth &&
      blogPage__menu_more.childElementCount > 1
    ) {
      blogPage__menu_more_link = blogPage__menu_more.lastElementChild;
      li = document.createElement("li");
      li.appendChild(blogPage__menu_more_link);
      blogPage__menu_list.appendChild(li);
      blogPage__menu_listRect = blogPage__menu_list.getBoundingClientRect();
      if (blogPageWidth < blogPage__menu_listRect.width) {
        blogPage__menu_more.insertBefore(
          blogPage__menu_more_link,
          blogPage__menu_more.lastChild
        );
        blogPage__menu_list.removeChild(blogPage__menu_list.lastElementChild);
        break;
      } else {
        blogPage__menu_more.removeChild(blogPage__menu_more.lastChild);
      }
    }

    if (blogPage__menu_more.childElementCount === 1) {
      document
        .querySelector(".blog-page__menu")
        .removeChild(document.querySelector(".blog-page__menu_more"));
    } else {
      children = blogPage__menu_more.childNodes;
      j = 2;
      for (let i = children.length - 1; i >= 2; i--) {
        blogPage__menu_more.insertBefore(
          children[children.length - 1],
          blogPage__menu_more.childNodes[j]
        );
        j++;
      }
    }
  }
}
