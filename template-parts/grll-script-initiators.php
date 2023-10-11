<?php
$program_name = get_the_program_name( $post );

if ( $program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' || $program_name == 'Spanish and Portuguese' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('li[aria-label="Language Programs"]').addClass('current_page_parent current_page_ancestor');
	});
	</script>

<?php endif; ?>

<?php if ( $program_name == 'French' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="french"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php elseif ( $program_name == 'German' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="german"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>	
<?php elseif ( $program_name == 'Hebrew and Yiddish' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="hebrew-and-yiddish"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php elseif ( $program_name == 'Italian' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="italian"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php elseif ( $program_name == 'Portuguese' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="portuguese"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php elseif ( $program_name == 'Spanish' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="spanish"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php elseif ( $program_name == 'Spanish and Portuguese' ) : ?>
	<script>
	jQuery(document).ready( function($) {
		$('a[href*="spanish-and-portuguese"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	});
	</script>
<?php endif; ?>

<?php if ( is_page_template( 'page-templates/courses-undergrad-program.php' ) || is_page_template( 'page-templates/courses-graduate-program.php' ) ) : ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script>
	jQuery(document).ready( function($) {
		$('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
			$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
		} );
		$('table.course-table').DataTable( {
			"order": [[ 0, "asc" ]],
				"lengthMenu": [[15, 30, -1],[15, 30, "All"]],
				"dom": '<"top"f>ilrt<"bottom"p><"clear">',
				"language": {
					"emptyTable": "Courses have a status of Closed, or are unavailable at this time. Please try again later."
				}
		} );
	} );
</script>
<?php endif; ?>

<?php if ( is_page_template( 'page-templates/courses-all-program.php' ) || is_page_template( 'page-templates/courses-program-select.php' ) ) :

wp_enqueue_style( 'data-tables', '//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css', array(), true );
wp_enqueue_style( 'data-tables-searchpanes', '//cdn.datatables.net/searchpanes/2.1.1/css/searchPanes.dataTables.min.css', array(), true );

wp_enqueue_script( 'data-tables', '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array(), '1.13.4', false );
wp_script_add_data( 'data-tables', 'defer', true );

wp_enqueue_script( 'data-tables-searchpanes', '//cdn.datatables.net/searchpanes/2.1.1/js/dataTables.searchPanes.min.js', array(), '2.1.1', false );
wp_script_add_data( 'data-tables-searchpanes', 'defer', true );

wp_enqueue_script( 'data-tables-select', '//cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js', array(), '1.4.0', false );
wp_script_add_data( 'data-tables-select', 'defer', true );
?>

<script>
jQuery(document).ready( function($) {
	$('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
		$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	} );

	$('table.course-table').DataTable( {
		"order": [[ 0, "asc" ]],
		"lengthMenu": [[15, 30, -1],[15, 30, "All"]],
		"dom": 'Plfrtip',
		"language": {
			"emptyTable": "Courses have a status of Closed, or are unavailable at this time. Please try again later."
		},
		searchPanes: {
				preSelect: [{
					rows:['Fall 2023'],
					column: 5
				}],
			},
		columnDefs: [
		{
			//This hides all but Term pane from search/filter
			searchPanes: {
				show: false
			},
			targets: [0,1,2,3,4,6]
		}
	]
	} );
} );
</script>
<?php endif; ?>