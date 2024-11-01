<?php
new Shortcode_Tinymce();
class Shortcode_Tinymce
{
    public function __construct()
    {
        //add_action('admin_init', array($this, 'pu_shortcode_button'));
        add_action( 'admin_init', array($this, 'xox_sc_buttons') );
        add_action('admin_footer', array($this, 'pu_get_shortcodes'));
    }

    /**
     * Create a shortcode button for tinymce
     *
     * @return [type] [description]
     */
    public function xox_sc_buttons() {
        add_filter( "mce_external_plugins", array($this, "xox_sc_add_buttons") );
        add_filter( 'mce_buttons', array($this, 'xox_sc_register_buttons') );
    }

    /**
     * Add new Javascript to the plugin scrippt array
     *
     * @param  Array $plugin_array - Array of scripts
     *
     * @return Array
     */
    public function xox_sc_add_buttons( $plugin_array ) {
        $plugin_array['xoxscbtn'] = plugins_url( 'js/xox-woo-carousel-add_sc.js', __FILE__ );
        return $plugin_array;
    }

    /**
     * Add new button to tinymce
     *
     * @param  Array $buttons - Array of buttons
     *
     * @return Array
     */
    public function xox_sc_register_buttons( $buttons ) {
        array_push( $buttons, 'separator', 'xoxscbtn' ); // dropcap', 'recentposts
        return $buttons;
    }

    /**
     * Add shortcode JS to the page
     *
     * @return HTML
     */
    public function pu_get_shortcodes()
    {
        //global $shortcode_tags;
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'xox-carousel-slider',
            'post_status' => "publish"            
        );
        $sliders = get_posts($args);
        

        echo '<script type="text/javascript">
        var xox_options = new Array();';

        $count = 0;

        foreach($sliders as $slider)
        {
            echo "xox_options[{$count}] = '{$slider->post_name}';";
            $count++;
        }

        echo '</script>';
    }
}

