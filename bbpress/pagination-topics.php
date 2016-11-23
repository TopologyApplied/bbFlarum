<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>
<ul class="pagination">
		<?php bbp_forum_pagination_links(); ?>
</ul>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
