<?php

function irelandcop_script_enqueue() {
	//css styles
	wp_enqueue_style('customstyle',get_template_directory_uri().'/css/irelandcop.css',array(),'1.0.0','all');
	wp_enqueue_style('custombootstrap',get_template_directory_uri().'/css/bootstrap.css',array(),'1.0.0','all');
		wp_enqueue_style('customfont',get_template_directory_uri().'/css/font.css',array(),'1.0.0','all');
		
		//Javascript
		wp_enqueue_script('customjs',get_template_directory_uri().'/js/irelandcop.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_bootstrap',get_template_directory_uri().'/js/bootstrap.js',array(),'1.0.0',true);
			wp_enqueue_script('customjs_jquery',get_template_directory_uri().'/js/jquery-3.2.1.min.js',array(),'1.0.0',true);

}

function irelandcop_theme_setup(){
add_theme_support('menus');
register_nav_menu('primary','Primary Header Navigation');
}

add_action('wp_enqueue_scripts','irelandcop_script_enqueue');
add_action('init','irelandcop_theme_setup');
