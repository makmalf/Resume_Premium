<?php
/**
 * mulamula Theme Customizer
 *
 * @package mulamula
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * The goodness of WP Customizer API starts from here
 */
function mulamula_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting( 'mulamula_header_big_color',     
		array(
            'default'     => '#fff'
        )
    );
	 $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_big_color',
            array(
                'label'      => __( 'Header Big Text Color', 'blankslate' ),
                'section'    => 'colors',
                'settings'   => 'mulamula_header_big_color'
            )
        )
    );

	$wp_customize->add_setting( 'mulamula_header_desc_color',     
		array(
            'default'     => '#A8A8A8'
        )
    );
	 $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'header_desc_color',
            array(
                'label'      => __( 'Header Desc Text Color', 'blankslate' ),
                'section'    => 'colors',
                'settings'   => 'mulamula_header_desc_color'
            )
        )
    );
}
add_action( 'customize_register', 'mulamula_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mulamula_customize_preview_js() {
	wp_enqueue_script( 'mulamula_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mulamula_customize_preview_js' );

