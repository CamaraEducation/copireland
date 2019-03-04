<?php get_header();?>


	<section class="hero">

		<?php
if ( is_user_logged_in() ) {
   

?>

		<div class="col-xs-6 col-centered">
			<span>
<?php echo get_avatar($current_user->ID, 64); ?>
</span>
		</div>
		<div class="col-xs-6 col-centered" style="padding-left: 12px;">

			<p class="profile-name"><?php um_fetch_user( get_current_user_id() );
				echo um_user('display_name'); // returns the display name of logged-in user
				?></p>
			<p class="work-title"><?php global $current_user; echo array_shift($current_user->roles); ?> @ Camara</p>

		</div>
		<?php
		} else {
    echo 'Welcome, visitor!';
}
?>
	</section>
	

sss
<hr>






<?php get_footer();?>