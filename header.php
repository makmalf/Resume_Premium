<?php
/**
 * Before you get deep into this theme's files, I want to ensure you that me coded this theme 
 * have tried so hard to make these line of codes readable and understandable just like your english novel.
 * No wonder if I left so many comments.
 * Dont forget to always check the codex.wordpress.org for the "highest quality" standard of 
 * how to develope any kinds of Wordpress theme in the right way.
 *
 * You're currently seeing this header element for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 * @package mulamula
 * That was mean this theme using "mulamula" word to helps you build this theme becomes a multilanguage theme.
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Why I dont see anything like CSS or JS in the head?
	 * That bunch of css and JS already called by a function I wrote at functions.php template. 
	 * That function I added well to wp_head function -->
	<?php 
	// So what's the meaning of this wp_head(); line ?
	wp_head(); /* This line is so important for your wordpress theme's supports and functionalities. 
	It hooks up any php functions of many Wordpress plugins you use and also many functions of this theme depend on this line. 
	Included, the CSS and JS files required by this theme. You'll be understand if you'r familiar with PHP 
	or if you once ever wrote a wordpress theme from zero */ 
	?> 

	<?php if( is_single() || has_post_thumbnail() && !is_home() ) : ?>
		<?php $background = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
		<style>
			header#home { 
				background: url(<?php echo $background[0]; ?>) repeat center center ;
			}

			header#home .banner-text {
				background: rgba(0, 0, 0, 0.5);
			}
		</style>
	<?php endif; ?>
</head>

<body <?php body_class(); //this is important too if you want to your site more dynamic. because this function
// returns or adds some classes based on conditions of the site, like the admin log in status, and so on ?>>
<div class="hfeed site">
	<header id="home" class="site-header" role="banner">
		
		<nav id="nav-wrap">
			<!-- just shows up when you're using mobile phone to open this site -->
	        <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
		    <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>
		    <?php if(is_home()) { // if you're on the homepage you'll see this: 
		     	/* function to shows up nav_home */
	         	mulamula_nav_home(); ?>
	        <?php } else { //but if you're not on the homepage you'll see this:
	         	mulamula_nav_page();
	         } ?>
      	</nav> <!-- end #nav-wrap -->

      	<div class="row banner">
	         <div class="banner-text">
		         	<?php if ( is_home() ) :
		         		/* function to show up the big bold "YOUR NAME" in the header of your homepage 
		         		it placed in inc/template-tags.php */
		         		mulamula_hello(); ?>
		            <ul class="social">
		           	 	<?php /* function to show up social icons, it placed in inc/template-tags.php */ 
		               		mulamula_social_icons(); ?>
		            </ul>
		            <hr/>
		            <?php else : 
		            	/* function to make header more dynamic, it placed in inc/template-tags.php */ 
		            	mulamula_logic_header();
					endif; // is_home ?>
	         </div>
      	</div>

      	<p class="scrolldown">
         	<a class="smoothscroll" href="#content"><i class="icon-down-open-big"></i></a>
      	</p>
      
	</header><!-- #masthead -->
	
	<div id="content" class="site-content">
	<div class="wrapper">