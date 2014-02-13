<?php

function list_all_posts($atts)
{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'category_name' => 'noticias',
		'posts_per_page' => 10,
		'paged' => $paged,
		'order' => 'DESC' 
	);

	$the_query = new WP_Query($args);

	// The Loop
	if ( $the_query->have_posts() ) {
?>								
	<ul>
<?php
		while ( $the_query->have_posts() ) {
			$the_query->the_post();								
?>
		<li>
			<?php echo get_the_date("d-m-Y"); ?> :
			<a href="<?php echo the_permalink(); ?>">
			<?php 
				$max_legth = 100;
				$tmp = "";
				$small_title = substr(get_the_title(), 0, $max_legth);

				if (strlen($small_title) > $max_legth - 1)
				{
					$tmp = "...";
				}

				echo $small_title . $tmp;
			?>
			</a>
		</li>
<?php
		}
?>								
	</ul>

	<nav id="nav-below" role="article">
		<ul class="pager">
		  <li class="previous"><?php echo get_previous_posts_link( 'Anteriores', $the_query->max_num_pages ); ?></li>
		  <li class="next"><?php echo get_next_posts_link( 'Próximos', $the_query->max_num_pages ); ?></li>
		</ul>
	</nav><!-- #nav-below -->

<?php
		} else {
			// no posts found
		}

		wp_reset_postdata();
}

add_shortcode('list_all_posts', 'list_all_posts');
?>