<?php get_header();?>


<?php
function getPostTerms($id,$tax){
$term_list = wp_get_post_terms($id, $tax, array("fields" => "all"));
foreach($term_list as $term_single) {
return $term_single->name; //do something here
}
}
?>

<section>
        <?php while ( have_posts() ) : the_post(); ?>


<div class="container">
            Dashboard > <?php echo getPostTerms($post->ID,'pathway'); ?> > <?php echo getPostTerms($post->ID,'topic'); ?> > 
        <?php echo the_title();?>
        </div>


        <div class="container">
			<h1 class="btitle"> <?php echo the_title();?>  </h1>
<button type="button" class="btn btn-outline-danger">
<?php echo getPostTerms($post->ID,'tool'); ?>
</button>
			 
			<hr>
		</div>


		<div class="container">
			<div class="row">
				<div class="col-md-8">
					

<!--LEVEL -->
<img src="<?php echo get_template_directory_uri();  ?>/images/level.png" class="img-responsive" with="10px"  alt="COP">
<?php echo getPostTerms($post->ID,'level'); ?>


<!--DURATION -->
<img src="<?php echo get_template_directory_uri();  ?>/images/duration.png" class="img-responsive" with="10px"  alt="COP">
<?php echo get_post_meta($post->ID, 'duration', true); ?>

<!--AGE GROUP -->
<img src="<?php echo get_template_directory_uri();  ?>/images/age_range.png" class="img-responsive" with="10px"  alt="COP">
<?php echo getPostTerms($post->ID,'age_range'); ?>


<!---- FEATURED IMAGE -->
<img src="<?php the_field('featured_image'); ?>" width="690" height="440" alt="aaaaa" style="margin-top:25px"/>


				</div>

				<div class="col-md-4">
					<div class="card cardmargin">
						<div class="card-body">
							<a href="<?php the_field('logic_model'); ?>" target="new">
<img src="<?php echo get_template_directory_uri(); ?>/images/logicModel.png" class="img-responsive"  alt="COP">
						 </a>
						</div>
					</div>	
					<div class="card cardmargin">
						<div class="card-body">
<a href="<?php the_field('equipment_list'); ?>" target="new">
<img src="<?php echo get_template_directory_uri(); ?>/images/equipmentList.png" class="img-responsive"  alt="COP">
						 </a>
						</div>
					</div>		
					<div class="card cardmargin">
						<div class="card-body">
<a href="<?php the_field('sample_lesson_plan'); ?>" target="new">
<img src="<?php echo get_template_directory_uri(); ?>/images/sampleSession.png" class="img-responsive"  alt="COP">
						 </a>
						</div>
					</div>
					<div class="card cardmargin">
						<div class="card-body">
<a href="<?php the_field('further_learning_resources'); ?>" target="new">
<img src="<?php echo get_template_directory_uri(); ?>/images/furtherReading.png" class="img-responsive"  alt="COP">
						 </a>
						</div>
					</div>
							
				</div>
			</div>
		</div>
</section>


	<section class="body">
		<div class="container">
			<h2s class="btitle">Step-by-Step-Guide</hs2>
			<hr>
		</div>
		<div class="container">

			<div class="row">
				<div class="col-md-8">
					<div class="col-md-10 aguidebackground">
						


<!----- content ------>

	
YOUR INSTRUCTOR 

	<?php 

$posts = get_field('instructor');
//var_dump($posts);

echo $posts['user_firstname'] . $posts['user_lastname'];

echo $posts['user_avatar'];

?>
<hr>


	<?php echo the_content();?>

					
</div>

</div>

