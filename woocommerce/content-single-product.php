<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined("ABSPATH") || exit();
// $product = wc_get_product(get_the_ID());
global $product;
if (get_post_type($post) === "product" && !is_a($product, "WC_Product")) {
  $product = wc_get_product(get_the_id()); // Get the WC_Product Object
}

$product_attributes = $product->get_attributes(); // Get the product attributes

do_action("woocommerce_before_single_product");

if (post_password_required()) {
  echo get_the_password_form(); // WPCS: XSS ok.
  return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class("", $product); ?>>
<section>
          <div class="product-single-top ">
            <div class="product-single-right">
                              <?php woocommerce_show_product_images(); ?>
                            <div class="product-single-details">
                              <?php
                              $terms = get_the_terms(
                                get_the_ID(),
                                "product_cat",
                              );
                              if ($terms && !is_wp_error($terms)):

                                $term_names = [];
                                foreach ($terms as $term) {
                                  $term_names[] = sprintf(
                                    '<a href="%1$s">%2$s</a>',
                                    esc_url(get_term_link($term)),
                                    esc_html($term->name),
                                  );
                                }
                                $terms_list = join(", ", $term_names);
                                ?>
                         <?php esc_html_e("", "text-domain"); ?>
                        <span class="prd_cat"> <?php echo wp_kses_post(
                          $terms_list,
                        ); ?>
                        </span>
                                        <?php
                              endif;
                              ?>
                              <h2>
<?php echo wc_get_product(
                                $post->ID,
                              )->get_title(); ?>
                              </h2>
                <p class="prd_stock">
<?php echo wc_get_product(
                  $post->ID,
                )->get_stock_status() == "instock"
                  ? "موجود در انبار"
                  : "ناموجود در انبار"; 
?>
                  </p>
                  <?php 
// نمایش ویژگی‌های محصول
if (class_exists('CPI_Frontend')) {
    CPI_Frontend::get_instance()->display_product_features();
}
?>
               
<?php
if (isset($product) && $product) {
                                  $rating_count = (int) $product->get_rating_count();
                                  $average = (float) $product->get_average_rating();
                                  if ($rating_count > 0) { ?>
                    <div class="woocommerce-product-rating">
                      <div class="star-rating" title="<?php echo esc_attr(
                        sprintf(
                          __("Rated %s out of 5", "woocommerce"),
                          $average,
                        ),
                      ); ?>">
                        <span style="width:<?php echo esc_attr(
                          ($average / 5) * 100,
                        ); ?>%"></span>
                      </div>
                      <a href="#reviews" class="review-count">(<?php echo esc_html(
                        $rating_count,
                      ); ?> نظر)</a>
                    </div>
                    <?php }
                                } ?>
              </div>
            </div>
            <div class="product-single-left">
            <div class="product-single-details">     
                <p><?php echo wc_get_product(
                  $post->ID,
                )->get_price_html(); ?></p>
              </div>
            <?php
            $downloads = $product->get_downloads();
            foreach ($downloads as $key => $each_download) {
              echo '<a href="' .
                $each_download["file"] .
                '" download>' .
                $each_download["name"];
              "</a>";
            }
            ?>
              <a href="https://force.co.ir/wp-content/themes/Force/files/catalogue.pdf">کاتالوگ همه محصولات<i class="fa fa-download"></i></a>
              <?php // اگر محصول قابل خرید است، دکمه افزودن به سبد نمایش داده شود؛ در غیر اینصورت لینک تماس باقی بماند

