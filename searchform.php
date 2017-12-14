<form method="get" class="search-form" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php _e( 'Search Form', 'hitchcock' ); ?>" name="s" id="s" /> 
	<a class="search-button" onclick="document.getElementById( 'search-form' ).submit(); return false;"><div class="fa fw fa-search"></div></a>
</form>