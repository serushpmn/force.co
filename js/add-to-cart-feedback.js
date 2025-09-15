document.addEventListener("DOMContentLoaded", function () {
  // فقط در صفحات محصول ووکامرس
  if (!document.body.classList.contains("single-product")) return;

  // رویداد ووکامرس پس از افزودن به سبد خرید (ajax)
  jQuery(document.body).on("added_to_cart", function (event, fragments, cart_hash, $button) {
    var btn = document.querySelector(".single_add_to_cart_button");
    if (!btn) return;

    // دکمه را مخفی کن
    btn.style.display = "none";

    // پیام موفقیت و دکمه مشاهده سبد خرید
    var cartUrl = "/cart";
    var msg = document.createElement("div");
    msg.className = "add-to-cart-success-msg";
    msg.innerHTML = `
      <span>محصول به سبد خرید شما افزوده شد.</span>
      <a href="${cartUrl}" class="view-cart-btn" style="margin-right:12px;">مشاهده سبد خرید</a>
    `;

    // اگر قبلا پیام وجود دارد حذف کن
    var oldMsg = btn.parentNode.querySelector(".add-to-cart-success-msg");
    if (oldMsg) oldMsg.remove();

    // پیام را بعد از دکمه قرار بده
    btn.parentNode.appendChild(msg);
  });
});
    wrapper.appendChild(msg);
  });
});
