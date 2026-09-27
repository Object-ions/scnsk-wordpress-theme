<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s-<?php echo esc_attr( wp_unique_id() ); ?>"><?php esc_html_e( 'Search the blog', 'scnsk' ); ?></label>
	<input type="search" id="s-<?php echo esc_attr( wp_unique_id() ); ?>" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search skin talk', 'scnsk' ); ?>">
	<button type="submit"><?php esc_html_e( 'Go', 'scnsk' ); ?></button>
</form>
