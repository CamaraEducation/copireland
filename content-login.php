<?php
/**
 * 
 *
 * @package CopIreland
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	
	<?php ?>

	<div class="entry-content">
		<?php
		//the_content();

		wp_login_form( array('redirect' => home_url()) );

		wp_link_pages(
			array(
				//'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				//'after'       => '</div>',
				//'link_before' => '<span>',
				//'link_after'  => '</span>',
				//'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				//'separator'   => '<span class="screen-reader-text">, </span>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article> <!--#post-## -->
