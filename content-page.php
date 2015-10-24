<article id="<?php MyTag::the_slug(); ?>" <?php post_class(); ?>>
    
    <?php
        the_title('<h1 class="entry-title">', '</h1>');
        the_content();
    ?>

</article><!-- #<?php MyTag::the_slug(); ?> -->