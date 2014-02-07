<?php get_header(); 
    $theme_option = flagship_sub_get_global_options();
    $news_quantity = $theme_option['flagship_sub_news_quantity'];
    $color_scheme = $theme_option['flagship_sub_color_scheme'];
		if ( false === ( $latest_post_query = get_transient( 'latest_post_query' ) ) ) {
		// It wasn't there, so regenerate the data and save the transient
		$latest_post_query = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => 1)); 
			set_transient( 'latest_post_query', $latest_post_query, 2592000 );
        } 
		if ( false === ( $news_query = get_transient( 'news_query' ) ) ) {
			// It wasn't there, so regenerate the data and save the transient
			$news_query = new WP_Query(array(
				'post_type' => 'post',
				'offset' => 1,
				'posts_per_page' => 6)); 
				set_transient( 'news_query', $news_query, 2592000 );
		} 	

?>
<div class="row hide-for-mobile">
    <div id="slider" class="twelve columns radius10 no-gutter">
        <div class="slide">
            <img src="<?php header_image(); ?>" class="radius10" />
        </div>
    </div>
</div>
<div class="row wrapper radius10" id="page" role="main">
	<div class="twelve columns">
	    <div class="row">
	        <?php if ( $latest_post_query->have_posts() ) : ?>
	            <div class="six columns">
                    <h4>Latest <?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
            <?php while ($latest_post_query->have_posts()) : $latest_post_query->the_post(); ?>
                    <div class="row post-container">
                        <div class="eleven columns centered post">
                    <a href="<?php the_permalink(); ?>">
                        <div class="row featured">
                                <?php if ( has_post_thumbnail()) { the_post_thumbnail('large', array('align'=>'center')); }?>
                        </div>
                        <h5><?php the_title(); ?></h5>
                        <?php the_excerpt(); ?>
                    </a>
                        </div>
                    </div>
            <?php endwhile; ?>
	            </div>
            <?php endif; ?>
	        <div class="panel callout radius10 five columns last">
	            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                <h4><?php the_title(); ?></h4>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
	        </div>
	    </div>
	    <?php if ( $news_query->have_posts() ) : ?>
	        <div class="row">
	           <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
	                <div class="four columns post-container">
	                    <div class="row">
	                        <div class="eleven columns centered post">
        	                    <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
            	                    <?php if(has_post_thumbnail()) { ?>
            	                        <div class="row">
            	                            <div class="twelve columns">
            	                                <?php the_post_thumbnail('rss', array('align'=>'center')); ?>
            	                            </div>
            	                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h5><?php the_title(); ?></h5>
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
        	                    </a>
	                        </div>
	                    </div>
	                </div>
	           <?php endwhile; ?>
	        </div>
        <div class="row">
		    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><h5 class="black">View All <?php echo $theme_option['flagship_sub_feed_name']; ?></h5></a>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
