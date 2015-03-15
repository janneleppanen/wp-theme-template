# WordPress Theme Template
**WordPress Theme Template** is a starter theme.

## Documentation

### Require Helper Clases and define theme constants
Start functions.php file by including helper classes and defining theme constants.
```
require_once( 'inc/class-my-theme.php' );
require_once( 'inc/class-my-tag.php' );

define( 'THEME_VERSION', 	0.1 );
define( 'THEME_DIR', 		get_template_directory_uri() );
define( 'THEME_NAME', 		basename( THEME_DIR ) );
define( 'IMAGES', 			THEME_DIR . '/images' );
```
### Initialize MyTheme class
It resets theme settings and sets theme filters and actions
```
MyTheme::init();
```
### Load CSS files
```
MyTheme::load_styles( array(
	array( 
		'handle' 	=> 'theme-stylesheet', 
		'src' 		=> '/styles/main.css', 
		'media' 	=> 'screen' 
	)
));
```
### Load JavaScript files
```
MyTheme::load_scripts( array(
	array(
		'handle' 	=> 'theme-functions',
		'src' 		=> '/js/functions.js',
		'deps' 		=> array('jquery'),
		'in_footer' => true
	)
));
```
### Set Menus
```
MyTheme::set_menus( array(
	'main-menu' => MyTheme::__( 'Main menu' )
));
```
### Set sidebars
```
MyTheme::set_sidebars( array(
	array( 
	 	'id' 		=> 'sidebar', 
	 	'name' 		=> MyTheme::__( 'Default Sidebar' )
	)
));
```
### Set style formats
```
MyTheme::set_style_formats( array(  
	array(
		'title' 	=> 'Button',
		'selector' 	=> 'a',
		'classes' 	=> 'btn'
	)
));
```
### Set login page stylesheet
```
MyTheme::set_login_stylesheet( '/styles/login.css' );
```
