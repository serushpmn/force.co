// نمایش tooltip با کلیک روی لوگو (موبایل و دسکتاپ)
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll(".group-logos .logo-box .each-logo")
    .forEach(function (logo) {
      logo.addEventListener("click", function (e) {
        // اگر قبلا باز بوده، ببند
        if (logo.classList.contains("show-tooltip")) {
          logo.classList.remove("show-tooltip");
        } else {
          // همه تولتیپ‌های دیگر را ببند
          document
            .querySelectorAll(".group-logos .logo-box .each-logo.show-tooltip")
            .forEach(function (l) {
              l.classList.remove("show-tooltip");
            });
          logo.classList.add("show-tooltip");
        }
        e.stopPropagation();
      });
    });
  // بستن تولتیپ با کلیک بیرون
  document.addEventListener("click", function () {
    document
      .querySelectorAll(".group-logos .logo-box .each-logo.show-tooltip")
      .forEach(function (l) {
        l.classList.remove("show-tooltip");
      });
  });
});
