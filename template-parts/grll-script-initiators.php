<?php
$program_name = get_the_program_name($post);

if($program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew and Yiddish' || $program_name == 'Italian' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) : ?>
	<script>
	   jQuery(document).ready( function($) {
	    $('li[aria-label="Language Programs"]').addClass('current_page_parent current_page_ancestor');
	   });
	</script>

<?php endif;?>

<?php if ($program_name == 'French') :?>
	<script>
	   jQuery(document).ready( function($) {
	    $('a[href*="french"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'German') :?>
	<script>
	  jQuery(document).ready( function($) {
	    $('a[href*="german"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>	
<?php elseif ($program_name == 'Hebrew and Yiddish') :?>
	<script>
	   jQuery(document).ready( function($) {
	    $('a[href*="hebrew-and-yiddish"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Italian') :?>
	<script>
	   jQuery(document).ready( function($) {
	    $('a[href*="italian"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Portuguese') :?>
	<script>
	   jQuery(document).ready( function($) {
	    $('a[href*="portuguese"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Spanish') :?>
	<script>
	   jQuery(document).ready( function($) {
	    $('a[href*="spanish"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php endif;?>

<?php if (is_page_template('page-templates/courses-undergrad-program.php') || is_page_template('page-templates/courses-graduate-program.php') ) : ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.16/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.16/datatables.min.js"></script>
  <script>
    jQuery(document).ready( function($) {
      $('a[aria-selected="true"]').on( 'shown.bs.tab', function (e) {
          $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
      } );
    
      $('table.course-table').DataTable( {
          "order": [[ 0, "asc" ]],
          "lengthMenu": [[15, 30, -1],[15, 30, "All"]],
          "dom": '<"top"f>ilrt<"bottom"p><"clear">'
      } );
  } );
  </script>
<?php endif; ?>