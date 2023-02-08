<?php

namespace BdevsElement;

defined('ABSPATH') || die();

class BDevs_El_Woocommerce
{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var BdevsElement The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return BdevsElement An instance of the class.
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    public static function category_list()
    {
        $args = [
            'number' => 100,
        ];

        $list = array('Select Category' => '');

        if (BDEVSEL_WOOCOMMERCE_ACTIVED) {

            $product_categories = get_terms('product_cat', $args);
            if (!empty($product_categories)) {

                foreach ($product_categories as $product_categorie) {
                    $list[$product_categorie->name] = $product_categorie->slug;
                }
            }
        }

        return $list;
    }


    public static function add_to_cart_button($product_id)
    {
        if (BDEVSEL_WOOCOMMERCE_ACTIVED) {
            $product = wc_get_product($product_id);
            if ($product) {
                $defaults = array(
                    'quantity' => 1,
                    'class' => implode(' ', array_filter(array(
                        '',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? '' : '',
                        $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : ''
                    )))
                );

                extract($defaults);

                return sprintf('<a rel="nofollow" data-toggle="tooltip" data-placement="top" title="Shoppingb Cart" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button"><i class="fal fa-cart-arrow-down"></i></a>',
                    esc_url($product->add_to_cart_url()),
                    esc_attr(isset($quantity) ? $quantity : 1),
                    esc_attr($product->get_id()),
                    esc_attr($product->get_sku()),
                    esc_attr(isset($class) ? $class : 'button')
                );
            }
        }
    }

    public static function add_to_cart_button_text($product_id)
    {
        if (BDEVSEL_WOOCOMMERCE_ACTIVED) {
            $product = wc_get_product($product_id);
            if ($product) {
                $defaults = array(
                    'quantity' => 1,
                    'class' => implode(' ', array_filter(array(
                        '',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? '' : '',
                        $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : ''
                    )))
                );

                extract($defaults);

                return sprintf('<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button">+ Add To Cart</a>',
                    esc_url($product->add_to_cart_url()),
                    esc_attr(isset($quantity) ? $quantity : 1),
                    esc_attr($product->get_id()),
                    esc_attr($product->get_sku()),
                    esc_attr(isset($class) ? $class : 'button')
                );
            }
        }
    }

    public static function quick_view_button($product_id) {

        $product = wc_get_product($product_id);

        $button = '';
        if ( $product_id ) {
      
            $button = '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fal fa-eye"></i></a>';
            $button = apply_filters( 'yith_add_quick_view_button_html', $button, '', $product );
        }

        return $button;
            
    }


    public static function product_compare_button($product_id) {

        $product = wc_get_product($product_id);

        $button = '';
        if ( $product_id ) {

            $url_args = array(
                'action' => 'yith-woocompare-add-product',
                'id' => $product_id
            );

            $button = sprintf('<a href="%1$s" class="compare button" data-product_id="%2$s" rel="nofollow"><i class="fal fa-exchange"></i></a>', 
                get_page_link() .'?action=yith-woocompare-add-product&amp;id='. esc_attr( $product_id ), 
                esc_attr( $product_id ) 
            );
      
        }

        return $button;
            
    }


    public static function bdevs_vc_get_product_thumb($id, $size = array()) {

        $markup = '';
        $image_attributes = wp_get_attachment_image_src($id, $size);

        if (!empty($image_attributes)) {

            $markup = '<img src="' . current($image_attributes) . '" alt="' . esc_attr('product img', 'bdevs-woocommerce') . '">';
        }

        return $markup;
    }

    public static function bdevs_vc_feature_product($size = array(135, 238), $uperdiv = true)
    {

        global $product;

        $output = '';
        if ($uperdiv) {
            $output .= '<div class="tm-pa-single-wrap large-pro">';
        }

        $output .= '<div class="tm-pa-single large">';
        $output .= '<div class="tm-pa-thumb">';
        $output .= tanzim_vc_get_product_thumb(get_post_thumbnail_id($product->get_id()), $size);
        $output .= '</div>';
        $output .= '<div class="tm-pa-content">';
        $output .= '<h2>' . get_the_title() . '</h2>';
        $output .= '<div class="price-box">';
        $output .= tanzim_woo_product_price($product, true);
        $output .= '</div>';
        $output .= '<div class="ratting-box">';
        $output .= tanzim_vc_woo_ration($product->get_average_rating());
        $output .= '</div>';
        $output .= '<div class="product-action compare">';
        $output .= tanzim_product_add_tocart_button();
        $output .= tanzim_vc_yith_wishlist();
        $output .= tanzim_vc_price_compare();
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        if ($uperdiv) {
            $output .= '</div>';
        }

        return $output;
    }

