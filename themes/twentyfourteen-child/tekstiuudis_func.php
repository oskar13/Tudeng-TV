<?php

$tekstiuudis_prefix = 'tekstiuudis_';

$tekstiuudis_meta_box = array(
	'id' => 'tekstiuudis-meta-box',
	'title' => 'Tekstiuudise andmed',
	'page' => 'tekstiuudis',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Autor',
			'desc' => 'Mari Maasikas',
			'id' => $tekstiuudis_prefix . 'autor',
			'type' => 'text',
			'std' => ''
		)
		
	)
);

add_action('admin_menu', 'tekstiuudis_add_box');

// Add meta box
function tekstiuudis_add_box() {
	global $tekstiuudis_meta_box;
	
	add_meta_box($tekstiuudis_meta_box['id'], $tekstiuudis_meta_box['title'], 'tekstiuudis_show_box', $tekstiuudis_meta_box['page'], $tekstiuudis_meta_box['context'], $tekstiuudis_meta_box['priority']);
}

// Callback function to show fields in meta box
function tekstiuudis_show_box() {
	global $tekstiuudis_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="tekstiuudis_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($tekstiuudis_meta_box['fields'] as $field) {
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

add_action('save_post', 'tekstiuudis_save_data');

// Save data from meta box
function tekstiuudis_save_data($post_id) {
	global $tekstiuudis_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['tekstiuudis_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($tekstiuudis_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


add_filter( 'manage_edit-tekstiuudis_columns', 'my_edit_tekstiuudis_columns' ) ;

function my_edit_tekstiuudis_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Pealkiri' ),
		'tekstiuudis_autor' => __( 'Autor' ),
		'tekstiuudis_tekstiuudis_image' => __( 'Pilt' ),
	);

	return $columns;
}

add_action( 'manage_tekstiuudis_posts_custom_column', 'my_manage_tekstiuudis_columns', 10, 2 );

function my_manage_tekstiuudis_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'tekstiuudis_tekstiuudis_image':
			$tekstiuudis_tekstiuudis_image = get_post_meta( $post_id, 'tekstiuudis_tekstiuudis_image', true );
			if ( empty( $tekstiuudis_tekstiuudis_image ) )
				echo __( 'tekstiuudis pilt on määramata');
			else
				echo __('<img width="200" src="'.$tekstiuudis_tekstiuudis_image.'" alt="" />');
			break;
		case 'tekstiuudis_pos':
			$tekstiuudis_pos = get_post_meta( $post_id, 'tekstiuudis_pos', true );
			if ( empty( $tekstiuudis_pos ) )
				echo __('Määramata');
			else
				echo __($tekstiuudis_pos );
			break;
		case 'tekstiuudis_autor':
			$tekstiuudis_autor = get_post_meta( $post_id, 'tekstiuudis_autor', true );
			if ( empty( $tekstiuudis_autor ) )
				echo __( '#' );
			else
				if(strlen($tekstiuudis_autor) > 30){
					$link_string = substr($tekstiuudis_autor,0,30);
					$link_string .= '...';
				}else{
					$link_string = $tekstiuudis_autor;
				}
				echo __('<a href="'.$tekstiuudis_autor.'">'.$link_string.'</a>');
			break;
		default :
			break;
	}
}











//Filterzz HAXXX


function change_tekstiuudis_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'tekstiuudis' ) {
		return 'Pealkiri';
	}
}

add_filter( 'enter_title_here', 'change_tekstiuudis_title' );


?>