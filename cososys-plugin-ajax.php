<?php
/*
 * Make call to fetch existing posts
 * Insert posts markup and data into Homepage (remove WP generated content)
 */

/*
 * Add JS on homepage/frontpage
 */
function addJs(): void
{
    if ( is_home() || is_front_page()) {
        wp_enqueue_script(
            'ajax-post-list',
            plugin_dir_url(__FILE__) . '/assets/js/ajax-post-list.js',
            ['jquery'],
            '1.0',
            true
        );
        wp_localize_script(
            'ajax-post-list',
            'ajax_post_list_params',
            ['ajaxurl' => admin_url('admin-ajax.php')]
        );
    }
}
add_action('wp_enqueue_scripts', 'addJs');

/*
 * Fetch posts callback
 */
function getPosts(): void
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );
    $posts_query = new WP_Query($args);

    ob_start();

    include plugin_dir_path(__FILE__) . "/views/posts-list.php";

    wp_reset_postdata();

    $response = array(
        'success' => true,
        'data' => ob_get_clean()
    );

    wp_send_json($response);
}
add_action('wp_ajax_getPosts', 'getPosts');
add_action('wp_ajax_nopriv_getPosts', 'getPosts');

/*
* Insert markup and data into homepage
*/
function insertInBody(): void
{
    ob_start();

    if ( is_home() || is_front_page()) {
        echo '<div id="post-list"></div>';
    }
}
add_action('wp_body_open', 'insertInBody');

function addFrontendPlugInStyles(): void
{
    wp_register_style( 'posts-list.css', plugin_dir_url( __FILE__ ) . '/assets/styles/posts-list.css' );
    wp_enqueue_style( 'posts-list.css');
}
add_action( 'wp_enqueue_scripts', 'addFrontendPlugInStyles' );
