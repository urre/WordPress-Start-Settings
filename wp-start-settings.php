<?php
/*
Plugin Name: WordPress Start Settings
Plugin URI:  http://urre.me
Description: Some default configuration settings.
Version:     0.2
Author:      Urban Sandén
Author URI:  http://urre.me
*/

function wp_start_settings() {
    global $wpdb;

    $o = array(
        'avatar_default'            => 'blank',
        'avatar_rating'             => 'G',
        'category_base'             => '/kategori',
        'tag_base'                  => '/etikett',
        'comment_max_links'         => 0,
        'comments_per_page'         => 0,
        'date_format'               => 'Y-m-d',
        'default_ping_status'       => 'closed',
        'default_post_edit_rows'    => 30,
        'links_updated_date_format' => 'j. F Y, H:i',
        'image_default_link_type'   => 'file',
        'permalink_structure'       => '/%postname%/',
        'rss_language'              => 'se',
        'start_of_week'             => 1,
        'timezone_string'           => 'Etc/GMT+1',
        'use_smilies'               => 0
    );

    foreach ( $o as $k => $v )
    {
        update_option($k, $v);
    }

    # Delete dummy posts, pages and comment
    wp_delete_post(1, TRUE);
    wp_delete_post(2, TRUE);
    wp_delete_comment(1);

    # Empty blogroll
    $wpdb->query("DELETE FROM $wpdb->links WHERE link_id != ''");

    return;
}
register_activation_hook(__FILE__, 'wp_start_settings');