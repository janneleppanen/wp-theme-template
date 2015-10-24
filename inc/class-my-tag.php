<?php

class MyTag {

    public static function the_slug( $id = null ) {
        echo self::get_slug( $id );
    }

    public static function get_slug( $id = null ) {
        global $post;

        $id = $id || $post->ID;

        $post_data = get_post( $id, ARRAY_A );

        return $post_data['post_name'];
    }
}