	</div><!-- .site-content -->

	<footer class="site-footer" role="contentinfo">
		<div class="footer-content">
			
			
		</div>
		<aside class="copyright">
			<?php echo '&copy; ' . get_bloginfo('name') . '. ' . date('Y'); ?>
		</aside>

		<a href="#top" class="mobile-jump-top"><span><?php MyTheme::_e( 'Jump top' ); ?></span></a>
	</footer>

</div><!-- .site-wrapper -->

<div class="analytics hide"><?php dynamic_sidebar( 'analytics' ); ?></div>

<?php wp_footer(); ?>

</body>
</html>