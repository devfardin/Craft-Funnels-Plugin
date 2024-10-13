<?php
function cf_single_post_search(){
    ob_start();  ?>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ) ?>">
    <style>

        .search-form .search-field{
            color:  #010711;
            font-family: Gilroy;
            font-size: 16px;
            font-weight: 500;
            border:1px solid rgba(0, 0, 0, 0.20);
            outline:none;

        }
        .search-form .search-submit-btn{
            top: 0;
            right: 20px;
            bottom: 0;
            color: #F1F1F1;
            font-family: Gilroy;
            font-size: 20px;
            font-weight: 600;
            position: absolute;
            transition: all .3s;
            border-top-right-radius:8px;
            border-bottom-right-radius:8px;
            border:1px solid rgba(0, 0, 0, 0.20);
            background: #298D06
        }
        .search-form .search-submit-btn:hover{
            background: #85B303;
            border: 1px solid #85B303;
        }
        .search-form .search-field{
            border-radius: 10px;
            /* border: 1px solid #D9E7FD; */
            outline:none;
            padding:10px;
        }
        .search-form .search-field:focus{
            border: 1px solid #85B303;
        }

    </style>
    <label>
        <span class="screen-reader-text"><?php _x( 'Search for:', 'label' ); ?> </span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search here', 'placeholder' ); ?> " value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <input type="submit" class="search-submit-btn" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?> " />
</form>
<?php
    return ob_get_clean();
}
add_shortcode( 'single_post_search', 'cf_single_post_search' );
