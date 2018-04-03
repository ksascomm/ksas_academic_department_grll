<?php
$program_name = get_the_program_name($post);

if($program_name == 'French' || $program_name == 'German' || $program_name == 'Hebrew' || $program_name == 'Italian' || $program_name == 'Media Literacy' || $program_name == 'Portuguese' || $program_name == 'Spanish' ) : ?>
	<script>
	   $(document).ready(function() {
	    $('li[aria-label="Language Programs"]').addClass('current_page_parent current_page_ancestor');
	   });
	</script>

<?php endif;?>

<?php if ($program_name == 'French') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="french"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'German') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="german"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>	
<?php elseif ($program_name == 'Hebrew') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="hebrew"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Italian') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="italian"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Media Literacy') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="media-literacy"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Portuguese') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="portuguese"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php elseif ($program_name == 'Spanish') :?>
	<script>
	   $(document).ready(function() {
	    $('a[href*="spanish"]').parent('#menu-main-menu-1 li').addClass('current_page_parent current_page_ancestor current_program');
	   });
	</script>
<?php endif;?>