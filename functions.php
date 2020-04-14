<?php
function my_theme_enqueue_styles() {
	$parent_style = 'main-stylesheet';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/dist/assets/css/app.css', array(), filemtime(get_template_directory() . '/src/assets/scss'), 'all' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function create_the_programs() {
	$labels = array(
		'name' 					=> _x( 'Programs', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Program', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Program', 'Program'),
		'add_new_item' 			=> __( 'Add New Program' ),
		'edit_item' 			=> __( 'Edit Program' ),
		'new_item' 				=> __( 'New Program' ),
		'view_item' 			=> __( 'View Program' ),
		'search_items' 			=> __( 'Search Programs' ),
		'not_found' 			=> __( 'No Program found' ),
		'not_found_in_trash' 	=> __( 'No Program found in Trash' ),
	);
	
	$pages = array('courses','profile','post','slider','bulletinboard','page');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Program'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_in_rest'      => true, // Needed for tax to appear in Gutenberg editor.
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'program', 'with_front' => false ),
	 );
	register_taxonomy('program', $pages, $args);
}
add_action('init', 'create_the_programs');
function create_the_sidebars() {
	if ( function_exists('register_sidebar') ) {
		$all_programs = get_terms('program', array('hide_empty'=> 0));
		foreach($all_programs as $single_program) {
			$single_name = $single_program->name;
			$single_slug = $single_program->slug;
			register_sidebar(array(
				'name'          => $single_name .  ' Sidebar',
				'id'            => $single_slug . '-sb',
				'description'   => 'This is the ' . $single_name . ' homepage sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s" aria-label="Sidebar Content %1$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title" role="heading"><h4>',
				'after_title'   => '</h4></div>' 
				));
		}

	}	
}
add_action('init', 'create_the_sidebars');

add_action('after_setup_theme','academic_grll_theme_support', 11);

function academic_grll_theme_support() {
	remove_theme_support( 'custom-background' );
}

function remove_unused_sidebars() {
		unregister_sidebar('page-sb');
		unregister_sidebar('graduate-sb');
		unregister_sidebar('undergrad-sb');
		unregister_sidebar('research-sb');
}
add_action( 'widgets_init', 'remove_unused_sidebars', 11 );


function get_the_program_slug($post) {
	$post = get_queried_object_id();
		$program = '';
		if( is_page() && !is_page_template('page-templates/program-homepage.php') ) { 
        	/* Get an array of Ancestors and Parents if they exist */
			$parents = get_post_ancestors( $post );
			if (!empty($parents)) {
			/* Get the top Level page->ID count base 1, array base 0 so -1 */ 
			$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent = get_post( $id );
			$program = $parent->post_name;
			}
		}  elseif (is_page_template('page-templates/program-homepage.php')) {
			$program = get_the_title($post);
			$program = strtolower($program);
		} elseif (is_category() || is_tax()) {
			$this_program = get_term_by('slug',get_query_var('program'), 'program');
			$program = $this_program->slug;
		} elseif (is_singular() && !is_singular('people')){
			$terms = get_the_terms($post, 'program');
			if(is_array($terms) || is_array($terms2)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->slug;
				 } 
				 $program = implode(' ', $term_names);
			} 
			
			else { $program = $terms->slug; }
		} elseif (is_singular('people')) {
			$terms = get_the_terms($post, 'filter');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->slug;
				 } 
				 $program = implode(' ', $term_names);
			} 
			
			else { $program = $terms->slug; }
		}
	return $program;
}

