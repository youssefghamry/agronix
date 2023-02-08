<?php
/**
 * Medodove Social Widget
 *
 *
 * @author         basictheme
 * @category     Widgets
 * @package     Medodove/Widgets
 * @version     1.0.1
 * @extends     WP_Widget
 */
add_action( 'widgets_init', 'bdevs_services_form_widget' );
function bdevs_services_form_widget() {
    register_widget( 'bdevs_services_form_widget' );
}

class bdevs_services_form_widget extends WP_Widget {

    public function __construct() {
        parent::__construct( 'bdevs_services_form_widget', esc_html__( 'Agronix Services Form', 'bdevs-toolkit' ), [
            'description' => esc_html__( 'Agronix Services Form Widget', 'bdevs-toolkit' ),
        ] );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );
        print $before_widget;

        if ( !empty( $title ) ) {
            print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
        }
        ?>

			<?php if ( !empty( $mailchimp_shortcode ) ): ?>

           <div class="custome-form mt-40">
              <?php print do_shortcode( $mailchimp_shortcode );?>
           </div>
            <?php endif;?>

	    	<?php print $after_widget;?>

		<?php
}

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     * @param array $instance
     * @return void
     */
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $mailchimp_shortcode = isset( $instance['mailchimp_shortcode'] ) ? $instance['mailchimp_shortcode'] : '';
        ?>
			<p>
				<label for="title"><?php esc_html_e( 'Title:', 'bdevs-toolkit' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'title' ) );?>"  class="widefat" name="<?php print esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php print esc_attr( $title );?>">

			<p>
				<label for="title"><?php esc_html_e( 'Mailchimp Shortcode:', 'bdevs-toolkit' );?></label>
			</p>
			<input type="text" id="<?php print esc_attr( $this->get_field_id( 'mailchimp_shortcode' ) );?>" class="widefat" name="<?php print esc_attr( $this->get_field_name( 'mailchimp_shortcode' ) );?>" value="<?php print esc_attr( $mailchimp_shortcode );?>">

			<?php
}

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['subscribe_style'] = ( !empty( $new_instance['subscribe_style'] ) ) ? strip_tags( $new_instance['subscribe_style'] ) : '';
        $instance['mailchimp_shortcode'] = ( !empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';
        return $instance;
    }
}