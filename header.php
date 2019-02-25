<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
		<meta name="viewport" content="width=device-width", initial-sacle="1">
		<title>Digital Creativity Dashboard </title>
		<?php wp_head() ?>
	</head>
	<body>
	
		<!-- main continer -->
		<div class="container"> 
			

<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand">
			<span><img src="<?php echo get_template_directory_uri();  ?>/images/techspacelogo.png" class="img-responsive" width="64" height="64" alt="COP"></span></a>
	
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>">Home <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/activities">Activities </a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/program">Programme Planning </a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/training">Training </a>
				</li>
			</ul>
			<img src="<?php echo get_template_directory_uri();  ?>/images/start.png" class="img-responsive"  alt="COP">
			  <div>
			  	

<?php

$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
$numSegments = count($segments); 
global $currentPathway;
$currentPathway= $segments[$numSegments - 1];

//echo 'Current Segment: ' , $currentPathway;

if ( is_user_logged_in() ) {
   //echo 'Welcome, registered user!';

//get user Pathway
	//$currentPathway ="steam";
global $current_user;
get_currentuserinfo();
//echo get_avatar($current_user->ID, 64);
?>
<?php echo get_avatar($current_user->ID, 64); ?>

  <span class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Acount</a>
    <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Logout</a>
  </div>
</span>

<?php

} else {
    //echo 'Welcome, visitor!';
    ?>
    
    <button type="button" class="btn btn-outline-primary"><a href=""> Account Login </a> </button>
<?php
}
?>
			
				<?php 
				function get_current_user_role() {
					global $wp_roles;
					$current_user = wp_get_current_user();
					$roles = $current_user->roles;
					return $roles? $roles : null; // returns roles if any found, else returns null
					}
				?>
			  </div>

			  
		</div>
	</nav>
	<?php //wp_nav_menu(array('theme_location'=>'primary'));?>