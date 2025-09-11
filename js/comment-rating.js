(function ($) {
  $(document).ready(function () {
    var $stars = $(".rating-stars .star");
    var $input = $("#rating");

    $stars.on("mouseenter", function () {
      var val = parseInt($(this).data("value"), 10);
      $stars.each(function () {
        var v = parseInt($(this).data("value"), 10);
        $(this).toggleClass("hover", v <= val);
      });
    });
    $(".rating-stars").on("mouseleave", function () {
      $(this).find(".star").removeClass("hover");
    });

    $stars.on("click", function () {
      var val = parseInt($(this).data("value"), 10);
      $input.val(val);
      $stars.each(function () {
        var v = parseInt($(this).data("value"), 10);
        $(this).toggleClass("active", v <= val);
      });
      $(".rating-stars").attr("data-selected", val);
    });

    // preset if form reloaded
    var preset = parseInt($input.val(), 10);
    if (preset > 0) {
      $stars.each(function () {
        var v = parseInt($(this).data("value"), 10);
        $(this).toggleClass("active", v <= preset);
      });
    }
  });
})(jQuery);
