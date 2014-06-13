<?php
require 'toetajad_func.php';

add_action('init', 'toetajad_init');
	function toetajad_init() 
	{
		$toetaja_labels = array(
			'name' => _x('Toetajad', 'post type general name'),
			'singular_name' => _x('Toetaja', 'post type singular name'),
			'all_items' => __('Kõik Toetajad'),
			'add_new' => _x('Lisa Uus Toetaja', 'Toetajad'),
			'add_new_item' => __('Lisa Uus Toetaja'),
			'edit_item' => __('Muuda Toetajat'),
			'new_item' => __('Uus Toetaja'),
			'view_item' => __('Vaata Toetajat'),
			'search_items' => __('Otsi Toetajate Seast'),
			'not_found' =>  __('Ühtegi Toetajat Ei Leitud'),
			'not_found_in_trash' => __('Ühtegi Toetajat Ei Leitud'), 
			'parent_item_colon' => ''
		);
		$toetaja_args = array(
			'labels' => $toetaja_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 23,
			'supports' => array('title'/*, 'editor'*/),
			'has_archive' => 'toetaja'
		); 
		register_post_type('toetaja',$toetaja_args);
	}




require 'meeskond_func.php';

add_action('init', 'meeskond_init');
	function meeskond_init() 
	{
		$meeskond_labels = array(
			'name' => _x('Meeskond', 'post type general name'),
			'singular_name' => _x('Meeskonna liige', 'post type singular name'),
			'all_items' => __('Kõik liikmed'),
			'add_new' => _x('Lisa Uus Liige', 'Liikmed'),
			'add_new_item' => __('Lisa Uus Liige'),
			'edit_item' => __('Muuda Liiget'),
			'new_item' => __('Uus Liige'),
			'view_item' => __('Vaata Liiget'),
			'search_items' => __('Otsi Liikmete Seast'),
			'not_found' =>  __('Ühtegi Liiget Ei Leitud'),
			'not_found_in_trash' => __('Ühtegi Liiget Ei Leitud'), 
			'parent_item_colon' => ''
		);
		$meeskond_args = array(
			'labels' => $meeskond_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 23,
			'supports' => array('title'/*, 'editor'*/),
			'has_archive' => 'meeskond'
		); 
		register_post_type('meeskond',$meeskond_args);
	}

?>