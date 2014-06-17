<?php

/*
add_action( 'init', 'create_toetaja_post_type' );


function create_toetaja_post_type() {

	register_post_type( 'toetaja',
		array(
			'labels' => array(
				'name' => __( 'Toetaja' ),
				'singular_name' => __( 'Toetaja' ),
				'new_item' => 'Uus Toetaja',
				'add_new_item' => 'Lisa toetaja',
				),
			'supports' => array(
				'title'
				),
			'public' => true,
			//'has_archive' => true,
			'register_meta_box_cb' => 'upload_toetaja'

			)
		);
}

function upload_toetaja() {

    add_meta_box(
		'wp_url_toetaja',
		'URL',
		'wp_url_toetaja',
		'toetaja',
		'normal',
		'high'
	);

    // Define the custom attachment for posts
	add_meta_box(
		'wp_toetaja_image',
		'Toetaja pilt',
		'wp_toetaja_image',
		'toetaja',
		'normal'
	);


} // end add custom meta boxes


function wp_toetaja_image(){
	
	wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');

	$html = '<p class="description">';
	$html .= 'Lisa toetaja pilt.';
	$html .= '</p>';
	$html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25">';

	echo $html; 	
	
}
// The Event Location Metabox
function wp_url_toetaja() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_location', true);
	// Echo out the field
	echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';
}*/


















add_image_size( 'toetaja-image', 250, 250, true );

$toetaja_prefix = 'toetaja_';

$toetajad_meta_box = array(
	'id' => 'toetajad-meta-box',
	'title' => 'Toetaja andmed',
	'page' => 'toetaja',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Toetaja kirjeldus',
			'desc' => '',
			'id' => $toetaja_prefix . 'desc',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Link Toetajale',
			'desc' => 'http://www.example.com/',
			'id' => $toetaja_prefix . 'link',
			'type' => 'text',
			'std' => 'http://'
		),
		array(
			'name' => 'Pilt',
			'desc' => 'Pildi üleslaadimiseks vali "Upload image" ja seejärel vali pilt meediateegist või lae uus pilt ülesse enda arvutist.',
			'id' => $toetaja_prefix . 'toetaja_image',
			'type' => 'image',
			'std' => ''
		)
		
	)
);

add_action('admin_menu', 'toetajad_add_box');

// Add meta box
function toetajad_add_box() {
	global $toetajad_meta_box;
	
	add_meta_box($toetajad_meta_box['id'], $toetajad_meta_box['title'], 'toetajad_show_box', $toetajad_meta_box['page'], $toetajad_meta_box['context'], $toetajad_meta_box['priority']);
}

// Callback function to show fields in meta box
function toetajad_show_box() {
	global $toetajad_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="toetajad_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($toetajad_meta_box['fields'] as $field) {
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

add_action('save_post', 'toetajad_save_data');

// Save data from meta box
function toetajad_save_data($post_id) {
	global $toetajad_meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['toetajad_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($toetajad_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


add_filter( 'manage_edit-toetaja_columns', 'my_edit_toetaja_columns' ) ;

function my_edit_toetaja_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Toetaja Nimi' ),
		'toetaja_link' => __( 'Link' ),
		'thumbnail' => __( 'Pilt' ),
	);

	return $columns;
}

add_action( 'manage_toetaja_posts_custom_column', 'my_manage_toetaja_columns', 10, 2 );

function my_manage_toetaja_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {
		case 'toetaja_toetaja_image':
			$toetaja_toetaja_image = get_post_meta( $post_id, 'toetaja_toetaja_image', true );
			if ( empty( $toetaja_toetaja_image ) )
				echo __( 'Toetaja pilt on määramata');
			else
				echo __('<img width="200" src="'.$toetaja_toetaja_image.'" alt="" />');
			break;
		case 'toetaja_pos':
			$toetaja_pos = get_post_meta( $post_id, 'toetaja_pos', true );
			if ( empty( $toetaja_pos ) )
				echo __('Määramata');
			else
				echo __($toetaja_pos );
			break;
		case 'toetaja_link':
			$toetaja_link = get_post_meta( $post_id, 'toetaja_link', true );
			if ( empty( $toetaja_link ) )
				echo __( '#' );
			else
				if(strlen($toetaja_link) > 30){
					$link_string = substr($toetaja_link,0,30);
					$link_string .= '...';
				}else{
					$link_string = $toetaja_link;
				}
				echo __('<a href="'.$toetaja_link.'">'.$link_string.'</a>');
			break;
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, 'toetaja-image' );
			break;
		default :
			break;
	}
}




// Change the text and reposition featured image meta box.
add_action('do_meta_boxes', 'change_featured_toetaja_image_title');
function change_featured_toetaja_image_title()
{
    remove_meta_box( 'postimagediv', 'toetaja', 'side' );
    add_meta_box('postimagediv', __('Toetaja pilt'), 'post_thumbnail_meta_box', 'toetaja', 'normal', 'high');
}





//Filterzz HAXXX


function change_toetaja_title( $title ){
	$screen = get_current_screen();

	if ( $screen->post_type == 'toetaja' ) {
		return 'Toetaja nimi';
	}
}

add_filter( 'enter_title_here', 'change_toetaja_title' );


?>