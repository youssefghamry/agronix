<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package agronix
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php
        $agronix_preloader = get_theme_mod( 'agronix_preloader', true );
        $agronix_backtotop = get_theme_mod( 'agronix_backtotop', true );

        $agronix_preloader_logo_icon = get_template_directory_uri() . '/assets/img/favicon.png';
        $agronix_preloader_logo = get_template_directory_uri() . '/assets/img/preloder.png';

        $preloader_logo_icon = get_theme_mod('preloader_icon', $agronix_preloader_logo_icon);
        $preloader_logo = get_theme_mod('preloader_logo', $agronix_preloader_logo);

    ?>

    <?php if ( !empty( $agronix_preloader ) ): ?>
      <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <div class="loading-icon text-center d-sm-flex align-items-center justify-content-center">
                  <img class="loading-logo mr-10" src="<?php print esc_url($preloader_logo_icon); ?>" alt="<?php print esc_attr__( 'logo icon', 'agronix' );?>">
                  <img src="<?php print esc_url($preloader_logo); ?>" alt="<?php print esc_attr__( 'logo', 'agronix' );?>">
               </div>
            </div>
         </div>  
      </div>
      <!-- pre loader area end -->
    <?php endif;?>

 
    <?php if ( !empty( $agronix_backtotop ) ): ?>
      <!-- back to top start -->
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <!-- back to top end -->
    <?php endif;?>
    

    <?php wp_body_open();?>

    <!-- header start -->
    <?php do_action( 'agronix_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'agronix_before_main_content' );?>






