<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package agronix
 */

/** 
 *
 * agronix header
 */

function agronix_check_header() {
    $agronix_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $agronix_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $agronix_header_style == 'header-style-1' ) {
        agronix_header_style_1();
    } 
    elseif ( $agronix_header_style == 'header-style-2' ) {
        agronix_header_style_2();
    } 
    elseif ( $agronix_header_style == 'header-style-3' ) {
        agronix_header_style_3();
    } 
    elseif ( $agronix_header_style == 'header-style-4' ) {
        agronix_header_style_4();
    }
    else {

        /** default header style **/
        if ( $agronix_default_header_style == 'header-style-2' ) {
            agronix_header_style_2();
        } 
        elseif ( $agronix_default_header_style == 'header-style-3' ) {
            agronix_header_style_3();
        }
        elseif ( $agronix_default_header_style == 'header-style-4' ) {
            agronix_header_style_4();
        } 
        else {
            agronix_header_style_1();
        }
    }

}
add_action( 'agronix_header_style', 'agronix_check_header', 10 );


// Header deafult
function agronix_header_style_1() {

   $agronix_header_right = get_theme_mod( 'agronix_header_right', false );
   $agronix_topbar_switch = get_theme_mod( 'agronix_topbar_switch', false );
   $agronix_header_social = get_theme_mod( 'agronix_header_social', false );

   $agronix_email = get_theme_mod( 'agronix_email', __( 'info@webmail.com', 'agronix' ) );
   $agronix_address = get_theme_mod( 'agronix_address', __( '13/A, New Hawk Tower, NYC', 'agronix' ) );
   $agronix_phone = get_theme_mod( 'agronix_phone', __( '897-985-564-45', 'agronix' ) );
   $agronix_address_link = get_theme_mod('agronix_address_link', __('#','agronix'));


   ?>


   <header>
      <div class="header__area header-area-white header_style-1">
         <?php if ( !empty( $agronix_topbar_switch ) ): ?>
         <div class="header__area-top-bar header-2-top-bar header-2-border">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
                     <div class="headerinfo">
                        <ul>
                           <?php if(!empty($agronix_email)) : ?>
                           <li><a href="mailto:<?php print esc_attr($agronix_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($agronix_email); ?></a></li>
                           <?php endif; ?>

                           <?php if(!empty($agronix_address)) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php print esc_url($agronix_address_link); ?>" target="_blank"><i class="fal fa-map-marker-alt"></i><?php print esc_html($agronix_address); ?></a></li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>
                  <?php if ( !empty( $agronix_header_social ) ): ?>
                  <div class="col-xl-6 col-lg-6 col-md-4 col-sm-6">
                     <div class="soical__icon">
                        <?php agronix_header_social_profiles(); ?>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <?php endif; ?>

         <div class="header-white-area theme-bg-secondary-h1" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-3 col-md-8 col-8">
                     <div class="logo">
                        <?php agronix_header_logo();?>
                     </div>
                  </div>
                  <div class="col-xl-10 col-lg-9 col-md-4 col-4 d-flex align-items-center justify-content-end">
                     <div class="main-menu-h1 main-menu main-menu-white text-center">
                        <nav id="mobile-menu">
                           <?php agronix_header_menu();?>
                        </nav>
                     </div>
                     <div class="side-menu-icon d-lg-none text-end">
                        <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                     </div>

                     <?php if ( !empty( $agronix_header_right ) ): ?>
                     <?php if(!empty($agronix_phone)) : ?>
                     <div class="header-cta">
                        <a href="tel:<?php print esc_url($agronix_phone); ?>"><i class="fas fa-phone-alt"></i></a>
                        <div class="phone-number">
                           <span><?php print esc_html__( 'Phone Number', 'agronix' );?></span>
                           <p><a href="tel:<?php print esc_url($agronix_phone); ?>"><?php print esc_html($agronix_phone); ?></a></p>
                        </div>
                     </div>
                     <?php endif; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->
    
   <!-- side info start -->
   <?php agronix_side_info(); ?>
   <!-- side info end -->     
   <div class="body-overlay"></div>
   <!-- sidebar area end -->

<?php
}


/**
 * header style 2
 */
 function agronix_header_style_2() {
   $agronix_header_right = get_theme_mod( 'agronix_header_right', false );
   $agronix_topbar_switch = get_theme_mod( 'agronix_topbar_switch', false );
   $agronix_header_social = get_theme_mod( 'agronix_header_social', false );

   $agronix_email = get_theme_mod( 'agronix_email', __( 'info@webmail.com', 'agronix' ) );
   $agronix_address = get_theme_mod( 'agronix_address', __( '13/A, New Hawk Tower, NYC', 'agronix' ) );
   $agronix_phone = get_theme_mod( 'agronix_phone', __( '897-985-564-45', 'agronix' ) );
   $agronix_address_link = get_theme_mod('agronix_address_link', __('#','agronix'));

   ?>

   <!-- header area start -->

   <header>
      <div class="header__area header-area-white header_style-2">
         <?php if ( !empty( $agronix_topbar_switch ) ): ?>
         <div class="header__area-top-bar header-2-top-bar theme-bg-primary-h1">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
                     <div class="headerinfo">
                        <ul>
                           <?php if(!empty($agronix_email)) : ?>
                           <li><a href="mailto:<?php print esc_url($agronix_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($agronix_email); ?></a></li>
                           <?php endif; ?>

                           <?php if(!empty($agronix_address)) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php print esc_url($agronix_address_link); ?>" target="_blank"><i class="fal fa-map-marker-alt"></i><?php print esc_html($agronix_address); ?></a></li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>

                  <?php if ( !empty( $agronix_header_social ) ): ?>
                  <div class="col-xl-6 col-lg-6 col-md-4 col-sm-6">
                     <div class="soical__icon">
                        <?php agronix_header_social_profiles(); ?>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <?php endif; ?>

         <div class="header-white-area theme-bg-secondary-h1" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
               <div class="col-xl-2 col-lg-3 col-md-8 col-8">
                  <div class="logo">
                     <?php agronix_header_logo();?>
                  </div>
               </div>
               <div class="col-xl-10 col-lg-9 col-md-4 col-4 d-flex align-items-center justify-content-end">
                  <div class="main-menu-h1 main-menu main-menu-white text-center">
                     <nav id="mobile-menu">
                        <?php agronix_header_menu();?>
                     </nav>
                  </div>
                  <div class="side-menu-icon d-lg-none text-end">
                     <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                  </div>
                  
                  <?php if ( !empty( $agronix_header_right ) ): ?>
                  <?php if(!empty($agronix_phone)) : ?>
                  <div class="header-cta">
                     <a href="tel:<?php print esc_url($agronix_phone); ?>"><i class="fas fa-phone-alt"></i></a>
                     <div class="phone-number">
                        <span><?php print esc_html__( 'Phone Number', 'agronix' );?></span>
                        <p><a href="tel:<?php print esc_url($agronix_phone); ?>"><?php print esc_html($agronix_phone); ?></a></p>
                     </div>
                  </div>
                  <?php endif; ?>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         </div>
      </div>
   </header>
    <!-- header area end -->
    
   <!-- side info start -->
   <?php agronix_side_info(); ?>
   <!-- side info end -->     
   <div class="body-overlay"></div>
   <!-- sidebar area end -->

<?php
}

