<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
		<meta name="viewport" content="width=device-width", initial-sacle="1">
		<title>Techspace CoP </title>
		<?php wp_head() ?>
	</head>
	<body>

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
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/programme-planning">Programme Planning </a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/training">Training </a>
				</li>
					<li class="nav-item">
					<a class="nav-link text-menu" href="<?php echo home_url(); ?>/publications">Publications </a>
				</li>
			</ul>		
<?php
					//<span class="fa fa-star checked"></span>
					//<span class="fa fa-star"></span>
					
//$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
//$numSegments = count($segments); 
//global $currentPathway;
//$currentPathway= $segments[$numSegments - 1];


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

//echo $currentPathway;


					//echo 'Current Segment: ' , $currentPathway;

					if ( is_user_logged_in() ) {
					   //echo 'Welcome, registered user!';

					//get user Pathway
						//$currentPathway ="steam";
					global $current_user;
					get_currentuserinfo();
					//echo get_avatar($current_user->ID, 64);
					?>
					
					<?php //echo 'Number of posts published by user: ' . $cash = count_user_posts( $current_user->ID ); 
					$cash = count_user_posts( $current_user->ID );
		            // $cash = count_user_posts( $current_user->ID;
		            echo "<br>";
		            if($cash >=0 && $cash <=5){
		                //echo "1 star";
		                ?>
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
						<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		              	<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">

		            <?php }
		            elseif($cash >=6 && $cash <=10){
		                //echo "2 start";
		                ?>
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
						<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		              	<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		            <?php }
		            elseif($cash >=11 && $cash <=15){
		                //echo "3 start";
		                ?>
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
						<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		              	<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		            <?php }
		            elseif($cash >=16 && $cash <=20){
		               // echo "4 start";
		                ?>
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		              	<img src="https://img.icons8.com/color/48/000000/star.png" style="width:20px;height:20px;">
		            <?php }
		            elseif($cash >=21 && $cash <=25) {
		               // echo "5 start";
		                ?>
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		                <img src="https://img.icons8.com/color/48/000000/filled-star.png" style="width:20px;height:20px;">
		            <?php }
		            ?>

					<?php echo get_avatar($current_user->ID, 64); ?>

					  <span class="dropdown">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  Action
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="http://techspace.camara.org/Dev/profile.php">Acount</a>
					    <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Logout</a>
					  </div>
					</span>

					<?php

					} else {
					    echo 'Welcome, visitor!';
					    ?>
					    <input type="button" class="btn btn-outline-primary" value="Account Login" onclick="window.location.href='login'"/>
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