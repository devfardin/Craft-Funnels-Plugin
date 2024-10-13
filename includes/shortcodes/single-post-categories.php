<?php
function cf_render_single_post_categories(){
    ob_start();

    $all_categories = get_categories( array(
        'taxonomy' => 'case-study-category',
        'orderby' => 'post',
        'order'   => 'ASC'

    ) );

    $current_posts_categories = get_the_terms( get_the_ID(), 'case-study-category') ;
    $current_posts_first_category_id=null;
    if( is_array( $current_posts_categories )){
        $current_posts_first_category_id = $current_posts_categories[0]->term_id;
    }; ?>


    <ul class='cf_single_post_categories'>
        <style>
            .cf_single_post_categories {
                margin: 0px;
                padding: 0px;
            }
            .cf_single_post_categories li a {
                color: var(--Black, #010101);
                font-family: Gilroy;
                font-size: 22px;
                font-weight: 500;
                border-top: 1px solid rgba(0, 0, 0, 0.20);
                display: block;
                padding: 15px 20px;
                transition:all .3s;
                opacity: 0.8;
            }
            .cf_single_post_categories li .single_post_category_active {
                background:rgba(0, 0, 0, 0.10);
                color:#010711;
            }
            .cf_single_post_categories li .single_post_category:hover{
                background:rgba(0, 0, 0, 0.10);
                color:#010711;
            }
            .cf_single_post_categories {
                list-style: none;
            }
        </style>

        <?php foreach( $all_categories as $category ):  ?>

        <li>
            <a href="<?php echo get_term_link($category, 'case-study-category')  ?>" class="<?php echo ( $category->term_id == $current_posts_first_category_id ) ? 'single_post_category_active': 'single_post_category' ?>">
                <?php echo $category->name; ?>
            </a>
        </li>

        <?php endforeach; ?>
    </ul>

    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_single_post_categories', 'cf_render_single_post_categories');