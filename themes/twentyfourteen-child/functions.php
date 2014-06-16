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


	require 'tekstiuudis_func.php';

	add_action('init', 'tekstiuudis_init');
		function tekstiuudis_init() 
		{
			$tekstiuudis_labels = array(
				'name' => _x('Tekstiuudis', 'post type general name'),
				'singular_name' => _x('Tekstiuudis', 'post type singular name'),
				'all_items' => __('Tekstiuudised'),
				'add_new' => _x('Lisa Uus Tekstiuudis', 'Tekstiuudised'),
				'add_new_item' => __('Lisa Uus Tekstiuudis'),
				'edit_item' => __('Muuda Tekstiuudist'),
				'new_item' => __('Uus Tekstiuudis'),
				'view_item' => __('Vaata Tekstiuudis'),
				'search_items' => __('Otsi Tekstiuudiste Seast'),
				'not_found' =>  __('Ühtegi Tekstiuudist Ei Leitud'),
				'not_found_in_trash' => __('Ühtegi Tekstiuudist Ei Leitud'), 
				'parent_item_colon' => ''
			);
			$tekstiuudis_args = array(
				'labels' => $tekstiuudis_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'menu_position' => 23,
				'supports' => array('title', 'editor',  'author', 'thumbnail', 'excerpt' ),
				'has_archive' => 'tekstiuudis'
			); 
			register_post_type('tekstiuudis',$tekstiuudis_args);
		}





	require 'videouudis_func.php';

	add_action('init', 'videouudis_init');
		function videouudis_init() 
		{
			$videouudis_labels = array(
				'name' => _x('Videouudised', 'post type general name'),
				'singular_name' => _x('Videouudis', 'post type singular name'),
				'all_items' => __('Videouudised'),
				'add_new' => _x('Lisa Uus Videouudis', 'Videouudised'),
				'add_new_item' => __('Lisa Uus Videouudis'),
				'edit_item' => __('Muuda Videouudist'),
				'new_item' => __('Uus Videouudis'),
				'view_item' => __('Vaata Videouudis'),
				'search_items' => __('Otsi Videouudiste Seast'),
				'not_found' =>  __('Ühtegi Videouudist Ei Leitud'),
				'not_found_in_trash' => __('Ühtegi Videouudist Ei Leitud'), 
				'parent_item_colon' => ''
			);
			$videouudis_args = array(
				'labels' => $videouudis_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'menu_position' => 23,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive' => 'videouudis'
			); 
			register_post_type('videouudis',$videouudis_args);
		}


		require 'hooaeg_func.php';

		add_action('init', 'hooaeg_init');
		function hooaeg_init() 
		{
			$hooaeg_labels = array(
				'name' => _x('Hooajad', 'post type general name'),
				'singular_name' => _x('Hooaeg', 'post type singular name'),
				'all_items' => __('Hooajad'),
				'add_new' => _x('Lisa Uus Hooaeg', 'Hooajad'),
				'add_new_item' => __('Lisa Uus Hooaeg'),
				'edit_item' => __('Muuda Hooaega'),
				'new_item' => __('Uus Hooaeg'),
				'view_item' => __('Vaata Hooaega'),
				'search_items' => __('Otsi Hooaegade Seast'),
				'not_found' =>  __('Ühtegi Hooaega Ei Leitud'),
				'not_found_in_trash' => __('Ühtegi Hooaega Ei Leitud'), 
				'parent_item_colon' => ''
			);
			$hooaeg_args = array(
				'labels' => $hooaeg_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'menu_position' => 23,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive' => 'hooaeg'
			); 
			register_post_type('hooaeg',$hooaeg_args);
		}


		require 'osa_func.php';

		add_action('init', 'osa_init');
		function osa_init() 
		{
			$osa_labels = array(
				'name' => _x('Osad', 'post type general name'),
				'singular_name' => _x('Osa', 'post type singular name'),
				'all_items' => __('Osad'),
				'add_new' => _x('Lisa Uus Osa', 'Osad'),
				'add_new_item' => __('Lisa Uus Osa'),
				'edit_item' => __('Muuda Osa'),
				'new_item' => __('Uus Osa'),
				'view_item' => __('Vaata Osa'),
				'search_items' => __('Otsi Osade Seast'),
				'not_found' =>  __('Ühtegi Osa Ei Leitud'),
				'not_found_in_trash' => __('Ühtegi Osa Ei Leitud'), 
				'parent_item_colon' => ''
			);
			$osa_args = array(
				'labels' => $osa_labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => true,
				'menu_position' => 23,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
				'has_archive' => 'osa'
			); 
			register_post_type('osa',$osa_args);
		}

		require 'pu_theme_options.php';
		/**
		 * Theme Option Page Example
		 */
		function pu_theme_menu()
		{
			add_theme_page( 'Veebilehe välimus', 'Veebilehe välimus', 'manage_options', 'pu_theme_options.php', 'pu_theme_page');  
		}
		add_action('admin_menu', 'pu_theme_menu');


		/**
		 * Register the settings to use on the theme options page
		 */
		add_action( 'admin_init', 'pu_register_settings' );

		/**
		 * Function to register the settings
		 */
		function pu_register_settings()
		{
		    // Register the settings with Validation callback
		    register_setting( 'pu_theme_options', 'pu_theme_options', 'pu_validate_settings' );

		    // Add settings section
		    add_settings_section( 'pu_text_section', 'Section 1', 'pu_display_section', 'pu_theme_options.php' );

		    // Create textbox field
		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox',
		      'name'      => 'pu_textbox',
		      'desc'      => 'Example of textbox description',
		      'std'       => '',
		      'label_for' => 'pu_textbox',
		      'class'     => 'css_class'
		    );

		    add_settings_field( 'example_textbox', 'Example Textbox', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

		    // Create textbox field
		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox3',
		      'name'      => 'pu_textbox3',
		      'desc'      => 'Example of textbox description3',
		      'std'       => '',
		      'label_for' => 'pu_textbox3',
		      'class'     => 'css_class3'
		    );

		    add_settings_field( 'example_textbox3', 'Example Textbox', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

		    add_settings_section( 'pu_text_section2', 'Section 2', 'pu_display_section', 'pu_theme_options.php' );

		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox2',
		      'name'      => 'pu_textbox2',
		      'desc'      => 'Example of textbox description2',
		      'std'       => '',
		      'label_for' => 'pu_textbox2',
		      'class'     => 'css_class2'
		    );

		    add_settings_field( 'example_textbox2', 'Example Textbox2', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section2', $field_args );
		}



