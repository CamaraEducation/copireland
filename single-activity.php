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
						 					 <!-- if user sad post, style button differently -->
			<i style="font-size: 24px; color: #f7203a;"<?php if (userDisliked($userid, $postid)): ?>
	   			class="fas fa-frown dislike-btn" 
	          <?php else: ?>
	            class="far fa-frown dislike-btn"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>&nbsp;
	          <span class="dislikes"><?php echo getDislikes($postid); ?></span>

	          &nbsp;&nbsp;&nbsp;&nbsp;
	          <i style="font-size: 24px; color: #e6bb35;"<?php if (userLiked($userid, $postid)): ?>
	      		  class="fas fa-meh like-btn"
	      	  <?php else: ?>
	      		  class="far fa-meh like-btn"
	      	  <?php endif ?>
	      	 data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>&nbsp;
	      	<span class="likes"><?php echo getLikes($postid); ?></span>
	          &nbsp;&nbsp;&nbsp;&nbsp;

	          <i style="font-size: 24px; color: #a6cb45;"<?php if (userExcited($userid, $postid)): ?>
	            class="fas fa-smile excite-btn"
	          <?php else: ?>
	            class="far fa-smile excite-btn"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>"></i>&nbsp;
			<span class="excites"><?php echo getExcites($postid); ?></span>
		</div> 
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
				  		$clicked_btn.siblings('i.fa-smile').removeClass('fas').addClass('far');
				      	$clicked_btn.siblings('i.fa-meh').removeClass('fas').addClass('far');
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
					  	  $clicked_btn.siblings('i.fa-smile').removeClass('fas').addClass('far');
					      $clicked_btn.siblings('i.fa-frown').removeClass('fas').addClass('far');
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
					      $clicked_btn.siblings('i.fa-meh').removeClass('fas').addClass('far');
					      $clicked_btn.siblings('i.fa-frown').removeClass('fas').addClass('far');
					    }
					  });

					});
			});
		</script> </div>
						<div class="card-header" >
							<?php echo nl2br("\n"); ?>LEVEL
						</div>
						<div class="btn-group">
						<i <?php if (userBiggner($userid, $postid)): ?>
	   			class="btn btn-success biggner-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default biggner-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Biggner</i>
	          <span class="biggners btn alert-success disabled"><?php echo getBiggner($postid); ?></span>

	          <i <?php if (userInter($userid, $postid)): ?>
	      		  class="btn btn-warning inter-btn btn-sm"
	      	  <?php else: ?>
	      		  class="btn btn-default inter-btn btn-sm"
	      	  <?php endif ?>
	      	 data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Intermidiate</i>
	      	<span class="inters btn alert-warning disabled"><?php echo getInter($postid); ?></span>
	          

	          <i <?php if (userAdvance($userid, $postid)): ?>
	            class="btn btn-danger advance-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default advance-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Advanced</i>
			<span class="advances btn alert-danger disabled"><?php echo getAdvance($postid); ?></span>
		</div>
		<script>
			$(document).ready(function(){
				// if the user clicks on the dislike button ...
				$('.biggner-btn').on('click', function(){
				  var user_id = $(this).data('userid');
				  var post_id = $(this).data('postid');
				  //alert(post_id + user_id);
				  $clicked_btn = $(this);
				  if ($clicked_btn.hasClass('btn-default')) {
				  	levelaction = 'biggner';
				  	//alert(post_id + user_id);
				  } else if($clicked_btn.hasClass('btn-success')){
				  	levelaction = 'unbiggner';
				  }
				  $.ajax({
				  	//url: 'single-activity.php',
				  	type: 'post',
				  	data: {
				  		'levelaction': levelaction,
				  		'post_id': post_id,
				  		'user_id': user_id
				  	},
				  	success: function(data){
				  		res = JSON.parse(data);
				  		if (levelaction == "biggner") {
				  			$clicked_btn.removeClass('btn-default');
				  			$clicked_btn.addClass('btn-success');
				  		} else if(levelaction == "unbiggner") {
				  			$clicked_btn.removeClass('btn-success');
				  			$clicked_btn.addClass('btn-default');
				  		}
				  		// display the number of likes and dislikes
				  		$clicked_btn.siblings('span.biggners').text(res.biggners);
				  		$clicked_btn.siblings('span.inters').text(res.inters);
				      	$clicked_btn.siblings('span.advances').text(res.advances);

				  		// change button styling of the other button if user is reacting the second time to post
				  		$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
				  	}
				  });
				});

///////////////////////////////////////////////////////////////////////////////////////////////////
				$('.inter-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					  	levelaction = 'inter';
					  } else if($clicked_btn.hasClass('btn-warning')){
					  	levelaction = 'uninter';
					  }
					  $.ajax({
					  	//url: 'index.php',
					  	type: 'post',
					  	data: {
					  		'levelaction': levelaction,
					  		'post_id': post_id,
				  			'user_id': user_id
					  	},
					  	success: function(data){
					  		res = JSON.parse(data);
					  		if (levelaction == "inter") {
					  			$clicked_btn.removeClass('btn-default');
					  			$clicked_btn.addClass('btn-warning');
					  		} else if(levelaction == "uninter") {
					  			$clicked_btn.removeClass('btn-warning');
					  			$clicked_btn.addClass('btn-default');
					  		}
					  		// display the number of likes and dislikes
					  		$clicked_btn.siblings('span.biggners').text(res.biggners);
					  		$clicked_btn.siblings('span.inters').text(res.inters);
					      	$clicked_btn.siblings('span.advances').text(res.advances);

					  		// change button styling of the other button if user is reacting the second time to post
					  		$clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
					  	}
					  });

					});
