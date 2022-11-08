<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="date" content="<?php the_modified_date(); ?>" />

		<?php wp_head(); ?>

		<meta name="msapplication-config" content="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/favicons/browserconfig.xml" />

		<?php get_template_part( 'template-parts/analytics' ); ?>
		<?php get_template_part( 'template-parts/script-initiators' ); ?>
		<?php get_template_part( 'template-parts/grll-script-initiators' ); ?>
	</head>
	<?php
	$program_slug             = get_the_program_slug( $post );
				$program_name = get_the_program_name( $post );
	global $blog_id;
	$site_id = 'site-' . $blog_id;
	?>
	<body <?php body_class( $program_slug . ' ' . $site_id ); ?>>
	<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VTN64C"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div role="navigation" aria-label="Skip to main content">
		<a class="skip-main show-on-focus" href="#page" >Skip to main content</a>
	</div>
	<div class="show-for-print" aria-hidden="true">
		<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.blue.svg" alt="krieger logo" loading="lazy">
		<h1><?php bloginfo( 'description' ); ?> <?php bloginfo( 'title' ); ?></h1>
	</div>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<header class="site-header" role="banner" aria-labelledby="dept-info">
		<div class="site-title-bar title-bar" <?php ksasacademic_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'ksasacademic' ); ?>" class="menu-icon" type="button" data-toggle="<?php ksasacademic_mobile_menu_id(); ?>"></button>
				<span class="site-mobile-title title-bar-title">
					Main Menu
				</span>
			</div>
		</div>

		<div class="roof-header-top show-for-large hide-for-print">
			<div class="row align-justify">
				<div class="roof-header-top-links">
					<?php get_template_part( 'template-parts/roof' ); ?>
				</div>
			</div>
		</div>

		<div class="small-site-holder">
			<div class="site-information hide-for-print">
				<div class="nav-shield">
					<a href="<?php echo esc_url( network_site_url( '/' ) ); ?>" rel="home">
						<div class="blue">
							<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.blue.svg" alt="KSAS Shield" loading="eager">
						</div>
						<div class="white">
							<img width="300" height="87" src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/krieger.white.svg" alt="KSAS Shield" loading="eager">
						</div>
					</a>
				</div>
				<div class="site-desktop-title">
					<div class="top-bar-title">
						<h1 itemprop="headline">
							<?php
								if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
					?>
					<a id="dept-info" href="<?php echo esc_url( site_url() ); ?>">
						<small class="hide-for-small-only">Department of <?php bloginfo( 'title' ); ?></small>
					</a>
					<a href="<?php echo esc_url( site_url( '/' ) . $program_slug . '/' ); ?>">
						<?php echo esc_html( $program_name . ' Program' ); ?>
					</a>
					<?php else : ?>
						<a id="dept-info" href="<?php echo esc_url( site_url() ); ?>">
						<?php if ( ! empty( get_bloginfo( 'description' ) ) ) : ?>
							<small class="hide-for-small-only"><?php bloginfo( 'description' ); ?></small>
						<?php endif; ?>
						<?php bloginfo( 'title' ); ?>
						</a>
					<?php endif; ?>
						</h1>
					</div>
				</div>
			</div>
		</div>
		<nav class="top-bar main-navigation hide-for-print" aria-label="Main Menu">
			<div class="top-bar-left">
			<?php
				if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
					?>
					<?php
					wp_nav_menu(
						array(
							'container'      => false,
							'menu_class'     => 'dropdown menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu aria-label="Primary Navigation">%3$s</ul>',
							'theme_location' => 'top-bar-r',
							'depth'          => 2,
							'fallback_cb'    => false,
							'menu'           => $program_name,
							'walker'         => new Ksasacademic_Top_Bar_Walker(),
						)
					);
					?>
				<?php else: ?> 
					<!-- MLL DEPARTMENT MENU -->
				<?php ksasacademic_top_bar_r(); ?>
				<?php endif; ?>
			</div>
			<div class="top-bar-right hide-for-small-only">
				<form method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" aria-label="Utility Bar Search">
					<div class="input-group">
						<label for="s" class="screen-reader-text">
							Search This Website
						</label>
						<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site" aria-label="Search This Website"/>
						<div class="input-group-button">
							<input type="submit" class="button" value="&#xf002;" aria-label="search">
						</div>
					</div>
				</form>
			</div>
		</nav>

		<?php if ( ! is_front_page() ) : ?>
		<div class="secondary">
			<div class="grid-container">
				<div class="grid-x grid-padding-x">		
					<?php ksasacademic_breadcrumb(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	</header>
