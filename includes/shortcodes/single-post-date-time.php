<?php
function cf_render_post_date_time(){
    ob_start(); ?>
    <div class='cf_single_post_date_time'>
        <style>
            .cf_single_post_date_time h3 {
                color:  #010101;
                font-family: "Open Sans";
                font-size: 16px;
                font-weight: 400;
                line-height: 22px; /* 137.5% */
                opacity: 0.8;
                text-align: right;
            }           
        </style>
    <?php $post_time = get_post_time() ;?>
        <h3> <?php echo date("h:i a, d M Y", $post_time ); ?> </h3>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_single_post_date_time', 'cf_render_post_date_time');