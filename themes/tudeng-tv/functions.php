<?php
/**
 * Tudeng TV functions and definitions
 *
 * @package Tudeng TV
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'tudeng_tv_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tudeng_tv_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tudeng TV, use a find and replace
	 * to change 'tudeng-tv' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tudeng-tv', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tudeng-tv' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tudeng_tv_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // tudeng_tv_setup
add_action( 'after_setup_theme', 'tudeng_tv_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tudeng_tv_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tudeng-tv' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'tudeng_tv_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tudeng_tv_scripts() {
	wp_enqueue_style( 'tudeng-tv-style', get_stylesheet_uri() );

	wp_enqueue_script( 'tudeng-tv-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'tudeng-tv-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tudeng_tv_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';












//Add support for custom header image:
$args = array(
	'flex-width'    => true,
	'width'         => 317,
	'flex-height'    => true,
	'height'        => 63,
	'default-image' => get_template_directory_uri() . '/images/logo.png',
);
add_theme_support( 'custom-header', $args );



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
			'supports' => array('title' , 'thumbnail'/*, 'editor'*/),
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
			'supports' => array('title' , 'thumbnail'/*, 'editor'*/),
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
				'has_archive' => 'videouudis',
				'taxonomies' => array('post_tag')
			); 
			register_post_type('videouudis',$videouudis_args);
		}

/*
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
*/

		require 'osa_func.php';

		add_action('init', 'osa_init');
		function osa_init() 
		{
			$osa_labels = array(
				'name' => _x('Saated', 'post type general name'),
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
		    add_settings_section( 'pu_text_section', 'Teise taseme pealkirjade omadused', 'pu_display_section', 'pu_theme_options.php' );

		    // Create textbox field
		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox',
		      'name'      => 'pu_textbox',
		      'desc'      => '',
		      'std'       => '',
		      'label_for' => 'pu_textbox',
		      'class'     => 'css_class'
		    );

		    //add_settings_field( 'example_textbox', 'Font', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

			
			
			

			
			
			add_settings_field(
			'Font',
			'Font',
			'sandbox_select_element_callback',
			'pu_theme_options.php',
			'pu_text_section'
		);
			
			
			
			
			
			
			

		    // Create textbox field
		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox3',
		      'name'      => 'pu_textbox3',
		      'desc'      => 'Näited: 2em, 32px;',
		      'std'       => '',
		      'label_for' => 'pu_textbox3',
		      'class'     => 'css_class3'
		    );

		    add_settings_field( 'example_textbox3', 'Suurus', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section', $field_args );

		    add_settings_section( 'pu_text_section2', 'Linkide värv', 'pu_display_section', 'pu_theme_options.php' );

		    $field_args = array(
		      'type'      => 'text',
		      'id'        => 'pu_textbox2',
		      'name'      => 'pu_textbox2',
		      'desc'      => 'Näide: #333333',
		      'std'       => '',
		      'label_for' => 'pu_textbox2',
		      'class'     => 'css_class2'
		    );

		    add_settings_field( 'example_textbox2', 'Värvikood', 'pu_display_setting', 'pu_theme_options.php', 'pu_text_section2', $field_args );
			
			$field_args = array(
		      'type'      => 'checkbox',
		      'id'        => 'example_checkbox2'
		    );
			
			add_settings_field(
				'example_checkbox2',
				'Kuva joont lingi all',
				'pu_display_setting',
				'pu_theme_options.php',
				'pu_text_section2',
				$field_args 
			);
			
		}

// Custom callbacks
function sandbox_checkbox_element_callback() {
 
    $options = get_option( 'sandbox_theme_input_examples' );
     
    $html = '<input type="checkbox" id="example_checkbox2" name="sandbox_theme_input_examples[checkbox_example]" />';
    $html .= '<label for="checkbox_example"></label>';
     
    echo $html;
 
} // end sandbox_checkbox_element_callback


