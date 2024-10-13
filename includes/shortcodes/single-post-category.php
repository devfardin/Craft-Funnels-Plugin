<?php
function cf_render_post_cagegory(){
    ob_start();
    ?>
    <div class='cf_single_post_category'>
        <style>
            .cf_single_post_category{
                display: flex;
                flex-wrap:wrap;
                align-items: center;
                gap: 10px;
            }
            .cf_single_post_category a{
                color: #F1F1F1;
                font-family: "Open Sans";
                font-size:14px;
                font-weight: 600;
                border-radius: 2px;
                background: #298D06;  
                border:1px solid #298D06;
                padding: 7px 20px;
                transition:all .4s;
            }
            .cf_single_post_category a:hover{
                color: #F1F1F1;
                opacity: 1;
                border:1px solid #85B303;
                background: #85B303;
            }
            .elementor-widget:not(:last-child) {
                margin-block-end: 5px !important;
            }
        </style>
   <?php 
    $categories = get_the_terms( get_the_ID(), 'case-study-category' );
        if (is_array($categories) ) {
            $first_three_categories = array_slice($categories, 0, 4, false);
            foreach ($first_three_categories as $category) :
                $link = get_term_link($category, 'case-study-category');?>
                <a href="<?php echo esc_url($link) ?>"><?php echo esc_html($category->name) ?></a>
                <?php 
            endforeach;
         };
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_post_category', 'cf_render_post_cagegory');


