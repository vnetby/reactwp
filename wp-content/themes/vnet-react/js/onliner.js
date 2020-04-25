"use strict";
function toggleMenu() {
  $("body").hasClass("body_state-header-style_opened") ? $("body").removeClass("body_state-header-style_opened") : $("body").addClass("body_state-header-style_opened")
}
$(".js-menu-hamburger").on("click", toggleMenu),
  $(document).on("click", function (e) {
    var n = $(".header-style__aside");
    !n.is(e.target) && 0 === n.has(e.target).length && $("body").hasClass("body_state-header-style_opened") && $("body").removeClass("body_state-header-style_opened")
  });