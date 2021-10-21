<?php

add_action( 'rest_api_init', function () {
    register_rest_route( 'wp/v2', 'ohio_lazy_load_shortcodes', [
        'methods' => 'POST',
        'callback' => function() {
            if ( empty( $_POST['shortcode'] ) ) return '';

            $page = isset( $_POST['paged'] ) ? (int)$_POST['paged'] : 1;
            set_query_var( 'paged', $paged );

            return do_shortcode( base64_decode( $_POST['shortcode'] ) );
        },
        'permission_callback' => function() {
            return true;
        }
    ]);
});
