<?php
/*
Template Name: Program Homepage
*/
get_header(); ?>

<?php /********SET VARIABLES**************/
	$theme_option = flagship_sub_get_global_options();
	$program_slug = get_the_program_slug($post);
	$program_name = get_the_program_name($post);

/********SLIDER QUERY*************/
	$slider_query = new WP_Query(array(
		'post_type' => 'slider',
		'program' => $program_slug,
		'posts_per_page' => 1));

/********NEWS QUERY**************/
	$news_quantity = $theme_option['flagship_sub_news_quantity']; $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
	    if ($news_query_cond === 1) {
		    $news_query = new WP_Query(array(
		    	'post_type' => 'post',
		    	'tax_query' => array(
		    		'relation' => 'AND',
		    		array(
		    		    'taxonomy' => 'category',
		    		    'field' => 'slug',
		    		    'terms' => array('books'),
		    		    'operator' => 'NOT IN',
		    		),
		    		array(
		    		    'taxonomy' => 'program',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug,
		    		)),
		    	'posts_per_page' => $news_quantity));
		} else {
		    $news_query = new WP_Query(array(
		    	'post_type' => 'post',
		    	'tax_query' => array(
		    		'relation' => 'OR',
		    		array(
		    		    'taxonomy' => 'category',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug
		    		),
		    		array(
		    		    'taxonomy' => 'program',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug,
		    		)),
		    	'posts_per_page' => $news_quantity));
		}
	    ?>

<?php if ( $slider_query->have_posts() ) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
	<?php get_template_part( 'template-parts/program-home-featured-image' ); ?>
<?php endwhile; endif;?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content program-homepage">
            <?php while ( have_posts() ) : the_post(); ?>
            	<div class="program-intro">
                	<?php get_template_part( 'template-parts/content', 'page' ); ?>
                </div>
            <?php endwhile;?>
			<?php if ( $news_query->have_posts() ) : ?>
			<h2><?php echo $program_name . ' ' . $theme_option['flagship_sub_feed_name']; ?></h2>
				<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
					<?php get_template_part( 'template-parts/content-news', get_post_format() ); ?>
				<?php endwhile; ?>
				<h3>
					<a href="<?php echo site_url('/program/') . $program_slug; ?>">
						View More <?php echo $theme_option['flagship_sub_feed_name']; ?>
					</a>
				</h3>
			<?php endif; ?>            
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
