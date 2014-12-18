<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package mulamula
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mulamula' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<div class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'mulamula' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->
