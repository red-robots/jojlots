<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );


add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function check_gform_email($email) {
	global $wpdb;
	if($email) {
		$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}gf_entry_meta WHERE meta_value = '".$email."'", OBJECT );
		return ($result) ? $result : false;
	} else {
		return false;
	}
}

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'ssshhh_string_key';
    $secret_iv = 'ssshhh_string_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}


add_action( 'wp_enqueue_scripts', 'ajax_enquiry_enqueue_scripts' );
function ajax_enquiry_enqueue_scripts() {
	wp_enqueue_script( 'enquiry', get_stylesheet_directory_uri().'/assets/js/custom/enquiry.js' , array('jquery'), '1.0', true );
	wp_localize_script( 'enquiry', 'enquiryform', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));
}

add_action( 'wp_ajax_nopriv_enquiry_form_action', 'enquiry_form_action' );
add_action( 'wp_ajax_enquiry_form_action', 'enquiry_form_action' );
function enquiry_form_action() {
	$email = $_REQUEST['email'];
	$timeNow = time();
	$time_encrypt = my_simple_crypt($timeNow,'e');
	$email_encrypt = my_simple_crypt($email,'e');
	$response['eemail'] = $email_encrypt;
	$response['etime'] = $time_encrypt;
	echo json_encode($response);
	wp_die();
}

function show_private_info($email,$time,$endTimeInSeconds=300) {
	$show_private_info = false;
	/* 300 = 5 minutes */
	if($email && $time) {
		$current_email = my_simple_crypt($email,'d'); /* d - decrypt */
		$time_stamp = my_simple_crypt($time,'d'); /* d - decrypt */
		$check_email = check_gform_email($current_email); /* Check email from inquiry form entries */
		$time_remaining = time() - $time_stamp;
		$time_stamp_date = date('Y-m-d',$time_stamp);
		$date_now = date('Y-m-d');
		if($check_email && ($time_stamp_date==$date_now) ) {
			if ( $time_remaining >= $endTimeInSeconds ) {
				$show_private_info = false;
			} else {
				$show_private_info = true;
			}
		} else {
			$show_private_info = false;
		}
	}
	return $show_private_info;
}



