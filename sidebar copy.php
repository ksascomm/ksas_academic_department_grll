<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<div class="sidebar">
	
	<!-- Sidebar Menu -->
	<?php 
	wp_reset_query();

	if( is_page() ) { ?>

	<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
	<?php 
		global $post;
		$program_name = get_the_program_name($post);
		$program_slug = get_the_program_slug($post);

if(empty($program_name)) {
global $post;
        $ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors
        	//Get the top-level page slug for sidebar/widget content conditionals
			$ancestor_id = ($ancestors) ? $ancestors[count($ancestors)-1]: $post->ID;
	        $the_ancestor = get_page( $ancestor_id );
	        $ancestor_slug = $the_ancestor->post_name;
	        $children = get_pages( array( 'child_of' => $post->ID ) );
	if (count($ancestors) == 0 && is_front_page() == false ) { ?>
			<div class="sidebar-menu <?php if (count($children) < 1 ) : echo 'widow'; endif; ?>">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">In This Section</h1>
		
			<?php $page_name = $post->post_title;
				$test_menu = wp_nav_menu( array( 
					'theme_location' => 'top-bar-r', 
					'menu_class' => 'nav',		
					'submenu' => $page_name,
					'depth' => 1,
					'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',	
				));?>
			</div>

			<?php if (strpos($test_menu,'<li id') !== false) : echo $test_menu; endif;
		}
        //If there are one or more display a menu of siblings
			elseif (count($ancestors) == 1) {
				$parent_page = get_post($post->post_parent);
				$parent_url  = get_permalink($post->post_parent);
				$parent_name = $parent_page->post_title;
			?>
			<!--Below is displayed when on a child page -->
			<div class="sidebar-menu">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo $parent_url;?>" aria-label="Sidebar Menu: <?php echo $parent_name; ?>"><?php echo $parent_name; ?></a></h1>
				<?php
					wp_nav_menu( array( 
						'theme_location' => 'top-bar-r', 
						'menu_class' => 'nav', 
						'submenu' => $parent_name,
						'depth' => 2,
						'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
					));?>
			
			</div>
		<?php } elseif (count($ancestors) >= 2) {
				$current = $post->ID;
				$parent = $post->post_parent;
				$parent_link = get_permalink($parent);
				$get_grandparent = get_post($parent);
				$grandparent = $get_grandparent->post_parent;
				$grandparent_name = get_the_title($grandparent);
				$grandparent_link = get_permalink($grandparent);
				$get_greatgrandparent = get_post($grandparent);
				$greatgrandparent = $get_greatgrandparent->post_parent;
				$greatgrandparent_name = get_the_title($greatgrandparent);
			?>
		<!--Below is displayed when on a grandchild page -->
		<div class="sidebar-menu">
			<h1 class="sidebar-menu-title" id="sidebar-navigation">Inside
			<?php if ($root_parent = get_the_title($grandparent) !== $root_parent = get_the_title($current)) :?>
				<a href="<?php echo $grandparent_link;?>" aria-label="Sidebar Menu: <?php echo $grandparent_name; ?>"><?php echo get_the_title($grandparent);?></a>
					 <?php else:?>
				<a href="<?php echo $parent_link;?>" aria-label="Sidebar Menu: <?php echo $parent_name; ?>"><?php echo get_the_title($parent);?></a>	 	
				<?php endif; ?>		
			</h1>
			<?php
				wp_nav_menu( array( 
					'theme_location' => 'top-bar-r', 
					'menu_class' => 'nav', 
					'submenu' => $grandparent_name,
					'depth' => 3,
					'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
				));?>
		</div>	
		<?php } ?>

<?php } else {
		wp_reset_query();
        $ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors
        	//Get the top-level page slug for sidebar/widget content conditionals
			$ancestor_id = ($ancestors) ? $ancestors[count($ancestors)-1]: $post->ID;
	        $the_ancestor = get_page( $ancestor_id );
	        $ancestor_slug = $the_ancestor->post_name;
	        $children = get_pages( array( 'child_of' => $post->ID ) );

     //If there are no ancestors display a menu of children. If no children, hide menu.
			if (count($ancestors) == 0 && is_front_page() == false ) { ?>
				<div class="sidebar-menu <?php if (count($children) < 1 ) : echo 'widow'; endif; ?>">
					<h1 class="sidebar-menu-title" id="sidebar-navigation">In This Section</h1>
				<?php 
				//if pages ARE NOT associated with a program, display the following:
				
					$page_name = $post->post_title;
						$test_menu = wp_nav_menu( array( 
							'theme_location' => 'top-bar-r', 
							'menu_class' => 'nav',		
							'submenu' => $page_name,
							'depth' => 1,
							'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',	
						)); 
						if (strpos($test_menu,'<li id') !== false) : 
							echo $test_menu; 
						endif; 
				//if pages ARE associated with a program, display the following:
					wp_nav_menu( array(
						'menu' => $program_name,
						'menu_class' => 'nav',
						'container_class' => 'offset-gutter',
						'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',	
					)); ?>		
				</div>
			<?php 
			}
        //If there are one or more display a menu of siblings
			elseif (count($ancestors) >= 1) {
				$parent_page = get_post($post->post_parent);
				$parent_url  = get_permalink($post->post_parent);
				$parent_name = $parent_page->post_title;
				$program_name = get_the_program_name($post);
			?>
			<!--Below is displayed when on a child page -->
			<div class="sidebar-menu">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo site_url('/') . $program_slug; ?>" aria-label="Sidebar Menu: <?php echo $program_name; ?>"><?php echo $program_name; ?></a></h1>
				<?php
					wp_nav_menu( array(
						'menu' => $program_name,
						'menu_class' => 'nav',
						'container_class' => 'offset-gutter',
						'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',	
					));?>
			
			</div>
		<?php }} ?>
		</aside>
	<?php } ?>

	<?php if (is_home() || is_category('books') || is_single() && ! is_singular(array( 'studyfields', 'ai1ec_event', 'people' )) ) : ?>
	<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
		<div class="sidebar-menu">
			<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo get_home_url();?>/about/" aria-label="Sidebar Menu: About">About</a></h1>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'top-bar-r',
				'menu_class' => 'nav',
				'submenu' => 'About',
				'depth' => 2,
				'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
			)); ?>
		</div>
	</aside>
	<?php endif;?>

	<?php if ( is_singular('people') ) : ?>
		<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
			<div class="sidebar-menu">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo get_home_url();?>/people/" aria-label="Sidebar Menu: People">People</a></h1>
				<?php
					wp_nav_menu( array( 
						'theme_location' => 'top-bar-r', 
						'menu_class' => 'nav', 
						'submenu' => 'People',
						'depth' => 2,
						'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
					));?>
			</div>
			<?php if (has_term('', 'role') && !has_term('job-market-candidate', 'role')) : ?>			
				<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
					<label for="jump">
						<h1 id="jump-menu">Jump to Faculty Member</h1>
					</label>
					<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<option>---<?php the_title(); ?></option> 
						<?php endwhile; endif; ?>
						<?php $jump_menu_query = new WP_Query(array(
							'post-type' => 'people',
							'role' => 'faculty',
							'meta_key' => 'ecpt_people_alpha',
							'orderby' => 'meta_value',
							'order' => 'ASC',
							'posts_per_page' => '-1')); ?>
						<?php while ($jump_menu_query->have_posts()) : $jump_menu_query->the_post(); ?>				
							<option value="<?php the_permalink() ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			<?php endif; ?>
		</aside>
	<?php endif;?>
	
	<!-- Widgetized Sidebars -->
	<!-- Page Specific Sidebar -->
	<?php if ( have_posts() && get_post_meta($post->ID, 'ecpt_page_sidebar', true) ) : while ( have_posts() ) : the_post();?>
			<aside class="custom page-widgets" aria-labelledby="custom-sidebar-content">
				<div class="widget ecpt-page-sidebar" id="custom-sidebar-content">
					<?php echo apply_filters('the_content', get_post_meta($post->ID, 'ecpt_page_sidebar', true)); ?>
				</div>
			</aside>
	<?php endwhile; endif; ?>
	<?php 
		$ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors
		$ancestor_id = ($ancestors) ? $ancestors[count($ancestors)-1]: $post->ID;
		$the_ancestor = get_page( $ancestor_id );
		$ancestor_slug = $the_ancestor->post_name;
		if ( is_home() ) : ?>   
			<?php dynamic_sidebar( 'archive-sb' ); ?>
		<?php elseif ( is_page( 'graduate' ) || $ancestor_slug == 'graduate' ) :   ?>
			<?php dynamic_sidebar( 'graduate-sb' ); ?>
		<?php elseif ( is_page( 'research' ) || $ancestor_slug == 'research' ) :     ?>
			<?php dynamic_sidebar( 'research-sb' ); ?>
		<?php elseif ( is_page( 'undergraduate' ) || $ancestor_slug == 'undergraduate' ) :   ?>  
			<?php dynamic_sidebar( 'undergrad-sb' ); ?>
		<?php else : ?>
			<?php dynamic_sidebar( 'page-sb' ); ?>
	<?php endif;?>
</aside>
</div>