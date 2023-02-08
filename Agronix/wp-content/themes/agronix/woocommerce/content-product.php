<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}



?>


<div <?php wc_product_class( '', $product ); ?>>

	<div class="agronix-single-product-3 agronix_single_pro mb-40 style-2 text-center swiper-slide"> 
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );


		print '<div class="product-item mb-30">';
		
			print '<div class="product-thumb gray-bg">';

				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */

				do_action( 'woocommerce_before_shop_loop_item_title_cart_button' );
				do_action( 'agronix_before_shop_loop_item_thumb_link' ); 
				do_action( 'woocommerce_before_shop_loop_item_title' );
				do_action( 'agronix_mid_shop_loop_item_end_link' );

			print '</div>';


			print '<div class="product__content mt-30">';

				global $post;
				$terms = get_the_terms( $post->ID, 'product_cat' );
				foreach ($terms as $term) {
				    $product_cat_name = $term->name;
				    $product_cat_id = $term->term_id;
				    break;
				}


				print '<div class="rating-area">';
				print '<a href=" '.get_category_link($product_cat_id).' " class="medilove_cat_name">'.$product_cat_name.'</a>';

				do_action( 'agronix_woocommerce_after_shop_loop_item_title' );
				print '</div>';
				print '<div class="product-wrapper">';
				
					/**
					 * Hook: woocommerce_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */

					do_action( 'agronix_before_shop_loop_item_thumb_link' );
					do_action( 'woocommerce_shop_loop_item_title' );
					do_action( 'agronix_mid_shop_loop_item_end_link' );


					do_action( 'woocommerce_after_shop_loop_item_title' );

				print '</div>';

			print '</div>';

		print '</div>';




		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>