/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('saade', 'hooaeg', array(
	// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
	// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Saated', 'taxonomy general name' ),
			'singular_name' => _x( 'Saade', 'taxonomy singular name' ),
			'search_items' =>  __( 'Otsi Saateid' ),
			'all_items' => __( 'Kõik Saated' ),
			'parent_item' => __( 'Parent Location' ),
			'parent_item_colon' => __( 'Parent Location:' ),
			'edit_item' => __( 'Muuda Saadet' ),
			'update_item' => __( 'Uuenda Saadet' ),
			'add_new_item' => __( 'Lisa Uus Saade' ),
			'new_item_name' => __( 'Uue Saate Nimi' ),
			'menu_name' => __( 'Saated' ),
			),
    // Control the slugs used for this taxonomy
		'rewrite' => array(
      'slug' => 'saated', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
      ),
		));
}
add_action( 'init', 'add_custom_taxonomies', 0 );











// A callback function to add a custom field to our "presenters" taxonomy  
function presenters_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
?>  

<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="presenter_id"><?php _e('WordPress User ID'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[presenter_id]" id="term_meta[presenter_id]" size="25" style="width:60%;" value="<?php echo $term_meta['presenter_id'] ? $term_meta['presenter_id'] : ''; ?>"><br />  
        <span class="description"><?php _e('The Presenter\'s WordPress User ID'); ?></span>  
    </td>  
</tr>  


<?php  
}   



// A callback function to save our extra taxonomy field(s)  
function save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
}  


// Add the fields to the "presenters" taxonomy, using our callback function  
add_action( 'presenters_edit_form_fields', 'presenters_taxonomy_custom_fields', 10, 2 );  

// Save the changes made on the "presenters" taxonomy, using our callback function  
add_action( 'edited_presenters', 'save_taxonomy_custom_fields', 10, 2 );  
