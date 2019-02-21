<?php
/**
*@package OceanWP WordPress theme
*/

function um_custom_login_redirect_secondary_language( $user_id ) {
	if ( UM()->external_integrations()->is_wpml_active() ) {

	global $sitepress;
	$language_code = $sitepress->get_current_language();

	if ( $language_code == 'fi' ) {
		if ( user_can( $user_id, 'subscriber' ) || user_can( $user_id, 'um_premium-subscribers' ) || user_can( $user_id, 'um_trial-expired' ) ) {
			$redirect = '/fi/palveluntarjoajia-etusivu/';
			exit( wp_redirect( $redirect ) );
		} elseif ( user_can( $user_id, 'customer' ) ) {
			$redirect = '/fi/asiakas-etusivu/';
			exit( wp_redirect( $redirect ) );
		}
		}
	}
}
add_action( 'um_on_login_before_redirect', 'um_custom_login_redirect_secondary_language' );
?>
