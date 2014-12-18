<?php
/**
 * Custom template tags for this theme.
 * This template used in order to keep main files of this theme clean
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package mulamula
 */

/** 
 * Nav_Home
 */
function mulamula_nav_home() { ?>
	<ul id="nav" class="nav">
	    <li class="current"><a class="smoothscroll" href="#home">Home</a></li>
	    <li><a class="smoothscroll" href="#about">About</a></li>
	    <li><a class="smoothscroll" href="#resume">Resume</a></li>
	    <li><a class="smoothscroll" href="#portfolio">Works</a></li>
	    <li><a class="smoothscroll" href="#testimonials">Testimonials</a></li>
	    <li><a class="smoothscroll" href="#contact">Contact</a></li>
	    <li><a class="smoothscroll" href="#widget-group">Feeds</a></li>
	</ul> <!-- end #nav -->
<?php }

function mulamula_nav_page() { ?>
	<ul id="nav" class="nav">
	    <li class="current"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">About</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#resume' ) ); ?>">Resume</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>">Works</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>">Testimonials</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a></li>
	    <li><a href="<?php echo esc_url( home_url( '/#widget-group' ) ); ?>">Feeds</a></li>
	</ul> <!-- end #nav -->
<?php }

if ( ! function_exists( 'mulamula_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function mulamula_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<div class="row">
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mulamula' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mulamula' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mulamula' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	</div>
	<?php
}
endif;

if ( ! function_exists( 'mulamula_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function mulamula_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mulamula' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'mulamula' ), true );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'mulamula' ), true );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'mulamula_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mulamula_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'mulamula' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'mulamula' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mulamula_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mulamula_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mulamula_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mulamula_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mulamula_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mulamula_categorized_blog.
 */
function mulamula_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'mulamula_categories' );
}
add_action( 'edit_category', 'mulamula_category_transient_flusher' );
add_action( 'save_post',     'mulamula_category_transient_flusher' );

/**
 * Social Icons
 */
function mulamula_social_icons() { 
	global $post; $author_id2=$post->post_author; ?>
	<li><a href="<?php the_author_meta('facebook', $author_id2); ?>"><i class="fa fa-facebook"></i></a></li>
	<li><a href="<?php the_author_meta('twitter', $author_id2); ?>"><i class="fa fa-twitter"></i></a></li>
	<li><a href="<?php the_author_meta('gplus', $author_id2); ?>"><i class="fa fa-google-plus"></i></a></li>
	<li><a href="<?php the_author_meta('linkedin', $author_id2); ?>"><i class="fa fa-linkedin"></i></a></li>
	<li><a href="<?php the_author_meta('instagram', $author_id2); ?>"><i class="fa fa-instagram"></i></a></li>
	<li><a href="<?php the_author_meta('github', $author_id2); ?>"><i class="fa fa-github"></i></a></li>
	<li><a href="<?php the_author_meta('pinterest', $author_id2); ?>"><i class="fa fa-pinterest"></i></a></li>

<?php } 

/*****
 * Credits theme
 */
function mulamula_credits() { ?>
	<li>Theme: <a href="https://github.com/makmalf/Resume">Resume</a> by <a href="http://makmalf.com/" rel="designer">Makmalf</a></li>
	<li><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'mulamula' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'mulamula' ), 'WordPress' ); ?></a></li>
    <li>From the static HTML called <a href="http://www.styleshout.com/free-templates/ceevee/">Ceevee10</a></li>
<?php }

/**
 * Hello, My name is . .. .
 */
function mulamula_hello() {
	global $post; $author_id0=$post->post_author; ?>
	<h1 class="responsive-headline">I'm <?php the_author_meta( 'display_name', $author_id0 ); ?>.</h1>
	<h3><?php the_author_meta('description', $author_id0); ?></h3>
<?php }

/**
 * Make it content of header dynamic based on what page he shows up
 */
function mulamula_logic_header() { 
	if ( is_category() ) : ?>
	<h1 class="responsive-headline"> <?php single_cat_title(); ?> </h1>

	<?php elseif ( is_tag() ) :
		echo '<h1 class="responsive-headline">'; 
		single_tag_title(); 
		echo '</h1>';

	elseif ( is_author() ) :
		echo '<h1 class="responsive-headline">'; 
		printf( __( 'Author: %s', 'mulamula' ), '<span class="vcard">' . get_the_author() . '</span>' );
		echo '</h1>';

	elseif ( is_day() ) :
		echo '<h1 class="responsive-headline">'; 
		printf( __( 'Day: %s', 'mulamula' ), '<span>' . get_the_date() . '</span>' );
		echo '</h1>';

	elseif ( is_month() ) :
		echo '<h1 class="responsive-headline">'; 
		printf( __( 'Month: %s', 'mulamula' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mulamula' ) ) . '</span>' );
		echo '</h1>';

	elseif ( is_year() ) :
		echo '<h1 class="responsive-headline">'; 
		printf( __( 'Year: %s', 'mulamula' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mulamula' ) ) . '</span>' );
		echo '</h1>';

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		_e( 'Asides', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		_e( 'Galleries', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		_e( 'Images', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		_e( 'Videos', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		_e( 'Quotes', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		_e( 'Links', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		_e( 'Statuses', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		_e( 'Audios', 'mulamula' );

	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		_e( 'Chats', 'mulamula' );

	elseif ( is_single() ) :
		the_title( '<h1 class="entry-title responsive-headline">', '</h1>' ); ?>
		<h3><?php echo get_the_excerpt(); ?></h3><!-- .entry-meta -->
		<?php
		$view_site = get_post_meta(get_the_ID(), 'Link', true);
		if ($view_site) {
			echo '<a href="' . $view_site . '" class="button">View site</a>';
		} ?>

	<?php elseif ( is_page() ) :
		the_title( '<h1 class="entry-title responsive-headline">', '</h1>' ); ?>
		<h3><?php echo get_the_excerpt(); ?></h3><!-- .entry-meta -->

	<?php elseif ( is_search() ) : ?>
		<?php printf( __( '<h1 class="responsive-headline">Search Results for: %s', 'mulamula' ), '<span>' . get_search_query() . '</span></h1>' ); ?>

	<?php else :
		_e( 'Archives', 'mulamula' );

	endif;
	// Show an optional term description.
	$term_description = term_description();
	if ( ! empty( $term_description ) ) :
		printf( '<h3 class="taxonomy-description">%s</h3>', $term_description );
	endif; // ! empty( $term_description )
}

function site_detail() {
	echo '<ul class="site-detail">';

	$view_site = get_post_meta(get_the_ID(), 'Link', true);
	if ($view_site) {
		echo '<li><a href="' . $view_site . '"><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;' . $view_site . '</a></li>';
	}

	$focus_site = get_post_meta(get_the_ID(), 'Development focus', true);
	if ($focus_site) {
		echo '<li><i class="fa fa-wrench"></i>&nbsp;&nbsp;&nbsp;' . $focus_site . '</li>';
	}

	$status_site = get_post_meta(get_the_ID(), 'Status', true);
	if ($status_site) {
		echo '<li><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;' . $status_site . '</li>';
	}

	echo '<li><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;' . get_the_tag_list( '', __( ', ', 'mulamula' ) ) . '</li>'; 

	echo '<ul>';
}