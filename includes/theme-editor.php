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

define('XOX_THEME_DIR', plugin_dir_path( __FILE__ ) . 'templates/');
function get_xox_theme(){
	$theme = array();
	foreach( glob(plugin_dir_path( __FILE__ ) . 'templates/*' , GLOB_ONLYDIR) as $dir){
		$replace = str_replace(plugin_dir_path( __FILE__ ) . 'templates/', '', $dir);
		$theme[$replace] = array('Name'=>ucfirst($replace));
	}
	return $theme;
}

function get_xox_theme_path($folder){
	$tname = array();
	$data = glob(plugin_dir_path( __FILE__ ) . 'templates/' . $folder . '/*', GLOB_ONLYDIR);
    foreach( $data as $dir ){
        $path = str_replace(plugin_dir_path(  __FILE__ ). 'templates/' . $folder . '/', '', $dir);
        $tname[] = $path;
    }
    return $tname;
}

function get_xox_theme_files($folder, $path){
	$tname = array();
	$data = glob(plugin_dir_path( __FILE__ ) . 'templates/' . $folder . '/' . $path . '/*.html');
    foreach( $data as $filename ){
        $file = str_replace(plugin_dir_path(  __FILE__ ). 'templates/', '', $filename);
        $tname[] = $file;
    }
    return $tname;
}