//////////////////////////////////////////////////////////////////////////////////////////////////
				$('.advance-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					    levelaction = 'advance';
					  } else if($clicked_btn.hasClass('btn-danger')){
					    levelaction = 'unadvance';
					  }
					  $.ajax({
					    //url: 'index.php',
					    type: 'post',
					    data: {
					      'levelaction': levelaction,
					      'post_id': post_id,
				  		  'user_id': user_id
					    },
					    success: function(data){
					      res = JSON.parse(data);
					      if (levelaction == "advance") {
					        $clicked_btn.removeClass('btn-default');
					        $clicked_btn.addClass('btn-danger');
					      } else if(levelaction == "unadvance") {
					        $clicked_btn.removeClass('btn-danger');
					        $clicked_btn.addClass('btn-default');
					      }
					      // display the number of likes and dislikes
					      $clicked_btn.siblings('span.biggners').text(res.biggners);
					  		$clicked_btn.siblings('span.inters').text(res.inters);
					      	$clicked_btn.siblings('span.advances').text(res.advances);

					      // change button styling of the other button if user is reacting the second time to post
					    $clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
					    }
					  });

					});
			});
		</script>
						<div class="card-header">
							TIME
						</div>
						<div class="btn-group">
						  <i <?php if (userLessOne($userid, $postid)): ?>
	   			class="btn btn-success lessone-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default lessone-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">< 1 hour</i>
	          <span class="lessone btn alert-success disabled"><?php  echo getLessOne($postid); ?></span>

	          <i <?php if (userOneToTwo($userid, $postid)): ?>
	      		  class="btn btn-warning onetotwo-btn btn-sm"
	      	  <?php else: ?>
	      		  class="btn btn-default onetotwo-btn btn-sm"
	      	  <?php endif ?>
	      	 data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">1 - 2 hours</i>
	      	<span class="onetotwo btn alert-warning disabled"><?php echo getOneToTwo($postid); ?></span>
	          

	          <i <?php if (userMoreTwo($userid, $postid)): ?>
	            class="btn btn-danger moretwo-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default moretwo-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">>2 hours</i>
			<span class="moretwo btn alert-danger disabled"><?php echo getMoreTwo($postid); ?></span>
		</div> 
		<script>
			$(document).ready(function(){
				// if the user clicks on the dislike button ...
				$('.lessone-btn').on('click', function(){
				  var user_id = $(this).data('userid');
				  var post_id = $(this).data('postid');
				  //alert(post_id + user_id);
				  $clicked_btn = $(this);
				  if ($clicked_btn.hasClass('btn-default')) {
				  	timeaction = 'biggner';
				  	//alert(post_id + user_id);
				  } else if($clicked_btn.hasClass('btn-success')){
				  	timeaction = 'unbiggner';
				  }
				  $.ajax({
				  	//url: 'single-activity.php',
				  	type: 'post',
				  	data: {
				  		'timeaction': timeaction,
				  		'post_id': post_id,
				  		'user_id': user_id
				  	},
				  	success: function(data){
				  		res = JSON.parse(data);
				  		if (timeaction == "biggner") {
				  			$clicked_btn.removeClass('btn-default');
				  			$clicked_btn.addClass('btn-success');
				  		} else if(timeaction == "unbiggner") {
				  			$clicked_btn.removeClass('btn-success');
				  			$clicked_btn.addClass('btn-default');
				  		}
				  		// display the number of likes and dislikes
				  		$clicked_btn.siblings('span.lessone').text(res.lessone);
				  		$clicked_btn.siblings('span.onetotwo').text(res.onetotwo);
				      	$clicked_btn.siblings('span.moretwo').text(res.moretwo);

				  		// change button styling of the other button if user is reacting the second time to post
				  		$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
				  	}
				  });
				});

///////////////////////////////////////////////////////////////////////////////////////////////////
				$('.onetotwo-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					  	timeaction = 'inter';
					  } else if($clicked_btn.hasClass('btn-warning')){
					  	timeaction = 'uninter';
					  }
					  $.ajax({
					  	//url: 'index.php',
					  	type: 'post',
					  	data: {
					  		'timeaction': timeaction,
					  		'post_id': post_id,
				  			'user_id': user_id
					  	},
					  	success: function(data){
					  		res = JSON.parse(data);
					  		if (timeaction == "inter") {
					  			$clicked_btn.removeClass('btn-default');
					  			$clicked_btn.addClass('btn-warning');
					  		} else if(timeaction == "uninter") {
					  			$clicked_btn.removeClass('btn-warning');
					  			$clicked_btn.addClass('btn-default');
					  		}
					  		// display the number of likes and dislikes
					  		$clicked_btn.siblings('span.lessone').text(res.lessone);
				  		$clicked_btn.siblings('span.onetotwo').text(res.onetotwo);
				      	$clicked_btn.siblings('span.moretwo').text(res.moretwo);

					  		// change button styling of the other button if user is reacting the second time to post
					  		$clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
					  	}
					  });

					});