if (isset($product) && $product && $product->is_purchasable()) {
                echo do_shortcode(
                  '[add_to_cart id="' .
                    intval(get_the_ID()) .
                    '" show_price="false"]',
                );
              } else {
                echo '<a href="#" id="openFormButton">ثبت درخواست خرید<i class="fa fa-phone"></i></a>';
              } ?>
                        <div id="popupFormContainer">
                          <div id="popupForm">
                            <h2>تماس با ما</h2>
                            <?php echo do_shortcode(
                              '[contact-form-7 id="ca52d6d" title="فرم تماس - محصولات"]',
                            ); ?>
                          </div>
                        </div>
            </div>
          </div>
          <div class="product-single-description">
            
            <div class="product-description">
              <div class="product-description-tab">
                <a href="#desc">توضیحات</a>
                <a href="#details">مشخصات کلی</a>
                </div>
                <div class="prd-description">
                  <h6 id="#desc">توضیحات دستگاه</h6>
                  <div class="description-content">
                    <div class="description-text">
                      <?php echo wc_get_product($post->ID)->get_description(); ?>
                    </div>
                    <button class="read-more-btn" onclick="toggleDescription(this)">
                      <span class="more-text">ادامه مطلب</span>
                      <span class="less-text" style="display: none;">بستن</span>
                      <i class="fa fa-chevron-down arrow-icon"></i>
                    </button>
                  </div>
                  
                  <h6 id="details">مشخصات کلی دستگاه</h6>
                  <div class="specs-content">
                    <div class="specs-text">
                      <?php echo wc_get_product($post->ID)->get_short_description(); ?>
                    </div>
                    <button class="read-more-btn" onclick="toggleSpecs(this)">
                      <span class="more-text">ادامه مطلب</span>
                      <span class="less-text" style="display: none;">بستن</span>
                      <i class="fa fa-chevron-down arrow-icon"></i>
                    </button>
                  </div>
                </div>
                
                <script>
                function toggleDescription(btn) {
                  const container = btn.parentElement;
                  const content = container.querySelector('.description-text');
                  const moreText = btn.querySelector('.more-text');
                  const lessText = btn.querySelector('.less-text');
                  const arrow = btn.querySelector('.arrow-icon');
                  
                  if (content.classList.contains('expanded')) {
                    content.classList.remove('expanded');
                    moreText.style.display = 'inline';
                    lessText.style.display = 'none';
                    arrow.style.transform = 'rotate(0deg)';
                  } else {
                    content.classList.add('expanded');
                    moreText.style.display = 'none';
                    lessText.style.display = 'inline';
                    arrow.style.transform = 'rotate(180deg)';
                  }
                }

                function toggleSpecs(btn) {
                  const container = btn.parentElement;
                  const content = container.querySelector('.specs-text');
                  const moreText = btn.querySelector('.more-text');
                  const lessText = btn.querySelector('.less-text');
                  const arrow = btn.querySelector('.arrow-icon');
                  
                  if (content.classList.contains('expanded')) {
                    content.classList.remove('expanded');
                    moreText.style.display = 'inline';
                    lessText.style.display = 'none';
                    arrow.style.transform = 'rotate(0deg)';
                  } else {
                    content.classList.add('expanded');
                    moreText.style.display = 'none';
                    lessText.style.display = 'inline';
                    arrow.style.transform = 'rotate(180deg)';
                  }
                }
                </script>

                         <?php
// دریافت لینک از ACF
$aparat_link = get_field("aparat_video_url");
if (!empty($aparat_link)) {
    // بررسی اینکه لینک آپارات باشد
    if (preg_match("/aparat\.com\/(?:v|embed)\/([a-zA-Z0-9]+)/", $aparat_link, $matches)) {
        $video_id = $matches[1]; ?>
        
        <div class="aparat-video-wrapper">
            <iframe 
                src="https://www.aparat.com/video/video/embed/videohash/<?php echo esc_attr($video_id); ?>/vt/frame"
                allowfullscreen>
            </iframe>
        </div>
        
        <style>
        .aparat-video-wrapper {
            position: relative;
            width: 100%;
            max-width: 1000px; /* حداکثر عرض دلخواه، مثلا 1000px */
            margin: 20px auto; /* وسط‌چین کردن */
            aspect-ratio: 16 / 9; /* نسبت تصویر */
        }

        .aparat-video-wrapper iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border: none;
        }
        </style>

<?php
    } else {
        echo "<p>لینک آپارات معتبر نیست.</p>";
    }
}
?>

            </div>
                   <div class="product-single-left sticky">
            <?php the_post_thumbnail(); ?>
            <h3 class="maghale-title"><?php the_title(); ?></h3>
            <p><?php echo wc_get_product($post->ID)->get_price_html(); ?></p>
            <?php
            $downloads = $product->get_downloads();
            foreach ($downloads as $key => $each_download) {
              echo '<a href="' .
                $each_download["file"] .
                '" download>' .
                $each_download["name"];
              "</a>";
            }
            ?>
<a href="<?php echo get_template_directory_uri(); ?>/files/catalogue.pdf" download>کاتالوگ همه محصولات<i class="fa fa-download"></i></a>
               <?php // اگر محصول قابل خرید است، دکمه افزودن به سبد نمایش داده شود؛ در غیر اینصورت لینک تماس باقی بماند

if (isset($product) && $product && $product->is_purchasable()) {
                 echo do_shortcode(
                   '[add_to_cart id="' .
                     intval(get_the_ID()) .
                     '" show_price="false"]',
                 );
               } else {
                 echo '<a href="#" id="openFormButton">ثبت درخواست خرید<i class="fa fa-phone"></i></a>';
               } ?>
            </div>
          </div>
        </section>
        </div>
<section class="related">
  <h2>محصولات مشابه</h2>
  <?php
  // Save globals
  global $post, $product;
  $orig_post = $post;
  $orig_product = $product;

  $related_ids = wc_get_related_products(get_the_ID(), 8);
  if (!empty($related_ids)) {
    echo '<div class="related-products products-grid">';
    foreach ($related_ids as $r_id) {
      $post = get_post($r_id);
      setup_postdata($post);
      $product = wc_get_product($r_id);
      // reuse loop template so styling stays consistent
      wc_get_template_part("content", "product");
    }
    echo "</div>";
    // restore globals
    wp_reset_postdata();
    $post = $orig_post;
    $product = $orig_product;
    setup_postdata($post);
  } else {
    echo '<p class="no-related">محصول مشابه وجود ندارد.</p>';
  }
  ?>
</section>
    <?php do_action("woocommerce_after_single_product"); ?>
