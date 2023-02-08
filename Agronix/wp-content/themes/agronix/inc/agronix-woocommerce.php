<?php
/**
 * [agronix_remove_hook description]
 * @return [type] [description]
 */
function agronix_remove_hook() {
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	add_action( 'agronix_before_shop_loop_item_thumb_link', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	add_action( 'woocommerce_sidebar', 'agronix_woocommerce_get_sidebar', 10 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'agronix_mid_shop_loop_item_end_link', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title_cart_button', 'agronix_product_cart_button', 10 );

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	add_action( 'agronix_woocommerce_after_shop_loop_item_title', 'agronix_woo_rating', 10 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'agronix_woocommerce_template_loop_price', 10 );

	add_action( 'agronix_woocommerce_after_shop_loop_item', 'agronix_list_product_cart_button_only', 20 );
	add_action( 'agronix_woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 10 );


	remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	add_action('woocommerce_before_shop_loop_notice', 'wc_print_notices', 9);

	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action ('woocommerce_shop_loop_item_title', 'agronix_woocommerce_template_loop_product_title', 10);


}

agronix_remove_hook();

add_filter( 'woocommerce_show_page_title', function () {
	return false;
} );




// agronix_dequeue_stylesandscripts_select2
add_action( 'wp_enqueue_scripts', 'agronix_dequeue_stylesandscripts_select2', 11 );
 
function agronix_dequeue_stylesandscripts_select2() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'select2' );
	    wp_dequeue_script( 'select2');
	    wp_dequeue_script( 'selectWoo' );
    } 
}


/**
 * Single Product
 */

if ( ! function_exists( 'agronix_quick_view_images' ) ) {

	/**
	 * Output the product image before the single product summary.
	 */
	function agronix_quick_view_images() { ?>
        <div class="bdevs-quick-view-images">
			<?php wc_get_template( 'single-product/product-image.php' );
			?>
        </div>
		<?php
	}
}

function agronix_woocommerce_template_loop_product_title() {
	echo '<h3 class="product__title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h3>';
}

/**
 * [agronix_product_title description]
 * @return [type] [description]
 */
function agronix_product_title() {
	echo '<h6><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>';
}

/**
 * [agronix_product_cart_button description]
 * @return [type] [description]
 */
function agronix_product_cart_button() {
	global $product;
	$class      = 'product_type_' . $product->get_type() . ' add_to_cart_button ' . ( $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' );
	$attributes = array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'aria-label'       => $product->add_to_cart_description(),
		'rel'              => 'nofollow',
	);
	print '<div class="product-item-action-2 text-center">';
	print '<a ' . http_build_query( $attributes, ' ', ' ' ) . ' class="' . $class . ' p-cart a_un" href="' . $product->add_to_cart_url() . '"><i class="fal fa-shopping-cart"></i></a>';
	print agronix_quick_view_button( $product->get_id() );
	print agronix_vc_yith_wishlist();


	print '</div>';
}


/**
 * [agronix_list_product_cart_button description]
 * @return [type] [description]
 */
function agronix_list_product_cart_button() {
	global $product;
	$class      = 'product_type_' . $product->get_type() . ' add_to_cart_button ' . ( $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' );
	$attributes = array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'aria-label'       => $product->add_to_cart_description(),
		'rel'              => 'nofollow',
	);
	print '<div class="product-action">';
	print '<a ' . http_build_query( $attributes, ' ', ' ' ) . ' class="' . $class . '" href="' . $product->add_to_cart_url() . '"><i class="fal fa-cart-arrow-down"></i></a>';
	print agronix_quick_view_button( $product->get_id() );
	print agronix_vc_yith_wishlist();
	print '</div>';
}

/**
 * [agronix_list_product_cart_button_only description]
 * @return [type] [description]
 */
