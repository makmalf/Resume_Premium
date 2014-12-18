<?php

/**********
 * JUST UNCOMMENT THEM IF YOU WANT THIS FEATURE
 */
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *	<?php if ( get_header_image() ) : ?>
 *	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
 *		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
 *	</a>
 *	<?php endif; // End header image check. ?>
 *
 *
 * @package mulamula
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses mulamula_header_style()
 * @uses mulamula_admin_header_style()
 * @uses mulamula_admin_header_image()
 */
 
/* function mulamula_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'mulamula_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header-background.jpg',
		'flex-width'			 => true,
		'width'                  => 1000,
		'height'                 => 768,
		'flex-height'            => true,
		'header-text'			 => false,
		'wp-head-callback'       => '',
		'admin-head-callback'    => 'mulamula_admin_header_style',
		'admin-preview-callback' => 'mulamula_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'mulamula_custom_header_setup' );


if ( ! function_exists( 'mulamula_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see mulamula_custom_header_setup().
 */
/* function mulamula_admin_header_style() {
?>
	<style type="text/css">
		header#home {
			background: #161415 url(<?php header_image(); ?>)  no-repeat top center;
		}

		header#home h1, header#home h3 {
			color: #fff;
		}
	</style>
<?php
}
endif; // mulamula_admin_header_style

if ( ! function_exists( 'mulamula_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see mulamula_custom_header_setup().
 */
/* function mulamula_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<header id="home" class="site-header" role="banner">
		<div class="row banner">
			<div class="banner-text">
				<center>
				<div id="name">
					<h1 class="displaying-header-text" onclick="return false;" <?php echo $style; ?>>
						Hello, I'm The Author of This Site
					</h1>
					<h3 class="displaying-header-text" onclick="return false;" <?php echo $style; ?>>
						Description goes here
					</h3>
					<hr />
				</div>
				</center>
			</div>
		</div>
	</header><!-- #masthead -->
<?php
}
endif; // mulamula_admin_header_image 