function get_the_program_name($post) {
	wp_reset_query();
	$post = get_queried_object_id();
	$program = '';
		if( is_page() && !is_page_template('page-templates/program-homepage.php') ) { 
        	/* Get an array of Ancestors and Parents if they exist */
			$parents = get_post_ancestors( $post );
			if (!empty($parents)) {

			/* Get the top Level page->ID count base 1, array base 0 so -1 */ 
			$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent = get_post( $id );
			$program = $parent->post_title;
			}
		} elseif (is_page_template('page-templates/program-homepage.php')) {
			$program = get_the_title($post);
		
		} elseif (is_category() || is_tax()) {
			$this_program = get_term_by('slug',get_query_var('program'), 'program');
			$program = $this_program->name;
		} elseif (is_singular() && !is_singular('people')){
			$terms = get_the_terms($post, 'program');
			if(is_array($terms) || is_array($terms2)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->name;
				 } 
				 $program = implode(' ', $term_names);
			} 
			
			else { $program = $terms->slug; }
		}elseif (is_singular('people')){
			$terms = get_the_terms($post, 'filter');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->name;
				 } 
				 $program = implode('', $term_names);
			} 
			
			else { $program = $terms->name; }
		}
	return $program;
}

function add_program_columns($columns) {
    unset($columns['author']);
    unset($columns['comments']);
    return array_merge($columns, 
              array('program' => __('Program')));
}
add_filter('manage_post_posts_columns' , 'add_program_columns');

add_action( 'manage_posts_custom_column' , 'custompost_columns', 10, 2 );

function custompost_columns( $column, $post_id ) {
    switch ( $column ) {
	case 'program' :
	    $terms = get_the_term_list( $post_id , 'program' , '' , ',' , '' );
            if ( is_string( $terms ) )
		    echo $terms;
		else
		    _e( 'No Program Assigned', 'your_text_domain' );
		break;

    }
}

// CREATE FILTERS WITH CUSTOM TAXONOMIES


function post_program_add_taxonomy_filters() {
	global $typenow;

	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('program');
 
	// must set this to the post type you want the filter(s) displayed on
	if ( $typenow == 'post' ) {
 
		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}

add_action( 'restrict_manage_posts', 'post_program_add_taxonomy_filters' );

function create_page_title_grll() {
	$post = get_queried_object_id();
	$program_slug = get_the_program_slug($post);
	$program_name = get_the_program_name($post);
	if ( is_front_page() )  { 
		$page_title = bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
	} 
	elseif ( is_home() ) { // blog page
		$page_title = single_post_title();
		$page_title .= print(' | ');
				if(!empty($program_slug)) {
					$page_title .= print($program_name);
					$page_title .= print(' | ');
				} else {
					$page_title .= print(' | ');
				}				
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
	} 
	elseif ( is_category() ) { 
		$page_title = single_cat_title();
		$page_title .= print(' | ');
			if(!empty($program_slug)) {
				$page_title .= print($program_name);
				$page_title .= print(' | ');
			} else {
				$page_title .= print(' | ');
			}	
		$page_title .= bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
 
		}

	elseif (is_single() ) { 
		$page_title = single_post_title(); 
		$page_title .= print(' | ');
			if(!empty($program_slug)) {
				$page_title .= print($program_name);
				$page_title .= print(' | ');
			} else {
				$page_title .= print(' | ');
			}					
		$page_title .= bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
		}

	elseif (is_page() && !is_page_template('page-templates/program-homepage.php') ) { 
		$page_title = single_post_title();
			if(!empty($program_slug)) {
				$page_title .= print(' | ');
				$page_title .= print($program_name);
				$page_title .= print(' | ');
			} else {
				$page_title .= print(' | ');
			}		
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University');
	}
	elseif (is_page() && is_page_template('page-templates/program-homepage.php')) {
		$page_title = print($program_name);
		$page_title .= print(' Program | ');
		$page_title .= bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
	}	
	elseif (is_404()) {
		$page_title = print('Page Not Found'); 
		$page_title .= print(' | ');
		$page_title .= bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
	}
	else { 
		$page_title = bloginfo('description');
		$page_title .= print(' '); 
		$page_title .= bloginfo('name');
		$page_title .= print(' | Johns Hopkins University'); 
		} 
	return $page_title;
}