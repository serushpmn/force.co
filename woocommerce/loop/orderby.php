<?php
/**
 * Product ordering form.
 *
 * Custom version to display sorting options as links instead of a dropdown.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the total number of products found
global $wp_query;
$product_count = $wp_query->found_posts;

?>

<div class="shop-header-bar">
    
    <div class="shop-title-section">
        <h2>همه محصولات</h2>
        <span class="product-count"><?php echo esc_html( $product_count ); ?> محصول</span>
    </div>

    <div class="custom-ordering-section">
        <span class="sorting-label">مرتب سازی:</span>
        <div class="custom-orderby">
            <?php
            // Get the current URL without the 'orderby' query parameter
            // wc_get_current_page_url() may not exist in all WooCommerce versions, build reliably instead
            $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
            $current_full_url = home_url( $request_uri );
            $current_url = remove_query_arg( 'orderby', $current_full_url );

            // Get the current sorting order, default to 'menu_order'
                // Determine current orderby: either from query or WooCommerce default
                $default_orderby = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
                $current_orderby = ! empty( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;

                // Provide catalog orderby options (filterable)
                // Custom Persian labels for sorting
                $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
                    'popularity'  => 'پرفروش ترین',
                    'price'       => 'ارزان ترین',
                    'price-desc'  => 'گران ترین',
                    'date'        => 'جدید ترین',
                ) );

                // Loop through each sorting option and create a link
                if ( ! empty( $catalog_orderby_options ) && is_array( $catalog_orderby_options ) ) {
                    foreach ( $catalog_orderby_options as $id => $name ) {
                        $link = add_query_arg( 'orderby', $id, $current_url );
                        $class = ( $current_orderby === $id ) ? 'active' : '';
                        printf( '<a href="%s" class="%s">%s</a>', esc_url( $link ), esc_attr( $class ), esc_html( $name ) );
                    }
                }
            ?>
        </div>
    </div>
    
</div>