//////////////////////////////////////////////////////////////////////////////////////////////////
				$('.moretwo-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					    timeaction = 'advance';
					  } else if($clicked_btn.hasClass('btn-danger')){
					    timeaction = 'unadvance';
					  }
					  $.ajax({
					    //url: 'index.php',
					    type: 'post',
					    data: {
					      'timeaction': timeaction,
					      'post_id': post_id,
				  		  'user_id': user_id
					    },
					    success: function(data){
					      res = JSON.parse(data);
					      if (timeaction == "advance") {
					        $clicked_btn.removeClass('btn-default');
					        $clicked_btn.addClass('btn-danger');
					      } else if(timeaction == "unadvance") {
					        $clicked_btn.removeClass('btn-danger');
					        $clicked_btn.addClass('btn-default');
					      }
					      // display the number of likes and dislikes
					     $clicked_btn.siblings('span.lessone').text(res.lessone);
				  		$clicked_btn.siblings('span.onetotwo').text(res.onetotwo);
				      	$clicked_btn.siblings('span.moretwo').text(res.moretwo);

					      // change button styling of the other button if user is reacting the second time to post
					    $clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
					    }
					  });

					});
			});
		</script>
						<div class="card-header">
							AGE GROUP
						</div>
						<div class="btn-group">
						  <i <?php if (userBiggnerAge($userid, $postid)): ?>
	   			class="btn btn-success agebignner-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default agebignner-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Beginner</i>
	          <span class="agebiggner btn alert-success disabled"><?php  echo getBiggnerAge($postid); ?></span>

	          <i <?php if (userInterAge($userid, $postid)): ?>
	      		  class="btn btn-warning ageinter-btn btn-sm"
	      	  <?php else: ?>
	      		  class="btn btn-default ageinter-btn btn-sm"
	      	  <?php endif ?>
	      	 data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Intermediate</i>
	      	<span class="ageinter btn alert-warning disabled"><?php echo getInterAge($postid); ?></span>
	          

	          <i <?php if (userAdvanceAge($userid, $postid)): ?>
	            class="btn btn-danger ageadvance-btn btn-sm"
	          <?php else: ?>
	            class="btn btn-default ageadvance-btn btn-sm"
	          <?php endif ?>
	          data-userid="<?php echo $userid ?>" data-postid="<?php echo $postid ?>">Advanced</i>
			<span class="ageadvance btn alert-danger disabled"><?php echo getAdvanceAge($postid); ?></span>
		</div>
		<script>
			$(document).ready(function(){
				// if the user clicks on the dislike button ...
				$('.agebignner-btn').on('click', function(){
				  var user_id = $(this).data('userid');
				  var post_id = $(this).data('postid');
				  //alert(post_id + user_id);
				  $clicked_btn = $(this);
				  if ($clicked_btn.hasClass('btn-default')) {
				  	ageaction = 'biggner';
				  	//alert(post_id + user_id);
				  } else if($clicked_btn.hasClass('btn-success')){
				  	ageaction = 'unbiggner';
				  }
				  $.ajax({
				  	//url: 'single-activity.php',
				  	type: 'post',
				  	data: {
				  		'ageaction': ageaction,
				  		'post_id': post_id,
				  		'user_id': user_id
				  	},
				  	success: function(data){
				  		res = JSON.parse(data);
				  		if (ageaction == "biggner") {
				  			$clicked_btn.removeClass('btn-default');
				  			$clicked_btn.addClass('btn-success');
				  		} else if(ageaction == "unbiggner") {
				  			$clicked_btn.removeClass('btn-success');
				  			$clicked_btn.addClass('btn-default');
				  		}
				  		// display the number of likes and dislikes
				  		$clicked_btn.siblings('span.agebiggner').text(res.agebiggner);
				  		$clicked_btn.siblings('span.ageinter').text(res.ageinter);
				      	$clicked_btn.siblings('span.ageadvance').text(res.ageadvance);

				  		// change button styling of the other button if user is reacting the second time to post
				  		$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
				  	}
				  });
				});

///////////////////////////////////////////////////////////////////////////////////////////////////
				$('.ageinter-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					  	ageaction = 'inter';
					  } else if($clicked_btn.hasClass('btn-warning')){
					  	ageaction = 'uninter';
					  }
					  $.ajax({
					  	//url: 'index.php',
					  	type: 'post',
					  	data: {
					  		'ageaction': ageaction,
					  		'post_id': post_id,
				  			'user_id': user_id
					  	},
					  	success: function(data){
					  		res = JSON.parse(data);
					  		if (ageaction == "inter") {
					  			$clicked_btn.removeClass('btn-default');
					  			$clicked_btn.addClass('btn-warning');
					  		} else if(ageaction == "uninter") {
					  			$clicked_btn.removeClass('btn-warning');
					  			$clicked_btn.addClass('btn-default');
					  		}
					  		// display the number of likes and dislikes
					  		$clicked_btn.siblings('span.agebiggner').text(res.agebiggner);
				  		$clicked_btn.siblings('span.ageinter').text(res.ageinter);
				      	$clicked_btn.siblings('span.ageadvance').text(res.ageadvance);

					  		// change button styling of the other button if user is reacting the second time to post
					  		$clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-danger').removeClass('btn-danger').addClass('btn-default');
					  	}
					  });

					});
