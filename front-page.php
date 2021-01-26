<?php
/*
Template Name: Front
*/
get_header(); ?>


<?php
/********SET VARIABLES**************/
	$theme_option = flagship_sub_get_global_options();
/********SLIDER QUERY**************/
	$hero_query = new WP_Query(array(
		'post_type' => 'slider',
		'orderby' => 'rand',
		'posts_per_page' => 1,
		'tax_query' => array(
	        array(
	            'taxonomy' => 'slider_type',
	            'field'    => 'slug',
	            'terms'    => 'program',
	            'operator' => 'NOT IN',
	        ),
	    )
));
/********NEWS QUERY**************/
	$news_query_cond = $theme_option['flagship_sub_news_query_cond'];
	$news_quantity = $theme_option['flagship_sub_news_quantity'];
	
			if ($news_query_cond === 1) {
				$news_query = new WP_Query(array(
					'post_type' => 'post',
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array( 'books' ),
							'operator' => 'NOT IN'
						)
					),
					'posts_per_page' => $news_quantity));
			} else {
				$news_query = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => $news_quantity));
			}
	/********BEGIN SLIDER**************/
	if ( $hero_query->have_posts() ) :?> 
	<header class="hero" role="banner" aria-label="Explore the Krieger School Slider">
	<div class="full-screen-image show-for-large">

		<?php //if slider, show those posts
		if ( $hero_query->have_posts() ) :  while ($hero_query->have_posts() ) : $hero_query->the_post(); ?>
			<div class="front-hero slide" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('full'); ?>, large], [<?php the_post_thumbnail_url('full'); ?>, xlarge]" aria-label="Featured Image">
					<?php endwhile; wp_reset_postdata(); ?>
				<div class="caption">
					<h1><?php the_field( 'hero_title' ); ?></h1>
					<p><?php the_field( 'hero_caption' ); ?></p>
				</div>
			</div>
		<?php //if slider query empty, show post thumbnail
		else : ?>
			<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
				<div class="front-hero static" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('full'); ?>, large], [<?php the_post_thumbnail_url('full'); ?>, xlarge]" aria-label="Featured Image">
				<?php endif; ?>
					<div class="caption">
						<h1><?php the_field( 'hero_title' ); ?></h1>
						<p><?php the_field( 'hero_caption' ); ?></p>
					</div>
				</div>
		<?php endif;?>

	</div>
	<?php endif; ?>
	<?php do_action( 'ksasacademic_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="background-bluejaysblue" id="page" role="main" tabindex="0" aria-label="Website Introduction">
			<div class="intro">
				<div class="seo-intro">
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile;?>
	<?php do_action( 'ksasacademic_after_content' ); ?>
	<?php get_template_part( 'template-parts/front-buckets'); ?>
	<div class="main-container">
	    <div class="main-grid homepage">
	        <div class="main-content homepage-news">

				<?php $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
				$news_quantity = $theme_option['flagship_sub_news_quantity']; 
						if ($news_query_cond === 1) {
							$news_query = new WP_Query(array(
								'post_type' => 'post',
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'slug',
										'terms' => array( 'books' ),
										'operator' => 'NOT IN'
									)
								),
								'posts_per_page' => $news_quantity)); 
						} else {
							$news_query = new WP_Query(array(
								'post_type' => 'post',
								'posts_per_page' => $news_quantity)); 
						}
					if ( $news_query->have_posts() ) : ?> 

				<header class="news-title" aria-label="Site Feed">
					<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
				</header>

				<?php while ($news_query->have_posts() ) : $news_query->the_post(); ?>					
			
				<?php get_template_part( 'template-parts/content-news-homepage', get_post_format() ); ?>

				<?php endwhile; ?>
				<div class="homepage-news-archive" role="region" aria-labelledby="region1">			
					<h4 id="region1">
						<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
							View <?php echo $theme_option['flagship_sub_feed_name']; ?> Archive <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
						</a>
					</h4>
				</div>		

		
				<?php endif; ?>

			<?php $hub_query_cond = $theme_option['flagship_sub_hub_cond'];
				if ($hub_query_cond === 1) : ?>
					<header class="hub-title" aria-label="Hub Feed">
						<h2>Related News from <a href="https://hub.jhu.edu/" aria-label="hub website">The Hub</a></h2>
					</header>
					<?php get_template_part( 'template-parts/hub-news' ); 
				endif; ?>

			</div>
			<div class="homepage sidebar">
				<?php dynamic_sidebar( 'homepage-sb' );?>
			</div>
		</div>
	</div>
<?php get_footer();