function agronix_list_product_cart_button_only() {
	global $product;
	$class      = 'product_type_' . $product->get_type() . ' add_to_cart_button ' . ( $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' );
	$attributes = array(
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'aria-label'       => $product->add_to_cart_description(),
		'rel'              => 'nofollow',
	);
	print '<div class="agronix_cart_list_button">';
	print '<a ' . http_build_query( $attributes, ' ', ' ' ) . ' class="epix-btn-1 epix_cart_only ' . $class . '" href="' . $product->add_to_cart_url() . '"><span>Add To Cart</span></a>';
	print agronix_vc_yith_wishlist();
	print agronix_quick_view_button( $product->get_id() );
	print '</div>';

}



/**
 * [agronix_woo_rating description]
 * @return [type] [description]
 */


function agronix_woo_rating() {
	global $product;
	$rating = $product->get_average_rating();
	$review = 'Rating ' . $rating . ' out of 5';
	$html   = '';
	$html   .= '<div class="rating" title="' . $review . '">';
	for ( $i = 0; $i <= 4; $i ++ ) {
		if ( $i < floor( $rating ) ) {
			$html .= '<a href="#"><i class="fas fa-star"></i></a>';
		} else {
			$html .= '<a href=""><i class="fal fa-star"></i></a>';
		}
	}
	$html .= '</div>';
	print agronix_woo_rating_html( $html );
}

function agronix_woo_rating_html( $html ) {
	return $html;
}



/**
 * [agronix_woo_rating description]
 * @return [type] [description]
 */
function agronix_woo_shop_rating() {
	global $product;
	$rating = $product->get_average_rating();
	$review = esc_html( 'Rating ' . $rating . ' out of 5' );
	ob_start(); ?>
    <div class="rating mb-10" title="<?php print esc_attr( $review ); ?>">
		<?php
		for ( $i = 0; $i <= 4; $i ++ ) {
			if ( $i < floor( $rating ) ) { ?>
                <i class="fas fa-star"></i>
				<?php
			} else { ?>
                <i class="fal fa-star"></i>
				<?php
			}
		}
		?>
    </div>
	<?php
	return ob_get_clean();
}

function agronix_get_price() {
	ob_start(); ?>
    <span class="price"><?php print agronix_get_price_html(); ?></span>
	<?php
	return ob_get_clean();
}

function agronix_get_price_html() {
	global $product;

	return $product->get_price_html();
}

/**
 * [agronix_comment_rating description]
 *
 * @param  [type] $rating [description]
 *
 * @return [type]         [description]
 */
function agronix_comment_rating( $rating ) {
	$review = 'Rating ' . $rating . ' out of 5';
	$html   = '';
	$html   .= '<div class="rating" title="' . $review . '">';
	for ( $i = 0; $i <= 4; $i ++ ) {
		if ( $i < floor( $rating ) ) {
			$html .= '<i class="fas fa-star"></i>';
		} else {
			$html .= '<i class="far fa-star"></i>';
		}
	}
	$html .= '</div>';

	return $html;
}


add_filter( 'add_to_cart_fragments', 'agronix_woocommerce_header_add_to_cart_fragment' );

/**
 * [agronix_woocommerce_header_add_to_cart_fragment description]
 *
 * @param  [type] $fragments [description]
 *
 * @return [type]            [description]
 */
function agronix_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
    <a class="cp-minicart" href="<?php echo wc_get_cart_url(); ?>"><i class="fas fa-shopping-cart"></i><span
                id="agronix-cart"
                class="mini-cart-items"><?php print WC()->cart->get_cart_contents_count(); ?></span></a>
	<?php
	$fragments['a.cp-minicart'] = ob_get_clean();

	return $fragments;
}

function agronix_vc_yith_wishlist() {

	global $product;

	$cssclass = 'wishlist-rd';
	$mar      = 'tanzim-mar-top';

	$id   = $product->get_id();
	$type = $product->get_type();
	$link = get_template_directory_uri();
	$img    = '<img src="' . esc_url( $link ) . '/assets/img/icon/wpspin_light.gif" class="ajax-loading tanzim_wi_loder" alt="' . esc_attr( 'loading' ) . '" width="16" height="16" style="visibility:hidden">';
	$markup = '';

	if ( AGRONIX_WISHLIST_ACTIVED ) {

		$markup .= '<div class="yith-wcwl-add-to-wishlist ' . $mar . ' add-to-wishlist-' . $id . '">';
		$markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
		$markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist p-cart a_un2 ' . $cssclass . '">';
		$markup .= '<i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div class="yith-wcwl-wishlistaddedbrowse wishlist hide" style="display:none;">';
		$markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div class="yith-wcwl-wishlistexistsbrowse wishlist  hide" style="display:none">';
		$markup .= '<a href="' . $link . '/wishlist/view/" rel="nofollow" class=" ' . $cssclass . '"><i class="fal fa-heart"></i></a>';
		$markup .= $img;
		$markup .= '</div>';
		$markup .= '<div style="clear:both"></div>';
		$markup .= '<div class="yith-wcwl-wishlistaddresponse"></div>';
		$markup .= '</div>';

	}

	return $markup;
}

