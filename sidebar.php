<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package immanence
 */

	if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<section id ="widget-area" class="main content">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</section>
<?php endif; ?>