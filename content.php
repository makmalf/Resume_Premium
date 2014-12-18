<?php
/**
 * The template for showing up blog posts at homepage
 * @package mulamula
 */
?>

<div class="row">
<div class="twelve columns">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mulamula_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->

	<div class="entry-content cf">
		<?php 

			//Add the div if has post_thumbnail
			if(has_post_thumbnail()) {
				echo '<div class="img-arc">'; 
				the_post_thumbnail('large'); 
				echo '</div>'; 
			}
		
			if(has_post_thumbnail()) {
				echo '<div class="meta-arc">';
			}

			if(has_excerpt()) { 
				the_excerpt();
			} else {
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Learn more %s <span class="meta-nav">&rarr;</span>', 'mulamula' ), 
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}

			site_detail(); #in template-tags.php

			//close that div if has post_thumbnail
			if(has_post_thumbnail()) {
				echo '</div>';
			}
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mulamula' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php if(!is_category('portfolio')) { ?>
	<div class="footer entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mulamula' ) );
				if ( $categories_list && mulamula_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'mulamula' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mulamula' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'mulamula' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'mulamula' ), __( '1 Comment', 'mulamula' ), __( '% Comments', 'mulamula' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'mulamula' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-footer -->
<?php } ?>
</article><!-- #post-## -->
</div>
</div>