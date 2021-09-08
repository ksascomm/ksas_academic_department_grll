<?php
/*
Template Name: People Directory (GRLL Program)
*/
get_header(); ?>
<?php
	$theme_option = flagship_sub_get_global_options();
	$program_slug = get_the_program_slug( $post );
	$program_name = get_the_program_name( $post );
	$roles        = get_terms(
		'role',
		array(
			'orderby'    => 'slug',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$filters      = get_terms(
		'filter',
		array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$role_slugs   = array();
	$filter_slugs = array();
	foreach ( $roles as $role ) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode( ' ', $role_slugs );
	foreach ( $filters as $filter ) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode( ' ', $filter_slugs );
	?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<?php do_action( 'ksasacademic_before_content' ); ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<header aria-label="<?php the_title(); ?>">
					<h1 class="entry-title"><?php echo $program_name; ?> Program <?php the_title(); ?> Directory</h1>
				</header>
				<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php $theme_option = flagship_sub_get_global_options(); ?>
					
				</div>
			</article>
			<?php endwhile; ?>
			<div class="directory-search callout lightgrey" role="region" aria-label="Filters">
				<?php if ( $theme_option['flagship_sub_role_search'] == true ) : ?>
					<?php
					$roles       = get_terms(
						'role',
						array(
							'orderby'    => 'slug',
							'order'      => 'ASC',
							'hide_empty' => true,
						)
					);
					$count_roles = count( $roles );
					if ( $count_roles > 0 ) :
						?>
				<p>Filter by Title:</p>
				<ul class="filter-list menu role-group" data-filter-group="role">
						<?php foreach ( $roles as $role ) : ?>
					<li class="role-filter">
						<a class="button capitalize" href="javascript:void(0)" data-filter=".<?php echo $role->slug; ?>" class="selected"><?php echo $role->name; ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
						<?php
				endif;
endif;
				?>
				<div class="grid-x search-sort">
					<div class="large-8 cell">
						<label for="id_search">
							<p>Search by name, title, and research interests:</p>
						</label>
						<div class="input-group">
							<span class="input-group-label">
								<span class="fa fa-search"></span>
							</span>
							<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search by name, title, and research interests"  />
						</div>
					</div>
				</div>
			</div>
			<div id="isotope-list" class="people-directory loading" role="region" aria-label="Results">
				<ul class="directory">
					<?php
					foreach ( $roles as $role ) {
						$role_slug = $role->slug;
						$role_name = $role->name;
						if ( $role_slug !== 'graduate' && $role_slug !== 'job-market-candidate' && $role_slug !== 'graduate-student' && $role_slug !== 'research' ) {
							$people_query = new WP_Query(
								array(
									'post_type'      => 'people',
									'role'           => $role_slug,
									'filter'         => $program_slug,
									'meta_key'       => 'ecpt_people_alpha',
									'orderby'        => 'meta_value',
									'order'          => 'ASC',
									'posts_per_page' => 200,
								)
							);
						}
						if ( $people_query->have_posts() ) :
							?>
					<li class="person sub-head quicksearch-match <?php echo $role->slug; ?>">
						<h2 class="black capitalize"><?php echo $role_name; ?>
						</h2>
					</li>
							<?php
							while ( $people_query->have_posts() ) :
								$people_query->the_post();
								?>
					
								<?php
								if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) :
											get_template_part( 'template-parts/hasbio-loop' );
							else :
								get_template_part( 'template-parts/nobio-loop' );
						endif;
							?>
								<?php
					endwhile;
endif;
					} wp_reset_postdata();
					?>
					<li id="noResult">
						<div class="callout warning">
							<h5>Sorry, No Results Found</h5>
							<p>Try changing your search terms</a></p>
						</div>
					</li>
				</ul>
			</div>
		</main>
		<?php do_action( 'ksasacademic_after_content' ); ?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_template_part( 'template-parts/script-initiators' );
get_footer();