/**
 * header style 3
 */
 function agronix_header_style_3() {

   $agronix_topbar_switch = get_theme_mod( 'agronix_topbar_switch', false );
   $agronix_header_social = get_theme_mod( 'agronix_header_social', false );

   $agronix_email = get_theme_mod( 'agronix_email', __( 'info@webmail.com', 'agronix' ) );
   $agronix_address = get_theme_mod( 'agronix_address', __( '13/A, New Hawk Tower, NYC', 'agronix' ) );
   $agronix_phone = get_theme_mod( 'agronix_phone', __( '897-985-564-45', 'agronix' ) );
   $agronix_address_link = get_theme_mod('agronix_address_link', __('#','agronix'));

   $agronix_header_right = get_theme_mod( 'agronix_header_right', false );
   $agronix_search = get_theme_mod( 'agronix_search', false );
   $agronix_menu_col = $agronix_header_right ? 'col-xl-8 col-lg-7 d-none d-lg-block' : 'col-xl-10 col-lg-9 d-none d-lg-block text-right';
   $agronix_mobile_menu_col = $agronix_header_right ? 'd-none' : 'd-lg-none col-md-6 col-6 text-end';

   ?>

   <header>
      <div class="header__area header_style-3">
         <?php if ( !empty( $agronix_topbar_switch ) ): ?>
         <div class="header__area-top-bar theme-bg-primary">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
                     <div class="headerinfo">
                        <ul>
                           <?php if(!empty($agronix_email)) : ?>
                           <li><a href="mailto:<?php print esc_url($agronix_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($agronix_email); ?></a></li>
                           <?php endif; ?>

                           <?php if(!empty($agronix_address)) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php print esc_url($agronix_address_link); ?>"><i class="fal fa-map-marker-alt"></i><?php print esc_html($agronix_address); ?></a></li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>

                  <?php if ( !empty( $agronix_header_social ) ): ?>
                  <div class="col-xl-6 col-lg-6 col-md-4 col-sm-6">
                     <div class="soical__icon">
                        <?php agronix_header_social_profiles(); ?>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <?php endif; ?>

         <div class="header__area__menu  theme-bg" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-3 col-md-6 col-6">
                     <div class="logo">
                        <?php agronix_header_logo();?>
                     </div>
                  </div>
                  <div class="<?php print esc_attr($agronix_menu_col); ?>">
                     <div class="main-menu text-center main-menu-white">
                        <nav id="mobile-menu">
                           <?php agronix_header_menu(); ?>
                        </nav>
                     </div>
                  </div>

                  <?php if ( !empty( $agronix_header_right ) ): ?>
                  <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                     <div class="header-action">
                           <ul>
                              <?php if ( !empty( $agronix_search ) ): ?>
                              <li><a href="javascript:void(0)" data-bs-toggle="modal" class="search" data-bs-target="#search-modal"><i class="fal fa-search d-none d-lg-block"></i></a></li>
                              <?php endif; ?>
                              <li><a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a></li>
                           </ul>
                     </div>
                  </div>
                  <?php endif; ?>

                  <div class="<?php print esc_attr($agronix_mobile_menu_col); ?>">
                     <div class="header-action">
                           <ul>
                              <li><a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a></li>
                           </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>

   <!-- side info start -->
   <?php agronix_side_info(); ?>
   <!-- side info end -->     
   <div class="body-overlay"></div>
   <!-- sidebar area end -->

   <!--- Header search ---->
   <?php agronix_header_search(); ?>

<?php
}

