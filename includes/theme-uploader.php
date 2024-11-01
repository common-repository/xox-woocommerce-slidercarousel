<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xox_Woo_Carousel
 * @subpackage Xox_Woo_Carousel/admin
 * @author     Xolluteon Indonesia <arungisyadi@outlook.com>
 */

// define('XOX_THEME_DIR', plugin_dir_path( __FILE__ ) . 'templates/');

function xox_carousel_slider_upload_theme(){
	$post_url =  basename($_SERVER['REQUEST_URI']);
	$title = __("Upload and Import Slider / Carousel Theme.");

	$file = '';
	$plugin = '';
	if ( isset( $_REQUEST['action'] ) ) {
		// var_dump($_REQUEST);
		require_once(ABSPATH .'/wp-admin/includes/file.php');

		global $wp_filesystem;
		
		WP_Filesystem();
		if ( ! $wp_filesystem )
			nuke_the_world_because_wpfs_cannot_be_initialized_in_case_of_missing_arguments('!');

		$file = wp_upload_bits( $_FILES['import']['name'], null, @file_get_contents( $_FILES['import']['tmp_name'] ) );;
		$folder = $_REQUEST['type'];
		$destination_path = plugin_dir_path( __FILE__ ) . 'templates/' . $folder;
		$unzipfile = unzip_file( $file['file'], $destination_path);

		if ( $unzipfile ) {
			unlink($file['file']);
			echo 'Successfully imported the file!';       
		} else {
			echo 'There was an error in importing the file. contact <a href="mailto:support@xolluteon.com">Xolluteon Support</a>';       
		}
	}

	if ( isset($_GET['liveupdate']) ) {
		check_admin_referer('edit-plugin-test_' . $file);

		$error = validate_plugin( $plugin );

		if ( is_wp_error( $error ) ) {
			wp_die( $error );
		}

		if ( ( ! empty( $_GET['networkwide'] ) && ! is_plugin_active_for_network( $file ) ) || ! is_plugin_active( $file ) ) {
			activate_plugin( $plugin, "edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=$file&phperror=1", ! empty( $_GET['networkwide'] ) );
		} // we'll override this later if the plugin can be included without fatal error

		wp_redirect( self_admin_url("edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=$file&plugin=$plugin&a=te&scrollto=$scrollto") );
		exit;
	}

	// List of allowable extensions
	$editable_extensions = array('php', 'txt', 'text', 'js', 'css', 'html', 'htm', 'xml', 'inc', 'include', 'zip', 'tar', 'gz');

	/**
	 * Filters file type extensions editable in the plugin editor.
	 *
	 * @since 2.8.0
	 *
	 * @param array $editable_extensions An array of editable plugin file extensions.
	 */
	$editable_extensions = (array) apply_filters( 'editable_extensions', $editable_extensions );

	get_current_screen()->add_help_tab( array(
	'id'		=> 'overview',
	'title'		=> __('Overview'),
	'content'	=>
		'<p>' . __('You can use the editor to make changes to any of your plugins&#8217; individual PHP files. Be aware that if you make changes, plugins updates will overwrite your customizations.') . '</p>' .
		'<p>' . __('Choose a plugin to edit from the dropdown menu and click the Select button. Click once on any file name to load it in the editor, and make your changes. Don&#8217;t forget to save your changes (Update File) when you&#8217;re finished.') . '</p>' .
		'<p>' . __('The Documentation menu below the editor lists the PHP functions recognized in the plugin file. Clicking Look Up takes you to a web page about that particular function.') . '</p>' .
		'<p id="newcontent-description">' . __( 'In the editing area the Tab key enters a tab character. To move below this area by pressing Tab, press the Esc key followed by the Tab key. In some cases the Esc key will need to be pressed twice before the Tab key will allow you to continue.' ) . '</p>' .
		'<p>' . __('If you want to make changes but don&#8217;t want them to be overwritten when the plugin is updated, you may be ready to think about writing your own plugin. For information on how to edit plugins, write your own from scratch, or just better understand their anatomy, check out the links below.') . '</p>' .
		( is_network_admin() ? '<p>' . __('Any edits to files from this screen will be reflected on all sites in the network.') . '</p>' : '' )
	) );

	get_current_screen()->set_help_sidebar(
		'<p><strong>' . __('For more information:') . '</strong></p>' .
		'<p>' . __('<a href="https://codex.wordpress.org/Plugins_Editor_Screen">Documentation on Editing Plugins</a>') . '</p>' .
		'<p>' . __('<a href="https://codex.wordpress.org/Writing_a_Plugin">Documentation on Writing Plugins</a>') . '</p>' .
		'<p>' . __('<a href="https://wordpress.org/support/">Support Forums</a>') . '</p>'
	);

	require_once(ABSPATH . 'wp-admin/admin-header.php');
	
	if (isset($_GET['a'])) : ?>
	 <div id="message" class="updated notice is-dismissible"><p><?php _e('File edited successfully.') ?></p></div>
	<?php elseif (isset($_GET['phperror'])) : ?>
	 <div id="message" class="updated"><p><?php _e('This plugin has been deactivated because your changes resulted in a <strong>fatal error</strong>.') ?></p>
		<?php
			if ( wp_verify_nonce( $_GET['_error_nonce'], 'plugin-activation-error_' . $file ) ) {
				$iframe_url = add_query_arg( array(
					'action'   => 'error_scrape',
					'plugin'   => urlencode( $file ),
					'_wpnonce' => urlencode( $_GET['_error_nonce'] ),
				), admin_url( 'plugins.php' ) );
				?>
		<iframe style="border:0" width="100%" height="70px" src="<?php echo esc_url( $iframe_url ); ?>"></iframe>
		<?php } ?>
	</div>
	<?php endif; ?>
	<div class="wrap">
	<h1><?php echo esc_html( $title ); ?></h1>

	<div class="fileedit-sub">
		<div class="alignleft">
			<form enctype="multipart/form-data" action="<?php echo $post_url; ?>" method="post">
				<p>
					<strong><label for="type"><?php _e('Select Slider or Carousel:'); ?> </label></strong>
					<select name="type" id="type">
						<option value="carousel">Carousel</option>
						<option value="slider">Slider</option>
					</select>
				</p>
				<p>
					<label for="upload"><strong>Choose a file from your computer:</strong></label> (Maximum size: 64 MB)
					<input type="file" id="upload" name="import" size="25">
					<input type="hidden" name="action" value="save">
					<input type="hidden" name="max_file_size" value="67108864">
					<?php wp_nonce_field( plugin_basename( __FILE__ ), 'import-nonce' ); ?>
				</p>
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Upload file and import"></p>
				
			</form>
		</div>
	<br class="clear" />
	</div>
	<br class="clear" />
	</div>
	<div id="ads-xox" class="postbox " style="width: 10%;float: right;position: relative;top: -15em;right: 1em;">
		<div class="inside">
			<div class="xox-donate">    
				<p>If you're enjoying our plugin and it's useful for your business, please care to donate.</p>
				<div style="text-align: center">
					<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8XWD2EQ2X6NGJ" target="_blank" rel="nofollow"><img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="" /></a>
				</div>
				<p>We're offering a per domain per donate support, to help you make the full usage of our plugin. <a href="http://xolluteon.press/2017/06/04/xox-woocommerce-slidercarousel-support/" target="_BLANK">Click here</a> for more information.</p>
			</div>
			<div class="xox-affiliate">
				<p><strong>Affiliate Links</strong></p>
				<div id="dshopit" class="affs-box">
					<a href="http://yvf.me/monitor/arungisyadi" target="_blank">
						<img src="http://res.cloudinary.com/xolluteon/image/upload/v1496595053/Dshopit_ztpctb.png" style="max-width: 100%;">
						<p>Dropshipping from Amazon to Ebay with AUTOPILOT. Guaranteed profit!</p>
					</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($){
	});
	</script>
	<?php
}