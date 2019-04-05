<?php get_header();?>

<?php
// require_once('comments.php');
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
						  $userid = $current_user->ID;
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
						 	<div class="btn-group">
						 	<?php
						 	$valu = $wpdb->get_var( "SELECT satsfaction FROM ".$wpdb->prefix."feedback WHERE user_id = '".$userid."' && post_id = '".$postid."'" );
							$sad = $wpdb->get_var( "SELECT sum(satsfaction = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							$happy = $wpdb->get_var( "SELECT sum(satsfaction = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							$excited = $wpdb->get_var( "SELECT sum(satsfaction = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
								 ?>
								 <!-- if user sad post, style button differently -->
							<i style="font-size: 2em; color: Red"<?php if (userDisliked($userid, $postid)): ?>
					   			class="fas fa-frown dislike-btn" 
					          <?php else: ?>
					            class="far fa-frown dislike-btn"
					          <?php endif ?>
					          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>
					          <span class="dislikes"><?php echo $sad; ?></span>

					          &nbsp;&nbsp;&nbsp;&nbsp;
					          <i style="font-size: 2em; color: Orange"<?php if (userLiked($userid, $postid)): ?>
					      		  class="fas fa-meh like-btn" 
					      	  <?php else: ?>
					      		  class="far fa-meh like-btn"
					      	  <?php endif ?>
					      	 data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>
					      	<span class="likes"><?php echo $happy; ?></span>
					          &nbsp;&nbsp;&nbsp;&nbsp;

					          <i style="font-size: 2em; color: Green"<?php if (userExcited($userid, $postid)): ?>
					            class="fas fa-smile excite-btn"
					          <?php else: ?>
					            class="far fa-smile excite-btn"
					          <?php endif ?>
					          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>
							<span class="excites"><?php echo $excited; ?></span>
						</div> 

						<?php /// o = far fas ?>
						<script>
							$(document).ready(function(){
								// if the user clicks on the dislike button ...
								$('.dislike-btn').on('click', function(){
								  var user_id = $(this).data('userid');
								  var post_id = $(this).data('postid');
								  //alert(post_id + user_id);
								  $clicked_btn = $(this);
								  if ($clicked_btn.hasClass('far')) {
								  	action = 'dislike';
								  	//alert(post_id + user_id);
								  } else if($clicked_btn.hasClass('fas')){
								  	action = 'undislike';
								  }
								  $.ajax({
								  	//url: 'single-activity.php',
								  	type: 'post',
								  	data: {
								  		'action': action,
								  		'post_id': post_id,
								  		'user_id': user_id
								  	},
								  	success: function(data){
								  		res = JSON.parse(data);
								  		if (action == "dislike") {
								  			$clicked_btn.removeClass('far');
								  			$clicked_btn.addClass('fas');
								  		} else if(action == "undislike") {
								  			$clicked_btn.removeClass('fas');
								  			$clicked_btn.addClass('far');
								  		}
								  		// display the number of likes and dislikes
								  		$clicked_btn.siblings('span.likes').text(res.likes);
								  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
								      	$clicked_btn.siblings('span.excites').text(res.excites);

								  		// change button styling of the other button if user is reacting the second time to post
								  		$clicked_btn.siblings('i.fa-meh').removeClass('fas fa-meh').addClass('far fa-meh');
								      	$clicked_btn.siblings('i.fa-smile').removeClass('fas fa-smile').addClass('far fa-smile');
								  	}
								  });
								});

///////////////////////////////////////////////////////////////////////////////////////////////////
								$('.like-btn').on('click', function(){
									  var user_id = $(this).data('userid');
								  		var post_id = $(this).data('postid');
									  $clicked_btn = $(this);
									  if ($clicked_btn.hasClass('far')) {
									  	action = 'like';
									  } else if($clicked_btn.hasClass('fas')){
									  	action = 'unlike';
									  }
									  $.ajax({
									  	//url: 'index.php',
									  	type: 'post',
									  	data: {
									  		'action': action,
									  		'post_id': post_id,
								  			'user_id': user_id
									  	},
									  	success: function(data){
									  		res = JSON.parse(data);
									  		if (action == "like") {
									  			$clicked_btn.removeClass('far');
									  			$clicked_btn.addClass('fas');
									  		} else if(action == "unlike") {
									  			$clicked_btn.removeClass('fas');
									  			$clicked_btn.addClass('far');
									  		}
									  		// display the number of likes and dislikes
									  		$clicked_btn.siblings('span.likes').text(res.likes);
									  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
									      $clicked_btn.siblings('span.excites').text(res.excites);

									  		// change button styling of the other button if user is reacting the second time to post
									  		$clicked_btn.siblings('i.fa-frown').removeClass('fas').addClass('far');
									      $clicked_btn.siblings('i.fa-smile').removeClass('fas').addClass('far');
									  	}
									  });

									});
//////////////////////////////////////////////////////////////////////////////////////////////////
								$('.excite-btn').on('click', function(){
									  var user_id = $(this).data('userid');
								  		var post_id = $(this).data('postid');
									  $clicked_btn = $(this);
									  if ($clicked_btn.hasClass('far')) {
									    action = 'excited';
									  } else if($clicked_btn.hasClass('fas')){
									    action = 'unexcited';
									  }
									  $.ajax({
									    //url: 'index.php',
									    type: 'post',
									    data: {
									      'action': action,
									      'post_id': post_id,
								  			'user_id': user_id
									    },
									    success: function(data){
									      res = JSON.parse(data);
									      if (action == "excited") {
									        $clicked_btn.removeClass('far');
									        $clicked_btn.addClass('fas');
									      } else if(action == "unexcited") {
									        $clicked_btn.removeClass('fas');
									        $clicked_btn.addClass('far');
									      }
									      // display the number of likes and dislikes
									      $clicked_btn.siblings('span.likes').text(res.likes);
									      $clicked_btn.siblings('span.dislikes').text(res.dislikes);
									      $clicked_btn.siblings('span.excites').text(res.excites);

									      // change button styling of the other button if user is reacting the second time to post
									      $clicked_btn.siblings('i.fa-frown').removeClass('fas').addClass('far');
									      $clicked_btn.siblings('i.fa-meh').removeClass('fas').addClass('far');
									    }
									  });

									});
							});
						</script>
						<div class="card-header">
							LEVEL
						</div>
						<div class="btn-group">
						<form method="post" id="level">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridbg" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidbg" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='1'>Beginner</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#level').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#level').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#level').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>&nbsp; &nbsp;
						  <?php 
						  $beginner = $wpdb->get_var( "SELECT sum(level = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $beginner;?>
						  	<form method="post" id="level1">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridint" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidint" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='2'>Intermediate</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#level1').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#level1').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#level1').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>&nbsp; &nbsp;
						  <?php 
						  $intermediate = $wpdb->get_var( "SELECT sum(level = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $intermediate;?>
						  		  	<form method="post" id="level2">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridad" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidad" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='3'>Advanced</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#level2').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#level2').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#level2').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>
						  <?php 
						  $advanced = $wpdb->get_var( "SELECT sum(level = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $advanced;?>
						</div> 
						<div class="card-header">
							TIME
						</div>
						<div class="btn-group">
						  <form method="post" id="time">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridon" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidon" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='1'>< 1 hour</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#time').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#time').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#time').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>
						  &nbsp; &nbsp;
						  <?php 
						  $one = $wpdb->get_var( "SELECT sum(time = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $one;?>
							<form method="post" id="time1">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridtw" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidtw" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='2'>1 - 2 hours</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#time1').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#time1').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#time1').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>&nbsp; &nbsp;
						  <?php 
						  $two = $wpdb->get_var( "SELECT sum(time = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $two;?>
						  <form method="post" id="time2">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridth" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidth" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='3'>>2 hours</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#time2').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#time2').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#time2').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>
						  <?php 
						  $three = $wpdb->get_var( "SELECT sum(time = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $three;?>
						</div> 
						<div class="card-header">
							AGE GROUP
						</div>
						<div class="btn-group">
						  <form method="post" id="age">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridan" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidan" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='1'>Beginner</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#age').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#age').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#age').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>&nbsp; &nbsp;
						  <?php 
						  $be = $wpdb->get_var( "SELECT sum(age_group = 1) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $be;?>
						  <form method="post" id="age1">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridhu" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidhu" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='2'>Intermediate</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#age1').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#age1').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#age1').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>&nbsp; &nbsp;
						  <?php 
						  $in = $wpdb->get_var( "SELECT sum(age_group = 2) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $in;?>
						  <form method="post" id="age2">
						</br><div class="form-group"><input type="hidden" class = "form-control" name="useridso" value="<?php echo $userid; ?>"></br></div>
						<div class="form-group"><input type="hidden" class = "form-control" name="postidso" value="<?php echo $postid; ?>"></br></div>
					  <button name='submit' value='3'>Advanced</button>
					<div class="messageDiv3"></div>
				</form>
				<script>
				jQuery(function(){
					jQuery('#age2').submit(function(event){
						event.preventDefault();

						jQuery.ajax({
							dataType : "json",
							type:"Post",
							data : jQuery('#age2').serialize(),
							url:"../admin-ajax.php",
							success:function(data)
							{
							jQuery('.messageDiv3').html(data.message);

							if(data.status == 1){
								jQuery('#age2').trigger('reset');
							}
							//	alert('Form Successfully Submit');
							}
						});
					});
				});
			</script>
						  <?php 
						  $ad = $wpdb->get_var( "SELECT sum(age_group = 3) FROM ".$wpdb->prefix."feedback WHERE post_id = $postid " );
							echo $ad;?>
						</div> 
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
<hr><h4 class="btitle">
    <?php
        printf( _nx( 'One thought on "%2$s"', '%1$s comments on "%2$s"', get_comments_number(), 'comments title', 'copireland' ),
            number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
     ?>
</h4>
</div>

<div class="container">

			<div class="row">
				<div class="col-md-8">
					<div class="col-md-10 aguidebackground">

				





<?php 
$wpdb->show_errors(); ?>
<?php comments_template(); ?>
<?php //comments_template('', true); ?>

<?php //wp_list_comments(); ?>
<?php 
// if ( comments_open() || get_comments_number() ) :
//     comments_template();
//  endif;
// if (comments_open()):
// 	comments_template();
// endif
?>
</div>
</div>
</div>
</div>

<?php get_footer();?>