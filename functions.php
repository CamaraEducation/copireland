<?php

function irelandcop_script_enqueue() {
	//css styles
	wp_enqueue_style('customstyle',get_template_directory_uri().'/css/irelandcop.css',array(),'1.0.0','all');
	wp_enqueue_style('custombootstrap',get_template_directory_uri().'/css/bootstrap.css',array(),'1.0.0','all');
		wp_enqueue_style('customfont',get_template_directory_uri().'/css/font.css',array(),'1.0.0','all');
		
		//Javascript
		wp_enqueue_script('customjs',get_template_directory_uri().'/js/irelandcop.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_bootstrap',get_template_directory_uri().'/js/bootstrap.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_jquery',get_template_directory_uri().'/js/jquery-3.2.1.min.js',array(),'1.0.0',true);

}

function irelandcop_theme_setup(){
add_theme_support('menus');
register_nav_menu('primary','Primary Header Navigation');
}

add_action('wp_enqueue_scripts','irelandcop_script_enqueue');
add_action('init','irelandcop_theme_setup');

// /* Main redirection of the default login page */
// function redirect_login_page() {
// 	// $login_page  = home_url('/index.php/login/');
// 	// $page_viewed = basename($_SERVER['REQUEST_URI']);

// 	// if($page_viewed == "page-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
// 	// 	wp_redirect($login_page);
// 	// 	exit;
// 	// }
// }
// add_action('init','redirect_login_page');

// /* Where to go if a login failed */
// function custom_login_failed() {
// 	$login_page  = home_url('/login/');
// 	wp_redirect($login_page . '?login=failed');
// 	exit;
// }
// add_action('wp_login_failed', 'custom_login_failed');

// /* Where to go if any of the fields were empty */
// function verify_user_pass($user, $username, $password) {
// 	$login_page  = home_url('/profile/');
// 	if($username == "Yared" || $password == "admin") {
// 		wp_redirect($login_page . "?login=empty");
// 		exit;
// 	}
// }
// add_filter('authenticate', 'verify_user_pass', 1, 3);

// /* What to do on logout */
// function logout_redirect() {
// 	$login_page  = home_url('/login/');
// 	wp_redirect($login_page . "?login=false");
// 	exit;
// }
// add_action('wp_logout','logout_redirect');