//////////////////////////////////////////////////////////////////////////////////////////////////
				$('.ageadvance-btn').on('click', function(){
					  var user_id = $(this).data('userid');
				  		var post_id = $(this).data('postid');
					  $clicked_btn = $(this);
					  if ($clicked_btn.hasClass('btn-default')) {
					    ageaction = 'advance';
					  } else if($clicked_btn.hasClass('btn-danger')){
					    ageaction = 'unadvance';
					  }
					  $.ajax({
					    //url: 'index.php',
					    type: 'post',
					    data: {
					      'ageaction': ageaction,
					      'post_id': post_id,
				  		  'user_id': user_id
					    },
					    success: function(data){
					      res = JSON.parse(data);
					      if (ageaction == "advance") {
					        $clicked_btn.removeClass('btn-default');
					        $clicked_btn.addClass('btn-danger');
					      } else if(ageaction == "unadvance") {
					        $clicked_btn.removeClass('btn-danger');
					        $clicked_btn.addClass('btn-default');
					      }
					      // display the number of likes and dislikes
					     $clicked_btn.siblings('span.agebiggner').text(res.agebiggner);
				  		$clicked_btn.siblings('span.ageinter').text(res.ageinter);
				      	$clicked_btn.siblings('span.ageadvance').text(res.ageadvance);

					      // change button styling of the other button if user is reacting the second time to post
					    $clicked_btn.siblings('i.btn-success').removeClass('btn-success').addClass('btn-default');
				      	$clicked_btn.siblings('i.btn-warning').removeClass('btn-warning').addClass('btn-default');
					    }
					  });

					});
			});
		</script>
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