<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package agronix
 */

$categories = get_the_terms( $post->ID, 'category' );

$agronix_blog_date = get_theme_mod( 'agronix_blog_date', true );
$agronix_blog_comments = get_theme_mod( 'agronix_blog_comments', true );
$agronix_blog_author = get_theme_mod( 'agronix_blog_author', true );
$agronix_blog_cat = get_theme_mod( 'agronix_blog_cat', false );


if ( is_single() ):
?>
    <article id="post-<?php the_ID();?>" <?php post_class( 'single-news mb-55 format-image' );?>>
        <?php if ( has_post_thumbnail() ): ?>    
        <div class="news-thumb">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>

        <div class="news-detalis-content news-detalis-content-2">
            <ul class="blog-meta mb-20">
                <?php if ( !empty($agronix_blog_author) ): ?>
               <li><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><i class="fal fa-user"></i><?php print get_the_author();?></a></li>
               <?php endif;?>

               <?php if ( !empty($agronix_blog_comments) ): ?>
               <li><a href="<?php comments_link();?>"><i class="fal fa-comments"></i> <?php comments_number();?></a></li>
               <?php endif;?>

               <?php if ( !empty($agronix_blog_date) ): ?>
               <li><i class="fal fa-calendar-alt"></i> <?php the_time( get_option('date_format') ); ?></li>
               <?php endif;?>
            </ul>

            <h4 class="news-title mt-20 mb-20">
              <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h4>
            <div class="post-text mb-20">
               <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'agronix' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
            </div>
            <?php print agronix_get_tag();?>
        </div>
    </article>
<?php
else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'single-news mb-55 format-image' );?> data-wow-delay=".3s">
        <?php if ( has_post_thumbnail() ): ?>    
        <div class="news-thumb">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>

        <div class="news-detalis-content news-detalis-content-2">
            <ul class="blog-meta mb-20">
                <?php if ( !empty($agronix_blog_author) ): ?>
               <li><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><i class="fal fa-user"></i><?php print get_the_author();?></a></li>
               <?php endif;?>

               <?php if ( !empty($agronix_blog_comments) ): ?>
               <li><a href="<?php comments_link();?>"><i class="fal fa-comments"></i> <?php comments_number();?></a></li>
               <?php endif;?>

               <?php if ( !empty($agronix_blog_date) ): ?>
               <li><i class="fal fa-calendar-alt"></i> <?php the_time( get_option('date_format') ); ?></li>
               <?php endif;?>
            </ul>

           <h4 class="news-title mt-20 mb-20">
              <a href="<?php the_permalink();?>"><?php the_title();?></a>
           </h4>

            <div class="post-text mb-20">
                <?php the_excerpt();?>
            </div>
            <!-- blog btn -->

            <?php
                $agronix_blog_btn = get_theme_mod( 'agronix_blog_btn', 'Read More' );
                $agronix_blog_btn_switch = get_theme_mod( 'agronix_blog_btn_switch', true );
            ?>

            <?php if ( !empty( $agronix_blog_btn_switch ) ): ?>
           <div class="read-button mt-30">
              <a href="<?php the_permalink();?>" class="read-btn"><i class="fal fa-arrow-circle-right"></i><?php print esc_html( $agronix_blog_btn );?></a>
           </div>    
            <?php endif;?>
        </div>
    </article>
<?php
endif;?>
