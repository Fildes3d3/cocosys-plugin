<?php
/*
Plugin Name: CoSoSys Plugin
Description: CoSoSys Assignment - Plugin for WordPress.
Version: 1.0
Author: Pop Adrian Bogdan
Author URI: https://www.popadrianbogdan.com/
*/

function getTableName(): string
{
    global $wpdb;

    return $wpdb->prefix . 'dummy_data';
}

function getCharset(): string
{
    global $wpdb;

    return $wpdb->get_charset_collate();
}

/*
 * Activation/Install actions
 * - create DB table (dummy_date),
 * - create data entries (10),
 * - write entries to table
 */
function plugInActivate(): void
{
    global $wpdb;

    $sql = "
        CREATE TABLE IF NOT EXISTS " . getTableName() ." 
        (
            id INT AUTO_INCREMENT NOT NULL,
            content LONGTEXT NOT NULL,
            PRIMARY KEY (id)
        ) " . getCharset();

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $data = [];

    for ($i = 1; $i < 11; $i++) {
        $data[] = 'entry nb.' . $i;
    }

    foreach ($data as $datum) {
        $wpdb->insert(
            getTableName(),
            [
                'content' => $datum
            ]
        );
    }
}
register_activation_hook(__FILE__, 'plugInActivate');

/*
 * Deactivation/Uninstall actions
 *- remove table created at plug-in activation
 */
function plugInDeactivate(): void
{
    global $wpdb;

    $wpdb->query("DROP TABLE IF EXISTS " . getTableName());
}
register_deactivation_hook(__FILE__, 'plugInDeactivate');

include plugin_dir_path(__FILE__) . "cososys-plugin-page.php";
include plugin_dir_path(__FILE__) . "cososys-plugin-ajax.php";