add_filter( 'woocommerce_product_additional_information_heading', 'agronix_tab_heading' );
add_filter( 'woocommerce_product_description_heading', 'agronix_tab_heading' );


/**
 * [agronix_tab_heading description]
 *
 * @param  [type] $heading [description]
 *
 * @return [type]          [description]
 */
function agronix_tab_heading( $heading ) {
	return '';
}

/**
 * [agronix_woo_pagination description]
 *
 * @param  [type] $pagination [description]
 *
 * @return [type]             [description]
 */
function agronix_woo_pagination( $pagination ) {
	$pagi = '';
	if ( $pagination != '' ) {
		$pagi .= '<ul class="pagination justify-content-start">';
		foreach ( $pagination as $key => $pg ) {
			$pagi .= '<li class="page-item">' . $pg . '</li>';
		}
		$pagi .= '</ul>';
	}

	return $pagi;
}

function agronix_woocommerce_get_sidebar() {
	dynamic_sidebar( 'product-sidebar' );
}
                                                         

function agronix_woocommerce_template_loop_price() {
	print '<span class="woo-price">';
	echo agronix_get_price();
	print '</span>';    
}

function agronix_woocommerce_template_single_price() {
	print '<div class="price mt-15 mb-20">';
	print agronix_get_price_html();
	print '</div>';
}

if ( ! function_exists( 'agronix_header_add_to_cart_fragment' ) ) {
	function agronix_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
        <span class="cart__count" id="agronix-cart-item">
			<?php echo esc_html( WC()->cart->cart_contents_count ); ?>
		</span>
		<?php
		$fragments['#agronix-cart-item'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'agronix_header_add_to_cart_fragment' );

if ( ! function_exists( 'agronix_header_add_to_cart_price' ) ) {
	function agronix_header_add_to_cart_price( $fragments ) {
		ob_start();
		?>
        <span class="cart__amount" id="agronix-total-price">
			<?php echo WC()->cart->get_cart_total(); ?>
		</span>
		<?php
		$fragments['#agronix-total-price'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'agronix_header_add_to_cart_price' );


function agronix_product_tab() {
	ob_start();
	?>
    <div class="ch-left mb-20">
        <ul class="nav shop-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true"><i class="fas fa-th"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false"><i class="fas fa-list-ul"></i></a>
            </li>
        </ul>
    </div>
    </div> <!-- pro-filter parent end -->
	<?php
	print ob_get_clean();
}

function agronix_quick_view_button( $product_id ) {
	if ( AGRONIX_QUICK_VIEW_ACTIVED ) {
		$product = wc_get_product( $product_id );
		$button  = '';
		if ( $product_id ) {

			$button = '<a href="#" class="button yith-wcqv-button p-cart product-popup-toggle a_un3 " data-product_id="' . esc_attr( $product_id ) . '" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fal fa-eye"></i></a>';
			$button = apply_filters( 'yith_add_quick_view_button_html', $button, '', $product );
		}

		return $button;
	}
}



function agronix_product_compare_button( $product_id ) {
	if ( AGRONIX_COMPARE_ACTIVED ) {
		$product = wc_get_product( $product_id );
		$button  = '';
		if ( $product_id ) {
			$url_args = array(
				'action' => 'yith-woocompare-add-product',
				'id'     => $product_id
			);
			$button   = sprintf( '<a href="%1$s" class="compare button" data-product_id="%2$s" rel="nofollow"><i class="fal fa-exchange"></i></a>',
				get_page_link() . '?action=yith-woocompare-add-product&amp;id=' . esc_attr( $product_id ),
				esc_attr( $product_id )
			);
		}

		return $button;
	}
}

add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <div class="header-mini-cart">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.header-mini-cart'] = ob_get_clean();
    return $fragments;
});


add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 200,
        'height' => 200,
        'crop' => 0,
    );
} );