/**
 * header style 4
 */
 function agronix_header_style_4() {

   $agronix_topbar_switch = get_theme_mod( 'agronix_topbar_switch', false );
   $agronix_header_social = get_theme_mod( 'agronix_header_social', false );

   $agronix_email = get_theme_mod( 'agronix_email', __( 'info@webmail.com', 'agronix' ) );
   $agronix_address = get_theme_mod( 'agronix_address', __( '13/A, New Hawk Tower, NYC', 'agronix' ) );
   $agronix_phone = get_theme_mod( 'agronix_phone', __( '897-985-564-45', 'agronix' ) );
   $agronix_address_link = get_theme_mod('agronix_address_link', __('#','agronix'));

   $agronix_header_right = get_theme_mod( 'agronix_header_right', false );
   $agronix_search = get_theme_mod( 'agronix_search', false );
   $agronix_menu_col = $agronix_header_right ? 'col-xl-5 col-lg-5 d-none d-lg-block' : 'col-xl-9 col-lg-9 d-none d-lg-block';
   $agronix_mobile_menu_col = $agronix_header_right ? 'd-none' : 'd-lg-none col-md-6 col-6 text-end';

   ?>

   <!-- header area start -->
   <header>
      <div class="header__area header_style-4">
         <div class="header__area-top-bar theme-bg-primary-h3">
            <div class="container-fluid custome-container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-8 col-sm-6">
                     <div class="headerinfo">
                        <ul>
                           <?php if(!empty($agronix_email)) : ?>
                           <li><a href="mailto:<?php print esc_url($agronix_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($agronix_email); ?></a></li>
                           <?php endif; ?>

                           <?php if(!empty($agronix_address)) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php print esc_url($agronix_address_link); ?>"><i class="fal fa-map-marker-alt"></i><?php print esc_html($agronix_address); ?></a></li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>

                  <?php if ( !empty( $agronix_header_social ) ): ?>
                  <div class="col-xl-6 col-lg-6 col-md-4 col-sm-6">
                     <div class="soical__icon">
                        <?php agronix_header_social_profiles(); ?>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <div class="header__area__menu bg-white" id="header-sticky">
            <div class="container-fluid custome-container">
               <div class="row align-items-center">
                  <div class="<?php print esc_attr($agronix_menu_col); ?>">
                     <div class="main-menu-h3 main-menu">
                        <nav id="mobile-menu">
                           <?php agronix_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                     <div class="logo">
                        <?php agronix_header_logo();?>
                     </div>
                  </div>

                  <?php if ( !empty( $agronix_header_right ) ): ?>
                  <div class="col-xl-4 col-lg-4 col-6">
                     <div class="header-action header-action-h3">
                        <ul>
                           <?php if ( !empty( $agronix_search ) ): ?>
                           <li><a href="javascript:void(0)" data-bs-toggle="modal" class="search" data-bs-target="#search-modal"><i class="fal fa-search d-none d-lg-block"></i></a></li>
                           <?php endif; ?>
                           <li><a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <?php endif; ?>

                  <div class="<?php print esc_attr($agronix_mobile_menu_col); ?>">
                     <div class="header-action header-action-h3">
                        <ul>
                           <li><a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a></li>
                        </ul>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->

   <!-- side info start -->
   <?php agronix_side_info(); ?>
   <!-- side info end -->

   <div class="body-overlay"></div>
   <!-- sidebar area end -->

   <!--- Header search ---->
   <?php agronix_header_search(); ?>

<?php
}




