<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category XOXWooCommerceCarousel
 * @package  XOXPackage
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

if ( file_exists( dirname( __FILE__ ) . '/cmb2-attached-posts/cmb2-attached-posts-field.php' ) )
require_once dirname( __FILE__ ) . '/cmb2-attached-posts/cmb2-attached-posts-field.php';

//Fiqi Function switch
function initialize_showcase_meta_box() { 
	require_once dirname( __FILE__ ) . '/cmb2/switch_metafield.php';
}

add_action('init', 'initialize_showcase_meta_box', 9999 );

function load_custom_cmb2_script() { 
	wp_enqueue_style( 'cmb2_switch-css', plugin_dir_url( __FILE__ ) . 'cmb2/css/switch_metafield.css', false, '1.0.0' );
	wp_enqueue_script( 'cmb2_switch-js', plugin_dir_url( __FILE__ ) . 'cmb2/js/switch_metafield.js' , '', '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'load_custom_cmb2_script', 20 );
//endFiqi

function get_product_cat(){
    $tname = array();
    $product_cats = get_terms( array('taxonomy' => 'product_cat', 'orderby' => 'id', 'hide_empty' => false) );
    foreach($product_cats as $cat){
        $tname[ $cat->slug ] = $cat->name;
    }
    return $tname;
}

add_action( 'cmb2_init', 'xox_main_box' );//create the first box before all other box

function xox_main_box() {
    
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_xoxcs_';
    
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_main = new_cmb2_box( array(
		'id'            => $prefix . 'main_select',
		'title'         => __( 'XoX Carousel/Slider', 'cmb2' ),
		'object_types'  => array( 'xox-carousel-slider', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

    $cmb_main->add_field( array(
		'name'             => __( 'Is this a Slider or Carousel ?!', 'cmb2' ),
		'desc'             => __( 'Chose whether this is a slider or carousel', 'cmb2' ),
		'id'               => $prefix . 'radio_cs',
		'type'             => 'radio_inline',
		'default'          => 'slider',
		'options'          => array(
			'slider' => __( 'Slider', 'cmb2' ),
			'carousel'   => __( 'Carousel', 'cmb2' ),
		),
	) );
}

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/cmb2/cmb-slider-options.php';

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/cmb2/cmb-carousel-options.php';

add_action( 'cmb2_init', 'xox_nav_box' );

function xox_nav_box() {
    $prefix = '_xoxcs_nav_';
    
    $cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'navigation',
		'title'         => __( 'Navigation Options', 'cmb2' ),
		'object_types'  => array( 'xox-carousel-slider', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Navigation and Pager', 'cmb2' ),
		'desc' => __( 'By default navigation and pager will be using font-awesome', 'cmb2' ),
		'id'   => $prefix . 'title_nav',
		'type' => 'title',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Use Navigation?!', 'cmb2' ),
		'desc'             => __( 'Navigation is the 2 arrows that help you select the desired item', 'cmb2' ),
		'id'               => $prefix . 'navigation',
		'type'             => 'switch',
		'default'          => 'yes',
		'options'          => array(
			'yes' => __( 'Yes', 'cmb2' ),
			'no'   => __( 'No', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Slider Navigation', 'cmb2' ),
		'desc'             => __( 'Select the type on Slider Navigation you want to use', 'cmb2' ),
		'id'               => $prefix . 'navtype',
		'type'             => 'select',
		'show_option_none' => false,
        'default'          => 'default',
		'options'          => array(
			'default' => __( 'Default', 'cmb2' ),
			'image'   => __( 'Image', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name'    => __( 'Navigation Color', 'cmb2' ),
		'desc'    => __( 'Chose Navigation Color for you slider<br>Note: This will not work if you chose "Image" for your navigation', 'cmb2' ),
		'id'      => $prefix . 'navcolor',
		'type'    => 'colorpicker',
		'default' => '#000000',
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Previous Navigation Image', 'cmb2' ),
		'desc' => __( 'Upload an image for Previous Navigation', 'cmb2' ),
		'id'   => $prefix . 'nav_prev_img',
		'type' => 'file',
	) );
    
    $cmb_demo->add_field( array(
		'name' => __( 'Next Navigation Image', 'cmb2' ),
		'desc' => __( 'Upload an image for Next Navigation', 'cmb2' ),
		'id'   => $prefix . 'nav_next_img',
		'type' => 'file',
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Use Pager?!', 'cmb2' ),
		'desc'             => __( 'Pager is a navigation tool, normally indicate the number of slider and active slider', 'cmb2' ),
		'id'               => $prefix . 'pager',
		'type'             => 'switch',
		'default'          => 'yes',
		'options'          => array(
			'yes' => __( 'Yes', 'cmb2' ),
			'no'   => __( 'No', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name'             => __( 'Pager Type', 'cmb2' ),
		'desc'             => __( 'Chose between using bullets (default) or number as your slider pager', 'cmb2' ),
		'id'               => $prefix . 'pager_type',
		'type'             => 'radio_inline',
		'default'          => 'bullet',
		'options'          => array(
			'bullet' => __( 'Bullet', 'cmb2' ),
			'number'   => __( 'Number', 'cmb2' ),
		),
	) );
    
    $cmb_demo->add_field( array(
		'name'    => __( 'Pager Color', 'cmb2' ),
		'desc'    => __( 'Chose your pagers default color', 'cmb2' ),
		'id'      => $prefix . 'pager_color',
		'type'    => 'colorpicker',
		'default' => '#000000',
	) );
    
}

add_action( 'cmb2_init', 'xox_source_data' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function xox_source_data() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_xox_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'cslider',
		'title'        => __( 'Data Source', 'cmb2' ),
		'object_types' => array( 'xox-carousel-slider', ),
	) );

    $cmb_group->add_field( array(
		'name'    => __( 'Data Source', 'cmb2' ),
		'desc'    => __( 'Chose the Slider/Carousel data source', 'cmb2' ),
		'id'      => $prefix . 'source',
		'type'    => 'radio',
        'default' => 'product_cat',
		'options' => array(
			'product_cat' => __( 'Product Category', 'cmb2' ),
			'products' => __( 'Products inside a Category', 'cmb2' ),
			'featured' => __( 'Featured Products', 'cmb2' ),
			'latest' => __( 'Latest Products', 'cmb2' ),
			'bestseller' => __( 'Best Seller Products', 'cmb2' ),
			'single' => __( 'Single products', 'cmb2' ),
            'custom' => __( 'Custom', 'cmb2' ),
		),
	) );
    
    $cmb_group->add_field( array(
        'name'     => __( 'Product Category', 'cmb2' ),
        'desc'     => __( 'This option only works when you chose "Products inside a Category" as the data source' ),
        'id'       => $prefix . 'taxonomy_pcat',
        //'taxonomy' => 'product_cat', //Enter Taxonomy Slug
        'type'     => 'radio',
        'options' => get_product_cat(),
    ) );

    $cmb_group->add_field( array(
    	'name'    => __( 'Select products', 'cmb2' ),
    	'desc'    => __( 'Drag products from the left column to the right column to attach them to this page.<br />You may rearrange the order of the products in the right column by dragging and dropping.', 'cmb2' ),
    	'id'      => $prefix . 'single',
    	'type'    => 'custom_attached_posts',
    	'options' => array(
    		'show_thumbnails' => true, // Show thumbnails on the left
    		'filter_boxes'    => true, // Show a text box for filtering the results
    		'query_args'      => array(
    			'posts_per_page' => 10,
    			'post_type'      => 'product',
    		), // override the get_posts args
    	),
    ) );

	$group_field_id = $cmb_group->add_field( array(
        'name'    => __( 'Custom Slider/Carousel', 'cmb2' ),
		//'desc'    => __( 'Chose the Slider/Carousel data source', 'cmb2' ),
		'id'          => $prefix . 'custom',
		'type'        => 'group',
		'description' => __( 'Custom Slider/Carousel', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Item {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Item', 'cmb2' ),
			'remove_button' => __( 'Remove Item', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
    
	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Entry Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Image Caption', 'cmb2' ),
		'id'   => 'image_caption',
		'type' => 'text',
	) );
    
    $cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'URL', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );
    
}
