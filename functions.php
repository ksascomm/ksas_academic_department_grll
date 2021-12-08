<?php
/**
 * Custom theme functions for MLL child theme
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KSASAcademicDepartment
 */

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	/**
	 * Sets up styles and scripts for this child theme
	 *
	 * Note that this function is hooked into the wp_enqueue_scripts
	 */
function my_theme_enqueue_styles() {
	$parent_style = 'main-stylesheet';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/dist/assets/css/app.css', array(), filemtime( get_template_directory() . '/src/assets/scss' ), 'all' );
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}


/**
 * Create the custom Programs taxonomy
 *
 * @return void
 */
function create_the_programs() {
	$labels = array(
		'name'               => _x( 'Programs', 'taxonomy general name' ),
		'singular_name'      => _x( 'Program', 'taxonomy singular name' ),
		'add_new'            => _x( 'Add New Program', 'Program' ),
		'add_new_item'       => __( 'Add New Program' ),
		'edit_item'          => __( 'Edit Program' ),
		'new_item'           => __( 'New Program' ),
		'view_item'          => __( 'View Program' ),
		'search_items'       => __( 'Search Programs' ),
		'not_found'          => __( 'No Program found' ),
		'not_found_in_trash' => __( 'No Program found in Trash' ),
	);

	$pages = array( 'courses', 'profile', 'post', 'slider', 'bulletinboard', 'page' );

	$args = array(
		'labels'            => $labels,
		'singular_label'    => __( 'Program' ),
		'public'            => true,
		'show_ui'           => true,
		'hierarchical'      => true,
		'show_in_rest'      => true, // Needed for tax to appear in Gutenberg editor.
		'show_tagcloud'     => false,
		'show_in_nav_menus' => false,
		'rewrite'           => array(
			'slug'       => 'program',
			'with_front' => false,
		),
	);
	register_taxonomy( 'program', $pages, $args );
}
add_action( 'init', 'create_the_programs' );

/**
 * Create the custom sidebars for each Program taxonomy
 *
 * @return void
 */
function create_the_sidebars() {
	if ( function_exists( 'register_sidebar' ) ) {
		$all_programs = get_terms( 'program', array( 'hide_empty' => 0 ) );
		foreach ( $all_programs as $single_program ) {
			$single_name = $single_program->name;
			$single_slug = $single_program->slug;
			register_sidebar(
				array(
					'name'          => $single_name . ' Sidebar',
					'id'            => $single_slug . '-sb',
					'description'   => 'This is the ' . $single_name . ' homepage sidebar',
					'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<div class="widget_title"><h4>',
					'after_title'   => '</h4></div>',
				)
			);
		}
	}
}
add_action( 'init', 'create_the_sidebars' );

/**
 * Remove unused sidebars that appear in Parent theme
 */
function remove_unused_sidebars() {
		unregister_sidebar( 'page-sb' );
		unregister_sidebar( 'graduate-sb' );
		unregister_sidebar( 'undergrad-sb' );
		unregister_sidebar( 'research-sb' );
}
add_action( 'widgets_init', 'remove_unused_sidebars', 11 );

/**
 * Gret the program slug for future use
 */
function get_the_program_slug( $post ) {
	$post    = get_queried_object_id();
	$program = '';
	if ( is_page() && ! is_page_template( 'page-templates/program-homepage.php' ) ) {
		/* Get an array of Ancestors and Parents if they exist */
		$parents = get_post_ancestors( $post );
		if ( ! empty( $parents ) ) {
			/* Get the top Level page->ID count base 1, array base 0 so -1 */
			$id = ( $parents ) ? $parents[ count( $parents ) - 1 ] : $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent  = get_post( $id );
			$program = $parent->post_name;
		}
	} elseif ( is_page_template( 'page-templates/program-homepage.php' ) ) {
		$program = get_the_title( $post );
		$program = strtolower( $program );
	} elseif ( is_category() || is_tax() ) {
		$this_program = get_term_by( 'slug', get_query_var( 'program' ), 'program' );
		$program      = $this_program->slug;
	} elseif ( is_singular() && ! is_singular( 'people' ) ) {
		$terms = get_the_terms( $post, 'program' );
		if ( is_array( $terms ) || is_array( $terms2 ) ) {
			$term_names = array();
			foreach ( $terms as $term ) {
				$term_names[] = $term->slug;
			}
			$program = implode( ' ', $term_names );
		} else {
			$program = $terms->slug; }
	} elseif ( is_singular( 'people' ) ) {
		$terms = get_the_terms( $post, 'filter' );
		if ( is_array( $terms ) ) {
			$term_names = array();
			foreach ( $terms as $term ) {
				$term_names[] = $term->slug;
			}
			$program = implode( ' ', $term_names );
		} else {
			$program = $terms->slug; }
	}
	return $program;
}

/**
 * Get the program name for future use
 */
