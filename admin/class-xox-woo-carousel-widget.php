<?php

// Creating the widget 
class wpb_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpb_widget', 

            // Widget name will appear in UI
            __('XoX WooCommerce Widget', 'wpb_widget_domain'), 

            // Widget description
            array( 'description' => __( 'X-tra Ordinary WooCommerce Caousel and Slider Widget', 'wpb_widget_domain' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $slider = $instance['slider'];
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        echo do_shortcode('[xoxslider name="'.$slider.'"]');
        echo $args['after_widget'];
    }
		
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
            $reg_slider = $instance[ 'slider' ];
        }else{
            $title = __( 'New title', 'wpb_widget_domain' );
            //$reg_slider = __( 'none', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
         $args = array(
			'posts_per_page' => -1,
			//'name' => $name,
			'post_type' => 'xox-carousel-slider',
			'post_status' => "publish",
			'orderby' => 'ID',
			'order' => 'DESC'
        );
        $sliders = get_posts($args);
        if($sliders){
            ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'slider' ); ?>"><?php _e( 'Slider:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'slider' ); ?>" name="<?php echo $this->get_field_name( 'slider' ); ?>">
            <?php foreach($sliders as $slider): ?>
            <?php $selected = $slider->post_name == $reg_slider ? ' selectd="selected"' : ''; ?>
            <option value="<?php echo $slider->post_name; ?>"<?php echo $selected; ?>><?php echo $slider->post_title; ?></option>
            <?php endforeach; ?>
            </select>
            </p>
            <?php
        }
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['slider'] = ( ! empty( $new_instance['slider'] ) ) ? strip_tags( $new_instance['slider'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );