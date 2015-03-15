<?php get_header(); ?>

<div id="content" class="primary full" role="main">
	
	<?php
	while ( have_posts() ) : the_post(); 

		get_template_part( 'content', 'page' );
		
	endwhile;
	?>

</div><!-- .primary -->

<?php get_footer(); ?>