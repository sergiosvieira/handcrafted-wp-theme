<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>
		<button type="button" class="btn btn-default">Default</button>

		<div id="primary">
			<div id="content">

				<?php get_template_part( 'loop', 'index' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>