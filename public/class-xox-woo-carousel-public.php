<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.xolluteon.com/
 * @since      1.0.0
 *
 * @package    Xox_Woo_Carousel
 * @subpackage Xox_Woo_Carousel/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xox_Woo_Carousel
 * @subpackage Xox_Woo_Carousel/public
 * @author     Arung Isyadi <arungisyadi@outlook.com>
 */
class Xox_Woo_Carousel_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Xox_Woo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Xox_Woo_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $post;
		if(has_shortcode($post->post_content, 'xoxslider')){
			wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'xoxslider', plugin_dir_url( __FILE__ ) . 'css/xox-woo-carousel-public.css', array(), $this->version, 'all' );
		}        
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Xox_Woo_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
         * The Xox_Woo_Carousel_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
		
		global $post;
		if(has_shortcode($post->post_content, 'xoxslider')){
			wp_enqueue_script( 'cycle2', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.min.js', array( 'jquery' ), $this->version, true );
			// wp_enqueue_script( 'cycle2-autoheight', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.autoheight.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-caption2', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.caption2.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-carousel', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.carousel.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-center', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.center.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			// wp_enqueue_script( 'cycle2-command', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.command.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-flip', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.flip.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-ie-fade', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.ie-fade.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			// wp_enqueue_script( 'cycle2-prevnext', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.prevnext.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-scrollVert', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-shuffle', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.shuffle.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-swipe', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.swipe.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-tile', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.tile.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'cycle2-video', plugin_dir_url( __FILE__ ) . 'js/cycle/jquery.cycle2.video.min.js', array( 'jquery', 'cycle2' ), $this->version, true );
			wp_enqueue_script( 'xoxslider', plugin_dir_url( __FILE__ ) . 'js/xox-woo-carousel-public.js', array( 'jquery' ), $this->version, true );
			
			// deactivating swiper as it's now a commercial license plugin.
			// wp_enqueue_script( 'swiper-js', plugin_dir_url( __FILE__ ) . 'js/swiper/xox.swiper.js', array( 'jquery' ), $this->version, true );//Fiqi Update
		}
	}
    
    public static function xoxslider( $atts ) {
        // Attributes
        extract( shortcode_atts(
            array(
                'name' => 'slider-xxx',
            ), $atts )
        );

        //$output = $name;
        $args = array(
            'posts_per_page' => 1,
            'name' => $name,
            'post_type' => 'xox-carousel-slider',
            'post_status' => "publish"
        );
        $slider = get_posts($args);
        if($slider){
            $sliderID = $slider[0]->ID;
        }

        $output = '';
        $xtype = get_post_meta( $sliderID, '_xoxcs_radio_cs', true );
        $navigation = get_post_meta( $sliderID, '_xoxcs_nav_navigation', true );
        $pager = get_post_meta( $sliderID, '_xoxcs_nav_pager', true );
        $pager_type = get_post_meta( $sliderID, '_xoxcs_nav_pager_type', true );
        $pager_color = get_post_meta( $sliderID, '_xoxcs_nav_pager_color', true );
        $nav_color = get_post_meta( $sliderID, '_xoxcs_nav_navcolor', true );
        //$gprefix = $xtype == 'slider' ? '_xoxslider_' : '_xoxcarousel_';
        //$output = $gprefix;
         $slider_opts = '';
        if( $xtype == 'slider' ){
            $genopts = self::sliderGeneralOpt( $sliderID );
            $dir = '/slider/';
            $slider_opts .= ' data-cycle-fx="' . $genopts['effect'] . '"';
            $slider_opts .= ' data-cycle-speed="' . $genopts['speed'] . '"';
            $slider_opts .= ' data-cycle-pause-on-hover="true"';
            $slider_opts .= ' data-cycle-loader="wait"';
            $slider_opts .= ' data-cycle-swipe="true"';
            $slider_opts .= ' data-cycle-swipe-fx="scrollHorz"';
        }elseif( $xtype == 'carousel' ){
            $genopts = self::carGeneralOpt( $sliderID );
            $dir = '/carousel/';
            $slider_opts .= ' data-cycle-fx="carousel"';
            $slider_opts .= ($genopts['scroll'] == 'vertical' ? ' data-cycle-carousel-vertical="true"' : '');
            $slider_opts .= ' data-cycle-timeout="' . $genopts['timeout'] . '"';
            $slider_opts .= ' data-cycle-carousel-visible="' . $genopts['visible'] . '"';
            $slider_opts .= ' data-cycle-carousel-fluid="true"';
			$slider_opts .= ' data-cycle-carousel-offset=5';
        }
        $slider_opts .= ' data-cycle-slides="div.item-'.$sliderID.'"';//set the one need to be slide
        $slider_opts .= ' data-cycle-prev=".prevNav-'.$sliderID.'"';
        $slider_opts .= ' data-cycle-next=".nextNav-'.$sliderID.'"';
        $default_prev = '';
        $default_next = '';
        if($navigation == 'yes'){
            $prev_img = get_post_meta( $sliderID, '_xoxcs_nav_nav_prev_img', true );
            $next_img = get_post_meta( $sliderID, '_xoxcs_nav_nav_next_img', true );
            $default_prev = $prev_img != '' ? '<img src="'.$prev_img.'">' : '<i class="fa fa-chevron-left"></i>';
            $default_next = $next_img != '' ? '<img src="'.$next_img.'">' : '<i class="fa fa-chevron-right"></i>';
        }
        if($pager == 'yes'){
            $slider_opts .= ' data-cycle-pager=".item_pager-'.$sliderID.'"';
            if($pager_type == 'number'){
                $color = ($pager_color=='#ffffff')?'#222':'';
                $slider_opts .= ' data-cycle-pager-template="<strong><a href=# class=\'xox-pager-number\' style=\'background: '.$pager_color.';color: '.$color.'\';> {{slideNum}} </a></strong>"';
            }elseif($pager_type == 'bullet'){
                $slider_opts .= ' data-cycle-pager-template="<strong><a href=# class=\'xox-pager-bullet\' style=\'border-color: '.$pager_color.';background: '.$pager_color.';\'> &nbsp; </a></strong>"';
            }
        }
        
        $background = ( $genopts['bgimage'] != '' ? ' background: url("'. $genopts['bgimage'] .'") repeat top left;' : '' );//background image
        $style = ' style="background-color: ' . $genopts['bgcolor'] .';'. $background .'"';//background stuffs
        
        $output .= '<div id="'. $genopts['bgimage'] .'" class="cycle-slideshow '. $genopts['template'] .'"'.$slider_opts.$style.'>'."\n";
        
        $dataType = get_post_meta( $sliderID, '_xox_group_source', true );
        //$catType = get_post_meta( $sliderID, '_xox_group_taxonomy_pcat', true );

        // we'll load the template here
        $path = plugin_dir_path( dirname( __FILE__ ) ) . 'includes/templates' . $dir . $genopts['template'];
        $template = $path . '/layout.html';
        // var_dump($template); exit;
        if(file_exists($template)){
        	$layout = file_get_contents( $template );
        	wp_enqueue_style( 'xslider-'.$sliderID, plugin_dir_url( dirname( __FILE__ ) ) . 'includes/templates' . $dir . $genopts['template'] . '/style.css', array(), '1.3', 'all' );
        	if( $layout != '' ){
        		// var_dump($layout);
        		$the_nav = '';
        		$the_pager = '';
        		$the_loop = '';

        		// Navigation inject.
        		$nav_file = $path . '/nav.html';
        		if(file_exists($nav_file)){
        			$nav = file_get_contents($nav_file);
        			$nav = str_replace('%%template%%', $genopts['template'], $nav);
        			$nav = str_replace('%%sliderID%%', $sliderID, $nav);
        			$nav = str_replace('%%nav_color%%', $nav_color, $nav);
        			$nav = str_replace('%%default_prev%%', $default_prev, $nav);
        			$nav = str_replace('%%default_next%%', $default_next, $nav);
        			$the_nav = $nav;
        		}

        		// Pager inject
        		$page_path = $path . '/pager.html';
        		if(file_exists($page_path)){
        			$p = file_get_contents($page_path);
        			$p = str_replace('%%sliderID%%', $sliderID, $p);
        			$the_pager = $p;
        		}

        		// loop inject - looping the query here - put last to not breaking others
        		$loop_path = $path . '/loop.html';
        		if(file_exists($loop_path)){
        			// query start here
        			 $loops = self::MakeLoop($dataType, $sliderID, $xtype); //echo $catType;
        			 
        			 if($loops && is_array($loops)){
        			 	$loops = array_values($loops);
        			 	// var_dump($loops); exit;
        			 	$canvas = array();
        			 	for($x =0; $x < count($loops); $x++){
        			 		$q[$x] = file_get_contents($loop_path);
        			 		$canvas[$x] = '';
        			 		$canvas[$x] = str_replace(array('%%template%%','%%sliderID%%','%%xtype%%','%%img%%','%%title%%','%%text%%','%%url%%','%%price%%','%%reg_price%%','%%sale_price%%'), array($genopts['template'],$sliderID,$xtype,$loops[$x]['img'],$loops[$x]['title'],$loops[$x]['text'],$loops[$x]['url'],$loops[$x]['price'],$loops[$x]['reg_price'],$loops[$x]['sale_price']), $q[$x]);
        			 	}
        			 	// var_dump($canvas); exit;
        			 	$loop_str = implode("\n", $canvas);
					}else{
						$loop_str = '';
					}
					$the_loop = $loop_str;
        		}
        		// base layout inject

        		$layout = str_replace(array('%%template%%','%%sliderID%%','%%xtype%%','%%navigation%%','%%pagination%%','%%loop%%'), array($genopts['template'],$sliderID,$xtype,$the_nav,$the_pager,$the_loop), $layout);
        	}
        	$output .= $layout;
        }else{
        	exit('ERROR: Missing layout structure');
        }
       
        $output .= "</div>\n";
        
        return $output;
    }
    
    private static function sliderGeneralOpt($sliderID){
        $prefix = '_xoxslider_';
        $return = array();
        
        $return['effect'] = get_post_meta( $sliderID, $prefix . 'effect', true);
        $return['speed'] = get_post_meta( $sliderID, $prefix . 'speed', true);
        $return['template'] = get_post_meta( $sliderID, $prefix . 'template', true);
        $return['bgcolor'] = get_post_meta( $sliderID, $prefix . 'bgcolor', true);
        $return['bgimage'] = get_post_meta( $sliderID, $prefix . 'bgimage', true);
        
        return $return;

    }
    
    private static function carGeneralOpt($sliderID){
        $prefix = '_xoxcarousel_';
        $return = array();
        
        $return['scroll'] = get_post_meta( $sliderID, $prefix . 'scroll', true);
        $return['timeout'] = get_post_meta( $sliderID, $prefix . 'timeout', true);
        $return['visible'] = get_post_meta( $sliderID, $prefix . 'visible', true);
        $return['template'] = get_post_meta( $sliderID, $prefix . 'template', true);
        $return['bgcolor'] = get_post_meta( $sliderID, $prefix . 'bgcolor', true);
        $return['bgimage'] = get_post_meta( $sliderID, $prefix . 'bgimage', true);
        
        return $return;

    }
    
    private static function MakeLoop($dataType, $sliderID, $xtype){
        GLOBAL $woocommerce;
        $return = array();
        $thumb_size ='full-size';

        switch($dataType){
            case 'product_cat':
            
            $cat = get_terms( 'product_cat', array(
            	'orderby' => 'id',
            	'hide_empty' => false
            	));
            $num = count($cat);
            for($i = 0; $i < $num; $i++){
                $thumbnail_id = get_woocommerce_term_meta( $cat[$i]->term_id, 'thumbnail_id', true );
				//conditional if tumbnail is null
                if($thumbnail_id != ''){
                    $image_attributes = wp_get_attachment_image_src( $thumbnail_id, $thumb_size ); // returns an array
                    $return[$i]['img'] = $image_attributes[0];
                    $return[$i]['title'] = $cat[$i]->name;
                    $return[$i]['text'] = $cat[$i]->description;
                    $return[$i]['url'] = get_term_link($cat[$i]);
                    $return[$i]['price'] = '';
                    $return[$i]['reg_price'] = '';
                    $return[$i]['sale_price'] = '';               
                }
            }
            
            break;
            
            case 'products':
            
            //$cat = get_post_meta( $sliderID, '_xox_group_product_cat', true ); 
            $cat = get_post_meta( $sliderID, '_xox_group_taxonomy_pcat', true );
            $args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => $cat,
                    ),
                ),
                //'product_cat' => $product_cat,
                'post_type' => 'product',
                'post_status' => 'publish',
                'orderby' => 'ID',
                'order' => 'DESC'
            );
            $my_product = get_posts($args);
            
            if( $my_product ){
                
                $num = count($my_product);
                for($i = 0; $i < $num; $i++){
                    $product_attr = self::get_product_attr($my_product[$i]->ID);
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($my_product[$i]->ID), $thumb_size ); // returns an array
                    $return[$i]['img'] = $image_attributes[0];
                    $return[$i]['title'] = $my_product[$i]->post_title;
                    $return[$i]['text'] = $my_product[$i]->post_excerpt;
                    $return[$i]['url'] = get_permalink($my_product[$i]->ID);

                    $_product = wc_get_product( $my_product[$i]->ID );
					$return[$i]['price'] = $_product->get_price_html();
					$return[$i]['reg_price'] = $_product->get_regular_price();
					$return[$i]['sale_price'] = $_product->get_sale_price();
                }
            }
            
            break;
            
            case 'featured':
            
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'product',
                'meta_key' => '_featured',  
                'meta_value' => 'yes', 
                'post_status' => 'publish',
                'orderby' => 'ID',
                'order' => 'DESC'
            );
            $my_product = get_posts($args);
            
            if( $my_product ){
                
                $num = count($my_product);
                for($i = 0; $i < $num; $i++){
                    $product_attr = self::get_product_attr($my_product[$i]->ID);
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($my_product[$i]->ID), $thumb_size ); // returns an array
                    $return[$i]['img'] = $image_attributes[0];
                    $return[$i]['title'] = $my_product[$i]->post_title;
                    $return[$i]['text'] = $my_product[$i]->post_excerpt;
                    $return[$i]['url'] = get_permalink($my_product[$i]->ID);

                    $_product = wc_get_product( $my_product[$i]->ID );
					$return[$i]['price'] = $_product->get_price_html();
					$return[$i]['reg_price'] = $_product->get_regular_price();
					$return[$i]['sale_price'] = $_product->get_sale_price();
                }
            }
            
            break;

            case 'bestseller':

            $posts_per_page = -1;

            $meta_query = WC()->query->get_meta_query();

            $atts = array();
                
            $args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $posts_per_page,
                'meta_key'            => 'total_sales',
                'orderby'             => 'meta_value_num',
                'meta_query'          => $meta_query
            );      

            $my_products = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $args, $atts));
            
            if( $my_product ){
                $num = count($my_product);
                for($i = 0; $i < $num; $i++){
                    $product_attr = self::get_product_attr($my_product[$i]->ID);
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($my_product[$i]->ID), $thumb_size ); // returns an array
                    $return[$i]['img'] = $image_attributes[0];
                    $return[$i]['title'] = $my_product[$i]->post_title;
                    $return[$i]['text'] = $my_product[$i]->post_excerpt;
                    $return[$i]['url'] = get_permalink($my_product[$i]->ID);

                    $_product = wc_get_product( $my_product[$i]->ID );
					$return[$i]['price'] = $_product->get_price_html();
					$return[$i]['reg_price'] = $_product->get_regular_price();
					$return[$i]['sale_price'] = $_product->get_sale_price();
                }
            }
            
            break;

            case 'latest':
            
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'product',
                'meta_value' => 'yes',
                'orderby' => 'date',
                'post_status' => 'publish',
                'order' => 'DESC'
            );
            $my_product = get_posts($args);
            
            if( $my_product ){
                $num = count($my_product);
                for($i = 0; $i < $num; $i++){
                    $product_attr = self::get_product_attr($my_product[$i]->ID);
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($my_product[$i]->ID), $thumb_size ); // returns an array
                    $return[$i]['img'] = $image_attributes[0];
                    $return[$i]['title'] = $my_product[$i]->post_title;
                    $return[$i]['text'] = $my_product[$i]->post_excerpt;
                    $return[$i]['url'] = get_permalink($my_product[$i]->ID);
					
					$_product = wc_get_product( $my_product[$i]->ID );
					$return[$i]['price'] = $_product->get_price_html();
					$return[$i]['reg_price'] = $_product->get_regular_price();
					$return[$i]['sale_price'] = $_product->get_sale_price();
                }
            }
            
            break;

            case 'single':
            
            $single_arr = get_post_meta( $sliderID, '_xox_group_single', true );
            // var_dump($single_arr); exit;

            if(!empty($single_arr) && is_array($single_arr)){
            	$args = array(
            	    'posts_per_page' => -1,
            	    'post_type' => 'product',
            	    'post__in' => $single_arr,
            	    'orderby' => 'post__in',
            	    'post_status' => 'publish',
            	    'order' => 'ASC'
            	);
            	$my_product = get_posts($args);
            	
            	if( $my_product ){
            	    $num = count($my_product);
            	    for($i = 0; $i < $num; $i++){
            	        $product_attr = self::get_product_attr($my_product[$i]->ID);
            	        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($my_product[$i]->ID), $thumb_size ); // returns an array
            	        $return[$i]['img'] = $image_attributes[0];
            	        $return[$i]['title'] = $my_product[$i]->post_title;
            	        $return[$i]['text'] = $my_product[$i]->post_excerpt;
            	        $return[$i]['url'] = get_permalink($my_product[$i]->ID);

            	        $_product = wc_get_product( $my_product[$i]->ID );
            	        $return[$i]['price'] = $_product->get_price_html();
            	        $return[$i]['reg_price'] = $_product->get_regular_price();
            	        $return[$i]['sale_price'] = $_product->get_sale_price();
            	    }
            	}
            }
            
            break;
            
            case 'custom':
            
            $custom = get_post_meta( $sliderID, '_xox_group_custom', true );
            if($custom){
                $num = count($custom);
                for($i = 0; $i < $num; $i++){
                    $return[$i]['img'] = $custom[$i]['image'];
                    $return[$i]['title'] = $custom[$i]['image_caption'];
                    //$return[$i]['text'] = $custom[$i][''];
                    $return[$i]['url'] = $custom[$i]['url'];
                }
            }
            
            break;
            
        }
        return $return;
    }
    
    private static function get_product_attr($postID){
        global $woocommerce;
        $return = array();
        $product = new WC_Product_Variable($postID);

        #Step 1: Get product varations
        $available_variations = $product->get_available_variations();


        if(!empty($available_variations)){
            $return['v_regular_price'] = $available_variations[0]['display_regular_price'];
        	$return['v_sale_price'] = ($available_variations[0]['display_regular_price'] != $available_variations[0]['display_price']) ? $available_variations[0]['display_price'] : null ;
            #Step 2: Get product variation id
            $variation_id = $available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.

            #Step 3: Create the variable product object
            $variable_product1= new WC_Product_Variation( $variation_id );

            #Step 4: You have the data. Have fun :)
            $return['regular_price'] = get_post_meta( $postID, '_regular_price', true);
        }else{
            $return['v_regular_price'] = $product->get_regular_price();
            $return['v_sale_price'] = $product->get_sale_price();
        }
        
        return $return;
    }

}

// Add Shortcode
add_shortcode( 'xoxslider', array( 'Xox_Woo_Carousel_Public', 'xoxslider' ) );
