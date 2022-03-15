<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<div class="sidebar">
	<?php
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );
	if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
		?>
		<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
			<div class="sidebar-menu <?php echo $program_slug; ?>" role="navigation">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo site_url( '/' ) . $program_slug; ?>" aria-label="Sidebar Menu: <?php echo $program_name; ?>"><?php echo $program_name; ?></a></h1>
				<?php
					wp_nav_menu(
						array(
							'menu_class' => 'nav',
							'menu'       => $program_name,
							'depth'      => 0,
							'items_wrap' => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
						)
					);
				?>
			</div>
		</aside>
		<?php elseif ( is_page() ) : ?>
			<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
				<div class="sidebar-menu" role="navigation">
					<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in the Department</h1>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'top-bar-r',
								'menu_class'     => 'nav',
								'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
							)
						);
					?>
				</div>
			</aside>
		<?php endif; ?>

	<?php if ( is_home() || is_single() && ! is_singular( array( 'studyfields', 'ai1ec_event', 'people' ) ) ) : ?>
		<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
			<div class="sidebar-menu" role="navigation">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo get_home_url(); ?>/about/" aria-label="Sidebar Menu: About">About</a></h1>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-bar-r',
						'menu_class'     => 'nav',
						'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
					)
				);
			?>
			</div>
		</aside>
	<?php endif; ?>

	<?php if ( is_singular( 'people' ) ) : ?>
		<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation-people">
			<div class="sidebar-menu" role="navigation">
				<h1 class="sidebar-menu-title" id="sidebar-navigation-people">Also in <a href="<?php echo get_home_url(); ?>/people/" aria-label="Sidebar Menu: People">People</a></h1>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top-bar-r',
							'menu_class'     => 'nav',
							'submenu'        => 'People',
							'depth'          => 2,
							'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu: People Directory">%3$s</ul>',
						)
					);
				?>
			</div>
			<?php if ( has_term( '', 'role' ) && ! has_term( 'job-market-candidate', 'role' ) ) : ?>			
				<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
					<label for="jump">
						<h1 id="jump-menu">Jump to Faculty Member</h1>
					</label>
					<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								?>
							<option>---<?php the_title(); ?></option> 
								<?php
						endwhile;
endif;
						?>
						<?php
						$jump_menu_query = new WP_Query(
							array(
								'post-type'      => 'people',
								'role'           => 'faculty',
								'meta_key'       => 'ecpt_people_alpha',
								'orderby'        => 'meta_value',
								'order'          => 'ASC',
								'posts_per_page' => 200,
							)
						);
						?>
						<?php
						while ( $jump_menu_query->have_posts() ) :
							$jump_menu_query->the_post();
							?>
							<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			<?php endif; ?>
		</aside>
	<?php endif; ?>

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
		if ( is_page_template( 'page-templates/program-homepage.php' ) ) :
			dynamic_sidebar( $program_slug . '-sb' );
		endif;
		?>

</div>
