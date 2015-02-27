<?php get_header(); ?>

<div class="primary" role="main">
	
	<h1><?php MyTheme::_e( 'Unfortunately that page can&rsquo;t be found.' ); ?></h1>

	<p><?php echo sprintf( MyTheme::__('You can %s visit the Home Page %s or perhaps searching will help'), '<a href="' . esc_url( home_url('/') ) . '">', '</a>' ); ?></p>
	
	<?php get_search_form(); ?>

</div><!-- .primary -->

<?php get_footer(); ?>