<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  agronix
 */
get_header(); ?>


    <div class="project-details-area pt-120 pb-90">
        <div class="container">
            <?php 
                if( have_posts() ):
                while( have_posts() ): the_post();
                    $port_info_title = function_exists('get_field') ? get_field('port_info_title') : '';
                    $port_cat_label = function_exists('get_field') ? get_field('port_cat_label') : '';
                    $port_cat_title = function_exists('get_field') ? get_field('port_cat_title') : '';
                    $port_client_label = function_exists('get_field') ? get_field('port_client_label') : '';
                    $port_client_title = function_exists('get_field') ? get_field('port_client_title') : '';
                    $port_date_label = function_exists('get_field') ? get_field('port_date_label') : '';
                    $port_date_title = function_exists('get_field') ? get_field('port_date_title') : '';
                    $port_budget_label = function_exists('get_field') ? get_field('port_budget_label') : '';
                    $port_budget_title = function_exists('get_field') ? get_field('port_budget_title') : '';

                    $port_btn_text = function_exists('get_field') ? get_field('port_btn_text') : '';


                    $department_info_list = function_exists('get_field') ? get_field('department_info_list') : '';
                    $port_details_image = function_exists('get_field') ? get_field('port_details_image') : '';

            ?>
           <div class="row">
              <div class="col-xl-10 col-lg-10 col-md-10">
                 <div class="project-details-image">
                    <?php if (!empty($port_details_image)) : ?>
                        <img src="<?php echo esc_url($port_details_image['url']); ?>" alt="img" class="img-fluid">
                    <?php endif; ?>
                    <div class="project-d-info">

                       <?php if (!empty($department_info_list['port_info_title'])) : ?>
                       <h5 class="project-d-info-title"><?php echo wp_kses_post( $department_info_list['port_info_title'] ); ?></h5>
                       <?php endif; ?>

                       <div class="project-info-lists mt-40">
                          <?php if (!empty($department_info_list['port_cat_title'])) : ?>
                          <div class="d-info-item mb-20">
                             <h6><?php echo wp_kses_post( $department_info_list['port_cat_label'] ); ?></h6>
                             <p><?php echo wp_kses_post( $department_info_list['port_cat_title'] ); ?></p>
                          </div>
                          <?php endif; ?>

                          <?php if (!empty($department_info_list['port_client_title'])) : ?>
                          <div class="d-info-item mb-20">
                             <h6><?php echo wp_kses_post( $department_info_list['port_client_label'] ); ?></h6>
                             <p><?php echo wp_kses_post( $department_info_list['port_client_title'] ); ?></p>
                          </div>
                          <?php endif; ?>

                          <?php if (!empty($department_info_list['port_date_title'])) : ?>
                          <div class="d-info-item mb-20">
                             <h6><?php echo wp_kses_post( $department_info_list['port_date_label'] ); ?></h6>
                             <p><?php echo wp_kses_post( $department_info_list['port_date_title'] ); ?></p>
                          </div>
                          <?php endif; ?>

                          <?php if (!empty($department_info_list['port_budget_title'])) : ?>
                          <div class="d-info-item mb-20">
                             <h6><?php echo wp_kses_post( $department_info_list['port_budget_label'] ); ?></h6>
                             <p><?php echo wp_kses_post( $department_info_list['port_budget_title'] ); ?></p>
                          </div>
                          <?php endif; ?>
                       </div>

                        <?php 
                        $port_button_link = get_field('port_button_link');
                        if( $port_button_link ): 
                            $link_url = $port_button_link['url'];
                        ?>
                       <div class="project-d-btn mt-30">
                          <a href="<?php echo esc_url( $link_url ); ?>" class="tp-btn-h1 p-d-btn"><?php echo wp_kses_post( $department_info_list['port_btn_text'] ); ?> <i class="fal fa-long-arrow-right"></i></a>
                          <a href="<?php echo esc_url( $link_url ); ?>"><i class="fal fa-share mt-30"></i></a>
                       </div>
                       <?php endif; ?>
                    </div>
                 </div>
              </div>
           </div>

           <div class="project-d-descriptiopn mt-70">
            <?php the_content(); ?>
           </div>
            <?php 
                endwhile; wp_reset_query();
            endif; 
            ?>
        </div>
    </div>


<?php get_footer();  ?>