// Enable click on + and - pseudo-buttons in WooCommerce quantity-control
document.addEventListener("DOMContentLoaded", function () {
  // Function to handle quantity button clicks
  function handleQuantityButtons(container) {
    const input = container.querySelector(".input-text.qty");
    if (!input) return;

    // Create and append plus/minus buttons if they don't exist
    if (!container.querySelector(".quantity-minus")) {
      const minusBtn = document.createElement("button");
      minusBtn.type = "button";
      minusBtn.className = "quantity-minus";
      minusBtn.innerText = "-";
      container.prepend(minusBtn);

      minusBtn.addEventListener("click", function () {
        const currentValue = parseInt(input.value, 10);
        const minValue = parseInt(input.min, 10) || 1;
        if (currentValue > minValue) {
          input.value = currentValue - 1;
          input.dispatchEvent(new Event("change", { bubbles: true }));
        }
      });
    }

    if (!container.querySelector(".quantity-plus")) {
      const plusBtn = document.createElement("button");
      plusBtn.type = "button";
      plusBtn.className = "quantity-plus";
      plusBtn.innerText = "+";
      container.append(plusBtn);

      plusBtn.addEventListener("click", function () {
        const currentValue = parseInt(input.value, 10);
        const maxValue = parseInt(input.max, 10) || 999;
        if (currentValue < maxValue) {
          input.value = currentValue + 1;
          input.dispatchEvent(new Event("change", { bubbles: true }));
        }
      });
    }
  }

  // Apply to cart page quantity controls
  const cartQuantityContainers = document.querySelectorAll(
    ".cart-items .quantity"
  );
  cartQuantityContainers.forEach(handleQuantityButtons);

  // Apply to single product page quantity controls (including mobile footer)
  const productQuantityContainers = document.querySelectorAll(
    ".single-product .quantity"
  );
  productQuantityContainers.forEach(handleQuantityButtons);

  // --- Logic for enabling/disabling the update cart button ---
  const updateCartButton = document.querySelector('button[name="update_cart"]');
  if (updateCartButton) {
    // Listen for changes on quantity inputs within the cart form
    const cartForm = document.querySelector(".woocommerce-cart-form");
    if (cartForm) {
      cartForm.addEventListener("change", function (event) {
        if (
          event.target.classList.contains("input-text") &&
          event.target.classList.contains("qty")
        ) {
          updateCartButton.disabled = false;
        }
      });
    }
  }
});
const govahinamehSwiper = new Swiper(".govahinameh", {
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
const heroSwiper = new Swiper(".hero-slider", {
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
var swiper = new Swiper(".kasbokar-slider", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".kasbokar-next",
    prevEl: ".kasbokar-prev",
  },
  breakpoints: {
    350: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
    1200: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },
  on: {
    reachEnd: function () {
      this.slideToLoop(0, 0, false);
    },
  },
});
const maghaleSwiper = new Swiper(".myMaghale", {
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
const akhbarSwiper = new Swiper(".myakhbar", {
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
const logosSwiper = new Swiper(".mylogos", {
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
  const banner = document.getElementById("top-site-banner");
  const closeBtn = document.querySelector(".close-banner-btn");

  if (banner && closeBtn) {
    closeBtn.addEventListener("click", function () {
      banner.style.display = "none";
    });
  }
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

var openFormBtn = document.getElementById("openFormButton");
if (openFormBtn) {
  openFormBtn.addEventListener("click", function () {
    var popupForm = document.getElementById("popupFormContainer");
    if (popupForm) {
      popupForm.style.display = "block";
    }
  });
}

var popupFormContainer = document.getElementById("popupFormContainer");
if (popupFormContainer) {
  popupFormContainer.addEventListener("click", function (e) {
    if (e.target === this) {
      popupFormContainer.style.display = "none";
    }
  });
}

var inputs = document.querySelectorAll('input[type="text"]');
inputs.forEach(function (input) {
  input.addEventListener("focus", function () {
    const h1Title = document.querySelector("h1").textContent;
    var targetInput = document.querySelector('input[name="text-334"]');
    targetInput.value = h1Title;
    // targetInput.disabled = true;
  });
});
