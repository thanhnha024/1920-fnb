<?php

/*
 * Change Footer Text in Admin
 */
add_filter('admin_footer_text', 'shin_change_footer_text');
function shin_change_footer_text() {
    echo "Core developed by <span ><a href='https://theshin.online' target='_blank'>Shin</a> or call me <a href='tel:0966514360'>0966514360</a></span> ";
}

/*
 *  Removing Items From the Admin Bar
 */
add_action('wp_before_admin_bar_render', 'shin_wp_admin_bar_remove', 0);
function shin_wp_admin_bar_remove() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('comments');
    
	// $wp_admin_bar->remove_menu('customize');
	// $wp_admin_bar->remove_menu('customize-background');
	// $wp_admin_bar->remove_menu('customize-header');
}

/*
 *  Removing Feature Comment For Core Wordpress
 */

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});