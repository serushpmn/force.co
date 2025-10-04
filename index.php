<?php get_header(); ?>
<!-- Hero  -->

<main>
   <div class="slider">
   <?php if( have_rows('hero_slider', 'option') ): // ✅ کلمه 'option' اضافه شد ?>

    <div class="swiper hero-slider">
        <div class="swiper-wrapper">

            <?php while( have_rows('hero_slider', 'option') ): the_row(); // ✅ کلمه 'option' اضافه شد
                // دریافت مقادیر فیلدهای فرزند
                $image = get_sub_field('slide_image'); // اینجا نیازی به 'option' نیست چون داخل حلقه هستیم
                $title = get_sub_field('slide_title');
                $link = get_sub_field('slide_link');
            ?>
                <div class="swiper-slide">
                    <?php if ($link): ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php if ($title): ?><h2 class="slide-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                    <?php if ($link): ?></a><?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>
   </div>

 <!-- kasbokar  Slider-->
   <section class="kasbokar-home" id="kasbokar">
      <div class="container-content">
         <h3 class="home-title">حوزه کسب و کار</h3>
         <!-- <div class="kasbokar-rect"></div> -->
         <div class="swiper kasbokar-slider">
            <div class="swiper-wrapper">
              <?php $the_query = new WP_Query([
              "post_type" => "kasbokar",
              "posts_per_page" => 8,
            ]); ?>
            <?php if ($the_query->have_posts()): ?>
            <?php while ($the_query->have_posts()):
              $the_query->the_post(); ?>
               <div class="swiper-slide each-kasbokar">
                  <div class="kasbokar-circle">
                     <a href="<?php echo esc_url(get_the_permalink()); ?>">
                        <div class="circle">
                           <?php the_post_thumbnail(); ?>
                        </div>
                     </a>
                     <span>
                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                           <?php the_title(); ?>
                        </a>
                     </span>
                  </div>
               </div>
               <?php endwhile; wp_reset_postdata(); ?>
               <?php else: ?>
               <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
               <?php endif; ?>
            </div>
            <!-- دکمه‌های ناوبری را با کلاس یکتا قرار دهید و خارج از .swiper-wrapper باشند -->
           <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
            
 
   <!-- Products  -->
   <section class="maghalat">
      <div class="container-content">
         <div class="top-section">
            <h3 class="home-title">محصولات</h3>
            <a href="https://force.co.ir/shop/" class="btn-orange">همه محصولات<i class="fa fa-chevron-circle-left"></i></a>
         </div>
         <div class="swiper myMaghale">
            <div class="swiper-wrapper">
               <?php $the_query = new WP_Query([
                 "post_type" => "product",
                 "posts_per_page" => "100",
               ]); ?>
               <?php if ($the_query->have_posts()): ?>
               <?php while ($the_query->have_posts()):
                 $the_query->the_post(); ?>
               <div class="swiper-slide each-maghale">
                  <div class="each-maghale-img">
                     <a href="<?php the_permalink(); ?>">
                         <?php // نمایش بج درصد تخفیف فقط اگر محصول موجود و تخفیف‌دار باشد
                         if (
                           $product->get_stock_status() === "instock" &&
                           $product->is_on_sale()
                         ) {
                           $regular_price = (float) $product->get_regular_price();
                           $sale_price = (float) $product->get_sale_price();
                           if (
                             $regular_price > 0 &&
                             $sale_price > 0 &&
                             $regular_price > $sale_price
                           ) {
                             $discount_percent = round(
                               (($regular_price - $sale_price) /
                                 $regular_price) *
                                 100,
                             );
                             echo '<span class="discount-badge">' .
                               $discount_percent .
                               "% تخفیف</span>";
                           }
                         } ?>
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink(); ?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <?php if ($product->get_stock_status() === "instock"): ?>
                  <span class="prd-price"><?php echo wc_get_product(
                    $post->ID,
                  )->get_price_html(); ?></span>
                  <?php endif; ?>
                  <a href="<?php the_permalink(); ?>" class="btn-white">خرید<i class="fa fa-shopping-cart"></i></a>
               </div>
               <?php
               endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else: ?>
               <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
               <?php endif; ?>
            </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>

    <!-- Special Products  -->
   <section class="maghalat special-products">
     <div class="container-content">
       <div class="top-section">
         <h3 class="home-title">پیشنهادهای ویژه</h3>
         <a href="https://force.co.ir/product-category/special/" class="btn-orange">همه پیشنهادهای ویژه<i class="fa fa-chevron-circle-left"></i></a>
       </div>
       <div class="swiper myMaghale">
         <div class="swiper-wrapper">
           <?php
           $the_query = new WP_Query([
             "post_type" => "product",
             "posts_per_page" => 100,
             "tax_query" => [
               [
                 "taxonomy" => "product_cat",
                 "field"    => "slug",
                 "terms"    => "special",
               ],
             ],
           ]);
           ?>
           <?php if ($the_query->have_posts()): ?>
             <?php while ($the_query->have_posts()): $the_query->the_post(); global $product; ?>
               <div class="swiper-slide each-maghale">
                 <div class="each-maghale-img">
                   <a href="<?php the_permalink(); ?>">
                     <?php
                     // نمایش بج درصد تخفیف فقط اگر محصول موجود و تخفیف‌دار باشد
                     if (
                       $product->get_stock_status() === "instock" &&
                       $product->is_on_sale()
                     ) {
                       $regular_price = (float) $product->get_regular_price();
                       $sale_price = (float) $product->get_sale_price();
                       if (
                         $regular_price > 0 &&
                         $sale_price > 0 &&
                         $regular_price > $sale_price
                       ) {
                         $discount_percent = round(
                           (($regular_price - $sale_price) / $regular_price) * 100
                         );
                         echo '<span class="discount-badge">' .
                           $discount_percent .
                           "% تخفیف</span>";
                       }
                     }
                     ?>
                     <?php the_post_thumbnail(); ?>
                   </a>
                 </div>
                 <a href="<?php the_permalink(); ?>">
                   <h3 class="maghale-title"><?php the_title(); ?></h3>
                 </a>
                 <?php if ($product->get_stock_status() === "instock"): ?>
                   <span class="prd-price"><?php echo wc_get_product($post->ID)->get_price_html(); ?></span>
                 <?php endif; ?>
                 <a href="<?php the_permalink(); ?>" class="btn-white">خرید<i class="fa fa-shopping-cart"></i></a>
               </div>
             <?php endwhile; wp_reset_postdata(); ?>
           <?php else: ?>
             <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
           <?php endif; ?>
         </div>
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
       </div>
     </div>
   </section>
     <!--  Comments -->
   <section class="comments-home">
      <div class="container-content">
      <h3 class="home-title">همراهانی که به ما اعتماد کردند</h3>
      <div class="comments-rect">
         <div class="swiper mylogos partner-brands">
            <div class="swiper-wrapper">
                <div class="swiper-slide group-logos">
                  <h2>شرکت های راه سازی و عمرانی</h2>
                        <div class="logo-box">
                           <?php $the_query = new WP_Query([
                               "post_type" => "logo",
                               "category_name" => "شرکت-های-راه-سازی-و-عمرانی",
                               "posts_per_page" => "10",
                           ]); ?>
                           <?php if ($the_query->have_posts()): ?>
                           <?php while ($the_query->have_posts()):
                               $the_query->the_post(); ?>
                           <div class="each-logo logo-clickable" 
                                data-company="<?php echo esc_attr(get_the_title()); ?>"
                                data-content="<?php echo esc_attr(get_the_content()); ?>"
                                data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                              <?php the_post_thumbnail(); ?>
                              <span class="logo-tooltip"><?php the_title(); ?></span>
                           </div>
                           <?php endwhile; ?>
                           <?php wp_reset_postdata(); ?>
                           <?php else: ?>
                           <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="comment-box" id="comment-box-1">
                           <img src="<?php echo get_template_directory_uri(); ?>/img/logos/قرارگاه-خاتم.jpg" alt="" class="ceo-comment-logo" id="comment-img-1"/>
                           <div class="ceo-comment">
                              <h3 id="comment-title-1">
                                 جواد نوری <span>-</span>
                                 <span>قرار گاه سازندگی خاتم الانبیا</span>
                              </h3>
                              <p id="comment-text-1">
                                 با احترام بدینوسیله مراتب رضایت این موسسه از عملکرد دستگاه فیلتراسیون روغن ساخت ان شرکت جهت تصفیه اب و ذرات موجود در روغن های هیدرولیک کارگاه الیگودرز اعلام میگردد .
                              فیلتراسیون این روغن ها صرفه اقتصادی مناسبی را برای این موسسه در برداشته است .امید است تلاش ان مجموعه فنی همواره مورد رضایت خداوند متعال بوده وشاهد موفقیت های روز افزون ان شرکت باشیم .ضمنا از زحمات و تلاش های بی وقفه مدیریت وکادر فنی ان شرکت محترم تشکر و قدر دانی می نماید.
                              </p>
                           </div>
                        </div>
                  </div>
                <div class="swiper-slide group-logos">
                        <h2>صنعت برق</h2>
                        <div class="logo-box">
                           <?php $the_query = new WP_Query([
                               "post_type" => "logo",
                               "category_name" => "صنعت-برق",
                               "posts_per_page" => "10",
                           ]); ?>
                           <?php if ($the_query->have_posts()): ?>
                           <?php while ($the_query->have_posts()):
                               $the_query->the_post(); ?>
                           <div class="each-logo logo-clickable" 
                                data-company="<?php echo esc_attr(get_the_title()); ?>"
                                data-content="<?php echo esc_attr(get_the_content()); ?>"
                                data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                              <?php the_post_thumbnail(); ?>
                              <span class="logo-tooltip"><?php the_title(); ?></span>
                           </div>
                           <?php endwhile; ?>
                           <?php wp_reset_postdata(); ?>
                           <?php else: ?>
                           <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="comment-box" id="comment-box-2">
                           <img src="<?php echo get_template_directory_uri(); ?>/img/logos/نیروگاه-رجائی.jpg" alt="" class="ceo-comment-logo" id="comment-img-2"/>
                           <div class="ceo-comment">
                              <h3 id="comment-title-2">
                              عبدالعظیم محمد نیازی
                                 <span>-</span>
                                 <span>شرکت تولید برق شهید رجایی</span>
                              </h3>
                              <p id="comment-text-2">
                              با احترام بدینوسیله مراتب رضایت این شرکت از عملکرد دستگاه فیلتراسیون روغن ساخت شرکت فرس جهت تصفیه آب و ذرات موجود در روغنهای این نیروگاه اعلام می‌گردد.
                              </p>
                           </div>
                     </div>
                  </div>
                  <div class="swiper-slide group-logos">
                     <h2> نفت و گاز و پتروشیمی</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "نفت-و-گاز-و-پتروشیمی",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box" id="comment-box-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logos/پتروشیمی-اصفهان.jpg" alt="" class="ceo-comment-logo" id="comment-img-3"/>
                        <div class="ceo-comment">
                           <h3 id="comment-title-3">
                           علی مستاجران<span>-</span>
                              <span>پتروشیمی اصفهان</span>
                           </h3>
                           <p id="comment-text-3">بدینوسیله تایید می گردد شرکت پیشگام صنعت فرس میزان هفتاد هزار لیتر روغن حرارتی واحد انیدرید فتالیک پتروشیمی اصفهان را به نحو مناسب تصفیه (اب زدایی) نموده است.   </p>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide group-logos">
                     <h2>صنعت فولاد</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "صنعت-فولاد",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box" id="comment-box-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logos/فولاد-نطنز.jpg" alt="" class="ceo-comment-logo" id="comment-img-4"/>
                        <div class="ceo-comment">
                           <h3 id="comment-title-4">
                           علیرضا توکلی طرقی <span>-</span>
                              <span>شرکت صنایع فولاد نطنز</span>
                           </h3>
                           <p id="comment-text-4">احتراما بدینوسیله صحت عملکرد یونیت تصفیه روغن سری FT که صرفه جویی اقتصادی قابل توجهی را به همراه داشته اعلام و از زحمات و تلاش بی وقفه مدیریت و کلیه متخصصین ان شرکت تشکر و قدر دانی میگردد. </p>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide group-logos">
                     <h2>صنعت کاشی</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "صنعت-کاشی",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box" id="comment-box-5">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logos/نوین-سرام-یزد.jpg" alt="" class="ceo-comment-logo" id="comment-img-5"/>
                        <div class="ceo-comment">
                           <h3 id="comment-title-5">
                           مدیریت بازرگانی<span>-</span>
                              <span>کاشی نوین سرام یزد</span>
                           </h3>
                           <p id="comment-text-5">احتراماً به استخضار می‌رساند که دستگاه تصفیه روغن کد FL50 که از شرکت فرس خریداری شده مورد تأیید این شرکت می‌باشد.
                           مراتب جهت اطلاع خدمتتان ارسال می‌گردد.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide group-logos">
                     <h2>صنعت معدن و سیمان</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "صنعت-معدن-و-سیمان",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     
                  </div>
                  <div class="swiper-slide group-logos">
                     <h2>کشتی رانی و بندر</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "کشتی-رانی-و-بندر",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box" id="comment-box-7">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logos/آریا-بنادر-ایرانیان.jpg" alt="" class="ceo-comment-logo" id="comment-img-7"/>
                        <div class="ceo-comment">
                           <h3 id="comment-title-7">
                           صفدر تاجیک<span>-</span>
                              <span>شرکت آریا بنادر ایرانیان </span>
                           </h3>
                           <p id="comment-text-7">احتراماً با بررسی به عمل آمده از دستگاه فیلتراسیون سوخت، خریداری شده از شرکت فرس، به عرض می‌رساند: در طول مدت بهره‌برداری این دستگاه،  از کیفیت و کارائی قابل قبولی برخوردار بوده به نحوی که استفاده از آن سبب افزایش طول عمر سیستم های سوخت و همچنین کاهش هزینه ا و تعمیرات را در پی داشته است.  </p>
                        </div>
                     </div>
                  </div>
                  
                  <div class="swiper-slide group-logos">
                     <h2>دیگر صنایع</h2>
                     <div class="logo-box">
                        <?php $the_query = new WP_Query([
                            "post_type" => "logo",
                            "category_name" => "دیگر-صنایع",
                            "posts_per_page" => "10",
                        ]); ?>
                        <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()):
                            $the_query->the_post(); ?>
                        <div class="each-logo logo-clickable" 
                             data-company="<?php echo esc_attr(get_the_title()); ?>"
                             data-content="<?php echo esc_attr(get_the_content()); ?>"
                             data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box" id="comment-box-8">
                        <div class="ceo-comment">
                           <h3 id="comment-title-8">
                           حسین ازادواری
                              <span>-</span>
                              <span>سازمان خدمات موتوری</span>
                           </h3>
                           <p id="comment-text-8">
                           ضمن اعلام رضایت از عملکرد دستگاه تصفیه گازوئیل ساخت  ان شرکت محترم خواهشمند است مراتب رضایت این سازمان را به کلیه همکاران تلاشگر تان اعلام فرمایید. از خداوند منان موفقیت روز افزون برای شما آرزومندیم.
                           </p>
                        </div>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </section>
 <!-- Govahinameh  -->
   <section class="govahiname">
      <div class="govahiname-bg"></div>
      <div class="container-content">
         <h3 class="home-title">تاییدیه و گواهی‌نامه‌ها</h3>
         <div class="swiper govahinameh">
            <div class="swiper-wrapper">
               <?php $the_query = new WP_Query([
                 "post_type" => "certificate",
                 "posts_per_page" => "10",
               ]); ?>
               <?php if ($the_query->have_posts()): ?>
               <?php while ($the_query->have_posts()):
                 $the_query->the_post(); ?>
               <div class="swiper-slide each-govahiname">
                  <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail(); ?>
                  </a>
               </div>
               <?php
               endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else: ?>
               <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
               <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
   <!-- Maghalat  -->
   <section class="maghalat">
      <div class="container-content">
         <div class="top-section">
            <h3 class="home-title">مقالات</h3>
            <a href="https://force.co.ir/category/articles/" class="btn-orange">همه مقالات<i class="fa fa-chevron-circle-left"></i></a>
         </div>
         <div class="swiper myMaghale">
            <div class="swiper-wrapper">
               <?php $the_query = new WP_Query([
                 "post_type" => "post",
                 "category_name" => "articles",
                 "posts_per_page" => "20",
               ]); ?>
               <?php if ($the_query->have_posts()): ?>
               <?php while ($the_query->have_posts()):
                 $the_query->the_post(); ?>
               <div class="swiper-slide each-maghale">
                  <div class="each-maghale-img">
                     <div class="sample-image">
                        <a href="<?php the_permalink(); ?>">
                     </div>
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink(); ?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="btn-white">ادامه مطلب <i class="fa fa-arrow-circle-left"></i></a>
               </div>
               <?php
               endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else: ?>
               <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
               <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
   <!--  Akhbar -->
   <section class="akhbar">
      <div class="container-content">
         <div class="top-section">
            <h3 class="home-title">اخبار</h3>
            <a href="https://force.co.ir/category/news/" class="btn-orange">همه اخبار<i class="fa fa-chevron-circle-left"></i></a>
         </div>
         <div class="swiper myakhbar">
            <div class="swiper-wrapper">
               <?php $the_query = new WP_Query([
                 "post_type" => "post",
                 "category_name" => "news",
                 "posts_per_page" => "20",
               ]); ?>
               <?php if ($the_query->have_posts()): ?>
               <?php while ($the_query->have_posts()):
                 $the_query->the_post(); ?>
               <div class="swiper-slide each-akhbar">
                  <div class="each-akhbar-img">
                     <a href="<?php the_permalink(); ?>">
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink(); ?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="btn-white">ادامه مطلب <i class="fa fa-arrow-circle-left"></i></a>
               </div>
               <?php
               endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else: ?>
               <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
               <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
   <script>
   document.addEventListener('DOMContentLoaded', function() {
      // گرفتن تمام لوگوهای کلیک‌پذیر
      const clickableLogos = document.querySelectorAll('.logo-clickable');
      
      clickableLogos.forEach(function(logo) {
         logo.style.cursor = 'pointer';
         
         logo.addEventListener('click', function() {
            const company = this.getAttribute('data-company');
            const content = this.getAttribute('data-content');
            const image = this.getAttribute('data-image');
            
            // پیدا کردن باکس کامنت مربوط به این اسلاید
            const slide = this.closest('.swiper-slide');
            const commentBox = slide.querySelector('.comment-box');
            
            if (commentBox && content) {
               const commentImg = commentBox.querySelector('.ceo-comment-logo');
               const commentTitle = commentBox.querySelector('.ceo-comment h3');
               const commentText = commentBox.querySelector('.ceo-comment p');
               
               // تغییر تصویر اگر موجود باشد
               if (commentImg && image) {
                  commentImg.src = image;
               }
               
               // تغییر عنوان
               if (commentTitle) {
                  commentTitle.innerHTML = company;
               }
               
               // تغییر متن
               if (commentText) {
                  commentText.innerHTML = content;
               }
               
               // افکت انیمیشن
               commentBox.style.opacity = '0';
               setTimeout(function() {
                  commentBox.style.transition = 'opacity 0.3s ease';
                  commentBox.style.opacity = '1';
               }, 100);
            }
         });
      });
   });
   </script>
</main>
               
<?php get_footer(); ?>
