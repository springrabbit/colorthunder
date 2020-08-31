<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
  <div></div>
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-field" placeholder="<?php echo __( 'Search...', 'colorthunder' ); ?>"/>
</form>
