<?php

function list_all_schedules($atts)
{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'post_type' => 'bravo_schedule',
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
		echo '<ul class="list-group">';

		while ( $the_query->have_posts() ) 
		{
			$the_query->the_post();
			$output = '
				<li><span>%s</span> - <a href="%s">%s</a></li>
			';

			$link = get_permalink();
			$max_legth = 100;
			$tmp = "";
			$small_title = substr(get_the_title(), 0, $max_legth);

			if (strlen(get_the_title()) > $max_legth)
			{
				$tmp = "...";
			}

			$date = get_post_meta( get_the_ID(), 'date', true );

			echo sprintf( 
				$output,
				$date,
				$link,
				$small_title . $tmp
			);
		}

		echo '</ul>';
		wp_reset_postdata();
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

add_shortcode('list_all_schedules', 'list_all_schedules');
?>