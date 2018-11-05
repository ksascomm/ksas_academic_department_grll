<?php
/**
 * The template for displaying program taxonomy archives
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); 
 $program_slug = get_the_program_slug($post);
 $program_name = get_the_program_name($post);
 $theme_option = flagship_sub_get_global_options(); 
 $news_query_cond = $theme_option['flagship_sub_news_query_cond']; ?>
 <div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
		<h1 class="page-title capitalize"><?php echo $program_name . ' ' . $theme_option['flagship_sub_feed_name']; ?> Archive</h1>
		<?php while (have_posts()) : the_post(); if('post' == get_post_type()) : ?>     
			<?php get_template_part( 'template-parts/content-news', get_post_format() ); ?>
         <?php endif; endwhile; ?>
			<?php
				if ( function_exists( 'foundationpress_pagination' ) ) :
					foundationpress_pagination();
				elseif ( is_paged() ) :
				?>
					<nav id="post-nav">
						<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
						<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
					</nav>
			<?php endif; ?>
        </main>
        <div class="sidebar">
        	<?php 
			$program_slug = get_the_program_slug($post);
			$program_name = get_the_program_name($post);
			if($program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) : ?>
				<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
					<div class="sidebar-menu <?php echo $program_slug;?>">
						<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo site_url('/') . $program_slug; ?>" aria-label="Sidebar Menu: <?php echo $program_name; ?>"><?php echo $program_name; ?></a></h1>
						<?php
							wp_nav_menu( array( 
								'menu_class' => 'nav', 
								'menu' => $program_name,
								'depth' => 0,
								'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
							));?>
					</div>
				</aside>
			<?php endif;?>
        </div>
    </div>
</div>
<?php get_footer();        