<?php
function axiusweb_view_counter(){
    ob_start(); ?>

    <?php
    $countKey = 'post_views_count';
    $count = get_post_meta(get_the_ID(), $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta(get_the_ID(), $countKey);
        add_post_meta(get_the_ID(), $countKey, '0');
    }else{
        $count++;
        update_post_meta(get_the_ID(), $countKey, $count);
    };
    ?>

    <?php
     return ob_get_clean();
}
add_shortcode( 'view_counter', 'axiusweb_view_counter' );