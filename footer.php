<!--  Footer -->
</div>
<button id="goToTopButton"><i class="fa fa-arrow-circle-up"></i></button>
<footer>
   <div class="container">
   <div class="footer-menu">
      <nav>
         <h3>ارتباط با ما</h3>
         <p>آدرس: <a href="#"><?php echo get_option('address')?></a></p>
         <p>تلفن: 
            <a href="tel:<?php echo get_option('phone_number')?>"  ><?php echo get_option('phone_number')?></a>
         </p>
         <p>  ایمیل: <a href="mailto:<?php echo get_option('email')?>"
            ><?php echo get_option('email')?></a></p>
         <div class="social-icons">
            <a href="<?php echo get_option('whatsapp')?>" ><i class="fa fa-whatsapp"></i></a>
            <a href="<?php echo get_option('instagram')?>" ><i class="fa fa-instagram"></i></a>
            <a href="<?php echo get_option('telegram')?>" ><i class="fa fa-telegram"></i></a>
            <a href="<?php echo get_option('aparat')?>" >
               <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <title>Aparat</title>
                  <path d="M12.0014 1.5938C2.7317 1.5906-1.9119 12.7965 4.641 19.3515c2.975 2.976 7.4496 3.8669 11.3374 2.257 3.8877-1.61 6.4228-5.4036 6.4228-9.6116 0-5.7441-4.6555-10.4012-10.3997-10.4031zM6.11 6.783c.5011-2.5982 3.8927-3.2936 5.376-1.1028 1.4834 2.1907-.4216 5.0816-3.02 4.5822-1.6118-.3098-2.6668-1.868-2.356-3.4794zm4.322 8.9882c-.5045 2.5971-3.8965 3.288-5.377 1.0959-1.4807-2.1922.427-5.0807 3.0247-4.5789 1.612.3114 2.6655 1.8714 2.3524 3.483zm1.2605-2.405c-1.1528-.2231-1.4625-1.7273-.4917-2.3877.9708-.6604 2.256.18 2.0401 1.3343-.1347.7198-.8294 1.1924-1.5484 1.0533zm6.197 3.8375c-.501 2.5981-3.8927 3.2935-5.376 1.1028-1.4834-2.1908.4217-5.0817 3.0201-4.5822 1.6117.3097 2.6667 1.8679 2.356 3.4794zm-1.9662-5.5018c-2.5981-.501-3.2935-3.8962-1.1027-5.3795 2.1907-1.4834 5.0816.4216 4.5822 3.02-.3082 1.6132-1.8668 2.6701-3.4795 2.3595zm-2.3348 11.5618l2.2646.611c1.9827.5263 4.0167-.6542 4.5433-2.6368l.639-2.4016a11.3828 11.3828 0 0 1-7.4469 4.4274zM21.232 3.5985l-2.363-.6284a11.3757 11.3757 0 0 1 4.3538 7.619l.6495-2.4578c.5194-1.9804-.6615-4.0076-2.6403-4.5328zM.6713 13.8086l-.5407 2.04c-.5263 1.9826.6542 4.0166 2.6368 4.5432l2.1066.5618a11.3792 11.3792 0 0 1-4.2027-7.145zM10.3583.702L8.1498.1261C6.166-.4024 4.1296.7785 3.603 2.763l-.5512 2.082A11.3757 11.3757 0 0 1 10.3583.702Z"></path>
               </svg>
            </a>
         </div>
      </nav>
      <nav>
         <div class="widget-icon">
            <a href="#"><i class="fa fa-file-text"></i>فاکتور رسمی</a>
            <a href="#"><i class="fa fa-plane"></i>ساخت و ارسال سریع</a>
            <a href="#"><i class="fa fa-check"></i>ضمانت کالا </a>
            <a href="#"><i class="fa fa-briefcase "></i>پرداخت اعتباری</a>
         </div>
      </nav>
      <nav class="footer-links">
        
            <h3>لینک</h3>
       
         <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
      </nav>
      <nav class="contact-form">
         <?php
            // Output the Contact Form 7 shortcode
            echo do_shortcode('[contact-form-7 id="8395370" title="فرم تماس - فوتر"]');
            echo do_shortcode('[contact-form-7 id="507657a" title="فرم تماس - فوتر 2"]');
            ?>
            <span>به جمع مشتریان فرس بپیوندید</span>
      </nav>
   </div>
   <div class="copy-right">
      <p>All rights reserved. Force co ©2023</p>
   </div>

