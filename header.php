<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="True">
<link rel="shortcut icon" type="image/ico" href="<?php echo THEME_DIR; ?>/favicon.ico">
<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">

<?php wp_head(); ?>
</head>
<body>

<div id="top" class="site-wrapper">

    <header class="site-header" role="banner">
        <div class="header-content">
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
                    <img src="<?php echo IMAGES; ?>/site-logo.png" alt="">
                    <span><?php bloginfo( 'name' ); ?></span>
                </a>
            </h1>
        </div>
    </header>

    <div class="site-content">