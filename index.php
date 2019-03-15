<?php get_header();?>



<!--  Hero Section -->
    <section id="hero">
        <div class="hero-container">

        <?php
if ( is_user_logged_in() ) {
   
?>

            <div class="col-xs-2 col-centered mx-2">
                <span>

                <img src="<?php echo get_avatar_url($current_user->ID); ?>" class="img-responsive" width="125" height="125" alt="COP">
            </span>
            </div>
            <div class="col-xs-6 col-centered">
                <p class="name-user"><?php um_fetch_user( get_current_user_id()); ?></p>
                <p class="txt-pos">
                    <?php  echo array_shift($current_user->roles); ?> @ Camara

                </p>
            </div>
    <?php } else { ?>


            <div class="col-xs-2 col-centered mx-2">
                <span>
            <img src="<?php echo gettermImage($currentPathway); ?>" width="55" height="63"> 

            </span>
            </div>
            <div class="col-xs-6 col-centered">
                <p class="name-user"><?php um_fetch_user( get_current_user_id()); ?></p>
                <p class="txt-pos">
                    <?php echo $currentPathway; ?>  Activities
                </p>
            </div>


<?php } ?>
        </div>
    
    </section>




<section>
		<div class="container">
			<h2 class="btitle">STEAM Starter Kit</h2>
			<hr>
		</div>


		<div class="container">
	<?php 
if (have_posts()) {
  while (have_posts()) {
    the_post();
    the_content(); 
  }
} 
?>

  </div>
	</section>

<div class="container">
<hr>
</div>


<?php get_footer();?>