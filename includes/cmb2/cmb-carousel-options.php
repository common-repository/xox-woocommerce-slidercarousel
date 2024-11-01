<?php
function get_carousel_template(){
    $tname = array();
    foreach( glob(plugin_dir_path( dirname( __FILE__ ) ) . 'templates/carousel/*', GLOB_ONLYDIR) as $filename ){
        $theme = str_replace(plugin_dir_path( dirname( __FILE__ ) ). 'templates/carousel/', '', $filename);
        // $file = str_replace('.php','',$filename);
        $value = ucfirst(str_replace('-', ' ', $theme));
        $tname[$theme] = $value;
        //var_dump($filename);
    }
    return $tname;
}
add_action( 'cmb2_init', 'xox_carousel_box' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function xox_carousel_box() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_xoxcarousel_';

	/**
	 * General Options for Sliders
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'carousel_box',
		'title'         => __( 'XoX Carousel Options', 'cmb2' ),
		'object_types'  => array( 'xox-carousel-slider', ), // Post type
		//'show_on_cb'    => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Carousel General Options', 'cmb2' ),
		'desc' => __( '', 'cmb2' ),
		'id'   => $prefix . 'title_general',
		'type' => 'title',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Select the carousel scroll', 'cmb2' ),
		'desc'             => __( 'Determine the scroll direction that you want for your slider', 'cmb2' ),
		'id'               => $prefix . 'scroll',
		'type'             => 'select',
		'show_option_none' => false,
        'default'          => 'default',
		'options'          => array(
			'default' => __( 'Default (Horizontal)', 'cmb2' ),
			'vertical'   => __( 'Vertical', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Time Out', 'cmb2' ),
		'desc' => __( 'Enter the time out of the carousel to start sliding<br>(in miliseconds, ie: 3000 this will equal 3.0 seconds)', 'cmb2' ),
		'id'   => $prefix . 'timeout',
        'default' => '1000',
		'type' => 'text_small',
		// 'repeatable' => true,
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Visible Item', 'cmb2' ),
		'desc' => __( 'Enter the number of items going to be displayed', 'cmb2' ),
		'id'   => $prefix . 'visible',
        'default' => '5',
		'type' => 'text_small',
		// 'repeatable' => true,
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Carousel Theme', 'cmb2' ),
		'desc'             => __( 'Select the theme you want to use for your Carousel', 'cmb2' ),
		'id'               => $prefix . 'template',
		'type'             => 'radio',
		'show_option_none' => false,
        //'default'          => 'default',
		'options'          => get_carousel_template(),
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
		'desc' => __( 'Upload an image for the Carousel background', 'cmb2' ),
		'id'   => $prefix . 'bgimage',
		'type' => 'file',
	) );
    
}