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

defined( 'ABSPATH' ) || exit;
// $product = wc_get_product(get_the_ID());
global $product;
if ( get_post_type( $post ) === 'product' && ! is_a($product, 'WC_Product') ) {
  $product = wc_get_product( get_the_id() ); // Get the WC_Product Object
}

$product_attributes = $product->get_attributes(); // Get the product attributes

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

<section>
          <div class="product-single-top ">
            <div class="product-single-right">
            
            
              <div style="position:relative;">
                <?php
                // نمایش بج درصد تخفیف اگر محصول تخفیف‌دار باشد
                if ( $product->is_on_sale() ) {
                  $regular_price = (float) $product->get_regular_price();
                  $sale_price = (float) $product->get_sale_price();
                  if ( $regular_price > 0 && $sale_price > 0 && $regular_price > $sale_price ) {
                    $discount_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                    echo '<span class="discount-badge">' . $discount_percent . '% تخفیف</span>';
                  }
                }
                ?>
                <?php woocommerce_show_product_images(); ?>
              </div>
              
              <div class="product-single-details">
             
                  <?php
                    $terms = get_the_terms( get_the_ID(), 'product_cat' );
                                        if ( $terms && ! is_wp_error( $terms ) ) :
                        $term_names = array();
                                            foreach ( $terms as $term ) {
                            $term_names[] = sprintf( '<a href="%1$s">%2$s</a>',
                                esc_url( get_term_link( $term ) ),
                                esc_html( $term->name )
                            );
                        }
                        $terms_list = join( ", ", $term_names );
                    ?>
                         <?php esc_html_e( '', 'text-domain' ); ?>
                        <span class="prd_cat"> <?php echo wp_kses_post( $terms_list ); ?>
                        </span>
                    
                    <?php endif; ?>
              
                <h2><?php echo wc_get_product( $post->ID )->get_title(); ?></h2>
                <p class="prd_stock<?php echo ($product->get_stock_status() !== 'instock') ? ' out-of-stock-text' : ''; ?>"><?php echo (wc_get_product( $post->ID )->get_stock_status()=='instock') ? 'موجود' :'ناموجود';?></p>
                <?php if ($product->get_stock_status() === 'instock') : ?>
                <div class="product-price-column">
                  <?php echo wc_get_product( $post->ID )->get_price_html(); ?>
                </div>
                <form class="cart add-to-cart-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' style="margin:18px 0;">
                  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
                  <button type="submit" class="buy-btn" style="width:100%;margin-top:8px;">افزودن به سبد خرید</button>
                </form>
                <?php endif; ?>

                <div class="product-icons-box" style="display:flex;gap:16px;align-items:center; justify-content:space-around;margin-bottom:16px;">

              <div class="icon-item" style="display:flex;flex-direction:column;align-items:center;">
                <i class="fa fa-truck" style="font-size:36px;color:#ff9800;"></i>
                <span style="font-size:18px;margin-top:4px;">ارسال سریع</span>
              </div>
              <div class="icon-item" style="display:flex;flex-direction:column;align-items:center;">
                <i class="fa fa-shield" style="font-size:36px;color:#ff9800;"></i>
                <span style="font-size:18px;margin-top:4px;">ضمانت اصالت</span>
              </div>
            </div>

              </div>
            </div>
            <div class="product-single-left">
            
            <?php $downloads = $product->get_downloads();

foreach( $downloads as $key => $each_download ) {
  echo '<a href="'.$each_download["file"].'" download>'.$each_download["name"];'</a>';
}?>
              <a href="https://force.co.ir/wp-content/themes/Force/files/catalogue.pdf">کاتالوگ همه محصولات<i class="fa fa-download"></i></a>
              <?php if ($product->get_stock_status() === 'instock') : ?>
                <a href="#" id="openFormButton">ثبت درخواست خرید<i class="fa fa-phone"></i></a>
              <?php else : ?>
                <a class="buy-btn disabled" href="#" tabindex="-1" aria-disabled="true" onclick="return false;">ثبت درخواست خرید<i class="fa fa-phone"></i></a>
              <?php endif; ?>
                        <div id="popupFormContainer">
                          <div id="popupForm">
                            <h2>تماس با ما</h2>
                            <?php
                              // Your PHP code...

                              // Output the Contact Form 7 shortcode
                              echo do_shortcode('[contact-form-7 id="ca52d6d" title="فرم تماس - محصولات"]');

                              // More of your PHP code...
                              ?>
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
                  <p>
                  <?php echo wc_get_product( $post->ID )->get_description(); ?>
                  </p>               
                  <h6 id="details">مشخصات کلی دستگاه</h6>
                  <?php echo wc_get_product( $post->ID )->get_short_description(); ?>
                </div>
            </div>

            <div class="product-single-left sticky">
            <?php the_post_thumbnail(); ?>
            <h3 class="maghale-title"><?php the_title(); ?></h3>
    <?php if ($product->get_stock_status() === 'instock') : ?>
    <div class="product-price-column">
      <?php echo wc_get_product( $post->ID )->get_price_html(); ?>
    </div>
    <?php endif; ?>
            <?php $downloads = $product->get_downloads();
foreach( $downloads as $key => $each_download ) {
  echo '<a href="'.$each_download["file"].'" download>'.$each_download["name"];'</a>';
}?>
<a href="<?php echo get_template_directory_uri();?>/files/catalogue.pdf" download>کاتالوگ همه محصولات<i class="fa fa-download"></i></a>
            <?php if ($product->get_stock_status() === 'instock') : ?>
                <a href="#" id="openFormButton">ثبت درخواست خرید<i class="fa fa-phone"></i></a>
              <?php else : ?>
                <a class="buy-btn disabled" href="#" tabindex="-1" aria-disabled="true" onclick="return false;">ثبت درخواست خرید<i class="fa fa-phone"></i></a>
              <?php endif; ?>
            </div>
          </div>
        </section>
        
</div>
<section class="related">
<h2>محصولات مشابه</h2>
<?php
// Get the current product ID
$current_product_id = get_the_ID();

// Get the product object
$current_product = wc_get_product($current_product_id);

// Get the related product IDs
$related_product_ids = $current_product->get_related();

// Query the related products
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 8,
    'post__in' => $related_product_ids,
    'post__not_in' => array($current_product_id),
);

$related_products = new WP_Query($args);

// Display the related products
if ($related_products->have_posts()) {
    echo '<ul class="related-products">';
    while ($related_products->have_posts()) {
        $related_products->the_post();
        global $product;
        ?>
        <li>
            <a href="<?php the_permalink(); ?>">
            <div class="each-img">
            <?php the_post_thumbnail(); ?>
            </div>
              <h3>
                <?php the_title(); ?>
              </h3>
            </a>
           
        </li>
        <?php
    }
    echo '</ul>';
    wp_reset_postdata();
} else {
    echo 'No related products found.';
}
?>



        </section>
      <?php
      // نمایش لینک دانلود فایل کاتالوگ برای همه کاربران
      if ( $product && $product->is_downloadable() ) {
        $files = $product->get_downloads();
        if ( !empty($files) ) {
          echo '<div class="product-catalog-downloads" style="margin-top:20px;">';
          echo '<h4>دانلود کاتالوگ محصول:</h4>';
          foreach ( $files as $file ) {
            $file_name = !empty($file["name"]) ? esc_html($file["name"]) : 'دانلود فایل';
            $file_url = esc_url($file["file"]);
            echo '<a href="' . $file_url . '" class="button" download>' . $file_name . '</a><br />';
          }
          echo '</div>';
        }
      }
      ?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
