<?php

$osa_prefix = 'osa_';

$osa_meta_box = array(
	'id' => 'osa-meta-box',
	'title' => 'Osa info',
	'page' => 'osa',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Osa kirjeldus',
			'desc' => '',
			'id' => $osa_prefix . 'desc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Video URL',
			'desc' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
			'id' => $videouudis_prefix . 'link',
			'type' => 'text',
			'std' => 'http://'
		),
		array(
			'name' => 'Kestvus',
			'desc' => '',
			'id' => $osa_prefix . 'time',
			'type' => 'textarea',
			'std' => ''
		)
		
	)
);

add_action('admin_menu', 'osa_add_box');

// Add meta box
function osa_add_box() {
	global $osa_meta_box;
	
	add_meta_box($osa_meta_box['id'], $osa_meta_box['title'], 'osa_show_box', $osa_meta_box['page'], $osa_meta_box['context'], $osa_meta_box['priority']);
}

// Callback function to show fields in meta box
function osa_show_box() {
	global $osa_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="osa_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($osa_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:13%; text-align:right;"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:50%" />',
					'<br /><p class="howto">', $field['desc'], '</p>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>',
				'<br /><p class="howto">', $field['desc'], '</p>';
				break;
			case 'image':
				echo '<input class="upload_image" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:50%" />',
					"<input id='upload_image_button' type='button' value='Upload Image' />",
					'<br /><p class="howto">', $field['desc'], '</p>';
				break;
			case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br /><p class="howto">', $field['desc'], '</p>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'osa_save_data');

// Save data from meta box
function osa_save_data($post_id) {
	global $osa_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['osa_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($osa_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}










add_filter( 'manage_edit-osa_columns', 'my_edit_osa_columns' ) ;

function my_edit_osa_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Pealkiri' ),
		'taxonomy-saade' => __( 'Saade' ),
		'date' => __( 'Kuupäev' )
	);

	return $columns;
}


/*
//http://make.wordpress.org/core/2012/12/11/wordpress-3-5-admin-columns-for-custom-taxonomies/
add_filter( 'manage_taxonomies_for_osa_columns', 'osa_type_columns' );
function osa_type_columns( $taxonomies ) {
    $taxonomies[] = 'osa-type';
    return $taxonomies;
}*/


add_action( 'manage_osa_posts_custom_column', 'my_manage_osa_columns', 10, 2 );

function my_manage_osa_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'osa_osa_image':
			$osa_osa_image = get_post_meta( $post_id, 'osa_osa_image', true );
			if ( empty( $osa_osa_image ) )
				echo __( 'osa pilt on määramata');
			else
				echo __('<img width="600" src="'.$osa_osa_image.'" alt="" />');
			break;
		case 'osa_pos':
			$osa_pos = get_post_meta( $post_id, 'osa_pos', true );
			if ( empty( $osa_pos ) )
				echo __('Määramata');
			else
				echo __($osa_pos );
			break;
		case 'osa_link':
			$osa_link = get_post_meta( $post_id, 'osa_link', true );
			if ( empty( $osa_link ) )
				echo __( '#' );
			else
				if(strlen($osa_link) > 30){
					$link_string = substr($osa_link,0,30);
					$link_string .= '...';
				}else{
					$link_string = $osa_link;
				}
				echo __('<a href="'.$osa_link.'">'.$link_string.'</a>');
			break;
		default :
			break;
	}
}









add_action('do_meta_boxes', 'change_featured_osa_image_title');
function change_featured_osa_image_title()
{
    remove_meta_box( 'postimagediv', 'osa', 'side' );
    add_meta_box('postimagediv', __(''), 'post_thumbnail_meta_box', 'osa', 'normal', 'high');

}

//Filterzz HAXXX


function change_osa_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'osa' ) {
		return 'Osa Nimetus';
	}
}

add_filter( 'enter_title_here', 'change_osa_title' );


?>