<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
 <div class="related-product pt-30 pb-15">
    <div class="container">
		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'agronix' ) );

		if ( $heading ) :
			?>
			<h6 class="related-product-title related-product-title-2 mb-50"><?php echo esc_html( $heading ); ?></h6>
		<?php endif; ?>	
		<?php woocommerce_product_loop_start(); ?>

		<?php
            $related_class = '';
            if (count($related_products) >= 4){
                $related_class = 'product-slider product-slider-active owl-carousel'; ?>
                <div class="product-wrapper <?php print esc_attr($related_class); ?>">
		        	<?php foreach ( $related_products as $related_product ) : ?>
							<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

							wc_get_template_part( 'content', 'product' );
							?>
					<?php endforeach; ?>
				</div>

        	<?php 
            } else { ?>
	            <div class="row">
	            	<?php foreach ( $related_products as $related_product ) : ?>
		    		<div class="col-sm-6 col-lg-3 col-md-4">
						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'content', 'product' );
						?>
					</div>
					<?php endforeach; ?>
				</div>
			<?php
            }
        ?>

        <?php woocommerce_product_loop_end(); ?>

    </div>
 </div>

	<?php
endif;

wp_reset_postdata();
