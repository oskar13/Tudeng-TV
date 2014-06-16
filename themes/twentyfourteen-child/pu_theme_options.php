<?php

 /**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */ 
 function pu_theme_page()
 {
 	?>
 	<div class="section panel">
 		<h1>Muuda välimuse sätteid</h1>
 		<form method="post" enctype="multipart/form-data" action="options.php">
 			<?php 
 			settings_fields('pu_theme_options'); 

 			do_settings_sections('pu_theme_options.php');
 			?>
 			<p class="submit">  
 				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
 			</p>  

 		</form>


 	</div>
 	<?php
 }



/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function pu_display_setting($args)
{
	extract( $args );

	$option_name = 'pu_theme_options';

	$options = get_option( $option_name );

	switch ( $type ) {  
		case 'text':  
		$options[$id] = stripslashes($options[$id]);  
		$options[$id] = esc_attr( $options[$id]);  
		echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
		break;  
	}
}


/**
 * Function to add extra text to display on each section
 */
function pu_display_section($section){ 

}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function pu_validate_settings($input)
{
	foreach($input as $k => $v)
	{
		$newinput[$k] = trim($v);

	// Check the input is a letter or a number
		if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
			$newinput[$k] = '';
		}
	}

	return $newinput;
}