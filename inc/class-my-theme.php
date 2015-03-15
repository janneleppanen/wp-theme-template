<?php

class MyTheme {
	const NAME		= THEME_NAME;
	const VERSION	= THEME_VERSION;

	protected static $textdomain = 'wordpress-theme-template';
	protected static $styles = array();
	protected static $scripts = array();
	protected static $sidebars = array();
	protected static $style_formats = array();
	protected static $menus = array();
	protected static $max_revisions = 3;
	protected static $login_stylesheet = '';

	public static function init() {
		add_action( "after_setup_theme", array( __CLASS__, 'after_setup_theme' ), 5 );
	}

	public static function after_setup_theme() {
		load_theme_textdomain( self::$textdomain, get_template_directory() . '/lang' );
		
		if ( ! isset( $content_width ) ) $content_width = 900;
		
		add_editor_style( '/styles/editor.css' );

		register_nav_menus( self::$menus );

		add_theme_support( 'post-formats', array() );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'large', 700, '', true );
		add_image_size( 'medium', 250, '', true );
		add_image_size( 'small', 120, '', true );

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

		// add_action( 'admin_menu',			array( __CLASS__, 'admin_menu' ) );
		add_action( 'wp_enqueue_scripts',		array( __CLASS__, 'wp_enqueue_scripts' ) );
		add_action( 'wp_dashboard_setup',		array( __CLASS__, 'remove_dashboard_widgets' ) );
		add_action( 'init',						array( __CLASS__, 'rewrite_rules' ) );
		add_action( 'widgets_init', 			array( __CLASS__, 'register_sidebars' ) );
		
		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'the_content', 				array( __CLASS__, 'antispambot_the_content_filter' ) );
		add_filter( 'wp_revisions_to_keep', 	array( __CLASS__, 'get_max_revisions' ), 10, 2 );
		add_filter( 'mce_buttons_2',			array( __CLASS__, 'mce_style_select' ) );
		add_filter( 'tiny_mce_before_init', 	array( __CLASS__, 'mce_custom_styles' ) );
		add_filter( 'login_headerurl', 			array( __CLASS__, 'login_headerurl') );
		add_filter( 'login_headertitle', 		array( __CLASS__, 'login_headertitle') );
		add_action( 'login_enqueue_scripts',	array( __CLASS__, 'login_enqueue_scripts') );
	}

	public static function register_sidebars() {
		$defaults = array(
			'id' 			=> 'sidebar', 
		 	'name' 			=> self::__( 'Default Sidebar' ),
		 	'description'	=> self::__( 'Place widgets here.' ),
		 	'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>'
		);

		foreach ( self::$sidebars as $sidebar ) {
			$sidebar = array_merge($defaults, $sidebar);

			register_sidebar( array(
				'id'			=> $sidebar['id'],
				'name' 			=> $sidebar['name'],
				'description'	=> $sidebar['description'],
				'before_widget'	=> $sidebar['before_widget'],
				'after_widget'	=> $sidebar['after_widget'],
				'before_title' 	=> $sidebar['before_title'],
				'after_title'	=> $sidebar['after_title']
			));
		}
	}

	public static function wp_enqueue_scripts() {
		foreach ( self::$styles as $style ) {
			if ( is_array( $style ) )
				wp_register_style( $style['handle'], THEME_DIR . $style['src'], $style['deps'], self::VERSION, $style['media'] );
		}

		foreach ( self::$styles as $style ) {
			if ( is_array( $style ) )
				wp_enqueue_style( $style['handle'] );
		}

		foreach ( self::$scripts as $script ) {
			if ( is_array( $script ) )
				wp_register_script( $script['handle'], THEME_DIR . $script['src'], $script['deps'], self::VERSION, $script['in_footer'] );
		}

		foreach ( self::$scripts as $script ) {
			if ( is_array( $script ) )
				wp_enqueue_script( $script['handle'] );
		}
	}

	public static function load_scripts( $scripts ) {
		self::$scripts = array_merge( self::$scripts, $scripts );
	}

	public static function load_styles( $styles ) {
		self::$styles = array_merge( self::$styles, $styles );
	}

	public static function set_sidebars( $sidebars ) {
		self::$sidebars = array_merge( self::$sidebars, $sidebars );
	}

	public static function set_style_formats( $style_formats ) {
		self::$style_formats = array_merge( self::$style_formats, $style_formats );
	}

	public static function set_login_stylesheet( $stylesheet ) {
		if ( $stylesheet ) {
			self::$login_stylesheet = $stylesheet;
		}
	}

	public static function set_menus( $menus ) {
		self::$menus = array_merge( self::$menus, $menus );
	}

	public static function set_max_revisions( $max ) {
		if ( $max > 0 ) {
			self::$max_revisions = $max;
			return true;
		}
		return false;
	}

	public static function get_max_revisions( $num, $post ) {
	    return self::$max_revisions;
	}

	public static function antispambot_the_content_filter( $content ) {
		$matches = array();
		preg_match_all( "/\b\w+\@\w+[\.\w+]+\b/", $content, $matches);
		
		foreach ( $matches[0] as $match ) {
		  $content = str_replace( $match, antispambot( $match ), $content);
		}
		
		return $content;
	}

	public static function rewrite_rules() {
		global $wp_rewrite;
		$wp_rewrite->pagination_base = self::__( 'page' );
	}

	public static function remove_dashboard_widgets() {
		$user = wp_get_current_user();
		if( $user->has_cap( 'manage_options') ) {
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  
		}
	}

	public static function mce_style_select( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	public static function mce_custom_styles( $init_array ) {   
		$init_array['style_formats'] = json_encode( self::$style_formats ); 
		return $init_array;
	}

	public static function login_enqueue_scripts() {
		if ( self::$login_stylesheet ) {
			wp_enqueue_style( 'login-styles', THEME_DIR . self::$login_stylesheet, false );
		}
	}

	public static function login_headerurl() {
		return get_bloginfo( 'url' );
	}
	
	public static function login_headertitle() {
	    return get_bloginfo( 'name' );
	}

	public static function _e( $str ) {
		echo self::__( $str );
	}

	public static function __( $str ) {
		return __( $str, self::$textdomain );
	}
	public static function _n( $one, $many, $count ) { 
		return _n( $one, $many, $count, self::$textdomain ); 
	}

	public static function _x( $str, $context ) { 
		return _x( $str, $context, self::$textdomain ); 
	}
}