// agronix_side_info
function agronix_side_info() {

   $agronix_side_search_hide = get_theme_mod( 'agronix_side_search_hide', false );
   $agronix_side_extra_text_hide = get_theme_mod( 'agronix_side_extra_text_hide', false );
   $agronix_side_map_hide = get_theme_mod( 'agronix_side_map_hide', false );
   $agronix_side_gallery_hide = get_theme_mod( 'agronix_side_gallery_hide', false );
   $agronix_side_contact_info_hide = get_theme_mod( 'agronix_side_contact_info_hide', false );
   $agronix_side_social_hide = get_theme_mod( 'agronix_side_social_hide', false );

   $agronix_side_logo = get_theme_mod( 'agronix_side_logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

   $agronix_extra_text = get_theme_mod( 'agronix_extra_text', __( 'Sidebar Extra Text...', 'agronix' ) );
   $agronix_extra_map_url = get_theme_mod( 'agronix_extra_map_url', __( 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29176.030811137334!2d90.3883827!3d23.924917699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1605272373598!5m2!1sen!2sbd', 'agronix' ) );
   $agronix_contact_title = get_theme_mod( 'agronix_contact_title', __( 'Contact Info', 'agronix' ) );
   $agronix_extra_address = get_theme_mod( 'agronix_extra_address', __( '12/A, Mirnada City Tower, NYC', 'agronix' ) );
   $agronix_address_link = get_theme_mod('agronix_address_link', __('#','agronix'));
   $agronix_extra_phone = get_theme_mod( 'agronix_extra_phone', __( '088889797697', 'agronix' ) );
   $agronix_extra_email = get_theme_mod( 'agronix_extra_email', __( 'support@mail.com', 'agronix' ) );

   $clients = get_theme_mod( 'clients_setting');

   ?>


   <div class="sidebar__area">
      <div class="sidebar__wrapper">
         <div class="sidebar__close">
            <button class="sidebar__close-btn" id="sidebar__close-btn">
               <i class="fal fa-times"></i>
            </button>
         </div>
         <div class="sidebar__content">
            <div class="sidebar__logo mb-40">
               <a href="<?php print esc_url( home_url( '/' ) );?>">
                  <img src="<?php print esc_url($agronix_side_logo); ?>" alt="<?php print get_bloginfo( 'name' ); ?>">
               </a>
            </div>

            <?php if ( !empty( $agronix_side_search_hide ) ): ?>
            <div class="sidebar__search mb-25">
               <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                  <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'What are you searching for?', 'agronix' );?>">
                  <button type="submit" ><i class="far fa-search"></i></button>
               </form>
            </div>
            <?php endif; ?>

            <div class="mobile-menu fix"></div>

            <?php if ( !empty( $agronix_side_extra_text_hide ) ): ?>
            <div class="sidebar__text d-none d-lg-block">
               <p><?php print esc_html($agronix_extra_text); ?></p>
            </div>
            <?php endif; ?>

            <?php if(!empty($agronix_side_gallery_hide)) : ?>
            <?php if( !empty($clients) ) : ?>
            <div class="sidebar__img d-none d-lg-block mb-20">
               <div class="row gx-2">
                  <?php foreach( $clients as $client ) : ?>
                  <div class="col-4">
                     <div class="sidebar__single-img w-img mb-10">
                        <a class="image-popups" href="<?php echo wp_get_attachment_url( $client['image_client'] ); ?>">
                           <img src="<?php echo wp_get_attachment_url( $client['image_client'] ); ?>" alt="<?php print esc_attr__( 'Client Images', 'agronix' );?>">
                        </a>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <?php if ( !empty( $agronix_side_map_hide ) ): ?>
            <div class="sidebar__map d-none d-lg-block mb-15">
               <iframe src="<?php print esc_url($agronix_extra_map_url); ?>"></iframe>
            </div>
            <?php endif; ?>

            <?php if ( !empty( $agronix_side_contact_info_hide ) ): ?>
            <div class="sidebar__contact mt-30 mb-20">
               <h4><?php print esc_html($agronix_contact_title); ?></h4>

               <ul>
                  <?php if(!empty($agronix_extra_address)) : ?>
                  <li class="d-flex align-items-center">
                     <div class="sidebar__contact-icon mr-15">
                        <i class="fal fa-map-marker-alt"></i>
                     </div>
                     <div class="sidebar__contact-text">
                        <a target="_blank" href="<?php print esc_url($agronix_address_link); ?>"><?php print esc_html($agronix_extra_address); ?></a>
                     </div>
                  </li>
                  <?php endif; ?>

                  <?php if(!empty($agronix_extra_phone)) : ?>
                  <li class="d-flex align-items-center">
                     <div class="sidebar__contact-icon mr-15">
                        <i class="far fa-phone"></i>
                     </div>
                     <div class="sidebar__contact-text">
                        <a href="tel:<?php print esc_url($agronix_extra_phone) ?>"><?php print esc_html($agronix_extra_phone); ?></a>
                     </div>
                  </li>
                  <?php endif; ?>

                  <?php if(!empty($agronix_extra_email)) : ?>
                  <li class="d-flex align-items-center">
                     <div class="sidebar__contact-icon mr-15">
                        <i class="fal fa-envelope"></i>
                     </div>
                     <div class="sidebar__contact-text">
                        <a href="mailto:<?php print esc_url($agronix_extra_email) ?>"><?php print esc_html($agronix_extra_email); ?></a>
                     </div>
                  </li>
                  <?php endif; ?>
               </ul>
            </div>
            <?php endif; ?>

            <?php if ( !empty( $agronix_side_social_hide ) ): ?>
            <div class="sidebar__social">
               <?php agronix_header_social_profiles(); ?>
            </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
   <!-- sidebar area end -->  

<?php }

/**
 * [agronix_header_lang description]
 * @return [type] [description]
 */
function agronix_header_lang_defualt() {
    $agronix_header_lang = get_theme_mod( 'agronix_header_lang', false );
    if ( $agronix_header_lang ): ?>

    <ul>
        <li><a href="#0" class="lang__btn"><?php print esc_html__( 'EN', 'agronix' );?> <i class="ti-arrow-down"></i></a>
        <?php do_action( 'agronix_language' );?>
        </li>
    </ul>

    <?php endif;?>
<?php
}

/**
 * [agronix_language_list description]
 * @return [type] [description]
 */
function _agronix_language( $mar ) {
    return $mar;
}
function agronix_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul>';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__( 'USA', 'agronix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'UK', 'agronix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'CA', 'agronix' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'AU', 'agronix' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agronix_language( $mar );
}
add_action( 'agronix_language', 'agronix_language_list' );

// favicon logo
function agronix_favicon_logo_func() {
        $agronix_favicon = get_template_directory_uri() . '/assets/img/favicon.png';
        $agronix_favicon_url = get_theme_mod( 'favicon_url', $agronix_favicon );
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $agronix_favicon_url );?>">

    <?php
}
add_action( 'wp_head', 'agronix_favicon_logo_func' );

// header logo
function agronix_header_logo() {
    ?>
    <?php
        $agronix_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $agronix_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $agronix_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.png';

        $agronix_site_logo = get_theme_mod( 'logo', $agronix_logo );
        $agronix_secondary_logo = get_theme_mod( 'seconday_logo', $agronix_logo_white );

        $header_page_logo = function_exists('get_field') ? get_field( 'header_page_logo' ) : NULL;
        $agronix_site_logo = $header_page_logo ? $header_page_logo['url'] : $agronix_site_logo; 
    ?>

        <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                if ( !empty( $agronix_logo_on ) ) {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $agronix_secondary_logo );?>" alt="<?php print get_bloginfo( 'name' ); ?>" />
                        </a>
                    <?php
                } else {
                    ?>
                        <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
                            <img src="<?php print esc_url( $agronix_site_logo );?>" alt="<?php print get_bloginfo( 'name' ); ?>" />
                        </a>
                    <?php
                }
            }
        ?>
    <?php
}

// header logo
function agronix_header_sticky_logo() {?>
    <?php
        $agronix_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
        $agronix_secondary_logo = get_theme_mod( 'seconday_logo', $agronix_logo_white );
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $agronix_secondary_logo );?>" alt="<?php print get_bloginfo( 'name' ); ?>" />
      </a>
    <?php
}

function agronix_mobile_logo() {
    // side info
    $agronix_mobile_logo_hide = get_theme_mod( 'agronix_mobile_logo_hide', false );

    $agronix_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $agronix_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $agronix_site_logo );?>" alt="<?php print get_bloginfo( 'name' ); ?>" />
        </a>
    </div>
    <?php endif;?>



