<?php

//add_rewrite_rule('^gallery/page/([0-9]+)','index.php?pagename=gallery&paged=$matches[1]', 'top');

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

// 'paged' => $paged // Add in WP Query Arguments

echo custom_pagination($communities);  // Call this functions

function custom_pagination($wp_query) {
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type'  => 'array',            
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<nav class=dd_pagination style="text-align:center;"><ul class="pagination">';
        foreach ( $pages as $page ) {            	
        	echo "<li class=page-item>".$page."</li>";
        }
       echo '</ul></nav>';
    }
}
?>
