<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  agronix
 */
get_header(); ?>


     <div class="services-details-area mt-120 mb-40">
        <div class="container">
            <?php 
            if( have_posts() ):
                while( have_posts() ): the_post();
                    $department_details_thumb = function_exists('get_field') ? get_field('department_details_thumb') : '';
            ?>
           <div class="row">
              <div class="col-xl-9 col-lg-8">
                 <div class="services-information mb-50">
                    <?php if (!empty($department_details_thumb['url'])) : ?>
                    <img src="<?php echo esc_url($department_details_thumb['url']); ?>" alt="img" class="img-fluid mb-40">
                    <?php endif; ?>
                    <h5 class="services-details-title"><?php the_title(); ?></h5>

                    <?php the_content(); ?>

                 </div>
              </div>

              <?php if ( is_active_sidebar( 'services-sidebar' ) ) : ?>
              <div class="col-xl-3 col-lg-4">
                 <div class="services-sidebar">
                    <?php do_action("agronix_service_sidebar"); ?>
                 </div>
              </div>
              <?php endif; ?>
           </div>
            <?php 
                endwhile; wp_reset_query();
            endif; 
            ?>
        </div>
     </div>



<?php get_footer();  ?>