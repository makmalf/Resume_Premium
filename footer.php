<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the #content div and all content after
*
* @package mulamula
*/
?>
			<section id="widget-group">
				
				<div class="row">
					<div class="three columns header-col">
						<?php dynamic_sidebar( 'footer-col-1' ); ?>
					</div>
					<div class="three columns header-col">
						<?php dynamic_sidebar( 'footer-col-2' ); ?>
					</div>
					<div class="three columns header-col">
						<?php dynamic_sidebar( 'footer-col-3' ); ?>
					</div>
					
					<div class="three columns header-col">
						<?php dynamic_sidebar( 'footer-col-4' ); ?>
					</div>
				</div>
			</section>
		</div><!-- .wrapper -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="site-info">
				<div class="row">
					<div class="twelve columns">
						<ul class="social-links">
							<?php mulamula_social_icons(); ?>
						</ul>
						<ul class="copyright">
							<?php mulamula_credits(); ?>
						</ul>
					</div>
					<div id="go-top">
						<a class="smoothscroll" title="Back to Top" href="#home"><i class="fa fa-chevron-up"></i></a>
					</div>
				</div>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- .hfeed .site -->
<?php 
// So what's the meaning of this wp_footer(); line ?
wp_footer(); //this line is so important for your wordpress theme's supports and functionalities. It hooks up any php 
// functions of many plugins and also many functions of this theme depend on this line. 
// you'll be understand if you'r familiar with PHP or if you ever wrote a wordpress theme from zero ?> 
</body>
</html>