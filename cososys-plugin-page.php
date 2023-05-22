<?php
/*
 * Add Menu entry to WP Admin to access plugIn page on Dashboard
 * Position - second item from top to bottom
 */
function addPlugInMenuItem(): void
{
    add_menu_page(
        'CoSoSys Assignment - Plugin for WordPress.',
        'CoSoSys Plugin',
        'manage_options',
        'CoSoSys',
        'renderPlugInPage',
        'dashicons-hammer',
        2
    );
}
add_action('admin_menu', 'addPlugInMenuItem');

/*
 *Render the plugIn page
 */
function renderPlugInPage(): void
{
    global $wpdb;

    $table_name = getTableName();
    $data = $wpdb->get_results("SELECT * FROM $table_name");

    include plugin_dir_path(__FILE__) . "/views/plug-in-page.php";
}
/*
 * Add plugIn page styling
 */
function addPlugInStyles(): void
{
    wp_register_style( 'plug-in-page.css', plugin_dir_url( __FILE__ ) . '/assets/styles/plug-in-page.css' );
    wp_enqueue_style( 'plug-in-page.css');
}
add_action( 'admin_enqueue_scripts', 'addPlugInStyles' );
