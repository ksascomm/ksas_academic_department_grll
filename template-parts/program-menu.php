<?php
/**
 * The navigation menu for each program
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */
?>

<?php
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );
	if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) :
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