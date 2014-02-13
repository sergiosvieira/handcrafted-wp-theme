<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); 

	$show = $_GET['show'];
?>

		<div id="primary">
			<div id="content-post" class="col-md-9">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if ($show != 'no') { ?>
				<nav id="nav-above" role="article">
					<ul class="pager">
					  <li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'themename' ) . '</span> ' ); ?></li>
					  <li class="next"><?php next_post_link( '%link', ' <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'themename' ) . '</span>' ); ?></li>
					</ul>
				</nav><!-- #nav-above -->
<?php } ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title orange-full"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
							if ($show != 'no') {
								printf( __( '<span class="meta-prep meta-prep-author">Publicado em </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="meta-sep"> por </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'themename' ),
									get_permalink(),
									get_the_date( 'c' ),
									get_the_date(),
									get_author_posts_url( get_the_author_meta( 'ID' ) ),
									sprintf( esc_attr__( 'View all posts by %s', 'themename' ), get_the_author() ),
									get_the_author()
								);
							}
							?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php
							if ($show != 'no') {
								$tag_list = get_the_tag_list( '', ', ' );
								if ( '' != $tag_list ) {
									$utility_text = __( 'Este artigo foi publicado em %1$s e marcado %2$s. Adicione <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a> como favorito.', 'themename' );
								} else {
									$utility_text = __( 'Este artigo foi publicado em %1$s. Adicione <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a> como favorito.', 'themename' );
								}
								printf(
									$utility_text,
									get_the_category_list( ', ' ),
									$tag_list,
									get_permalink(),
									the_title_attribute( 'echo=0' )
								);
							}
						?>

						<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

<?php if ($show != 'no') { ?>
				<nav id="nav-below" role="article">
					<ul class="pager">
					  <li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'themename' ) . '</span> ' ); ?></li>
					  <li class="next"><?php next_post_link( '%link', ' <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'themename' ) . '</span>' ); ?></li>
					</ul>
				</nav><!-- #nav-below -->
<?php } ?>

				<?php //comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>