<div class="col-md-4">
					<p>A step-by-step PDF guide for your group to follow</p>
					<button type="button" class="btn btn-outline-danger">
						<a href="<?php the_field('step_by_step_guide'); ?>" /> Download Guide</a>
					</button>
					<hr>

					<div class="card" style="width: 23rem;">
						<div class="card-body cardback">
							<h5 class="card-title">Card title</h5>
							<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="card-link">Card link</a>
							<a href="#" class="card-link">Another link</a>
						</div>
					</div><br>

					<div class="card" style="width: 23rem;">
						<div class="card-header">
							Featured
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Cras justo odio</li>
							<li class="list-group-item">Dapibus ac facilisis in</li>
							<li class="list-group-item">Vestibulum at eros</li>
						</ul>
					<?php
						  global $current_user;
						  get_currentuserinfo();
						  $postid = get_the_ID();
						  $username = $current_user->user_login;
						  $user_id = $current_user->ID;
						?>
						<button type="button" class="btn btn-outline-danger">
						<i class="fa fa-icon"></i>
						<?php echo $user_id; 
						echo $postid;
						?>
						</button>
						<div class="card-header">
							Satisfaction
						</div>
						 <div class="btn-group">
						  <button>Sad</button>&nbsp; &nbsp;
						  <?php 
						  $sad = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $sad;?>
						  <button>Happy</button>&nbsp; &nbsp;
						  <?php $happy = $wpdb->get_var( "SELECT sum(satsfaction = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $happy;?>
						  <button>Excited</button>
							<?php $excited = $wpdb->get_var( "SELECT sum(satsfaction = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $excited;?>
						</div> 
						<div class="card-header">
							LEVEL
						</div>
						<div class="btn-group">
						  <button>Beginner</button>&nbsp; &nbsp;
						  <?php 
						  $beginner = $wpdb->get_var( "SELECT sum(level = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $beginner;?>
						  <button>Intermediate</button>&nbsp; &nbsp;
						  <?php 
						  $intermediate = $wpdb->get_var( "SELECT sum(level = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $intermediate;?>
						  <button>Advanced</button>
						  <?php 
						  $advanced = $wpdb->get_var( "SELECT sum(level = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $advanced;?>
						</div> 
						<div class="card-header">
							TIME
						</div>
						<div class="btn-group">
						  <button>< 1 hour</button>&nbsp; &nbsp;
						  <?php 
						  $one = $wpdb->get_var( "SELECT sum(time = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $one;?>
						  <button>1 - 2 hours</button>&nbsp; &nbsp;
						  <?php 
						  $two = $wpdb->get_var( "SELECT sum(time = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $two;?>
						  <button>>1 hour</button>
						  <?php 
						  $three = $wpdb->get_var( "SELECT sum(time = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $three;?>
						</div> 
						<div class="card-header">
							AGE GROUP
						</div>
						<div class="btn-group">
						  <button>Beginner</button>&nbsp; &nbsp;
						  <?php 
						  $be = $wpdb->get_var( "SELECT sum(age_group = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $be;?>
						  <button>Intermediate</button>&nbsp; &nbsp;
						  <?php 
						  $in = $wpdb->get_var( "SELECT sum(age_group = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $in;?>
						  <button>Advanced</button>
						  <?php 
						  $ad = $wpdb->get_var( "SELECT sum(age_group = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $ad;?>
						</div> 
						<div>
							<button onclick="submit_feedback()">Submit Feedback</button> 
						<script type="text/javascript">
							
							function submit_feedback() {
							 // document.getElementById("field2").value = document.getElementById("field1").value;
							  global $wpdb;
							  $wpdb->;insert(
 
								$wpdb->;wp_feedback,
								 
								array(
																
								'post_id' =>; $postid,
								 
								'user_id' =>; $user_id,

								'Satisfaction' =>; 1,

								'level' =>; 2,

								'time' =>; 3,
								 
								'age_group' =>; 2
								 
								),
								 
								array(
								 
								'%s',
								 
								'%s',
								 
								'%s',

								'%s',
								 
								'%s',

								'%s'
								 
								)
								 
								);
							}
							
							</script>
					</div>

				</div>
			</div>
		</div>
	</section>


	<section class="body">
		<div class="container">
			<h2w class="btitle">Activity Tried & Tested</hw2>
			<hr>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-8 commentbox">
					asdfasdfas
				</div>

				<div class="col-md-4">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae incidunt natus debitis consequuntur, soluta animi quaerat optio delectus officia doloremque nostrum libero nihil dignissimos, voluptate ullam quibusdam maxime. In, alias.	
				</div>
			</div>
		</div>
	</section>




<!-------------END OF CONENT LOOP --->

<?php endwhile; // end of the loop. ?>

<div class="container">
<hr>
</div>

<?php 
$wpdb->show_errors(); ?>
<?php comments_template( '', true ); ?>
<?php //wp_list_comments(); ?>
<?php //comment_form(); ?>
<?php 
if ( comments_open() || get_comments_number() ) :
     comments_template();
 endif;
?>

<?php get_footer();?>