<?php }


function agronix_header_search() { ?>

   <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">×</span>
      </button>
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                  <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'What are you searching for?', 'agronix' );?>">
                  <button>
                     <i class="fa fa-search"></i>
                  </button>
            </form>
         </div>
      </div>
   </div>

<?php }

/**
 * [agronix_header_social_profiles description]
 * @return [type] [description]
 */
function agronix_header_social_profiles() {
    $agronix_topbar_fb_url = get_theme_mod( 'agronix_topbar_fb_url', __( '#', 'agronix' ) );
    $agronix_topbar_twitter_url = get_theme_mod( 'agronix_topbar_twitter_url', __( '#', 'agronix' ) );
    $agronix_topbar_instagram_url = get_theme_mod( 'agronix_topbar_instagram_url', __( '#', 'agronix' ) );
    $agronix_topbar_linkedin_url = get_theme_mod( 'agronix_topbar_linkedin_url', __( '#', 'agronix' ) );
    $agronix_topbar_youtube_url = get_theme_mod( 'agronix_topbar_youtube_url', __( '#', 'agronix' ) );
    ?>
        <ul>
        <?php if ( !empty( $agronix_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $agronix_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $agronix_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $agronix_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $agronix_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $agronix_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $agronix_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $agronix_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $agronix_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $agronix_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

function agronix_footer_social_profiles() {
    $agronix_footer_fb_url = get_theme_mod( 'agronix_footer_fb_url', __( '#', 'agronix' ) );
    $agronix_footer_twitter_url = get_theme_mod( 'agronix_footer_twitter_url', __( '#', 'agronix' ) );
    $agronix_footer_instagram_url = get_theme_mod( 'agronix_footer_instagram_url', __( '#', 'agronix' ) );
    $agronix_footer_linkedin_url = get_theme_mod( 'agronix_footer_linkedin_url', __( '#', 'agronix' ) );
    $agronix_footer_youtube_url = get_theme_mod( 'agronix_footer_youtube_url', __( '#', 'agronix' ) );
    ?>

        <ul>
        <?php if ( !empty( $agronix_footer_fb_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $agronix_footer_fb_url );?>">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $agronix_footer_twitter_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $agronix_footer_twitter_url );?>">
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $agronix_footer_instagram_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $agronix_footer_instagram_url );?>">
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $agronix_footer_linkedin_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $agronix_footer_linkedin_url );?>">
                    <i class="fab fa-linkedin"></i>
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $agronix_footer_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $agronix_footer_youtube_url );?>">
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif;?>
        </ul>
<?php
}




/**
 * [agronix_header_menu description]
 * @return [type] [description]
 */
function agronix_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Agronix_Navwalker_Class::fallback',
            'walker'         => new Agronix_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [agronix_header_menu description]
 * @return [type] [description]
 */
function agronix_mobile_menu() {
    ?>
    <?php
        $agronix_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'menu_id'        => 'mobile-menu-active',
            'echo'           => false,
        ] );

    $agronix_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $agronix_menu );
        echo wp_kses_post( $agronix_menu );
    ?>
    <?php
}

/**
 * [agronix_search_menu description]
 * @return [type] [description]
 */
function agronix_header_search_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Agronix_Navwalker_Class::fallback',
            'walker'         => new Agronix_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [agronix_footer_menu description]
 * @return [type] [description]
 */
function agronix_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'Agronix_Navwalker_Class::fallback',
        'walker'         => new Agronix_Navwalker_Class,
    ] );
}


/**
 * [agronix_category_menu description]
 * @return [type] [description]
 */
function agronix_category_menu() {
    wp_nav_menu( [
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Agronix_Navwalker_Class::fallback',
        'walker'         => new Agronix_Navwalker_Class,
    ] );
}

/**
 *
 * agronix footer
 */
add_action( 'agronix_footer_style', 'agronix_check_footer', 10 );

function agronix_check_footer() {
    $agronix_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $agronix_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $agronix_footer_style == 'footer-style-1' ) {
        agronix_footer_style_1();
    } elseif ( $agronix_footer_style == 'footer-style-2' ) {
        agronix_footer_style_2();
    } elseif ( $agronix_footer_style == 'footer-style-3' ) {
        agronix_footer_style_3();
    } else {

        /** default footer style **/
        if ( $agronix_default_footer_style == 'footer-style-2' ) {
            agronix_footer_style_2();
        } elseif ( $agronix_default_footer_style == 'footer-style-3' ) {
            agronix_footer_style_3();
        } else {
            agronix_footer_style_1();
        }

    }
}

/**
 * footer  style_defaut
 */
