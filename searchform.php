<?php 
$form_unique_id = uniqid( 'search-form-' ); 
$field_unique_id = uniqid( 'search-field-' ); 
?>

<form method="get" class="search-form" id="<?php echo esc_attr( $form_unique_id ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php _e( 'Search Form', 'hitchcock' ); ?>" name="s" id="<?php echo esc_attr( $field_unique_id ); ?>" /> 
	<button type="submit" class="search-button">
		<span class="screen-reader-text"><?php _e( 'Search', 'hitchcock' ); ?></span>
		<div class="fa fw fa-search"></div>
	</button>
</form>