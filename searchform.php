<form role="search" method="get" class="search-form" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-bar" class="search-bar">
        <input type="search" class="search-field" id="search-field" placeholder="Suche" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="" id="search-submit"/>
	<div class="search-icon"></div>
</form>
