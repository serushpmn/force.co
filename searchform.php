<form class="searchbar" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                  <input type="search" 
                  value="<?php echo get_search_query() ?>" 
                  name="s" 
                  placeholder="<?php echo esc_attr_x( 'جستجو کنید...', 'placeholder' ) ?>"
                  autocomplete="off">
                  <button type="submit" name="button">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>

                </form>