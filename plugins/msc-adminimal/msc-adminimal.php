<?php
/*
Plugin Name: MSC Adminimal
Plugin URI: http://mikestopcontinues.com/
Description: Reduces admin interface to something sensical for a single-user blog.
Version: 1.0
Author: Mike Stop Continues
Author URI: http://mikestopcontinues.com/
*/

/*
 * ADMIN BAR: Hide from all but Administrators
 */
if(!function_exists('msc_adminimal_show_admin_bar')) {
	add_filter('show_admin_bar', 'msc_adminimal_show_admin_bar', 1000, 1);
	function msc_adminimal_show_admin_bar($data) {
		// only for admins and editors
		if(!current_user_can('edit_posts'))
			return FALSE;

		return $data;
	}
}

/*
 * ADMIN BAR: Clean out the goo.
 */
if(!function_exists('msc_adminimal_admin_bar_menus')) {
	add_action('add_admin_bar_menus', 'msc_adminimal_admin_bar_menus', 1000);
	function msc_adminimal_admin_bar_menus() {
		global $wp_admin_bar;

		// preventative measures
		remove_action('admin_bar_menu', 'wp_admin_bar_my_account_menu', 0);
		remove_action('admin_bar_menu', 'wp_admin_bar_search_menu', 4);
		remove_action('admin_bar_menu', 'wp_admin_bar_my_account_item', 7);

		remove_action('admin_bar_menu', 'wp_admin_bar_wp_menu', 10);
		remove_action('admin_bar_menu', 'wp_admin_bar_my_sites_menu', 20);
		remove_action('admin_bar_menu', 'wp_admin_bar_site_menu', 30);

		// clean alternatives
		add_action('admin_bar_menu', 'msc_adminimal_admin_bar_user_menu', 0);
		add_action('admin_bar_menu', 'msc_adminimal_admin_bar_site_menu', 1);
	}
}

/*
 * ADMIN BAR: Clean user link.
 */
if(!function_exists('msc_adminimal_admin_bar_user_menu')) {
	function msc_adminimal_admin_bar_user_menu($wp_admin_bar) {
		$user_id = get_current_user_id();

		$wp_admin_bar->add_node(array(
			'parent' => '',
			'id' => 'my-account',
			'title' => get_avatar($user_id, 16),
			'href' => get_edit_profile_url($user_id),
			'meta' => array(
				'class' => 'with-avatar',
				'title' => 'My Account',
			),
		));
	}
}

/*
 * ADMIN BAR: Clean front-end/back-end toggle.
 */
if(!function_exists('msc_adminimal_admin_bar_site_menu')) {
	function msc_adminimal_admin_bar_site_menu($wp_admin_bar) {
		if(is_admin()) {
			$wp_admin_bar->add_node(array(
				'parent' => '',
				'id' => 'site-name',
				'title' => 'View',
				'href' => get_home_url(),
				'meta' => array(),
			));
		} else {
			$wp_admin_bar->add_node(array(
				'parent' => '',
				'id' => 'my-sites',
				'title' => 'Admin',
				'href' => get_admin_url(),
				'meta' => array(),
			));
		}
	}
}

/*
 * DASHBOARD: Clean up the goo.
 */
if(!function_exists('msc_adminimal_remove_dashboard_widgets')) {
	add_action('wp_dashboard_setup', 'msc_adminimal_remove_dashboard_widgets', 1000);
	add_action('wp_user_dashboard_setup', 'msc_adminimal_remove_dashboard_widgets', 1000);
	add_action('wp_network_dashboard_setup', 'msc_adminimal_remove_dashboard_widgets', 1000);
	function msc_adminimal_remove_dashboard_widgets() {
		global $wp_meta_boxes;

		// network
		remove_meta_box('dashboard_plugins', 'dashboard-network', 'normal');
		remove_meta_box('dashboard_primary', 'dashboard-network', 'side');
		remove_meta_box('dashboard_secondary', 'dashboard-network', 'side');
		remove_meta_box('backwpup_dashboard_widget_logs', 'dashboard-network', 'normal');
		remove_meta_box('backwpup_dashboard_widget_activejobs', 'dashboard-network', 'normal');

		// admin
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');
		remove_meta_box('dashboard_secondary', 'dashboard', 'side');
	}
}

/*
 * DASHBOARD: Hide welcome panel.
 */
if(!function_exists('continuum_hide_welcome_panel')) {
	add_action('load-index.php', 'continuum_hide_welcome_panel', 1);
	function continuum_hide_welcome_panel() {
		$user_id = get_current_user_id();

		if(get_user_meta($user_id, 'show_welcome_panel', TRUE) > 0)
			update_user_meta($user_id, 'show_welcome_panel', 0);
	}
}