</footer>
<div class="call-button">
   <a href="tel:<?php echo get_option('phone_number')?>">تماس با ما</a>
</div>
<div class="call-button-large">
   <div class="floating-container">
      <div class="floating-button">تماس با ما</div>
      <div class="element-container">
         <a href="tel:<?php echo get_option('phone_number')?>">
         <span class="float-element tooltip-left">
         <i class="fa fa-phone"></i>
         </span>
         </a>
         <a href="mailto:<?php echo get_option('email')?>"
            >
         <span class="float-element">
         <i class="fa fa-envelope"></i>
         </span>
         </a>
         <a href="https://force.co.ir/contact-us">
         <span class="float-element">
         <i class="fa fa-map-marker"></i>
         </span>
         </a>
      </div>
   </div>
</div>



<!-- Initialize Swiper -->
<script>
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
</script>
<script>
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
          window.addEventListener('scroll', function() {
            var button = document.getElementById('goToTopButton');
            if (window.pageYOffset > 0) {
              button.style.display = 'block';
              console.log('ok');
            } else {
              button.style.display = 'none';
            }
          });

          document.getElementById('goToTopButton').addEventListener('click', function() {
            window.scrollTo({
              top: 0,
              behavior: 'smooth'
            });
          });
 document.addEventListener('DOMContentLoaded', function() {
    const openMenuButton = document.querySelector('.mobile-menu-open');
    const closeMenuButton = document.querySelector('.mobile-menu-close');
    const menuContainer = document.querySelector('#mobile-menu-container');
    const menuOverlay = document.querySelector('.mobile-menu-overlay');

    if (openMenuButton && menuContainer) {
        // باز کردن منو با کلیک روی دکمه همبرگر
        openMenuButton.addEventListener('click', function() {
            menuContainer.classList.add('is-open');
            document.body.style.overflow = 'hidden'; // جلوگیری از اسکرول صفحه
        });
    }

    function closeMenu() {
        menuContainer.classList.remove('is-open');
        document.body.style.overflow = ''; // فعال کردن مجدد اسکرول
    }

    if (closeMenuButton) {
        // بستن منو با کلیک روی دکمه ضربدر
        closeMenuButton.addEventListener('click', closeMenu);
    }

    if (menuOverlay) {
        // بستن منو با کلیک روی پس‌زمینه نیمه‌شفاف
        menuOverlay.addEventListener('click', closeMenu);
    }
});
   
       document.getElementById('openFormButton').addEventListener('click', function() {
       document.getElementById('popupFormContainer').style.display = 'block';
     });
   
     document.getElementById('openFormButton').addEventListener('click', function() {
       document.getElementById('popupFormContainer').style.display = 'block';
     });
   
     document.getElementById('popupFormContainer').addEventListener('click', function(e) {
       if (e.target === this) {
         document.getElementById('popupFormContainer').style.display = 'none';
       }
     });
   
       var inputs = document.querySelectorAll('input[type="text"]');
       inputs.forEach(function(input) {
         input.addEventListener('focus', function() {
           const h1Title = document.querySelector('h1').textContent;
           var targetInput = document.querySelector('input[name="text-334"]');
           
           targetInput.value = h1Title;
           // targetInput.disabled = true;
         });
       });
     
</script>
<?php wp_footer(); ?>
</body>
</html>