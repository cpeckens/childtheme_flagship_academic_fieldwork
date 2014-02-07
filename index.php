<?php get_header();    $theme_option = flagship_sub_get_global_options(); ?>
<div class="row wrapper radius10" id="page" role="main">
	<div class="twelve columns">
		<section class="content ten columns">
		<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
		<?php 
			$paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;
			if ( false === ( $news_archive_query = get_transient( 'news_archive_query_' . $paged ) ) ) {
				if ($news_query_cond === 1) {
					$news_archive_query = new WP_Query(array(
						'post_type' => 'post',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => array( 'books' ),
								'operator' => 'NOT IN'
							)
						),
						'posts_per_page' => 10,
						'paged' => $paged)); 
				} else {
					$news_archive_query = new WP_Query(array(
						'post_type' => 'post',
						'posts_per_page' => 10,
						'paged' => $paged
						)); 
				}
					set_transient( 'news_archive_query_' . $paged, $news_archive_query, 2592000 );
			} 	

		while ($news_archive_query->have_posts()) : $news_archive_query->the_post(); ?>
			<a href="<?php the_permalink(); ?>">	
				<h5><?php the_title();?></h5>
					<?php if ( has_post_thumbnail()) { ?> 
						<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft")); ?>
					<?php } ?>
				<?php the_excerpt(); ?>
			</a>
				<hr>
			<?php endwhile; ?>
		<div class="row">
			<?php flagship_pagination($news_archive_query->max_num_pages); ?>		
		</div>	
		</section>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>