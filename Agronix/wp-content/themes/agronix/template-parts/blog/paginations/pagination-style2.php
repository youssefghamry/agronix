<?php 

global $wp_query;

// stop execution if there's only 1 page
if ( $wp_query->max_num_pages <= 1 ){
    return;
}
if(isset($_REQUEST['pg'])){
    $paged = $_REQUEST['pg'];   
}else{
    $paged = 1;     
}

$max	    = intval( $wp_query->max_num_pages );

// add current page to the array
if ( $paged >= 1 ){
    $links[] = $paged;
}

// add the pages around the current page to the array
if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
}

if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
}

$c_url = remove_query_arg( 'pg' ,get_pagenum_link( 1 ));


echo '<ul class="pagination justify-content-center">' . "\n";

if ( $paged>1 ){
    $p = (int)$paged-1;
    $url =  $c_url.'?pg='.$p;
    printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", '', esc_url($url ), '<i class="tsicon tsicon-left_arrow"></i>' );

}


// link to first page, plus ellipses if necessary
if ( !in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="active"' : '';
    $url =  $c_url.'?pg=1';
    printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url($url ), '1' );

    if ( !in_array( 2, $links ) )
        echo '<li class="pagination-dots">…</li>';
}

// link to current page, plus 2 pages in either direction if necessary
sort( $links );
foreach ( (array) $links as $link ) {
    $url =  $c_url.'?pg='.$link;
   
    $class = $paged == $link ? ' class="active"' : '';
    printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( $url ), $link );
}

// link to last page, plus ellipses if necessary
if ( !in_array( $max, $links ) ) {
    if ( !in_array( $max - 1, $links ) )
        echo '<li>…</li>' . "\n";

    $class = $paged == $max ? ' class="active"' : '';
    $url =  $c_url.'?pg='.$max;
    printf( '<li%s><a class="page-link" href="%s" >%s</a></li>' . "\n", $class, esc_url($url ), $max );
}

if ( $paged<$max ){
    $p = (int)$paged+1;
    $url =  $c_url.'?pg='.$p;
    printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", '', esc_url($url ), '<i class="tsicon tsicon-right_arrow"></i>' );

}

echo '</ul>' . "\n";