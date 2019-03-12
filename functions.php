<?php






function irelandcop_script_enqueue() {
	//css styles
	wp_enqueue_style('customstyle',get_template_directory_uri().'/css/irelandcop.css',array(),'1.0.0','all');
	wp_enqueue_style('custombootstrap',get_template_directory_uri().'/css/bootstrap.css',array(),'1.0.0','all');

		wp_enqueue_style('customfont',get_template_directory_uri().'/css/font.css',array(),'1.0.0','all');
    wp_enqueue_style('customfont',get_template_directory_uri().'/css/irelandcop_2.css',array(),'1.0.0','all');
    
		
		//Javascript
		wp_enqueue_script('customjs',get_template_directory_uri().'/js/irelandcop.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_bootstrap',get_template_directory_uri().'/js/bootstrap.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_jquery',get_template_directory_uri().'/js/jquery-3.2.1.min.js',array(),'1.0.0',true);

}

add_filter( 'query_vars', 'addnew_query_vars', 10, 1 );
function addnew_query_vars($vars)
{   
    $vars[] = 'var1'; // var1 is the name of variable you want to add       
    return $vars;
}


function irelandcop_theme_setup(){
add_theme_support('menus');
register_nav_menu('primary','Primary Header Navigation');
}

add_action('wp_enqueue_scripts','irelandcop_script_enqueue');
add_action('init','irelandcop_theme_setup');


/* Main redirection of the default login page */
function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');

function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'jsa_contributor', $user->roles ) ) {
            // redirect them to the default place
            $data_login = get_option('axl_jsa_login_wid_setup');

            return get_permalink($data_login[0]);
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function logout_page() {
  $login_page  = home_url( '/login/' );
  
  wp_redirect( $login_page . "?login=false" );
  exit;
}
add_action('wp_logout','logout_page');

function admin_login_redirect( $redirect_to, $request, $user )
{

global $user;
$steam_page  = home_url( '/steam/' );
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else  {
return home_url();
}
}
else
{
return $redirect_to;
}
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);