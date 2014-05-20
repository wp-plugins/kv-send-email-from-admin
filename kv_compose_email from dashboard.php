<?php
/*
Plugin Name: Kv Compose Email From Dashboard
Plugin URI: https://kvcodes.com.com	
Description: A tiny plugin to compose and send a custom emails from your wp-admin. 
Version: 1.0
Author: Kvvaradha
Author URI: http://www.kvcodes.com
*/

define('KV_COMPOSE_EMAIL_URL', plugin_dir_url( __FILE__ ));


add_filter ("wp_mail_content_type", "my_awesome_mail_content_type");
function my_awesome_mail_content_type() {
	return "text/html";
}
add_filter ("wp_mail_from", "my_awesome_mail_from");
function my_awesome_mail_from() {
	return get_option('admin_email');
}
	
add_filter ("wp_mail_from_name", "my_awesome_email_from_name");
function my_awesome_email_from_name($email_from ) {
	return  get_option('blogname');
}

if(!function_exists('kv_admin_menu')) {
	function kv_admin_menu() { 		
		add_menu_page('Kvcodes', 'Kvcodes', 'manage_options', 'kvcodes' , 'kv_codes_plugins', KV_COMPOSE_EMAIL_URL.'/images/kv_logo.png', 66);	
		add_submenu_page( 'kvcodes', 'KV Admin Email', 'KV Admin Email', 'manage_options', 'kv_email', 'kv_admin_email' );
	}
add_action('admin_menu', 'kv_admin_menu');



function kv_codes_plugins() {

?>
 <div class="wrap">
    <div class="icon32" id="icon-tools"><br/></div>
    <h2><?php _e('KvCodes', 'kvcodes') ?></h2>		
	<div class="welcome-panel">
		Thank you for using Kvcodes Plugins . Here is my few Plugins work .MY plugins are very light weight and Simple.  <p>
		<a href="http://www.kvcodes.com/" target="_blank" ><h3> Visit My Blog</h3></a></p> 
	</div> 
	
	<div id="poststuff" > 
		<div id="post-body" class="metabox-holder columns-2" >
			<div id="post-body-content" > 
				<div class="meta-box-sortables"> 
					<div id="dashboard_right_now" class="postbox">
						<div class="handlediv" > <br> </div>
						<h3 class="hndle"  ><img src="<?php echo KV_COMPOSE_EMAIL_URL.'/images/kv_logo.png'; ?>" >  My plugins </h3> 
						<div class="inside" style="padding: 10px; "> 								
							<?php $kv_wp =  kv_get_web_page('http://profiles.wordpress.org/kvvaradha'); 
									
									 $kv_first_pos = strpos($kv_wp['content'], '<div id="content-plugins" class="info-group plugin-theme main-plugins inactive">');
									
									$kv_first_trim = substr($kv_wp['content'] , $kv_first_pos ); 
										
									$kv_sec_pos = strpos($kv_first_trim, '</div>');
									
									$kv_sec_trim = substr($kv_first_trim ,0, $kv_sec_pos );  
									
									echo $kv_sec_trim; 	?> 
						</div>
					</div>
				</div>							
			</div>
		</div>
	</div> 			
	<div id="postbox-container-1" class="postbox-container" > 
		<div class="meta-box-sortables"> 
			<div id="postbox-container-2" class="postbox-container" >
				<div id="dashboard_right_now" class="postbox">
					<div class="handlediv" > <br> </div>
					<h3 class="hndle" ><img src="<?php echo KV_COMPOSE_EMAIL_URL.'/images/kv_logo.png'; ?>" >  Donate </h3> 
					<div class="inside" style="padding: 10px; " > 
						<b>If i helped you, you can buy me a coffee, just press the donation button :)</b> 
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_donations" />
							<input type="hidden" name="business" value="<?php echo 'kvvaradha@gmail.com'; ?>" />
							<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div> 
				</div> 
			</div>
			<div id="postbox-container-2" class="postbox-container" > 
				<div id="dashboard_quick_press" class="postbox">
					<div class="handlediv" > <br> </div>
					<h3 class="hndle" ><img src="<?php echo KV_COMPOSE_EMAIL_URL.'/images/kv_logo.png'; ?>" >  Support me from Facebook </h3> 
					<div class="inside" style="padding: 10px; "> 
						<p><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fkvcodes&amp;width=180&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false&amp;appId=117935585037426" style="border:none; overflow:hidden; width:250px; height:300px;"></iframe></p>
					</div> 
				</div> 
			</div>
		</div>
	</div> 				
</div> <!-- /wrap -->
<?php

}

function kv_get_web_page( $url )
{
	$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle compressed
		CURLOPT_USERAGENT      => "spider", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);

	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}
} else {
	function kv_admin_submenu_email() { 		
		add_submenu_page( 'kvcodes', 'KV Admin Email', 'KV Admin Email', 'manage_options', 'kv_email', 'kv_admin_email' );
	}
add_action('admin_menu', 'kv_admin_submenu_email');
	
}
add_action( 'admin_print_styles', 'kv_admin_css' );
function kv_admin_css() {
	 wp_enqueue_style("kvcodes_admin", KV_COMPOSE_EMAIL_URL."/kv_admi_style.css", false, "1.0", "all");

}

function kv_admin_email() {
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "kv_send_mail") {
		if(isset($_POST['receiver_email'])) 
			$receiver_email_id = esc_attr($_POST['receiver_email']);
		if(isset($_POST['subj'])) 
			$email_subject = esc_attr($_POST['subj']);
		if(isset($_POST['email_body'])) 
			$email_body = 	nl2br(esc_attr($_POST['email_body']));	
			
		$header = 'From:' . get_bloginfo('admin_email').  "\r\n";

		$kv_mail_report = wp_mail($receiver_email_id, $email_subject, $email_body, $header);
		if($kv_mail_report) {
			$success = ' Mail Sent ! '. $kv_mail_report ; 
		} else {
			$success = '';
		}
	}	?>
<form method="POST">
<table cellpadding="0" border="0" class="form-table">
    <tr><td colspan="2"> <h2>Compose E-Mail</h2> </td> </tr>
	<?php   if($success != '') { 
		echo '<tr><td colspan="2"  > <h4 style=" border: 1px solid green; background-color:#CFF8E6; padding: 10px; width: 50%; ">'.$success.'</h4> </td> </tr>' ; 
		} ?>
	<tr> <td> To: </td><td> 	<div id="single_email" > <input type="email" align="left" name="receiver_email" size="60%" value="<?php echo $usr_email ; ?>"> </div> 	</td>  </tr>
	<tr> <td> Subject: </td>    <td> <input type="text" align="left" name="subj" size="80%" value="<?php echo $subject ;?>" ></td></tr>     
	<tr> <td> Message: </td> 	<td align="left">  <?php $args = array("textarea_name" => "email_body", "textarea_name" => "email_body", "textarea_rows" => "22", "teeny" => true, "media_buttons" => true , "quicktags" =>false);
	wp_editor( $pre_msg, "email_body", $args ); ?>  </td></tr>
	<input type="hidden" name="action" value="kv_send_mail" />
<tr><td colspan="2" align="center">	  <input type="submit" value="Send Message" name="submit" class="button"> </td> </tr>				
 </table>
 </form>
<?php

}
