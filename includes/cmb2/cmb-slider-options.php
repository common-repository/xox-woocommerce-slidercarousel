<?php
function get_slider_template(){
    $tname = array();
    foreach( glob(plugin_dir_path( dirname( __FILE__ ) ) . 'templates/slider/*', GLOB_ONLYDIR) as $filename ){
        $theme = str_replace(plugin_dir_path( dirname( __FILE__ ) ). 'templates/slider/', '', $filename);
        // $file = str_replace('.php','',$filename);
        $value = ucfirst(str_replace('-', ' ', $theme));
        $tname[$theme] = $value;
        //var_dump($filename);
    }
    return $tname;
}
add_action( 'cmb2_init', 'xox_slider_box' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function xox_slider_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_xoxslider_';

	/**
	 * General Options for Sliders
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'slider_box',
		'title'         => __( 'XoX Slider Options', 'cmb2' ),
		'object_types'  => array( 'xox-carousel-slider', ), // Post type
		//'show_on_cb'    => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Slider General Options', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'title_general',
		'type' => 'title',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Select the slider effect', 'cmb2' ),
		'desc'             => __( 'Determine the effect that you want for your slider', 'cmb2' ),
		'id'               => $prefix . 'effect',
		'type'             => 'select',
		'show_option_none' => false,
        'default'          => 'none',
		'options'          => array(
			'none' => __( 'No Effect', 'cmb2' ),
			'fade'   => __( 'Fade In', 'cmb2' ),
			'fadeout'     => __( 'Fade Out', 'cmb2' ),
            'scrollHorz'   => __( 'Scroll Horizontal', 'cmb2' ),
            'ScrollVert'   => __( 'Scroll Vertical', 'cmb2' ),
			'flipHorz'     => __( 'Flip Horizontal', 'cmb2' ),
            'flipVert'   => __( 'Flip Vertical', 'cmb2' ),
			'shuffle'     => __( 'Shuffle', 'cmb2' ),
            'tileSlide'   => __( 'Tile Side', 'cmb2' ),
			'tileBlind'     => __( 'Tile Blind', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Speed', 'cmb2' ),
		'desc' => __( 'Enter the slider transition speed (in miliseconds, ie: 3000 this will equal 3.0 seconds)', 'cmb2' ),
		'id'   => $prefix . 'speed',
        'default' => '3000',
		'type' => 'text_small',
		// 'repeatable' => true,
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Slider Theme', 'cmb2' ),
		'desc'             => __( 'Select the theme you want to use for your slider', 'cmb2' ),
		'id'               => $prefix . 'template',
		'type'             => 'radio',
		'show_option_none' => false,
        //'default'          => 'default',
		'options'          =>  get_slider_template(),
	) );
    
    $cmb_demo->add_field( array(
		'name'    => __( 'Background Color', 'cmb2' ),
		'desc'    => __( 'Chose a Background Color for you slider', 'cmb2' ),
		'id'      => $prefix . 'bgcolor',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Background Image', 'cmb2' ),
		'desc' => __( 'Upload an image for the slider background', 'cmb2' ),
		'id'   => $prefix . 'bgimage',
		'type' => 'file',
	) );
    
}