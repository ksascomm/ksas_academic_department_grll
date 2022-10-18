<?php
/**
 * Template Name: Faculty Books (By Program)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSAS_Academic_Department
 */

get_header();
?>
<?php
$program_slug = get_the_program_slug( $post );
$program_name = get_the_program_name( $post );

?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<h1 class="page-title"><?php echo esc_html( $program_name ); ?> Faculty Books</h1>
			<?php
				$program_faculty_book_query = new WP_Query(
					array(
						'post_type'      => 'faculty-books',
						'posts_per_page' => 100,
						'meta_key'       => 'ecpt_pub_date',
						'orderby'        => 'meta_value date',
						'order'          => 'DESC',
						'tax_query'      => array(
							array(
								'taxonomy' => 'program',
								'field'    => 'slug',
								'terms'    => $program_slug,
							),
						),
					)
				);
				if ( $program_faculty_book_query->have_posts() ) :
					while ( $program_faculty_book_query->have_posts() ) :
						$program_faculty_book_query->the_post();
						?>
						<?php get_template_part( 'template-parts/content', 'faculty-books' ); ?>
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
