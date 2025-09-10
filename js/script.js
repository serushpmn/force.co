var swiper = new Swiper(".govahinameh", {
  slidesPerView: 4,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 2500,
  },
  breakpoints: {
    350: {
      slidesPerView: 3,
      spaceBetween: 5,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
});
var swiper = new Swiper(".hero-slider", {
  slidesPerView: 1,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 2500,
  },
});
var swiper = new Swiper(".myMaghale", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 3000,
  },
  breakpoints: {
    350: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 50,
    },
  },
});
var swiper = new Swiper(".myakhbar", {
  slidesPerView: 3,
  spaceBetween: 15,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 3000,
  },
  breakpoints: {
    350: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
  },
});
var swiper = new Swiper(".mylogos", {
  slidesPerView: 1,
  spaceBetween: 15,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 5000,
  },
});
window.addEventListener("scroll", function () {
  var button = document.getElementById("goToTopButton");
  if (window.pageYOffset > 0) {
    button.style.display = "block";
    console.log("ok");
  } else {
    button.style.display = "none";
  }
});

document.getElementById("goToTopButton").addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const openMenuButton = document.querySelector(".mobile-menu-open");
  const closeMenuButton = document.querySelector(".mobile-menu-close");
  const menuContainer = document.querySelector("#mobile-menu-container");
  const menuOverlay = document.querySelector(".mobile-menu-overlay");

  if (openMenuButton && menuContainer) {
    // باز کردن منو با کلیک روی دکمه همبرگر
    openMenuButton.addEventListener("click", function () {
      menuContainer.classList.add("is-open");
      document.body.style.overflow = "hidden"; // جلوگیری از اسکرول صفحه
    });
  }

  function closeMenu() {
    menuContainer.classList.remove("is-open");
    document.body.style.overflow = ""; // فعال کردن مجدد اسکرول
  }

  if (closeMenuButton) {
    // بستن منو با کلیک روی دکمه ضربدر
    closeMenuButton.addEventListener("click", closeMenu);
  }

  if (menuOverlay) {
    // بستن منو با کلیک روی پس‌زمینه نیمه‌شفاف
    menuOverlay.addEventListener("click", closeMenu);
  }
});

document
  .getElementById("openFormButton")
  .addEventListener("click", function () {
    document.getElementById("popupFormContainer").style.display = "block";
  });

document
  .getElementById("openFormButton")
  .addEventListener("click", function () {
    document.getElementById("popupFormContainer").style.display = "block";
  });

document
  .getElementById("popupFormContainer")
  .addEventListener("click", function (e) {
    if (e.target === this) {
      document.getElementById("popupFormContainer").style.display = "none";
    }
  });

var inputs = document.querySelectorAll('input[type="text"]');
inputs.forEach(function (input) {
  input.addEventListener("focus", function () {
    const h1Title = document.querySelector("h1").textContent;
    var targetInput = document.querySelector('input[name="text-334"]');

    targetInput.value = h1Title;
    // targetInput.disabled = true;
  });
});

// Theme initialization and toggle moved to `js/theme-toggle.js` to avoid
// duplicate/conflicting handlers. See that file for theme logic.
