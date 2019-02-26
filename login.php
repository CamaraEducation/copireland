<?php
/**
*@package Techspace
*/

// function um_custom_login_redirect_secondary_language( $user_id ) {
// 	if ( UM()->external_integrations()->is_wpml_active() ) {

// 	global $sitepress;
// 	$language_code = $sitepress->get_current_language();

// 	if ( $language_code == 'fi' ) {
// 		if ( user_can( $user_id, 'subscriber' ) || user_can( $user_id, 'um_premium-subscribers' ) || user_can( $user_id, 'um_trial-expired' ) ) {
// 			$redirect = '/fi/palveluntarjoajia-etusivu/';
// 			exit( wp_redirect( $redirect ) );
// 		} elseif ( user_can( $user_id, 'customer' ) ) {
// 			$redirect = '/fi/asiakas-etusivu/';
// 			exit( wp_redirect( $redirect ) );
// 		}
// 		}
// 	}
// }
// add_action( 'um_on_login_before_redirect', 'um_custom_login_redirect_secondary_language' );
get_header(); ?>
<?php
    require_once(dirname(__FILE__) . '/wp-config.php');
    $wp->init();
    $wp->parse_request();
    $wp->query_posts();
    $wp->register_globals();
    $wp->send_headers();

    // Your Wordpress Functions here...
    echo site_url();
?>
	<!-- section -->
    <section class="aa_loginForm">
        <?php 
            global $user_login;
            // In case of a login error.
            if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) : ?>
    	            <div class="aa_error">
    		            <p><?php _e( 'FAILED: Try again!', 'Techspace' ); ?></p>
    	            </div>
            <?php 
                endif;
            // If user is already logged in.
            if ( is_user_logged_in() ) : ?>

                <div class="aa_logout"> 
                    
                    <?php 
                        _e( 'Hello', 'Username' ); 
                        echo $user_login; 
                    ?>
                    
                    </br>
                    
                    <?php _e( 'You are already logged in.', 'AA' ); ?>

                </div>

                <a id="wp-submit" href="<?php echo wp_logout_url(); ?>" title="Logout">
                    <?php _e( 'Logout', 'AA' ); ?>
                </a>

            <?php 
                // If user is not logged in.
                else: 
                
                    // Login form arguments.
                    $args = array(
                        'echo'           => true,
                        'redirect'       => home_url( '/wp-admin/' ), 
                        'form_id'        => 'loginform',
                        'label_username' => __( 'Username' ),
                        'label_password' => __( 'Password' ),
                        'label_remember' => __( 'Remember Me' ),
                        'label_log_in'   => __( 'Log In' ),
                        'id_username'    => 'user_login',
                        'id_password'    => 'user_pass',
                        'id_remember'    => 'rememberme',
                        'id_submit'      => 'wp-submit',
                        'remember'       => true,
                        'value_username' => NULL,
                        'value_remember' => true
                    ); 
                    
                    // Calling the login form.
                    wp_login_form( $args );
                endif;
        ?> 

	</section>
	<!-- /section -->

<?php get_footer(); ?>