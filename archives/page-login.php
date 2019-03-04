<?php
/**
 *
 * @package CopIreland
 *
 */

//get_header(); ?>
<div class="login-branding">
  <a href="/images/techspacelogo.png" class="login-logo">Techspace.camara.org</a>
  <p class="login-desc">
    Techspace.camara.org.
  </p>
</div>
<div class="login-form">
<?php
// $args = array(
//     'redirect' => home_url(), 
//     'id_username' => 'user',
//     'id_password' => 'pass',
//    ) 
;?>
<?php //wp_login_form( $args ); ?>
</div>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the page content template.
			get_template_part( 'content', 'login' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		endwhile;
		?>

	</main><!-- .site-main -->
</div>
 <?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; 
if ( $login === "failed" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
} elseif ( $login === "empty" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}
?>