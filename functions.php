<?php

require_once( 'inc/class-my-theme.php' );
require_once( 'inc/class-my-tag.php' );

define( 'THEME_VERSION',    0.1 );
define( 'THEME_DIR',        get_template_directory_uri() );
define( 'THEME_NAME',       basename( THEME_DIR ) );
define( 'IMAGES',           THEME_DIR . '/images' );

MyTheme::init();

MyTheme::load_styles( array(
    array( 
        'handle'    => 'theme-stylesheet', 
        'src'       => '/styles/theme.css', 
        'media'     => 'screen' 
    )
));

MyTheme::load_scripts( array(
    array(
        'handle'    => 'theme-functions',
        'src'       => '/js/functions.js',
        'deps'      => array('jquery'),
        'in_footer' => true
    )
));

MyTheme::set_sidebars( array(
    array( 
        'id'        => 'sidebar', 
        'name'      => MyTheme::__( 'Default Sidebar' ), 
    ),
    array( 
        'id'        => 'analytics', 
        'name'      => MyTheme::__( 'Analytics Widgets' ), 
    )
));

MyTheme::set_style_formats( array(  
    array(
        'title'     => 'Button',
        'selector'  => 'a',
        'classes'   => 'btn'
    ),
    array(
        'title'     => 'Uppercase',
        'selector'  => 'p',
        'classes'   => 'uppercase'
    )
));

MyTheme::set_menus( array(
    'main-menu' => MyTheme::__( 'Main menu' )
));

MyTheme::set_login_stylesheet( '/styles/login.css' );