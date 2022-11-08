<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
	<div class="main-grid">
	<?php
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );
	if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
		?>
		<main class="main-content-full-width">
		<?php else : ?>
		<main class="main-content">
	<?php endif; ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
			<?php if ( is_page( 'Sitemap' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-bar-r',
						'menu_class'     => 'vertical',
						'items_wrap'     => '<ul class="%2$s" aria-label="Sitemap Menu">%3$s</ul>',
					)
				);
				?>
			<?php endif; ?>
		</main>
		<?php
		if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
			?>
			<?php
			if ( have_posts() && get_post_meta( $post->ID, 'ecpt_page_sidebar', true ) ) :
				while ( have_posts() ) :
					the_post();
					?>
		<div class="footer-widget-area w-full bg-grey-cool bg-opacity-50">
			<aside class="custom page-widgets" aria-labelledby="custom-sidebar-content">
				<div class="widget ecpt-page-sidebar" id="custom-sidebar-content">
						<?php echo apply_filters( 'the_content', get_post_meta( $post->ID, 'ecpt_page_sidebar', true ) ); ?>
					</div>
				</aside>
			</div>	
					<?php
				endwhile;
			endif;
			else :
					get_sidebar();
			endif;
			?>
	</div>
</div>
<?php
get_footer();
