<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>
		<div id="primary">
			<div id="content" class="row">
				<?php 
					if (is_home())
					{
?>
<!-- Home -->
				<section class="col-md-9">
					<div id="boot-strap-slider">
						<?php do_action('insert_bootstrapslider'); ?>	
					</div> <!-- boot-strap-slider -->
					<div id="home-news">
						<h1 class="orange">
							Destaques AADIC
						</h1>
					</div>
				</section>
<?
					}
					else
					{
						get_template_part( 'loop', 'index' ); 	
					}
				?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>