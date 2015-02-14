<?php

class MyTheme {
	const NAME 		= THEME_NAME;
	const VERSION 	= THEME_VERSION;

	protected static $textdomain = 'wordpress-theme-template';
	protected static $styles = array();
	protected static $scripts = array();

	public static function init() {
		add_action( "after_setup_theme", array(__CLASS__, 'after_setup_theme'), 5 );
	}

	public static function after_setup_theme() {
		load_theme_textdomain( self::NAME, get_template_directory() . '/_/lang' );
		
		if ( ! isset( $content_width ) ) $content_width = 900;
		
		add_editor_style( '/css/editor.css' );

		// add_theme_support( 'post-formats', array() );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

		// add_action( 'admin_menu',			array( __CLASS__, 'admin_menu' ) );
		add_action( 'wp_enqueue_scripts',	array( __CLASS__, 'wp_enqueue_scripts' ) );
		// add_action( 'wp_dashboard_setup',	array( __CLASS__, 'remove_dashboard_widgets' ) );
		// add_action( 'init',					array( __CLASS__, 'rewrite_rules' ) );
		// add_action( 'widgets_init', 		array( __CLASS__, 'register_sidebars' ) );
		
		// add_filter( 'use_default_gallery_style', '__return_false' );
		// add_filter( 'wp_title', 			array( __CLASS__, 'wp_title' ) );
		add_filter( 'the_content',			array( __CLASS__, 'antispambot_the_content_filter' ) );
		add_filter( 'wp_revisions_to_keep', array( __CLASS__, 'limit_revisions' ), 10, 2 );
		// add_filter( 'mce_buttons_2',		array( __CLASS__, 'mce_style_select' ) );
		// add_filter( 'tiny_mce_before_init', array( __CLASS__, 'mce_custom_styles' ) );
		// add_filter( 'login_headerurl', 		array( __CLASS__, 'login_headerurl') );
		// add_filter( 'login_headertitle', 	array( __CLASS__, 'login_headertitle') );
		// add_action( 'login_enqueue_scripts',array( __CLASS__, 'login_enqueue_scripts') );
	}

	public static function wp_enqueue_scripts() {
		foreach ( self::$styles as $style ) {
			if( is_array( $style ) )
				wp_register_style( $style['handle'], THEME_DIR . $style['src'], $style['deps'], self::VERSION, $style['media'] );
		}

		foreach ( self::$styles as $style ) {
			if( is_array( $style ) )
				wp_enqueue_style( $style['handle'] );
		}

		foreach ( self::$scripts as $script ) {
			if( is_array( $script ) )
				wp_register_script( $script['handle'], THEME_DIR . $script['src'], $script['deps'], self::VERSION, $script['in_footer'] );
		}

		foreach ( self::$scripts as $script ) {
			if( is_array( $script ) )
				wp_enqueue_script( $script['handle'] );
		}
	}

	public static function load_scripts( $scripts ) {
		self::$scripts = array_merge( self::$scripts, $scripts );
	}

	public static function load_styles( $styles ) {
		self::$styles = array_merge( self::$styles, $styles );
	}

	public static function antispambot_the_content_filter($content) {
		$matches = array();
		preg_match_all( "/\b\w+\@\w+[\.\w+]+\b/", $content, $matches);
		
		foreach ( $matches[0] as $match ) {
		  $content = str_replace( $match, antispambot( $match ), $content);
		}
		
		return $content;
	}

	public static function _e($str) {
		echo self::__($str);
	}

	public static function __($str) {
		return __($str, self::$textdomain);
	}
}