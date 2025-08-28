<?php 
/*
Template Name: Contact-Us
*/

get_header(); ?>
      <main>
        
        <!-- Hero -->
        <div class="hero-single">
          <div class="round-circle"></div>
          <div class="hero-img">
            <img src="<?php echo get_template_directory_uri();?>/img/bg-low-size.jpg" alt="شرکت فیلتراسین فرس" />
          </div>

          <h1 class="brand-title">
          <?php the_title(); ?>
           </h1>
        </div>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="single-article">
          <div class="container-content">
          <div class="about-us-single-contents">
              
          <div class="contact-us-content">
                      <div class="contact-us-info">
                        <div class="each-contact-info">
                          <i class="fa fa-phone"></i><span>شماره تماس: </span><a href="tel:<?php echo get_option('phone_number')?>"  ><?php echo get_option('phone_number')?></a>
                        </div>
                        <div class="each-contact-info">
                          <i class="fa fa-envelope"></i><span>ایمیل: </span><a href="mailto:<?php echo get_option('email')?>"
                            ><?php echo get_option('email')?></a>
                        </div>
                        <div class="each-contact-info">
                          <i class="fa fa-map-marker"></i><span>آدرس: </span><a href="#"><?php echo get_option('address')?></a>
                        </div>
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
                      </div>
                      <div class="maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3391.1454963376104!2d54.21907502143631!3d31.79378442154235!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fa605a7490d9ebd%3A0x217f9ecbd0964c3!2z2b7bjNi02q_Yp9mFINuM2LLYryDYtdmG2LnYqiDZgdix2LMg2KrZgdiq!5e0!3m2!1sen!2s!4v1695382436828!5m2!1sen!2s" width="100%" height="100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                           </div>
              
                    </div>
                        </div>
                            <?php endwhile; else : ?>
                                <p><?php esc_html_e( 'متاسفیم' ); ?></p>
                                <?php endif; ?>
          </section>
      </main>
      <?php get_footer(); ?>
      