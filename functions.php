<?php
/**
 * mulamula functions and definitions
 *
 * @package mulamula
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'mulamula_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mulamula_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mulamula, use a find and replace
	 * to change 'mulamula' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mulamula', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	
}
endif; // mulamula_setup
add_action( 'after_setup_theme', 'mulamula_setup' );

/**
 * Adding some required conditional CSS
 */
function mulamula_style_just_in_home() { 
 	if(!is_home()) { ?>
		<style>
			#content {
	   			padding-top: 96px;
			}
			#main {
			   padding-bottom: 48px;
			}
		</style>
<?php } 
}
add_action( 'wp_head', 'mulamula_style_just_in_home' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mulamula_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Col-1', 'mulamula' ),
		'id'            => 'footer-col-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Col-2', 'mulamula' ),
		'id'            => 'footer-col-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Col-3', 'mulamula' ),
		'id'            => 'footer-col-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Col-4', 'mulamula' ),
		'id'            => 'footer-col-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'mulamula_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mulamula_scripts() {
	wp_enqueue_style( 'mulamula-style', get_stylesheet_uri() );

	// css files from the static:
	wp_enqueue_style( 'mulamula-style-default', get_template_directory_uri() . '/css/default.css' );
	wp_enqueue_style( 'mulamula-style-layout', get_template_directory_uri() . '/css/layout.css' );
	wp_enqueue_style( 'mulamula-style-media-queries', get_template_directory_uri() . '/css/media-queries.css' );
	wp_enqueue_style( 'mulamula-style-magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style ( 'mulamula-tetelo', get_template_directory_uri() . '/css/fontello/css/tetelo.css' );
	wp_enqueue_style( 'mulamula-fontAwesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
	
	// js files from the static:
	wp_enqueue_script( 'mulamula-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '20140929', true );
	wp_enqueue_script( 'mulamula-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '20140929', true );
	wp_enqueue_script( 'mulamula-waypoints', get_template_directory_uri() . '/js/waypoints.js', array(), '20140929', true );
	wp_enqueue_script( 'mulamula-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array(), '20140929', true );
	wp_enqueue_script( 'mulamula-style-magnific-popupjs', get_template_directory_uri() . '/js/magnific-popup.js', array(), '20140929', true );
	wp_enqueue_script( 'mulamula-init', get_template_directory_uri() . '/js/init.js', array(), '20140929', true );

	// js files from Wordpress preinstall
	wp_enqueue_script( 'jquery' );

	// js files from standard mulamula by _s
	wp_enqueue_script( 'mulamula-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'mulamula-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// support Wordpress threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mulamula_scripts' );

/**
 * Add User Meta Profile Fields
**/
function mulamula_modify_contact_methods($profile_fields) {

     // Add new fields
     $profile_fields['twitter'] = 'Twitter URL';
     $profile_fields['facebook'] = 'Facebook URL';
     $profile_fields['gplus'] = 'Google+ URL';
     $profile_fields['instagram'] = 'Instagram URL';
     $profile_fields['pinterest'] = 'Pinterest URL';
     $profile_fields['linkedin'] = 'LinkedIN URL';
     $profile_fields['github'] = 'Github URL';
     $profile_fields['address'] = 'Address';
     $profile_fields['phone'] = 'Phone/Whatsapp';
     $profile_fields['bbm'] = 'BBM';

     return $profile_fields;
}
add_filter('user_contactmethods', 'mulamula_modify_contact_methods');

/**
 * Support Widget FB Like BOX
**/
function mulamula_fbScript() { ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=260337454144358&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
        
                 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46607349-1', 'auto');
  ga('send', 'pageview');

</script>
        
<?php }
add_action('wp_footer', 'mulamula_fbScript' ); // script put into footer by wp_footer

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

/**
 * jQuery function to show/hide element in options panel
 * when a checkbox is clicked.
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

	// for Testimonials Section
	jQuery('#testimonials_section_display').click(function() {
  		jQuery('#section-testimonials_section').fadeToggle(400);
	});

	if (jQuery('#testimonials_section_display:checked').val() !== undefined) {
		jQuery('#section-testimonials_section').show();
	}

	// for Call to Action Section
	jQuery('#call_to_action_section_display').click(function() {
  		jQuery('#section-call_to_action_section').fadeToggle(400);
  		jQuery('#section-url_call_to_action_button').fadeToggle(400);
  		jQuery('#section-words_call_to_action_button').fadeToggle(400);
  		jQuery('#section-desc_call_to_action_section').fadeToggle(400);
	});

	if (jQuery('#call_to_action_section_display:checked').val() !== undefined) {
		jQuery('#section-call_to_action_section').show();
		jQuery('#section-url_call_to_action_button').show();
		jQuery('#section-words_call_to_action_button').show();
		jQuery('#section-desc_call_to_action_section').show();
	}

});
</script>

<?php
}

/**
 * Implement the Custom Header feature.
 * Since I prefer to use Theme Options Framework, 
 * I no longoer used this, if you want to, just uncomment this.
 */
// require get_template_directory() . '/inc/custom-header.php';

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
