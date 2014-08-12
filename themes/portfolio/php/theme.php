<?php

class Theme_Registration
{
	public function __construct() {
		add_action('after_setup_theme', array($this, 'features'));

		add_action('init', array($this, 'post_types'));
		add_action('init', array($this, 'taxonomies'));

		add_action('init', array($this, 'sidebars'));
		add_filter('dynamic_sidebar_params', array($this, 'sidebar_params'), 1000, 1);
	}

	public function features() {
		// Add theme support for Automatic Feed Links
		add_theme_support('automatic-feed-links');

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'client'));

		// Set custom thumbnail dimensions
		set_post_thumbnail_size(652, 367, true);

		// Add theme support for Semantic Markup
		$markup = array('search-form', 'comment-form', 'comment-list');
		add_theme_support('html5', $markup);
	}

	public function sidebars() {
		$defaults = array(
			'before_title' => '<h1>',
			'after_title' => '</h1>',
			'before_widget' => '<section id="%1$s" class="widget cf %2$s">',
			'after_widget' => '</section>',
		);

		//register_sidebar(wp_parse_args(array(), $defaults));

		register_sidebar(wp_parse_args(array(
			'id' => 'sidebar',
			'name' => 'Main Sidebar',
			'description' => '',
		), $defaults));
	}

	private $widget_counter = array();

	public function sidebar_params($params) {
		$region = array_shift(explode('-', $params[0]['id']));
		$class = '';

		if(!isset($this->widget_counter[$region]))
			$this->widget_counter[$region] = 0;

		if($region == 'sidebar') {
			$class .= 'c' . (($this->widget_counter[$region] % 3) + 1) . ' ';
		}

		$params[0]['before_widget'] = str_replace('class="', 'class="' . $class, $params[0]['before_widget']);

		$this->widget_counter[$region]++;

		return $params;
	}

	public function taxonomies() {
		register_taxonomy('sort', array('portfolio'), array(
			'labels' => array(
				'name' => 'Sorts',
				'singular_name' => 'Sort',
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'sort',
				'with_front' => false,
			),
		));

		register_taxonomy('attribute', array('portfolio'), array(
			'labels' => array(
				'name' => 'Attributes',
				'singular_name' => 'Attribute',
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => false,
			'rewrite' => array(
				'slug' => 'attribute',
				'with_front' => false,
			),
		));
	}

	public function post_types() {
		register_post_type('portfolio', array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio',
			),
			'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
			'taxonomies' => array('sort', 'attribute'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 5,
			'menu_icon' => MSC_THEME_URI.'/img/portfolio.png',
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'rewrite' => array(
				'slug' => 'portfolio',
				'with_front' => false,
			),
		));

		register_post_type('client', array(
			'labels' => array(
				'name' => 'Clients',
				'singular_name' => 'Client',
			),
			'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
			'taxonomies' => array('sort'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 5,
			'menu_icon' => MSC_THEME_URI.'/img/client.png',
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
			'rewrite' => array(
				'slug' => 'client',
				'with_front' => false,
			),
		));
	}
}

$registration = new Theme_Registration();
