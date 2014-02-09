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
							echo do_shortcode("[simpleSubscribeForm]");
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
							}						
						?>
					</div>
					<div id="facebook">
						<h1 class="orange">Facebook AADIC</h1>
						<div class="fb-like-box" data-width="209" data-href="http://www.facebook.com/FacebookDevelopers" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" ></div>
					</div>
					<div id="partners">
						<h1 class="orange">Parceiros</h1>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisl lacus, molestie sed commodo volutpat, rutrum quis diam. Ut fringilla imperdiet pharetra. Fusce et mattis ipsum. Curabitur pulvinar egestas dolor nec porta. Phasellus rutrum, tortor ac consectetur iaculis, dui felis accumsan quam, quis tincidunt risus justo at quam. In vestibulum lorem non aliquam pulvinar. Curabitur a augue massa. Morbi mattis leo tellus, at porttitor neque aliquet eu. Pellentesque in enim sem. Pellentesque aliquet, velit quis porttitor viverra, risus massa suscipit mi, in faucibus quam enim at elit. Praesent egestas tortor a vestibulum aliquam.							
						</p>						
					</div>
				</section><!-- sidebar -->