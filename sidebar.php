<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?>
				<section id="sidebar" class="col-md-3">
					<div id="newsletter">
						<h1 class="orange">Boletim AADIC</h1>
						<?php
							echo do_shortcode("[newsletter]");
						?>
					</div>
					<div id="schedule">
						<h1 class="orange">Agenda AADIC</h1>
						<?php
							$args = array(
								'post_type' => 'bravo_schedule',
								'posts_per_page' => 5, 
								'order' => 'DESC' 
							);

							$the_query = new WP_Query($args);

							// The Loop
							if ( $the_query->have_posts() ) {
								echo '<ul class="list-group">';

								while ( $the_query->have_posts() ) 
								{
									$the_query->the_post();
									$output = '
										<li><span>%s</span> - <a href="%s">%s</a></li>
									';

									$link = get_permalink();
									$max_legth = 40;
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
							}						
						?>
					</div>
					<div id="facebook">
						<h1 class="orange">Facebook AADIC</h1>
						<div class="fb-like-box" data-width="209" data-href="http://www.facebook.com/FacebookDevelopers" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" ></div>
					</div>
					<div id="partners">
						<h1 class="orange">Parceiros</h1>
<?php
							$args = array(
								'post_type' => 'bravo_partners',
								'order' => 'DESC' 
							);

							$the_query = new WP_Query($args);

							// The Loop
							if ( $the_query->have_posts() ) {
								echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';
								
								$partnersArray = array();

								while ( $the_query->have_posts() ) 
								{
									$the_query->the_post();
									$array = array(
										"title" => get_the_title(),
										"thumbnail" => get_the_post_thumbnail(get_the_ID(), array(209, 209))
									);

									array_push($partnersArray, $array);
								}


								echo '<ol class="carousel-indicators">';

								$counter = 0;

								foreach ($partnersArray as $partner) {
	  								if ($counter == 0)
	  								{
	 									$output = '<li data-target="#carousel-example-generic" data-slide-to="%d" class="active"></li>';
	  								}
	    							else
	    							{
	    								$output =  '<li data-target="#carousel-example-generic" data-slide-to="%d"></li>';
	    							}

	    							echo sprintf($output, $counter);
	    							$counter++;								
								}

								echo '</ol>';
								echo '<div class="carousel-inner">';

								$counter = 0;

								foreach($partnersArray as $partner)
								{
									//var_dump($partnersArray);
									$active = "";

									if ($counter == 0)
									{
										$active = "active";
									}

									$output = '
									    <div class="item '. $active .'">
									      %s
									    </div>';

									$image = "";

									if (!isset($partner["thumbnail"]) || strlen($partner["thumbnail"]) < 1)
									{
										$image = sprintf('<img src="http://dummyimage.com/209x209/000/fff" alt="" class="img-thumbnail">');
									}
									else
									{
										$image = $partner["thumbnail"];
									}

									echo sprintf($output, $image);
									$counter++;
								}

								echo '</div>';

								echo '
									  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
									    <span class="glyphicon glyphicon-chevron-left"></span>
									  </a>
									  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
									    <span class="glyphicon glyphicon-chevron-right"></span>
									  </a>
								';

								echo '</div> <!-- carrousel -->';
							}	
							wp_reset_postdata();
?>					
					</div>
				</section><!-- sidebar -->