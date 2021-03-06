<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); 

?>
		<div id="primary">
			<div id="content" class="row">
				<?php 
					
					$type = $_GET['type'] ? $_GET['type'] : "";

					if ($type == "schedule")
					{
						get_template_part('schedules');
						get_sidebar();
					}
					else if (is_home())
					{
?>
<!-- Home -->
				<section class="col-md-9">
					<div id="boot-strap-slider">
						<?php do_action('insert_bootstrapslider'); ?>	
					</div> <!-- boot-strap-slider -->
					<div id="home-news">
						<h1 class="orange-full">
							Destaques AADIC
						</h1>
						<?php
							$args = array(
								'category_name' => 'noticias',
								'posts_per_page' => 3, 
								'order' => 'DESC' 
							);

							$the_query = new WP_Query($args);

							// The Loop
							if ( $the_query->have_posts() ) {
?>								
						<ul class="nav nav-pills nav-justified">
<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();								
?>
							<li id="post-item">
									<div id="post-image">
									<?php
										$thumbnail = get_the_post_thumbnail(get_the_ID(), array(211, 131));

										if (isset($thumbnail))
										{
											echo $thumbnail;
										}
										else
										{
											echo '<img src="http://dummyimage.com/211x131/000/fff" alt="">';
										}
									?>
									</div>
									<div id="post-title">
										<a href="<?php echo the_permalink(); ?>">
										<?php 
											$max_legth = 60;
											$tmp = "";
											$small_title = substr(get_the_title(), 0, $max_legth);

											if (strlen($small_title) > $max_legth - 1)
											{
												$tmp = "...";
											}

											echo $small_title . $tmp;
										?>
										</a>
									</div>
									<div id="post-content-resume">
										<?php
											$max_legth = 60;
											$tmp = "";
											$small_content = substr(get_the_content(), 0, $max_legth);

											if (strlen($small_title) > $max_legth - 1)
											{
												$tmp = "...";
											}

											echo strip_tags($small_content) . $tmp; 
										?>								
								</div>
							</li>
<?php
							}
?>								
						</ul>
<?php
							} else {
								// no posts found
							}

							wp_reset_postdata();
						?>
						<?php echo '<a class="btn btn-primary navbar-btn" href="' . get_permalink( get_page_by_title( 'Notícias' ) ) .'">Ver todas</a>'; ?>						
					</div>
					<div id="contact">
						<section id="contact-title">
							<p>
								Para nós, atendimento é sinônimo de confiança, segurança e comprometimento em todos os momentos. Em que podemos lhe ajudar?
							</p>
						</section> <!-- contact-title -->
						<section id="contact-email" class="col-md-offset-1 col-md-6">
							<?php 
								echo do_shortcode("[si-contact-form form='1']"); 
							?>
						</section>
					</div><!-- contact -->
				</section> <!-- body section -->
				<?php get_sidebar(); ?>
<?
					}
					else
					{
						get_template_part( 'loop', 'index' );
					}
				?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
