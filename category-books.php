<?php
/**
 * The template for displaying program specific Faculty Books
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Blocks
 */

get_header();
?>
<?php
$program_slug = get_the_program_slug( $post );
$program_name = get_the_program_name( $post );
$slider_query = new WP_Query(
	array(
		'post_type'      => 'slider',
		'program'        => $program_slug,
		'posts_per_page' => 1,
	)
);
?>
<?php
if ( $slider_query->have_posts() ) :
	while ( $slider_query->have_posts() ) :
		$slider_query->the_post();
		?>
			<?php get_template_part( 'template-parts/program-home-featured-image' ); ?>
		<?php
	endwhile;
endif;
?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<h1 class="page-title"><?php echo $program_name; ?> Faculty Books</h1>
			<?php
				$faculty_book_query = new WP_Query(
					array(
						'post_type'      => 'faculty-books',
						'posts_per_page' => 100,
						'tax_query'      => array(
							array(
								'taxonomy' => 'program',
								'field'    => 'slug',
								'terms'    => $program_slug,
							),
						),
					)
				);
				if ( $faculty_book_query->have_posts() ) :
					while ( $faculty_book_query->have_posts() ) :
						$faculty_book_query->the_post();
						?>
						<article <?php post_class( 'faculty-book' ); ?> aria-labelledby="post-<?php the_ID(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							the_post_thumbnail(
								'medium',
								array(
									'class' => 'float-left',
									'alt'   => esc_html( get_the_title() ),
								)
							);
							?>
					<?php } ?>
						<?php
							$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
							$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
						?>
					<ul class="no-bullet">
						<li>
							<h2 itemprop="headline" id="post-<?php the_ID(); ?>">
							<?php the_title(); ?>
							</h2>
						</li>
						<li>
						<?php if ( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_date', true ); ?>,
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_publisher', true ); ?>
					<?php endif; ?>
						</li>
						<li>
							<a href="<?php echo get_permalink( $faculty_post_id ); ?>">
							<?php echo get_the_title( $faculty_post_id ); ?>,
							<?php if ( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_role', true ); ?>
							<?php endif; ?>
							</a>
						</li>
						<li>
						<?php
						if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
							?>
							<br>
							<a href="<?php echo get_permalink( $faculty_post_id2 ); ?>">
								<?php echo get_the_title( $faculty_post_id2 ); ?>,&nbsp;
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_role2', true ); ?>
							</a>
						<?php } ?>
						</li>
						<li><?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
							<a href="http://<?php echo get_post_meta( $post->ID, 'ecpt_pub_link', true ); ?>" aria-label="Purchase Online">
								Purchase Online <span class="fa-solid fa-square-arrow-up-right"></span>
							</a>
							<?php endif; ?>
						</li>
					</ul>
						<?php the_content(); ?>
						<hr>
						</article>
						<?php
						endwhile;
endif;
				?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
