<?php get_template_part('header', 'top'); ?>

<body <?php body_class(); ?>>

<div id="top" class="site-wrapper">

    <header class="site-header" role="banner">
        <div class="header-content">
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>

            <nav class="main-menu" role="navigation">
                <a class="sr-only skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu') ); ?>
            </nav>
        </div><!-- .header-content -->
    </header><!-- .site-header -->

    <div class="site-content">