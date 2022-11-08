<?php
/**
 * Template Name: Program Homepage
 * The template for language program homepages
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>

<?php
/********SET VARIABLES**************/
	$theme_option = flagship_sub_get_global_options();
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );

/********SLIDER QUERY*/
	$program_home_slider_query = new WP_Query(
		array(
			'post_type'      => 'slider',
			'program'        => $program_slug,
			'posts_per_page' => 1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'slider_type',
					'field'    => 'slug',
					'terms'    => 'program',
				),
			),
		)
	);

	/********NEWS QUERY*/
	$news_quantity   = $theme_option['flagship_sub_news_quantity'];
	$news_query_cond = $theme_option['flagship_sub_news_query_cond'];
	if ( $news_query_cond === 1 ) {
		$news_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( 'books' ),
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'program',
						'field'    => 'slug',
						'terms'    => $program_slug,
					),
				),
				'posts_per_page' => $news_quantity,
			)
		);
	} else {
		$news_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'tax_query'      => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $program_slug,
					),
					array(
						'taxonomy' => 'program',
						'field'    => 'slug',
						'terms'    => $program_slug,
					),
				),
				'posts_per_page' => $news_quantity,
			)
		);
	}
	?>

<?php
if ( $program_home_slider_query->have_posts() ) :
	while ( $program_home_slider_query->have_posts() ) :
		$program_home_slider_query->the_post();
		?>
			<?php get_template_part( 'template-parts/program-home-featured-image' ); ?>
		<?php
	endwhile;
endif;
?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width program-homepage">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<div class="program-intro">
					<?php get_template_part( 'template-parts/content', 'page' ); ?>
				</div>
			<?php endwhile; ?>
			<?php if ( $news_query->have_posts() ) : ?>
			<div class="heading-archives">
				<div>
			<h2><?php echo esc_html( $program_name . ' ' . $theme_option['flagship_sub_feed_name'] ); ?></h2></div>
			<div>
					<a class="button post-archive" href="<?php echo esc_url( site_url( '/program/' ) . $program_slug ); ?>">
						View More <?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?>&nbsp;<span class="fa-solid fa-circle-chevron-right" aria-hidden="true"></span>
					</a>
				</div>
			</div>
			<div class="grid-x grid-margin-x" data-equalizer data-equalize-on="medium">
				<?php
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>
					<?php get_template_part( 'template-parts/content-news', 'program-homepage' ); ?>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</main>
		<?php if ( is_active_sidebar( $program_slug . '-sb' ) ) : ?>
		<div class="footer-widget-area">
			<?php
			if ( have_posts() && get_post_meta( $post->ID, 'ecpt_page_sidebar', true ) ) :
				while ( have_posts() ) :
					the_post();
					?>
			<aside class="custom page-widgets" aria-labelledby="custom-sidebar-content">
				<div class="widget ecpt-page-sidebar" id="custom-sidebar-content">
					<?php echo apply_filters( 'the_content', get_post_meta( $post->ID, 'ecpt_page_sidebar', true ) ); ?>
				</div>
			</aside>
					<?php
				endwhile;
			endif;
			?>

			<!-- Start Widget Content -->
			<?php
			dynamic_sidebar( $program_slug . '-sb' );
			?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