function sandbox_select_element_callback() {
 
    $options = get_option( 'sandbox_theme_input_examples' );
     
    $html = '<select id="font_options" name="sandbox_theme_input_examples[font_options]">';
        $html .= '<option value="default">Vali sobiv font...</option>';
        $html .= '<option value="Open Sans"' . selected( $options['font_options'], 'Open Sans', false) . '>Open Sans</option>';
        $html .= '<option value="Arial"' . selected( $options['font_options'], 'Arial', false) . '>Arial</option>';
        $html .= '<option value="Comic Sans MS"' . selected( $options['font_options'], 'Comic Sans MS', false) . '>Comic Sans MS</option>';
    $html .= '</select>';
     
    echo $html;
 
} // end sandbox_radio_element_callback






/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
	// Add new "Saated" taxonomy to Posts
	register_taxonomy('saade', 'osa', array(
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
		'slug' => 'saade', // This controls the base slug that will display before each term
		'with_front' => false, // Don't display the category base before "/saated/"
		'show_ui'           => true,
		'show_admin_column' => true,
		'hierarchical' => true // This will allow URL's like "/saated/fookus/hooaeg-1/"
		),
		));
}
add_action( 'init', 'add_custom_taxonomies', 0 );












// Add term page
function ttv_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'ttv' ); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','ttv' ); ?></p>
	</div>
<?php
}
add_action( 'saade_add_form_fields', 'ttv_taxonomy_add_new_meta_field', 10, 2 );


// Edit term page
function ttv_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'ttv' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a value for this field','ttv' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'saade_edit_form_fields', 'ttv_taxonomy_edit_meta_field', 10, 2 );


// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_saade', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_saade', 'save_taxonomy_custom_meta', 10, 2 );



// WP Admin CSS
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .wp-post-image{
    	max-width:100px;height:auto;
    };
  </style>';

}











//Add widget area to videouudised
/**
 * Register our sidebars and widgetized areas.
 *
 */
function ttv_widgets_init() {

	register_sidebar( array(
		'name' => 'Ala videouudiste all',
		'id' => 'viimati_lisatud_vid',
		'before_widget' => '<div id="news_clips" class="clips">',
		'after_widget' => '</div>',
		'before_title' => '<p>',
		'after_title' => '</p>'
	) );
}
add_action( 'widgets_init', 'ttv_widgets_init' );











/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class ttv_Widget_Recent_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Vimati lisatud video uudised") );
        parent::__construct('recent-posts', __('Viimased Videouudised'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
/*
        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :*/
?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>


        <?php 
        /*
       	while ( $r->have_posts() ) : $r->the_post(); ?>
            <li>
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
            <?php if ( $show_date ) : ?>
                <span class="post-date"><?php echo get_the_date(); ?></span>
            <?php endif; ?>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
*/
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
// TTV - otsi välja samade tagidega postitused


    $current_post_ID = get_the_ID();
       $tags = wp_get_post_tags( $current_post_ID );
       //echo var_dump($tags);
    $search_tags = array();

	$length = count($tags);
	for ($i = 0; $i < $length; $i++) {
		//print $tags[$i]->slug;
		if (!empty($tags[$i]->slug)) {
			$search_tags[$i] =  $tags[$i]->slug;
		}
	}

	//echo "<p>Sisaldab tag-i: ". var_dump($search_tags) . "</p>";


if ( ! empty( $tags ) ) {
  // Create new query of related
  $related = new WP_Query(
  	array(
  		'posts_per_page' => 3,
  		'tag_slug__in' => $search_tags/*$tags[0]->slug*/, // Containse tags in array - $search_tags
  		'orderby' => 'rand',
  		'post_type'=> 'any'
  	) );

//
	if( $related->have_posts() ) {
		while ($related->have_posts()) : $related->the_post(); 
		if ($current_post_ID != get_the_ID()) {?>
		<div class="clips-container">
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail( 'videouudis-image' ); ?>
			</a>
				<span class="clip-title"><?php the_title(); ?></span>
				<?php //the_tags(); ?>
			</div>
			<?php
		}
		endwhile;
	}
}
wp_reset_postdata();

echo $after_widget;

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////


        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = (bool) $new_instance['show_date'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('ttv_Widget_Recent_Posts', 'widget');
    }

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
    }
}


function ttv_register_custom_widgets() {
    register_widget( 'ttv_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'ttv_register_custom_widgets' );

