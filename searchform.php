<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-bar">
        <input type="search" id="search-bar" class="search-field" placeholder="Suche" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="" />
	<div class="search-icon"></div>
</form>