function xox_carousel_slider_edit_theme(){
	$post_url =  basename($_SERVER['REQUEST_URI']);
	$title = __("Edit Slider / Carousel Theme.");

	$plugins = get_xox_theme();

	if ( empty( $plugins ) ) {
		include( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( $title ); ?></h1>
			<div id="message" class="error"><p><?php _e( 'You do not appear to have any template available at this time.' ); ?></p></div>
		</div>
		<?php
		include( ABSPATH . 'wp-admin/admin-footer.php' );
		exit;
	}

	$file = '';
	$plugin = '';
	if ( isset( $_REQUEST['file'] ) ) {
		$file = sanitize_text_field( $_REQUEST['file'] );
	}

	if ( isset( $_REQUEST['plugin'] ) ) {
		$plugin = sanitize_text_field( $_REQUEST['plugin'] );
	}

	if ( isset( $_REQUEST['theme'] ) ) {
		$theme = sanitize_text_field( $_REQUEST['theme'] );
	}

	if ( empty( $plugin ) ) {
		if ( $file ) {
			$plugin = $file;
		} else {
			$plugin = array_keys( $plugins );
			$plugin = $plugin[0];
		}
	}
	// var_dump($file);
	$plugin_path = get_xox_theme_path($plugin);
	// var_dump($plugin_path);
	if ( empty($file) && !isset($theme) && !empty($plugin_path) ){
		$path = $plugin_path[0];
	}elseif( !empty($file) && !isset($theme) ){
		$file_arr = explode('/', $file);
		$path = $file_arr[1];
	}elseif( !empty( $theme && !empty($file) )){
		$path = $theme;
	}else{
		$path = isset($theme) ? $theme : 'default';
	}

	$plugin_files = get_xox_theme_files($plugin, $path);

	// var_dump($plugin_files); exit;

	if ( empty($file) )
		$file = $plugin_files[0];

	$file = validate_file_to_edit($file, $plugin_files);
	$real_file = XOX_THEME_DIR . '/' . $file;
	$scrollto = isset($_REQUEST['scrollto']) ? (int) $_REQUEST['scrollto'] : 0;

	if ( isset( $_REQUEST['action'] ) && 'update' === $_REQUEST['action'] ) {

		check_admin_referer('edit-plugin_' . $file);

		$newcontent = wp_unslash( $_POST['newcontent'] );
		if ( is_writeable($real_file) ) {
			$f = fopen($real_file, 'w+');
			fwrite($f, $newcontent);
			fclose($f);

			$network_wide = is_plugin_active_for_network( $file );

			// Deactivate so we can test it.
			if ( is_plugin_active( $plugin ) || isset( $_POST['phperror'] ) ) {
				if ( is_plugin_active( $plugin ) ) {
					deactivate_plugins( $plugin, true );
				}

				if ( ! is_network_admin() ) {
					update_option( 'recently_activated', array( $file => time() ) + (array) get_option( 'recently_activated' ) );
				} else {
					update_site_option( 'recently_activated', array( $file => time() ) + (array) get_site_option( 'recently_activated' ) );
				}

				wp_redirect( add_query_arg( '_wpnonce', wp_create_nonce( 'edit-plugin-test_' . $file ), "edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=$file&plugin=$plugin&liveupdate=1&scrollto=$scrollto&networkwide=" . $network_wide ) );
				exit;
			}
			wp_redirect( self_admin_url( "edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=$file&plugin=$plugin&a=te&scrollto=$scrollto" ) );
		} else {
			wp_redirect( self_admin_url( "edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=$file&plugin=$plugin&scrollto=$scrollto" ) );
		}
		exit;

	} else {

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
		$editable_extensions = array('php', 'txt', 'text', 'js', 'css', 'html', 'htm', 'xml', 'inc', 'include');

		/**
		 * Filters file type extensions editable in the plugin editor.
		 *
		 * @since 2.8.0
		 *
		 * @param array $editable_extensions An array of editable plugin file extensions.
		 */
		$editable_extensions = (array) apply_filters( 'editable_extensions', $editable_extensions );

		if ( ! is_file($real_file) ) {
			wp_die(sprintf('<p>%s</p>', __('No such file exists! Double check the name and try again.')));
		} else {
			// Get the extension of the file
			if ( preg_match('/\.([^.]+)$/', $real_file, $matches) ) {
				$ext = strtolower($matches[1]);
				// If extension is not in the acceptable list, skip it
				if ( !in_array( $ext, $editable_extensions) )
					wp_die(sprintf('<p>%s</p>', __('Files of this type are not editable.')));
			}
		}

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

		update_recently_edited(WP_PLUGIN_DIR . '/' . $file);

		$content = file_get_contents( $real_file );

		if ( '.php' == substr( $real_file, strrpos( $real_file, '.' ) ) ) {
			$functions = wp_doc_link_parse( $content );

			if ( !empty($functions) ) {
				$docs_select = '<select name="docs-list" id="docs-list">';
				$docs_select .= '<option value="">' . __( 'Function Name&hellip;' ) . '</option>';
				foreach ( $functions as $function) {
					$docs_select .= '<option value="' . esc_attr( $function ) . '">' . esc_html( $function ) . '()</option>';
				}
				$docs_select .= '</select>';
			}
		}

		$content = esc_textarea( $content );
		?>
	<?php if (isset($_GET['a'])) : ?>
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
			<p>Available variables : %%template%%, %%sliderID%% , %%xtype%%, %%img%%, %%title%%, %%text%%, %%url%%, %%price%%, %%reg_price%%, %%sale_price%%</p>
			<big><?php
			if ( is_writeable( $real_file ) ) {
				/* translators: %s: plugin file name */
				echo sprintf( __( 'Editing %s' ), '<strong>' . $file . '</strong>' );
			} else {
				/* translators: %s: plugin file name */
				echo sprintf( __( 'Browsing %s' ), '<strong>' . $file . '</strong>' );
			}
			?></big>
		</div>
		<div class="alignright">
			<form action="<?php echo $post_url; ?>" method="post">
				<strong><label for="plugin"><?php _e('Select Slider or Carousel:'); ?> </label></strong>
				<select name="plugin" id="plugin">
		<?php
			foreach ( $plugins as $plugin_key => $a_plugin ) {
				$plugin_name = $a_plugin['Name'];
				if ( $plugin_key == $plugin )
					$selected = " selected='selected'";
				else
					$selected = '';

				$plugin_name = esc_attr($plugin_name);
				$plugin_key = esc_attr($plugin_key);
				echo "\n\t<option value=\"$plugin_key\" $selected>$plugin_name</option>";
			}
		?>
				</select>
				<strong><label for="plugin"><?php _e('Select Theme to edit:'); ?> </label></strong>
				<select name="theme" id="theme">
		<?php
			foreach ( $plugin_path as $t ) {
				if ( $path == $t )
					$selected = " selected='selected'";
				else
					$selected = '';

				$theme_name = esc_attr($t);
				$theme_key = esc_attr($t);
				echo "\n\t<option value=\"$theme_key\" $selected>$theme_name</option>";
			}
		?>
				</select>
				<?php submit_button( __( 'Select' ), '', 'Submit', false ); ?>
			</form>
		</div>
	<br class="clear" />
	</div>

	<div id="templateside">
		<h2><?php _e( 'Theme Files' ); ?></h2>

		<ul>
	<?php
	foreach ( $plugin_files as $plugin_file ) :
		// Get the extension of the file
		if ( preg_match('/\.([^.]+)$/', $plugin_file, $matches) ) {
			$ext = strtolower($matches[1]);
			// If extension is not in the acceptable list, skip it
			if ( !in_array( $ext, $editable_extensions ) )
				continue;
		} else {
			// No extension found
			continue;
		}
	?>
			<li<?php echo $file == $plugin_file ? ' class="highlight"' : ''; ?>><a href="edit.php?post_type=xox-carousel-slider&page=xox-carousel-slider-edit-theme&file=<?php echo urlencode( $plugin_file ) ?>&amp;plugin=<?php echo urlencode( $plugin ) ?>"><?php echo $plugin_file ?></a></li>
	<?php endforeach; ?>
		</ul>
	</div>
	
	<form name="template" id="template" action="<?php echo $post_url; ?>" method="post" style="width: 95%;">
		<?php wp_nonce_field('edit-plugin_' . $file) ?>
			<div><textarea cols="70" rows="25" name="newcontent" id="newcontent" aria-describedby="newcontent-description"><?php echo $content; ?></textarea>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="file" value="<?php echo esc_attr($file) ?>" />
			<input type="hidden" name="plugin" value="<?php echo esc_attr($plugin) ?>" />
			<input type="hidden" name="scrollto" id="scrollto" value="<?php echo $scrollto; ?>" />
			</div>
			<?php if ( !empty( $docs_select ) ) : ?>
			<div id="documentation" class="hide-if-no-js"><label for="docs-list"><?php _e('Documentation:') ?></label> <?php echo $docs_select ?> <input type="button" class="button" value="<?php esc_attr_e( 'Look Up' ) ?> " onclick="if ( '' != jQuery('#docs-list').val() ) { window.open( 'https://api.wordpress.org/core/handbook/1.0/?function=' + escape( jQuery( '#docs-list' ).val() ) + '&amp;locale=<?php echo urlencode( get_user_locale() ) ?>&amp;version=<?php echo urlencode( get_bloginfo( 'version' ) ) ?>&amp;redirect=true'); }" /></div>
			<?php endif; ?>
	<?php if ( is_writeable($real_file) ) : ?>
		<?php if ( in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) ) { ?>
			<p><?php _e('<strong>Warning:</strong> Making changes to active plugins is not recommended. If your changes cause a fatal error, the plugin will be automatically deactivated.'); ?></p>
		<?php } ?>
		<p class="submit">
		<?php
			if ( isset($_GET['phperror']) ) {
				echo "<input type='hidden' name='phperror' value='1' />";
				submit_button( __( 'Update File and Attempt to Reactivate' ), 'primary', 'submit', false );
			} else {
				submit_button( __( 'Update File' ), 'primary', 'submit', false );
			}
		?>
		</p>
	<?php else : ?>
		<p><em><?php _e('You need to make this file writable before you can save your changes. See <a href="https://codex.wordpress.org/Changing_File_Permissions">the Codex</a> for more information.'); ?></em></p>
	<?php endif; ?>
	</form>
	<br class="clear" />
	</div>
	<div id="ads-xox" class="postbox " style="width: 10%;float: right;position: relative;top: -30em;right: 1em;">
		<div class="inside">
			<div class="xox-donate">    
				<p>If you're enjoying our plugin and it's useful for your business,  please care to donate.</p>
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
		$('#template').submit(function(){ $('#scrollto').val( $('#newcontent').scrollTop() ); });
		$('#newcontent').scrollTop( $('#scrollto').val() );

		$('select#plugin').on('change', function(){
			$('select#theme').val('default');
		});
	});
	</script>
	<?php
	}

}