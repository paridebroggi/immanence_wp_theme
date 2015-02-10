<?php
/**
 * The template part for displaying a message that search didn't find any result.
 *
 * @package immanence
 */
?>
	<div class="title search-title"><?php _e( 'Nothing Found', 'immanence' ); ?></div>
	<div class="no-content">
	<?php 
		if ( is_search() )
		{
			_e( 'The search returned no result. Please, try with different keywords. Otherwise you can enjoy a recent post or browse the archives below. ', 'immanence' );
		}
		elseif ( is_category() )
		{
			_e( 'Sorry, but there is no post for this category. ', 'immanence' );
		}
		else
		{
			_e( 'Nothing found.', 'immanence' );
		}
	?>
	</div><!-- no-content -->