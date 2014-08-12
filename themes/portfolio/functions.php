<?php

/* CONSTANTS */
define('MSC_SITE_ROOT', get_bloginfo('url'));
define('MSC_SITE_NAME', get_bloginfo('name'));

define('MSC_TEMPLATE_DIR', get_template_directory());
define('MSC_TEMPLATE_URI', get_template_directory_uri());

define('MSC_THEME_DIR', get_stylesheet_directory());
define('MSC_THEME_URI', get_stylesheet_directory_uri());

/* theme registration */
require_once('php/theme.php');

/* PARALLEL TO WP_FOOTER */
if(!function_exists('wp_header')) {
	function wp_header() {
		do_action('wp_header');
	}
}

if(!function_exists('msc_register_scripts')) {
	add_action('init', 'msc_register_scripts', 9);
	function msc_register_scripts() {
		if(!is_admin()) {
			# JQUERY #
			wp_enqueue_script('jquery');
			wp_register_style('jquery-ui', '');

			# THEME #
			wp_enqueue_script('continuity_theme_script', MSC_THEME_URI . '/js/script.js', array('jquery'));

			if(class_exists('WPLessPlugin')) {
				$less = WPLessPlugin::getInstance();
				$less->setImportDir(array(
					MSC_THEME_DIR . '/less',
					MSC_TEMPLATE_DIR . '/less',
				));

				wp_enqueue_style('msc_theme_style', MSC_THEME_URI . '/less/style.less');
			} else {
				wp_enqueue_style('msc_theme_style', MSC_THEME_URI . '/css/style.css');
			}

			# WORDPRESS #
			if(get_option('thread_comments'))
				wp_enqueue_script('comment-reply');
		}
	}
}

if(!function_exists('msc_continuity_google_webfonts')) {
	add_action('wp_head', 'msc_continuity_google_webfonts', 1);
	function msc_continuity_google_webfonts() {
		echo "<link href='http://fonts.googleapis.com/css?family=Lato:300,700,300italic|Poiret+One' rel='stylesheet' type='text/css'>";
	}
}

if(!function_exists('msc_nav_menu_args')) {
	add_filter('wp_nav_menu_args', 'msc_nav_menu_args', 1000, 1);
	function msc_nav_menu_args($args) {
		$args['container'] = 'nav';

		if($args['menu']->slug == 'pages') {
			$args['link_before'] = '<span class="arrow"></span>';
		}

		return $args;
	}
}

if(!function_exists('msc_pre_get_posts')) {
	add_action('pre_get_posts', 'msc_pre_get_posts', 1000, 1);
	function msc_pre_get_posts($query) {
		if($query->is_main_query()) {
			$query->set('posts_per_page', -1);
			$query->set('nopaging', true);

			if(!is_admin() && $query->get('post_type') == 'portfolio' && $query->is_post_type_archive) {
				$query->set('meta_key', 'feature');
				$query->set('meta_value', 'portfolio');
			}
		}

		if(is_feed()) {
			$query->set('post_type', array('post', 'client', 'portfolio'));
		}

		return $query;
	}
}

function remove_comments_rss($for_comments) {
	return;
}

add_filter('post_comments_feed_link', 'remove_comments_rss');

function msc_content($post) {
	$content_post = get_post($post);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
}