    public static function yith_wishlist($product_id)
    {

        $product = wc_get_product($product_id);

        $cssclass = 'wishlist-rd';
        $mar = 'tanzim-mar-top';

        $id = $product->get_id();
        $type = $product->get_type();
        $link = get_site_url();

        $img = '<img src="' . $link . '/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading tanzim_wi_loder" alt="loading" width="16" height="16" style="visibility:hidden">';
        $markup = '';

        if (BDEVSEL_WISHLIST_ACTIVED) {

            $markup .= '<div class="yith-wcwl-add-to-wishlist ' . $mar . ' add-to-wishlist-' . $id . '">';
            $markup .= '<div class="yith-wcwl-add-button wishlist show" style="display:block">';
            $markup .= '<a href="' . $link . '/shop/?add_to_wishlist=' . $id . '" rel="nofollow" data-product-id="' . $id . '" data-product-type="' . $type . '" class="add_to_wishlist ' . $cssclass . '">';
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

    public static function product_price($product_id, $oldp = false)
    {

        $product = wc_get_product($product_id);

        $price = $product->get_regular_price();
        $old = '';

        if ($product->get_sale_price() != '') {

            $price = $product->get_sale_price();

            if ($oldp) {
                $old = '<span class="old-price"><del>' . get_woocommerce_currency_symbol(get_woocommerce_currency()) . $product->get_regular_price() . '</del></span>';
            }
        }

        $price = get_woocommerce_currency_symbol(get_woocommerce_currency()) . $price;

        return '<span class="price">' . $price . '</span> ' . $old;
    }

    public static function bdevs_vc_product_thumb($size = array(370, 425))
    {

        $markup = '';
        global $post, $product, $woocommerce;

        $attachment_ids = $product->get_gallery_image_ids();
        $fea_image = array(get_post_thumbnail_id());
        $attachment_ids = array_merge($fea_image, $attachment_ids);
        $i = 1;

        if (!empty($attachment_ids)) {

            $markup .= '<a href="' . get_the_permalink() . '">';
            foreach ($attachment_ids as $attachment_id) {
                if ($i == 3) {
                    break;
                }
                $class = ($i == 1) ? 'front-img' : 'back-img';
                $image_attributes = wp_get_attachment_image_src($attachment_id, $size);
                if ($image_attributes[0] != '') {
                    $markup .= '<img class="' . $class . '" src="' . $image_attributes[0] . '" alt="' . esc_html__('image', 'bdevs-woocommerce') . '" >';
                }
                $i++;
            }
            $markup .= '</a>';
        }

        return $markup;
    }

    public static function bdevs_vc_loop_product_thumb()
    {

        $markup = '';
        global $post, $product, $woocommerce;
        $attachment_ids = $product->get_gallery_image_ids();
        $fea_image = array(get_post_thumbnail_id());
        $attachment_ids = array_merge($fea_image, $attachment_ids);
        $i = 1;
        if (!empty($attachment_ids)) {
            $markup .= '<a href="' . get_the_permalink() . '">';
            foreach ($attachment_ids as $attachment_id) {
                if ($i == 3) {
                    break;
                }
                $class = ($i == 1) ? 'front-img' : 'back-img';
                $image_attributes = wp_get_attachment_image_src($attachment_id, array(300, 300));
                if ($image_attributes[0] != '') {
                    $markup .= '<img class="' . $class . '" src="' . $image_attributes[0] . '" alt="' . esc_html__('image', 'bdevs-woocommerce') . '" >';
                }
                $i++;
            }
            $markup .= '</a>';
        }

        return $markup;
    }


    public static function product_rating($product_id)
    {

        $product = wc_get_product($product_id);
        $product->get_average_rating();
        $rating = $product->get_rating_count();

        $review = 'Rating ' . $rating . ' out of 5';

        $html = '';
        $html .= '<ul class="pro-rating" title="' . $review . '">';

        for ($i = 0; $i <= 4; $i++) {

            if ($i < floor($rating)) {

                $html .= '<li class="rating-active"><i class="fas fa-star"></i></li>';
            } else {

                $html .= '<li><i class="fas fa-star"></i></li>';
            }
        }

        $html .= '</ul>';

        return $html;
    }


    /**
     * taxonomy category
     */
    public static function product_get_terms($id, $tax)
    {

        $terms = get_the_terms(get_the_ID(), $tax);

        $list = '';
        if ($terms && !is_wp_error($terms)) :
            $i = 1;
            $cats_count = count($terms);

            foreach ($terms as $term) {
                $exatra = ($cats_count > $i) ? ', ' : '';
                $list .= $term->name . $exatra;
                $i++;
            }
        endif;

        return trim($list, ',');
    }

}

BDevs_El_Woocommerce::instance();