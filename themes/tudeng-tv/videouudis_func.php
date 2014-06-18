<?php



add_image_size( 'videouudis-image', 177, 100, false );

$videouudis_prefix = 'videouudis_';

$videouudised_meta_box = array(
	'id' => 'videouudised-meta-box',
	'title' => 'Videouudise andmed',
	'page' => 'videouudis',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Toimetaja',
			'desc' => '',
			'id' => $videouudis_prefix . 'toimetaja',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => 'Reporter',
			'desc' => '',
			'id' => $videouudis_prefix . 'reporter',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => 'Operaator',
			'desc' => '',
			'id' => $videouudis_prefix . 'operaator',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => 'Monteeria',
			'desc' => '',
			'id' => $videouudis_prefix . 'monteeria',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => 'Video URL',
			'desc' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
			'id' => $videouudis_prefix . 'link',
			'type' => 'text',
			'std' => 'http://'
		),
		
	)
);

add_action('admin_menu', 'videouudised_add_box');

// Add meta box
function videouudised_add_box() {
	global $videouudised_meta_box;
	
	add_meta_box($videouudised_meta_box['id'], $videouudised_meta_box['title'], 'videouudised_show_box', $videouudised_meta_box['page'], $videouudised_meta_box['context'], $videouudised_meta_box['priority']);
}

// Callback function to show fields in meta box
function videouudised_show_box() {
	global $videouudised_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="videouudised_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($videouudised_meta_box['fields'] as $field) {
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

add_action('save_post', 'videouudised_save_data');

// Save data from meta box
function videouudised_save_data($post_id) {
	global $videouudised_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['videouudised_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($videouudised_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


//Create the columns for the wp-admin post list
add_filter( 'manage_edit-videouudis_columns', 'my_edit_videouudis_columns' ) ;

function my_edit_videouudis_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Videouudise Nimi' ),
		'videouudis_link' => __( 'Video URL' ),
		'thumbnail' => __( 'Pilt' ),
	);

	return $columns;
}




//Get data for columns
add_action( 'manage_videouudis_posts_custom_column', 'my_manage_videouudis_columns', 10, 2 );

function my_manage_videouudis_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'videouudis_videouudis_image':
			$videouudis_videouudis_image = get_post_meta( $post_id, 'videouudis_videouudis_image', true );
			if ( empty( $videouudis_videouudis_image ) )
				echo __( 'Videouudise pilt on määramata');
			else
				echo __('<img width="200" src="'.$videouudis_videouudis_image.'" alt="" />');
			break;
		case 'videouudis_pos':
			$videouudis_pos = get_post_meta( $post_id, 'videouudis_pos', true );
			if ( empty( $videouudis_pos ) )
				echo __('Määramata');
			else
				echo __($videouudis_pos );
			break;
		case 'videouudis_link':
			$videouudis_link = get_post_meta( $post_id, 'videouudis_link', true );
			if ( empty( $videouudis_link ) )
				echo __( '#' );
			else
				if(strlen($videouudis_link) > 30){
					$link_string = substr($videouudis_link,0,30);
					$link_string .= '...';
				}else{
					$link_string = $videouudis_link;
				}
				echo __('<a href="'.$videouudis_link.'">'.$link_string.'</a>');
			break;
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, 'videouudis-image' );
			break;
		default :
			break;
	}
}








add_action('do_meta_boxes', 'change_featured_videouudis_image_title');
function change_featured_videouudis_image_title()
{
    remove_meta_box( 'postimagediv', 'videouudis', 'side' );
    add_meta_box('postimagediv', __('Videouudise Pilt'), 'post_thumbnail_meta_box', 'videouudis', 'normal', 'high');
}


//Filterzz HAXXX
/*

function change_videouudis_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'videouudis' ) {
		return 'Videouudise nimi';
	}
}

add_filter( 'enter_title_here', 'change_videouudis_title' );
*/

?>