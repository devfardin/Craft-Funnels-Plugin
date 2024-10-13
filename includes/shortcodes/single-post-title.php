<?php
function render_cf_single_post_title(){
    ob_start(); ?>
    <div class="cf_single_post_title">
        <style>
            .cf_single_post_title h1 {
                color:  #010101;
                font-family: Avion;
                font-size: 35px;
                font-style: normal;
                font-weight: 400;
                line-height: normal;
                text-align:center;

                opacity: 0.7;
            }
            @media (min-width: 576px) {
                .cf_single_post_title h1 {
                    font-size: 60px;
                    line-height:1.0em;
                }
             }

        </style>

        <h1>
            <?php if( is_single() ) : ?>
                <?php echo get_the_title() ; ?>
            <?php endif; ?>
        </h1>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_single_post_title', 'render_cf_single_post_title' );