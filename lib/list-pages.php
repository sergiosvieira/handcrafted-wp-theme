<?php
	// add_action('init', 'list_pages');
	ob_start();

	function list_pages()
	{
		$parent = "PARENT_PAGE_ID";
		$args = array(
		  'depth'        => 0,
		  'show_date'    => '',
		  'date_format'  => get_option('date_format'),
		  'child_of'     => $parent,
		  'exclude'      => '',
		  'include'      => '',
		  'title_li'     => __(''),
		  'echo'         => 1,
		  'authors'      => '',
		  'sort_column'  => 'order, post_title',
		  'link_before'  => '',
		  'link_after'   => '',
		  'walker'       => '',
		  'post_type'    => 'page',
		  'post_status'  => 'publish'
		);
		$pages = get_pages($args);
?>

						<ul class="nav nav-pills nav-justified menu">
<?php
		foreach ($pages as $page) {
			$title = $page->post_title;
			$subtitle = get_post_meta($page->ID, "subtitle", true);
			$link = get_page_link($page->ID);
?>
							<li>
								<a href="<?php echo $link; ?>" class="menu-item">
									<p class="menu-title">
										<?php echo $title ?>	
									</p>
									<p class="menu-subtitle">
										<?php echo $subtitle; ?>
									</p>
								</a>							
							</li>
<?php
		}
}
?>
						</ul>