function agronix_footer_style_1() {

   $agronix_footer_logo = get_theme_mod( 'agronix_footer_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png' );

   $footer_bg_img = get_theme_mod( 'agronix_footer_bg' );

   $agronix_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'agronix_footer_bg' ) : '';
   $agronix_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'agronix_footer_bg_color' ) : '';
   $footer_bg_color = get_theme_mod( 'agronix_footer_bg_color' );
   $agronix_footer_menu_switch = get_theme_mod( 'agronix_footer_menu_switch' );



   $footer_page_logo = function_exists('get_field') ? get_field( 'footer_page_logo' ) : NULL;
   $agronix_footer_logo = $footer_page_logo ? $footer_page_logo['url'] : $agronix_footer_logo; 

   $agronix_footer_logo_col = $agronix_footer_menu_switch ? 'col-xl-4 col-lg-4 col-md-4 col-sm-5 text-center order-first order-md-1' : 'col-xl-8 col-lg-8 col-md-8 text-end';

   // bg image
   $bg_img = !empty( $agronix_footer_bg_url_from_page['url'] ) ? $agronix_footer_bg_url_from_page['url'] : $footer_bg_img;

   // bg color
   $bg_color = !empty( $agronix_footer_bg_color_from_page ) ? $agronix_footer_bg_color_from_page : $footer_bg_color;


    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 3 );

    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        if ( is_active_sidebar( 'footer-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {

    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '4':
        $footer_class[1] = 'col-xl-3 col-lg-3 col-md-6';
        $footer_class[2] = 'col-xl-3 col-lg-3 col-md-6';
        $footer_class[3] = 'col-xl-3 col-lg-3 col-md-6';
        $footer_class[4] = 'col-xl-3 col-lg-3 col-md-6';
        break;
    case '5':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6';
        $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6';
        $footer_class[4] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6';
        $footer_class[5] = 'col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;

    }

   ?>

   <!-- footer area start --> 

   <footer>
      <?php if ( is_active_sidebar( 'footer-1' ) OR is_active_sidebar( 'footer-2' ) OR is_active_sidebar( 'footer-3' ) OR is_active_sidebar( 'footer-4' ) ): ?>
      <div class="footer-top theme-bg pt-100 pb-60" data-bg-color="<?php print esc_attr( $bg_color );?>" data-background="<?php print esc_url( $bg_img );?>">
         <div class="container">
            <div class="row">
               <?php
                    if ( $footer_columns < 5 ) {
                    print '<div class="col-xl-3 col-lg-3 col-md-6">';
                    dynamic_sidebar( 'footer-1' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-6">';
                    dynamic_sidebar( 'footer-2' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-6">';
                    dynamic_sidebar( 'footer-3' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-6">';
                    dynamic_sidebar( 'footer-4' );
                    print '</div>';
                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-' . $num );
                            print '</div>';
                        }
                    }
               ?>
           </div>
         </div>
      </div>
      <?php endif; ?>

      <div class="copy-right-area theme-bg-common pt-30">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-4 col-lg-4 col-md-4 order-last order-md-first">
                   <p class="copy-right-text mb-30"><?php print agronix_copyright_text(); ?></p>
               </div>
               <div class="<?php print esc_attr($agronix_footer_logo_col); ?>">
                  <div class="footer-logo mb-30">
                     <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url($agronix_footer_logo); ?>" alt="<?php print get_bloginfo( 'name' ); ?>"></a>
                  </div>
               </div>

               <?php if ( !empty( $agronix_footer_menu_switch ) ): ?>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-7 order-md-last">
                   <div class="useful_link mb-30">
                       <ul>
                           <li><a href="#"><?php print esc_html__( 'Faq', 'agronix' );?></a></li>
                           <li><a href="#"><?php print esc_html__( 'About Us', 'agronix' );?></a></li>
                           <li><a href="#"><?php print esc_html__( 'Terms & Conditions', 'agronix' );?></a></li>
                       </ul>
                   </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </footer>


<?php
}

/**
 * footer  style 2
 */
function agronix_footer_style_2() {

   $agronix_footer_logo = get_theme_mod( 'agronix_footer_logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );
   $footer_copyright_img = get_theme_mod( 'agronix_footer_copyright_img', get_template_directory_uri() . '/assets/img/service/payment.png' );

   $footer_bg_img = get_theme_mod( 'agronix_footer_bg' );
   $agronix_footer_logo = get_theme_mod( 'agronix_footer_logo' );

   $footer_page_logo = function_exists('get_field') ? get_field( 'footer_page_logo' ) : NULL;
   $agronix_footer_logo = $footer_page_logo ? $footer_page_logo['url'] : $agronix_footer_logo; 

   $copyright_page_logo = function_exists('get_field') ? get_field( 'footer_copyright_page_logo' ) : NULL;
   $footer_copyright_img = $copyright_page_logo ? $copyright_page_logo['url'] : $footer_copyright_img; 
   
   $footer_columns = 0;
   $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

   for ( $num = 1; $num <= $footer_widgets; $num++ ) {
      if ( is_active_sidebar( 'footer-2-' . $num ) ) {
         $footer_columns++;
      }
   }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-4 col-md-4';
        $footer_class[2] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[3] = 'col-xl-5 col-lg-5 col-md-4 col-sm-6';
        break;
    case '4':
        $footer_class[1] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[2] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[3] = 'col-lg-3 col-md-6 col-sm-6';
        $footer_class[4] = 'col-lg-3 col-md-6 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

    ?>

   <!-- footer area start -->
   <footer>
      <?php if ( is_active_sidebar('footer-2-1') OR is_active_sidebar('footer-2-2') OR is_active_sidebar('footer-2-3') ): ?>
      <div class="footer-top footer-top-2 pt-80 pb-40">
         <div class="container">
            <div class="footer-features white-bg mb-70">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-3 col-md-4 col-12">
                        <div class="footer-logo mb-20">
                           <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url($agronix_footer_logo); ?>" alt="<?php print get_bloginfo( 'name' ); ?>"></a>
                        </div>
                     </div> 
                     <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                        <div class="footer-features-item mb-20">
                           <i class="flaticon-fields"></i>
                           <h5 class="footer-features-title"><?php print esc_html__( 'We Use New Technology', 'agronix' );?></h5>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                        <div class="footer-features-item mb-20">
                           <i class="flaticon-sapling"></i>
                           <h5 class="footer-features-title"><?php print esc_html__( 'Some of the partners & clients', 'agronix' );?></h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
                <?php
                    if ( $footer_columns > 3 ) {
                    print '<div class="col-xl-4 col-lg-4 col-md-4">';
                    dynamic_sidebar( 'footer-2-1' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-2-2' );
                    print '</div>';

                    print '<div class="col-xl-5 col-lg-5 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-2-3' );
                    print '</div>';

                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-2-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-2-' . $num );
                            print '</div>';
                        }
                    }
                ?>
            </div>
         </div>
      </div>
      <?php endif; ?>

      <div class="copy-right-area theme-bg-common pt-30">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                   <p class="mb-30 copy-right-text-1"><?php print agronix_copyright_text(); ?></p>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                   <div class="payment-img mb-30 f-right">
                     <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url($footer_copyright_img); ?>" alt="<?php print esc_attr__( 'Copyright Img', 'agronix' );?>"></a>
                   </div>
               </div>
            </div>
         </div>
      </div>
   </footer>

<?php
}


// footer style 03
function agronix_footer_style_3() {

   $agronix_footer_logo = get_theme_mod( 'agronix_footer_logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );
   $footer_copyright_img = get_theme_mod( 'agronix_footer_copyright_img', get_template_directory_uri() . '/assets/img/service/payment.png' );

   $footer_bg_img = get_theme_mod( 'agronix_footer_bg' );
   $agronix_footer_logo = get_theme_mod( 'agronix_footer_logo' );

   $footer_page_logo = function_exists('get_field') ? get_field( 'footer_page_logo' ) : NULL;
   $agronix_footer_logo = $footer_page_logo ? $footer_page_logo['url'] : $agronix_footer_logo; 

   $copyright_page_logo = function_exists('get_field') ? get_field( 'footer_copyright_page_logo' ) : NULL;
   $footer_copyright_img = $copyright_page_logo ? $copyright_page_logo['url'] : $footer_copyright_img; 

   // footer_columns
   $footer_columns = 0;
   $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        if ( is_active_sidebar( 'footer-3-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-4 col-md-4';
        $footer_class[2] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[3] = 'col-xl-5 col-lg-5 col-md-4 col-sm-6';
        break;
    case '4':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-70';
        $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-90';
        $footer_class[4] = 'col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        break;
    case '5':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-70';
        $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-90';
        $footer_class[4] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6';
        $footer_class[5] = 'col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

    ?>

   <!-- footer area start --> 
   <footer >
      <?php if ( is_active_sidebar('footer-3-1') OR is_active_sidebar('footer-3-2') OR is_active_sidebar('footer-3-3') ): ?>
      <div class="footer-top footer-top-3 pt-80 pb-40">
         <div class="container">
            <div class="footer-features h3-gray-bg mb-70">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-3 col-md-4 col-12">
                        <div class="footer-logo mb-20">
                           <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url($agronix_footer_logo); ?>" alt="<?php print get_bloginfo( 'name' ); ?>"></a>
                        </div>
                     </div> 
                     <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                        <div class="footer-features-item-h3 footer-features-item mb-20">
                           <i class="flaticon-fields"></i>
                           <h5 class="footer-features-title-h3 footer-features-title"><?php print esc_html__( 'We Use New Technology', 'agronix' );?></h5>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                        <div class="footer-features-item-h3 footer-features-item mb-20">
                           <i class="flaticon-sapling"></i>
                           <h5 class="footer-features-title-h3 footer-features-title">
                             <?php print esc_html__( 'Some of the partners & clients', 'agronix' );?>
                          </h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <?php
                    if ( $footer_columns > 3 ) {
                    print '<div class="col-xl-4 col-lg-4 col-md-4">';
                    dynamic_sidebar( 'footer-3-1' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-3-2' );
                    print '</div>';

                    print '<div class="col-xl-5 col-lg-5 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-3-3' );
                    print '</div>';

                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-3-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-3-' . $num );
                            print '</div>';
                        }
                    }
               ?>
            </div>
         </div>
      </div>
      <?php endif; ?>

      <div class="copy-right-area h3-deep-bg pt-30">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                   <p class="mb-30 copy-right-text-2 copy-right-text-1"><?php print agronix_copyright_text(); ?></p>
               </div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                   <div class="payment-img mb-30 f-right">
                       <a href="<?php print esc_url( home_url( '/' ) );?>"><img src="<?php print esc_url($footer_copyright_img); ?>" alt="<?php print esc_attr__( 'Copyright Img', 'agronix' );?>"></a>
                   </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- footer area end -->


<?php
}


// agronix_copyright_text
function agronix_copyright_text() {
   print get_theme_mod( 'agronix_copyright', esc_html__( 'Copyright & Design By ThemePure - 2022', 'agronix' ) );
}

/**
 * [agronix_breadcrumb_func description]
 * @return [type] [description]
 */
function agronix_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image') : '';

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod( 'breadcrumb_blog_title', __( 'Blog', 'agronix' ) );
        $breadcrumb_class = 'home_front_page';
    } 
    elseif ( is_front_page() ) {
        $title = get_theme_mod( 'breadcrumb_blog_title', __( 'Blog', 'agronix' ) );
        $breadcrumb_show = 0;  
    } 

    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    
    elseif ( is_home() && function_exists('tutor') ) {
         if ( get_option( 'page_for_posts' ) ) {

            $user_name = sanitize_text_field(get_query_var('tutor_student_username'));
            $get_user = tutor_utils()->get_user_by_login($user_name);
   
            if ( $get_user == NULL ) {
               $title = get_the_title( get_option( 'page_for_posts' ) );
               $id = get_option( 'page_for_posts' );
            }
            else {
               $title = ucwords($get_user->user_login);
            }
            
        }
        
    } 
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'agronix' ) );
    } 
    elseif ( is_single() && 'bdevs-services' == get_post_type() ) {
        $title = get_the_title();

    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'agronix' );
    } 
    elseif ( is_single() && 'bdevs-event' == get_post_type() ) {
      $title = esc_html__( 'Event Details', 'agronix' );
    } 
    elseif ( is_single() && 'bdevs-cases' == get_post_type() ) {
        $title = get_the_title();
    } 
    elseif ( is_search() ) {

        $title = esc_html__( 'Search Results for : ', 'agronix' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'agronix' );
    } 
    elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'agronix' ) );
    } 
    elseif ( is_archive() ) {

        $title = get_the_archive_title();
    } 
    // elseif( get_option('page_for_posts') == true ) {
    //   $title = get_the_title( get_option('page_for_posts', true) );
    // }
    else {
        $title = get_the_title();
    }
 


    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';

    if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

        // get_theme_mod
        $bg_img_url = get_template_directory_uri() . '/assets/img/page-title/page-title.jpg';
        $bg_img = get_theme_mod( 'breadcrumb_bg_img' );
        $agronix_breadcrumb_shape_switch = get_theme_mod( 'agronix_breadcrumb_shape_switch', true );

        if ( $hide_bg_img ) {
            $bg_img = '';
        } else {
            $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }?>


         <!-- page__title -start -->
         <div class="page__title align-items-center theme-bg-primary-h1 pt-140 pb-135 <?php print esc_attr( $breadcrumb_class );?>">
            <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="page__title-content text-center">
                            <div class="page_title__bread-crumb">
                              <nav aria-label="breadcrumb">
                                 <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <?php 
                                    if(function_exists('bcn_display')) {
                                       bcn_display();
                                    } ?>
                                 </nav> 
                              </nav>
                            </div>
                            <h3 class="breadcrumb-title breadcrumb-title-sd mt-30"><?php echo wp_kses_post( $title ); ?></h3>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <!-- page__title -end -->
        <?php
}
}

