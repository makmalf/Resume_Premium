<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'mulamula'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'mulamula'),
		'two' => __('Two', 'mulamula'),
		'three' => __('Three', 'mulamula'),
		'four' => __('Four', 'mulamula'),
		'five' => __('Five', 'mulamula')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'mulamula'),
		'two' => __('Pancake', 'mulamula'),
		'three' => __('Omelette', 'mulamula'),
		'four' => __('Crepe', 'mulamula'),
		'five' => __('Waffle', 'mulamula')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the categories into an array with output CATEGORY_NAME
	$options_categories_title = array();
	$options_categories_title_obj = get_categories();
	foreach ($options_categories_title_obj as $category) {
		$options_categories_title[$category->cat_name] = $category->cat_name;
	}


	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all tags into an array output with TAG_NAME
	$options_tags_title = array();
	$options_tags_title_obj = get_tags();
	foreach ( $options_tags_title_obj as $tag ) {
		$options_tags_title[$tag->name] = $tag->name;
	}

	// Pull all the pages into an array output with ID
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// Pull all the pages into an array output with PAGE_TITLE
	$options_pages_title = array();
	$options_pages_title_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages_title[''] = 'Select a page:';
	foreach ($options_pages_title_obj as $page) {
		$options_pages_title[$page->post_title] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	/**
	 * The admin interface starts here.
	 */

	//Basic Setting
	//***************************************
	$options[] = array(
		'name' => __('Homepage', 'mulamula'),
		'type' => 'heading');

	// About Us section
	$options[] = array(
		'name' => __('Select a Page for About Us section', 'mulamula'),
		'id' => 'about_page',
		'type' => 'select',
		'options' => $options_pages_title);

	// Resume Section
	$options[] = array(
		'name' => __('Select Pages for Resume section', 'mulamula'),
		'id' => 'resume_page_1',
		'type' => 'select',
		'options' => $options_pages_title);

	$options[] = array(
		'id' => 'resume_page_2',
		'type' => 'select',
		'options' => $options_pages_title);

	$options[] = array(
		'id' => 'resume_page_3',
		'type' => 'select',
		'options' => $options_pages_title);


	// Portofolio Section
	if ( $options_categories_title ) {
	$options[] = array(
		'name' => __('Select a Category of your portofolio', 'mulamula'),
		'id' => 'portofolio_cat',
		'type' => 'select',
		'options' => $options_categories_title);
	}

	// Testimonials Section
	$options[] = array(
		'name' => __('Show testimonials section?', 'mulamula'),
		'desc' => __('Check if you want to show it.', 'mulamula'),
		'id' => 'testimonials_section_display',
		'type' => 'checkbox');

	if ( $options_categories_title ) {
	$options[] = array(
		'desc' => __('Choose category posts of your testimonials.', 'mulamula'),
		'id' => 'testimonials_section',
		'class' => 'hidden',
		'type' => 'select',
		'options' => $options_categories_title);
	}

	// Call to Action Sections
	$options[] = array(
		'name' => __('Show Call to Action section?', 'mulamula'),
		'desc' => __('Check if you want to show it.', 'mulamula'),
		'id' => 'call_to_action_section_display',
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'call_to_action_section',
		'class' => 'hidden',
		'placeholder' => 'Words like: You have to try this',
		'type' => 'text');

	$options[] = array(
		'id' => 'desc_call_to_action_section',
		'class' => 'hidden',
		'placeholder' => 'Because it feels so good',
		'type' => 'textarea');

	$options[] = array(
		'desc' => __('Put URL to the button.', 'mulamula'),
		'id' => 'url_call_to_action_button',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Put your words to the button.', 'mulamula'),
		'id' => 'words_call_to_action_button',
		'class' => 'hidden',
		'type' => 'text');

	// Contact form sections 
	$options[] = array(
		'name' => __('Contact section', 'mulamula'),
		'desc' => __('Page for your words like: lets get in touch.', 'mulamula'),
		'id' => 'words_contact_section',
		'type' => 'select',
		'options' => $options_pages_title);

	$options[] = array(
		'id' => 'email',
		'placeholder' => 'Your email',
		'type' => 'text');

	$options[] = array(
		'id' => 'gmaps',
		'placeholder' => 'Your gmaps URL',
		'type' => 'textarea');

	// Style & Display Setting
	// ************************************
	$options[] = array(
		'name' => __('Style and Display Settings', 'mulamula'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('If you dont like black so much', 'mulamula'),
		'id' => 'dont_like_black',
		'std' => '#000',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'mulamula'),
		'desc' => __('Click here and see what happens.', 'mulamula'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Hidden Text Input', 'mulamula'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'mulamula'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Uploader Test', 'mulamula'),
		'desc' => __('This creates a full size uploader that previews the image.', 'mulamula'),
		'id' => 'example_uploader',
		'type' => 'upload');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' =>  __('Example Background', 'mulamula'),
		'desc' => __('Change the background CSS.', 'mulamula'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'mulamula'),
		'desc' => __('Multicheck description.', 'mulamula'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);

	

	$options[] = array( 'name' => __('Typography', 'mulamula'),
		'desc' => __('Example typography.', 'mulamula'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );

	$options[] = array(
		'name' => __('Custom Typography', 'mulamula'),
		'desc' => __('Custom typography options.', 'mulamula'),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );

	// Text Editor
	// *********************************
	$options[] = array(
		'name' => __('Text Editor', 'mulamula'),
		'type' => 'heading' );

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'mulamula'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'mulamula' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	

	return $options;
}