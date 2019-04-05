
<?php

/** Set some global variables */
$pathways = get_terms( 'pathway', array(
    'orderby'    => 'count',
    'hide_empty' => 1 //hide opat
) );

//var_dump($pathways);

global $currentPathway;
global $currentPathway_id;
if ( ! empty( $pathways ) && ! is_wp_error( $pathways ) ){ 
 $currentPathway = array_values($pathways)[0]->name;
 $currentPathway_id = array_values($pathways)[0]->term_taxonomy_id;;
}else {
   $currentPathway = "STEAM";
 // echo $newP;
}




				function get_current_user_role() {
					global $wp_roles;
					$current_user = wp_get_current_user();
					$roles = $current_user->roles;
					return $roles? $roles : null; // returns roles if any found, else returns null
					}
				
?>


<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
		<meta name="viewport" content="width=device-width", initial-sacle="1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<title>Techspace CoP </title>
		<?php wp_head() ?>
	</head>
	<body>

	
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
		<a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive md-avatar size-2" alt="COP"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item menu-text active">
					<a class="nav-link" href="<?php echo home_url(); ?>">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item menu-text">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/activities">Activities </a>
				</li>
				<li class="nav-item menu-text">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/programme-planning">Programme Planning </a>
				</li>

				<li class="nav-item menu-text">
				<a class="nav-link text-menu" href="<?php echo home_url(); ?>/training">Training </a>
				</li>

				<li class="nav-item menu-text">
				<a class="nav-link text-menu" href="<?php echo home_url(); ?>/publications">Publications </a>
				</li>
			</ul>

			
				

<?php
if ( is_user_logged_in() ) {
					   
					global $current_user;
					get_currentuserinfo();
?>
				<ul class="nav navbar-nav">
				<li class="nav-item">
				<button type="button" class="btn btn-outline-warning">Community Contributor > 
				<br>


	<?php //echo 'Number of posts published by user: ' . $cash = count_user_posts( $current_user->ID ); 
					$cash = count_user_posts( $current_user->ID );
		            // $cash = count_user_posts( $current_user->ID;
		            
		            if($cash >=0 && $cash <=5){
		            	//echo "1 start";
					?>

						<span class="float-left"><i class="text-warning fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>

<?php 
}elseif($cash >=6 && $cash <=10){
		                //echo "2 start";
				?>
						<span class="float-left"><i class="text-warning fa fa-star"></i></span>						
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
<?php 
}elseif($cash >=11 && $cash <=15){
		             //echo "3 start";
		                ?>

<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>						
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
 <?php
 }elseif($cash >=16 && $cash <=20){
		               // echo "4 start";
		                ?>
		<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>						
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						<span class="float-left"><i class="text-light fa fa-star"></i></span>
						
<?php 
}elseif($cash >=21 && $cash <=25) {
		               // echo "5 start";  
		           ?>              	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>						
<span class="float-left"><i class="text-warning fa fa-star"></i></span>	
<span class="float-left"><i class="text-warning fa fa-star"></i></span>						
												

<?php } ?>
					</button>
					</li>

						<li class="nav-item avatar dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						<img src="<?php echo get_avatar_url($current_user->ID); ?>" class="rounded-circle z-depth-0 md-avatar" alt="avatar image">
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
						<a class="dropdown-item" href="profile">My Profile</a>
						<a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Logout </a>

					</div>
				</li>
			</ul>
<?php
}else {

	?>
	<ul class="nav navbar-nav">
					<li class="nav-item avatar dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						<img src="<?php echo get_template_directory_uri();  ?>/images/loginIcon.png" class="rounded-circle z-depth-0 md-avatar" alt="avatar image">
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
						<a class="dropdown-item" href="login">Login</a>
						
					</div>
				</li>
			</ul>
<?php
}//end if else 
?>
		</div>
	</nav>
