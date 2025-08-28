<?php get_header(); ?>
<!-- Hero  -->

<main>
   <div class="slider">
   <div class="swiper hero-slider">
      <div class="swiper-wrapper">
         <!-- Slider #1 -->
         <div class="swiper-slide each-hero">
            <div class="hero">
               <div class="img-slider">
                  <img src="<?php echo get_template_directory_uri();?>/img/bg-low-size.jpg" alt="شرکت فیلتراسین فرس" loading="lazy"/>
               </div>
                  <h1 class="brand-title">
                     <?php bloginfo('name'); ?>
                     <span class="brand-description"><?php bloginfo('description'); ?></span>
                  </h1>
                  <h3 class="brand-title">
                     <a href="<?php echo get_template_directory_uri();?>/files/catalogue.pdf" download>
                        دانلود کاتالوگ
                        <span class="brand-description"><i class="fa fa-download"></i></span>
                     </a>
                  </h3>
               <div class="hero-info container-content">
                  <p>+2152 <span>پروژه کل</span></p>
                  <p>+3436 <span>مشتریان راضی</span></p>
                  <p>+35 <span>پروژه در دست انجام</span></p>
                  <p>+26 <span>گواهینامه معتبر</span></p>
               </div>
            </div>
         </div>
         <!-- Slider #2 -->
         <div class="swiper-slide each-hero">
            <div class="hero">
               <div class="img-slider">
                  <img src="<?php echo get_template_directory_uri();?>/img/Force-slider-5.jpg" alt="شرکت فیلتراسین فرس"loading="lazy" />
               </div>
               <h2 class="brand-title">
                تماس با ما
                  <span class="brand-description"></span>
               </h2>
               <div class="hero-info container-content">
                  <p>نیم قرن تجربه صنعتی همراه با انرژی جوانی دانش بنیان</p>
               </div>
            </div>
         </div>
         <!-- Slider #3 -->
         <div class="swiper-slide each-hero">
            <div class="hero">
               <div class="img-slider">
                  <img src="<?php echo get_template_directory_uri();?>/img/Force-slider-6.jpg" alt="شرکت فیلتراسین فرس" loading="lazy"/>
               </div>
               <h2 class="brand-title">
                  ما را مشاور خود بدانید
                   </h2>
               <div class="hero-info container-content">
                  <span class="brand-description-2">طراحی</span>
                  <span class="brand-description-2">ساخت</span>
                  <span class="brand-description-2">اجرا</span>
                  <span class="brand-description-2">تولید</span>
                  <span class="brand-description-2">بازرگانی داخلی</span>
                  <span class="brand-description-2">بازرگانی خارجی</span>
               </div>
            </div>
         </div>
         <!-- Slider #4 -->
         <div class="swiper-slide each-hero">
            <div class="hero">
               <div class="img-slider">
                  <img src="<?php echo get_template_directory_uri();?>/img/Force-slider-2.jpg" alt="شرکت فیلتراسین فرس"loading="lazy" />
               </div>
                </div>
         </div>
      </div>
   </div>
   </div>
   <!-- kasbokar  -->
   <section class="kasbokar-home" id="kasbokar">
      <div class="container-content">
         <h3 class="home-title">حوزه کسب و کار</h3>
         <div class="kasbokar-rect"></div>
         <div class="kasbokar-circles">
            <?php $the_query = new WP_Query([
               "post_type" => "kasbokar",
               "posts_per_page" => "10",
                 ]); ?>
            <?php if ($the_query->have_posts()): ?>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
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
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else: ?>
            <p><?php esc_html_e("متاسفانه محتوایی پیدا نشد"); ?></p>
            <?php endif; ?>
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
                           <div class="each-logo">
                              <?php the_post_thumbnail(); ?>
                              <span class="logo-tooltip"><?php the_title(); ?></span>
                           </div>
                           <?php
                              endwhile; ?>
                           <?php wp_reset_postdata(); ?>
                           <?php else: ?>
                           <p><?php esc_html_e(
                              "متاسفانه محتوایی پیدا نشد"
                              ); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="comment-box">
                           <img
                              src="<?php echo get_template_directory_uri();?>/img/logos/قرارگاه-خاتم.jpg"
                              alt=""
                              class="ceo-comment-logo"
                              />
                           <div class="ceo-comment">
                              <h3>
                                 جواد نوری <span>-</span>
                                 <span>قرار گاه سازندگی خاتم الانبیا</span>
                              </h3>
                              <p>
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
                           <div class="each-logo">
                              <?php the_post_thumbnail(); ?>
                              <span class="logo-tooltip"><?php the_title(); ?></span>
                           </div>
                           <?php
                              endwhile; ?>
                           <?php wp_reset_postdata(); ?>
                           <?php else: ?>
                           <p><?php esc_html_e(
                              "متاسفانه محتوایی پیدا نشد"
                              ); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="comment-box">
                           <img
                              src="<?php echo get_template_directory_uri();?>/img/logos/نیروگاه-رجائی.jpg"
                              alt=""
                              class="ceo-comment-logo"
                              />
                           <div class="ceo-comment">
                              <h3>
                              عبدالعظیم محمد نیازی
                                 <span>-</span>
                                 <span>
                                 شرکت تولید برق شهید رجایی
                                 </span>
                              </h3>
                              <p>
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box">
                        <img
                           src="<?php echo get_template_directory_uri();?>/img/logos/پتروشیمی-اصفهان.jpg"
                           alt=""
                           class="ceo-comment-logo"
                           />
                        <div class="ceo-comment">
                           <h3>
                           علی مستاجران<span>-</span>
                              <span>پتروشیمی اصفهان</span>
                           </h3>
                           <p>بدینوسیله تایید می گردد شرکت پیشگام صنعت فرس میزان هفتاد هزار لیتر روغن حرارتی واحد انیدرید فتالیک پتروشیمی اصفهان را به نحو مناسب تصفیه (اب زدایی) نموده است.   </p>
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box">
                        <img
                           src="<?php echo get_template_directory_uri();?>/img/logos/فولاد-نطنز.jpg"
                           alt=""
                           class="ceo-comment-logo"
                           />
                        <div class="ceo-comment">
                           <h3>
                           علیرضا توکلی طرقی <span>-</span>
                              <span>شرکت صنایع فولاد نطنز</span>
                           </h3>
                           <p>احتراما بدینوسیله صحت عملکرد یونیت تصفیه روغن سری FT که صرفه جویی اقتصادی قابل توجهی را به همراه داشته اعلام و از زحمات و تلاش بی وقفه مدیریت و کلیه متخصصین ان شرکت تشکر و قدر دانی میگردد. </p>
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box">
                        <img
                           src="<?php echo get_template_directory_uri();?>/img/logos/نوین-سرام-یزد.jpg"
                           alt=""
                           class="ceo-comment-logo"
                           />
                        <div class="ceo-comment">
                           <h3>
                           مدیریت بازرگانی<span>-</span>
                              <span>کاشی نوین سرام یزد</span>
                           </h3>
                           <p>احتراماً به استخضار می‌رساند که دستگاه تصفیه روغن کد FL50 که از شرکت فرس خریداری شده مورد تأیید این شرکت می‌باشد.
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box">
                        <img
                           src="<?php echo get_template_directory_uri();?>/img/logos/آریا-بنادر-ایرانیان.jpg"
                           alt=""
                           class="ceo-comment-logo"
                           />
                        <div class="ceo-comment">
                           <h3>
                           صفدر تاجیک<span>-</span>
                              <span>شرکت آریا بنادر ایرانیان </span>
                           </h3>
                           <p>احتراماً با بررسی به عمل آمده از دستگاه فیلتراسیون سوخت، خریداری شده از شرکت فرس، به عرض می‌رساند: در طول مدت بهره‌برداری این دستگاه،  از کیفیت و کارائی قابل قبولی برخوردار بوده به نحوی که استفاده از آن سبب افزایش طول عمر سیستم های سوخت و همچنین کاهش هزینه ا و تعمیرات را در پی داشته است.  </p>
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
                        <div class="each-logo">
                           <?php the_post_thumbnail(); ?>
                           <span class="logo-tooltip"><?php the_title(); ?></span>
                        </div>
                        <?php
                           endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                        <p><?php esc_html_e(
                           "متاسفانه محتوایی پیدا نشد"
                           ); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="comment-box">
                        
                        <div class="ceo-comment">
                           <h3>
                           حسین ازادواری
                              <span>-</span>
                              <span>
                              سازمان خدمات موتوری
                                 </span>
                           </h3>
                           <p>
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
   <!-- Products  -->
   <section class="maghalat">
      <div class="container-content">
         <div class="top-section">
            <h3 class="home-title">محصولات</h3>
            <a href="https://force.co.ir/shop/" class="btn-orange">همه محصولات<i class="fa fa-chevron-circle-left"></i></a>
         </div>
         <div class="swiper myMaghale">
            <div class="swiper-wrapper">
               <?php
                  $the_query = new WP_Query( array( 'post_type' => 'product', 'posts_per_page'=>'100') ) ?>
               <?php if ( $the_query->have_posts() ) : ?>
               <?php
                  while ( $the_query->have_posts() ) :
                      $the_query->the_post();
                      ?>
               <div class="swiper-slide each-maghale">
                  <div class="each-maghale-img">
                     <a href="<?php the_permalink();?>">
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink();?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <span class="prd-price"><?php echo wc_get_product( $post->ID )->get_price_html(); ?></span>
                  <a href="<?php the_permalink() ?>" class="btn-white">خرید<i class="fa fa-shopping-cart"></i></a>
               </div>
               <?php endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else : ?>
               <p><?php esc_html_e( 'متاسفانه محتوایی پیدا نشد' ); ?></p>
               <?php endif; ?>
            </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
   <!-- About US  -->
   <section class="about-us" id="about-us">
      <div class="container-content">
         <h3 class="home-title">درباره ما</h3>
         <div class="about-us-content">
            <div class="right">
               <p>
                  شرکت فرس به منظور دستیابی صنایع کشور به تجهیزات مدرن
                  فیلتراسیون روغن و سوخت در جهت افزایش طول عمر روغن، قطعات،
                  ماشین آلات و کاهش زمان تولید و کاهش هزینه و زمان تعمیرات و در
                  نهایت افزایش راندمان اقتصادی شرکت ها از سال 1384 در زمینه
                  فیلتراسیون روغن و سوخت تحقیقات گسترده ای آغاز نموده که در
                  نهایت این امر منجر به تاسیس شرکت فرس با چشم انداز، ماموریت و
                  ارزشهای ذیل شده‌است. امروزه شرکت فرس با تولید بیش از هزار
                  دستگاه در سال با صنایع بزرگ کشور از جمله: صنایع فولاد، معادن،
                  پتروشیمی، پالایشگاه، سیمان و ... همکاری دارد.
               </p>
               <p>
                  رویکرد هیئت موسس شرکت فرس از ابتدا استفاده از جوانان و توسعه
                  محصولات بوده است و امروزه با افتخار اعلام میکنیم با رویکرد
                  اتخاذ شده، علاوه بر تولید خود را رقیبی جدی برای شرکتهای صنعتی
                  بزرگ میبیند. علاوه بر تجهیزات، از سال های ابتدایی تأسیس، شرکت
                  فرس با علاقمندی در زمینه پتروپالایش، فعالیتهای گستردهای را در
                  کشور آغاز نموده و امروز اعلام میکنیم علاوه بر تولید محصولات
                  فرآیندی، شرکت ما مجری ساخت مینی پالایشگاهها نیز میباشد.
               </p>
               <div class="buttons">
                  <a href="/Force/catalogue.pdf" class="btn-orange" download
                     >دانلود کاتالوگ</a
                     >
                  <a href="#" class="btn-orange">مشاهده پروژه ها</a>
               </div>
            </div>
            <img src="<?php echo get_template_directory_uri();?>/img/about-us.jpg" alt="" />
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
                  <a href="<?php the_permalink() ?>">
                  <?php the_post_thumbnail(); ?>
                  </a>
               </div>
               <?php endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else : ?>
               <p><?php esc_html_e( 'متاسفانه محتوایی پیدا نشد' ); ?></p>
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
               <?php
                  $the_query = new WP_Query( array( 'post_type' => 'post', 'category_name' => 'articles','posts_per_page'=>'20' ) ) ?>
               <?php if ( $the_query->have_posts() ) : ?>
               <?php
                  while ( $the_query->have_posts() ) :
                      $the_query->the_post();
                      ?>
               <div class="swiper-slide each-maghale">
                  <div class="each-maghale-img">
                     <div class="sample-image">
                        <a href="<?php the_permalink();?>">
                     </div>
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink();?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink() ?>" class="btn-white">ادامه مطلب <i class="fa fa-arrow-circle-left"></i></a>
               </div>
               <?php endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else : ?>
               <p><?php esc_html_e( 'متاسفانه محتوایی پیدا نشد' ); ?></p>
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
               <?php
                  $the_query = new WP_Query( array( 'post_type' => 'post','category_name' => 'news','posts_per_page'=>'20' ) ) ?>
               <?php if ( $the_query->have_posts() ) : ?>
               <?php
                  while ( $the_query->have_posts() ) :
                      $the_query->the_post();
                      ?>
               <div class="swiper-slide each-akhbar">
                  <div class="each-akhbar-img">
                     <a href="<?php the_permalink();?>">
                     <?php the_post_thumbnail(); ?>
                     </a> 
                  </div>
                  <a href="<?php the_permalink();?>">
                     <h3 class="maghale-title"><?php the_title(); ?></h3>
                  </a>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink() ?>" class="btn-white">ادامه مطلب <i class="fa fa-arrow-circle-left"></i></a>
               </div>
               <?php endwhile; ?>
               <!-- end of the loop -->
               <?php wp_reset_postdata(); ?>
               <?php else : ?>
               <p><?php esc_html_e( 'متاسفانه محتوایی پیدا نشد' ); ?></p>
               <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
         </div>
      </div>
   </section>
</main>
               
<?php get_footer(); ?>