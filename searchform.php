<li>
	<form method="get" class="navlink" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input class="search-input" type="text" name="s" placeholder=" search" value="<?php echo esc_attr( get_search_query() ); ?>">
		<button class="search-button" type="submit"><i class="fa fa-search"></i></button>
	</form>
</li>