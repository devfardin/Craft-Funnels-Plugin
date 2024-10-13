<?php
function cf_render_single_post_content(){
    ob_start(); ?>
    <div class='cf_single_post_content post-content'>
        <style>
        div#respond {
            border: 1px solid rgba(0, 92, 239, 0.10);
            padding: 25px;
            border-radius: 20px;
        }
        .comment-body {
            border-color: rgba(0, 92, 239, 0.10) !important;
        }
        .post-content p{
            color: rgba(0, 0, 0, 0.60);
            font-family: Gilroy;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: 30px; /* 166.667% */
        }
        </style>
        <?php
            echo get_the_content();
        ?>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_single_post_content', 'cf_render_single_post_content');