add_action( 'agronix_before_main_content', 'agronix_breadcrumb_func' );

// agronix_search_form
function agronix_search_form() {
    ?>
     <div class="search-wrapper p-relative transition-3 d-none">
         <div class="search-form transition-3">
             <form method="get" action="<?php print esc_url( home_url( '/' ) );?>" >
                 <input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Enter Your Keyword', 'agronix' );?>" >
                 <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
             </form>
             <a href="javascript:void(0);" class="search-close"><i class="far fa-times"></i></a>
         </div>
     </div>
   <?php
}

add_action( 'agronix_before_main_content', 'agronix_search_form' );


/**
 *
 * pagination
 */
if ( !function_exists( 'agronix_pagination' ) ) {

    function _agronix_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function agronix_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _agronix_pagi_callback( $pagi );
    }
}


// header top bg color
function agronix_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'agronix_breadcrumb_bg_color', '#222' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'agronix-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_breadcrumb_bg_color' );

// breadcrumb-spacing top
function agronix_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'agronix_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'agronix-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function agronix_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'agronix_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'agronix-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_breadcrumb_bottom_spacing' );

// scrollup
function agronix_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'agronix_scrollup_switch', false );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'agronix-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_scrollup_switch' );

// theme color
function agronix_custom_color() {
    $color_code = get_theme_mod( 'agronix_color_option', '#2b4eff' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".demo-color { background-color: " . $color_code . "}";

        $custom_css .= ".demo-color { color: " . $color_code . "}";

        $custom_css .= ".demo-color { fill: " . $color_code . "}";
        $custom_css .= ".demo-color { border-color: " . $color_code . "}";
        $custom_css .= ".demo-color { border-left-color: " . $color_code . "}";
        $custom_css .= ".demo-color { stroke: " . $color_code . "}";
        $custom_css .= ".demo-color { border-color: " . $color_code . "}";
        wp_add_inline_style( 'agronix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_custom_color' );


// theme color
function agronix_custom_color_primary() {
    $color_code = get_theme_mod( 'agronix_color_option_2', '#f2277e' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".course__tag a:nth-child(2), .price__offer span, .cta__content span, .page__title-pre:hover, .banner__item span, .events__join-btn a { background-color: " . $color_code . "}";

        $custom_css .= ".row .col-xxl-4:nth-child(3) .blog__tag a, .events__info-discount span { color: " . $color_code . "}";

        $custom_css .= ".price__offer span::after { border-left-color: " . $color_code . "}";
        wp_add_inline_style( 'agronix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_custom_color_primary' );
// theme color
function agronix_custom_color_scrollup() {
    $color_code = get_theme_mod( 'agronix_color_scrollup', '#2b4eff' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".progress-wrap::after { color: " . $color_code . "}";
        $custom_css .= ".progress-wrap svg.progress-circle path { stroke: " . $color_code . "}";
        wp_add_inline_style( 'agronix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_custom_color_scrollup' );

// theme color
function agronix_custom_color_secondary() {
    $color_code = get_theme_mod( 'agronix_color_option_3', '#30a820' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".price__features ul li:hover i { background-color: " . $color_code . "}";

        $custom_css .= ".price__features ul li:hover, .price__features ul li i, .about__list ul li i, .price__features ul li:hover, .price__features ul li i, .about__list ul li i, .events__allow ul li i { color: " . $color_code . "}";

        $custom_css .= "asdf { border-color: " . $color_code . "}";
        wp_add_inline_style( 'agronix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_custom_color_secondary' );

// theme color
function agronix_custom_color_secondary_2() {
    $color_code = get_theme_mod( 'agronix_color_option_3_2', '#ffb352' );
    wp_enqueue_style( 'agronix-custom', AGRONIX_THEME_CSS_DIR . 'agronix-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".asf { background-color: " . $color_code . "}";

        $custom_css .= ".slider__content > span { color: " . $color_code . "}";

        $custom_css .= "asdf { border-color: " . $color_code . "}";
        wp_add_inline_style( 'agronix-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'agronix_custom_color_secondary_2' );


// agronix_kses_intermediate
function agronix_kses_intermediate( $string = '' ) {
    return wp_kses( $string, agronix_get_allowed_html_tags( 'intermediate' ) );
}

function agronix_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function agronix_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
   );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}