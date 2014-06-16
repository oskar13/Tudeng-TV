<?php

$hooaeg_prefix = 'hooaeg_';

$hooaeg_meta_box = array(
	'id' => 'hooaeg-meta-box',
	'title' => 'Liikme andmed',
	'page' => 'hooaeg',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Pealkiri',
			'desc' => 'Mehaanik;Kaameramees;Jumestaja',
			'id' => $hooaeg_prefix . 'title',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Kirjeldus',
			'desc' => '',
			'id' => $hooaeg_prefix . 'desc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Kestvus',
			'desc' => '',
			'id' => $hooaeg_prefix . 'time',
			'type' => 'textarea',
			'std' => ''
		),
		
	)
);

add_action('admin_menu', 'hooaeg_add_box');

// Add meta box
function hooaeg_add_box() {
	global $hooaeg_meta_box;
	
	add_meta_box($hooaeg_meta_box['id'], $hooaeg_meta_box['title'], 'hooaeg_show_box', $hooaeg_meta_box['page'], $hooaeg_meta_box['context'], $hooaeg_meta_box['priority']);
}

// Callback function to show fields in meta box
function hooaeg_show_box() {
	global $hooaeg_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="hooaeg_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($hooaeg_meta_box['fields'] as $field) {
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

add_action('save_post', 'hooaeg_save_data');

// Save data from meta box
function hooaeg_save_data($post_id) {
	global $hooaeg_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['hooaeg_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($hooaeg_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


add_filter( 'manage_edit-hooaeg_columns', 'my_edit_hooaeg_columns' ) ;

function my_edit_hooaeg_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Pealkiri' ),
		'hooaeg_link' => __( 'Link' ),
	);

	return $columns;
}

add_filter( 'manage_edit-hooaeg_columns', 'my_edit_hooaeg_columns' ) ;

function my_edit_hooaeg_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Kirjeldus' ),
		'hooaeg_link' => __( 'Link' ),
	);

	return $columns;
}

add_filter( 'manage_edit-hooaeg_columns', 'my_edit_hooaeg_columns' ) ;

function my_edit_hooaeg_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Kestvus' ),
		'hooaeg_link' => __( 'Link' ),
	);

	return $columns;
}






//Filterzz HAXXX


function change_hooaeg_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'hooaeg' ) {
		return 'Nimi';
	}
}

add_filter( 'enter_title_here', 'change_hooaeg_title' );


?>