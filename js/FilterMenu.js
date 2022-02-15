(function ($) {
  // init Isotope
  console.log("init__________________________");
  var $grid = $(".products").isotope({
    // options
    itemSelector: ".menu-item",
  });
  // filter items on button click
  $("#burgers-button").on("click", () => {
    $grid.isotope({ filter: ".Burgers" });
  });

  $("#combos-button").on("click", () => {
    $grid.isotope({ filter: ".Combos" });
  });

  $("#wrap-button").on("click", () => {
    $grid.isotope({ filter: ".Wrap" });
  });

  $("#deserts-button").on("click", () => {
    $grid.isotope({ filter: ".Deserts" });
  });

  $("#sub-button").on("click", () => {
    $grid.isotope({ filter: ".Sub" });
  });

  $("#side-button").on("click", () => {
    $grid.isotope({ filter: ".Side" });
  });

  $("#drink-button").on("click", () => {
    $grid.isotope({ filter: ".Drink" });
  });

  $("#show-all").on("click", () => {
    $grid.isotope({ filter: "*" });
  });
})(jQuery);
