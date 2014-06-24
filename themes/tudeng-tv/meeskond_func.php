<?php

add_image_size( 'liige-image', 300, 300, true );

$meeskond_prefix = 'meeskond_';

$meeskond_meta_box = array(
	'id' => 'meeskond-meta-box',
	'title' => 'Liikme andmed',
	'page' => 'meeskond',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Liikme töökohad',
			'desc' => 'Tudeng TV juhataja, Kaameramees',
			'id' => $meeskond_prefix . 'jobs',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Telefon',
			'desc' => '',
			'id' => $meeskond_prefix . 'desc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Email',
			'desc' => 'example@example.com',
			'id' => $meeskond_prefix . 'link',
			'type' => 'text',
			'std' => ''
		)
		
	)
);

add_action('admin_menu', 'meeskond_add_box');

// Add meta box
function meeskond_add_box() {
	global $meeskond_meta_box;
	
	add_meta_box($meeskond_meta_box['id'], $meeskond_meta_box['title'], 'meeskond_show_box', $meeskond_meta_box['page'], $meeskond_meta_box['context'], $meeskond_meta_box['priority']);
}

// Callback function to show fields in meta box
function meeskond_show_box() {
	global $meeskond_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="meeskond_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meeskond_meta_box['fields'] as $field) {
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

add_action('save_post', 'meeskond_save_data');

// Save data from meta box
function meeskond_save_data($post_id) {
	global $meeskond_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['meeskond_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($meeskond_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


add_filter( 'manage_edit-meeskond_columns', 'my_edit_meeskond_columns' ) ;

function my_edit_meeskond_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Liikme Nimi' ),
		'meeskond_link' => __( 'Link' ),
		'thumbnail' => __( 'Pilt' ),
	);

	return $columns;
}

add_action( 'manage_meeskond_posts_custom_column', 'my_manage_meeskond_columns', 10, 2 );

function my_manage_meeskond_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'meeskond_meeskond_image':
			$meeskond_meeskond_image = get_post_meta( $post_id, 'meeskond_meeskond_image', true );
			if ( empty( $meeskond_meeskond_image ) )
				echo __( 'meeskond pilt on määramata');
			else
				echo __('<img width="200" src="'.$meeskond_meeskond_image.'" alt="" />');
			break;
		case 'meeskond_pos':
			$meeskond_pos = get_post_meta( $post_id, 'meeskond_pos', true );
			if ( empty( $meeskond_pos ) )
				echo __('Määramata');
			else
				echo __($meeskond_pos );
			break;
		case 'meeskond_link':
			$meeskond_link = get_post_meta( $post_id, 'meeskond_link', true );
			if ( empty( $meeskond_link ) )
				echo __( '#' );
			else
				if(strlen($meeskond_link) > 30){
					$link_string = substr($meeskond_link,0,30);
					$link_string .= '...';
				}else{
					$link_string = $meeskond_link;
				}
				echo __('<a href="'.$meeskond_link.'">'.$link_string.'</a>');
			break;
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, 'liige-image' );
			break;
		default :
			break;
	}
}




add_action('do_meta_boxes', 'change_featured_liige_image_title');
function change_featured_liige_image_title()
{
    remove_meta_box( 'postimagediv', 'meeskond', 'side' );
    add_meta_box('postimagediv', __('Liikme Pilt'), 'post_thumbnail_meta_box', 'meeskond', 'normal', 'high');
}








//Filterzz HAXXX


function change_meeskond_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'meeskond' ) {
		return 'Nimi';
	}
}

add_filter( 'enter_title_here', 'change_meeskond_title' );


?>