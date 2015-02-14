<?php get_header(); ?>

<div class="primary">
	
	<?php
	while ( have_posts() ) : the_post(); 

		get_template_part( 'content', 'page' );
		
	endwhile;
	?>

</div>

<?php get_footer(); ?>