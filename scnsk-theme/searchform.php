<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s-<?php echo esc_attr( wp_unique_id() ); ?>"><?php esc_html_e( 'Search the blog', 'scnsk' ); ?></label>
	<input type="search" id="s-<?php echo esc_attr( wp_unique_id() ); ?>" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search skin talk', 'scnsk' ); ?>">
	<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'scnsk' ); ?>">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5"/><path d="M15.5 15.5 21 21"/></svg>
	</button>
</form>
