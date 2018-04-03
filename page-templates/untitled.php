<?php elseif( $program_name == 'Department') : ?>

<?php if( is_page() ) : ?>

	<!--SIDEBAR FOR NON-PROGRAM PAGES-->
	<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
	<?php 
		global $post;
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
		</aside>
	<?php endif; ?>
<?php endif;?>