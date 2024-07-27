$("#sidebar-toggle").click(function () {
  document.cookie = `slider-collapsed=${$("body")[0].classList.contains("closed") ? "0" : "1"}; path=/`;
  $("body")[0].classList.toggle("closed");
});