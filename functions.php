<?php

require_once( 'inc/class-my-theme.php' );
require_once( 'inc/class-my-tag.php' );

define( 'THEME_VERSION', 0.1 );
define( 'THEME_DIR', get_template_directory_uri() );
define( 'THEME_NAME', basename( THEME_DIR ) );
define( 'IMAGES', THEME_DIR . '/_/images' );

MyTheme::init();

MyTheme::load_styles(array(
	array( 
		'handle' => 'theme-stylesheet', 
		'src' => '/styles/main.css', 
		'media' => 'screen' 
	)
));

MyTheme::load_scripts(array(
	array(
		'handle' => 'theme-functions',
		'src' => '/js/functions.js',
		'deps' => array('jquery'),
		'in_footer' => true
	)
));

MyTheme::set_sidebars(array(
	array( 
	 	'id' 			=> 'sidebar', 
	 	'name' 			=> MyTheme::__( 'Default Sidebar' ), 
	),
	array( 
		'id' 			=> 'analytics', 
	 	'name' 			=> MyTheme::__( 'Analytics Widgets' ), 
	)
));