function get_the_program_name( $post ) {
	wp_reset_postdata();
	$post    = get_queried_object_id();
	$program = '';
	if ( is_page() && ! is_page_template( 'page-templates/program-homepage.php' ) ) {
		/* Get an array of Ancestors and Parents if they exist */
		$parents = get_post_ancestors( $post );
		if ( ! empty( $parents ) ) {

			/* Get the top Level page->ID count base 1, array base 0 so -1 */
			$id = ( $parents ) ? $parents[ count( $parents ) - 1 ] : $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent  = get_post( $id );
			$program = $parent->post_title;
		}
	} elseif ( is_page_template( 'page-templates/program-homepage.php' ) ) {
		$program = get_the_title( $post );

	} elseif ( is_category() || is_tax() ) {
		$this_program = get_term_by( 'slug', get_query_var( 'program' ), 'program' );
		$program      = $this_program->name;
	} elseif ( is_singular() && ! is_singular( 'people' ) ) {
		$terms = get_the_terms( $post, 'program' );
		if ( is_array( $terms ) || is_array( $terms2 ) ) {
			$term_names = array();
			foreach ( $terms as $term ) {
				$term_names[] = $term->name;
			}
			$program = implode( ' ', $term_names );
		} else {
			$program = $terms->slug; }
	} elseif ( is_singular( 'people' ) ) {
		$terms = get_the_terms( $post, 'filter' );
		if ( is_array( $terms ) ) {
			$term_names = array();
			foreach ( $terms as $term ) {
				$term_names[] = $term->name;
			}
			$program = implode( '', $term_names );
		} else {
			$program = $terms->name; }
	}
	return $program;
}

/**
 * Add program columns to wp-admin
 */
function add_program_columns( $columns ) {
	unset( $columns['author'] );
	unset( $columns['comments'] );
	return array_merge(
		$columns,
		array( 'program' => __( 'Program' ) )
	);
}
add_filter( 'manage_post_posts_columns', 'add_program_columns' );

add_action( 'manage_posts_custom_column', 'custompost_columns', 10, 2 );

/**
 * Add program columns to wp-admin
 */
function custompost_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'program':
			$terms = get_the_term_list( $post_id, 'program', '', ',', '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			} else {
				_e( 'No Program Assigned', 'your_text_domain' );
			}
			break;

	}
}

/**
 * Create filters from custom Program taxonomy
 */
function post_program_add_taxonomy_filters() {
	global $typenow;

	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug.
	$taxonomies = array( 'program' );

	// must set this to the post type you want the filter(s) displayed on.
	if ( $typenow == 'post' ) {

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[ $tax_slug ] ) ? $_GET[ $tax_slug ] : false;
			$tax_obj          = get_taxonomy( $tax_slug );
			$tax_name         = $tax_obj->labels->name;
			$terms            = get_terms( $tax_slug );
			if ( count( $terms ) > 0 ) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name . ' (' . $term->count . ')</option>';
				}
				echo '</select>';
			}
		}
	}
}

add_action( 'restrict_manage_posts', 'post_program_add_taxonomy_filters' );

/** Disable Parent Theme custom <title> filter */
function remove_parent_page_title() {
	remove_filter( 'pre_get_document_title', 'custom_ksasacademic_page_title', 9999 );
}
add_action( 'after_setup_theme', 'remove_parent_page_title' );

/**
 * Add custom text to <title> using child theme specific pre_get_document_title hook
 */
function custom_ksasacademic_mll_page_title( $title ) {
	$post         = get_queried_object_id();
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );
	if ( is_front_page() && is_home() ) {
		$title = get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_front_page() ) {
				$title = get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_home() ) {
		if ( is_paged() ) {
			$page_number = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$title       = get_the_title( get_option( 'page_for_posts', true ) ) . ' Page ' . $page_number . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
			return $title;
		} else {
			$title = get_the_title( get_option( 'page_for_posts', true ) ) . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
			return $title;
		}
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_author() ) {
		global $post;
		$title = get_the_author_meta( 'display_name', $post->post_author ) . ' Author Archives | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_archive() ) {
		if ( is_paged() ) {
			$page_number = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$title       = single_cat_title( '', false ) . ' Archive Page ' . $page_number . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
			return $title;
		} else {
		$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
		}
	} elseif ( is_single() ) {
		$title = get_the_title() . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_page() && ! is_page_template( 'page-templates/program-homepage.php' ) ) {
		if ( ! empty( $program_name ) ) :
			$title = get_the_title() . ' | ' . $program_name . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
			return $title;
		else :
			$title = get_the_title() . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
			return $title;
		endif;
	} elseif ( is_page() && is_page_template( 'page-templates/program-homepage.php' ) ) {
		$title = $program_name . ' Program | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_404() ) {
		$title = 'Page Not Found | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_tax( 'bbtype' ) ) {
		$title = single_tag_title( '', false ) . ' | ' . get_bloginfo( 'description' ) . ' ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} else {
		return $title;
	}
}

add_filter( 'pre_get_document_title', 'custom_ksasacademic_mll_page_title', 99999 );
