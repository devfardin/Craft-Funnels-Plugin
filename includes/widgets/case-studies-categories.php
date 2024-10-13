<?php

class Elementor_case_studies_categories extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cf-case-study-categorys';
    }

    public function get_title() {
        return esc_html__( 'Case Study Categories', 'cf-plugin' );
    }

    public function get_icon() {
        return 'eicon-gallery-group';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'case-study-category'];
    }

    protected function render(){
        // Inclued inline style
        $this->case_studies_style_render(); ?>

        
            <div class="portfolio_container">
                <?php if (have_posts()): ?>
                    <div class="latest-posts__row">
                        <?php while (have_posts()): the_post(); ?>
                            

                        <article class="latest-posts__post">

                                <div class="portfolio_feature_image">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"
                                        aria-label="More about <?php echo get_the_title(); ?>">
                                        <?php the_post_thumbnail('thumb_lg'); ?>
                                    </a>
                                </div>

                            <div class="portfolio_posts__info">

                                <div class='portfolio_post_category'>
                                    <?php  echo get_the_term_list( get_the_ID(), 'case-study-category' );?>
                                </div>

                                <h3 class="portfolio_post_title">
                                    <?php echo get_the_title(); ?>
                                </h3>

                                <p class='portfolio_post_excerpt'>
                                    <?php echo substr(get_the_excerpt(), 0, 110) . '...'; ?>
                                </p>

                                <a class="portfolio_post_btn" href="<?php the_permalink(); ?>" rel="bookmark"
                                    aria-label="More about <?php echo get_the_title(); ?>">
                                    Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_267_1454)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.911 10.0111L18.7231 10.803C17.7094 11.4789 16.1359 12.5566 14.6114 13.9164C13.076 15.2858 11.6558 16.8843 10.8843 18.5816C10.6639 19.0664 10.0923 19.2808 9.60755 19.0604C9.12265 18.84 8.90828 18.2684 9.1287 17.7835C10.0617 15.7308 11.7097 13.9203 13.3277 12.4772C13.9466 11.9252 14.5707 11.4187 15.1633 10.965L1.82468 10.965C1.29214 10.965 0.860435 10.5333 0.860441 10.0007C0.860447 9.4682 1.29213 9.03651 1.82466 9.03652L15.1985 9.03652C14.5373 8.52946 13.8389 7.96314 13.1565 7.35319C11.5242 5.89421 9.87869 4.09574 9.11121 2.17704C8.91343 1.6826 9.15393 1.12144 9.64837 0.923662C10.1428 0.725885 10.704 0.96638 10.9018 1.46083C11.4979 2.95122 12.8638 4.50501 14.4417 5.91535C15.998 7.30643 17.6597 8.47076 18.7328 9.20496L19.911 10.0111Z" fill="#FAFCFD"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_267_1454">
                                                <rect width="14.1421" height="14.1421" fill="white" transform="translate(10.0049 0.000610352) rotate(45)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                </a>
                            </div>

                        </article>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <div class='wp-pagenavi' role='navigation'>
                        <?php
                        global $wp_query;
                        $big = 999999999; // need an unlikely integer
                        $translated = __( '', 'extracatchy' ); // Supply translatable string
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
                        ) ); ?>
                    </div>
                            
                 <?php else: ?>
                    <div class='cf-case-studies__result_not_match'>
                        <h5 class='__result_not_match-text'>
                            Oops! It looks like we couldn't find any results matching your search.
                            Please try again with different keywords or refine your search criteria.
                            If you need further assistance, feel free to contact us.
                        </h5>
                    </div>
                
                <?php  endif; ?>
            </div>



<?php 
}

    function case_studies_style_render(){ 
        ?>

        <style>
            .latest-posts__row{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            justify-content: space-between;
            gap: 30px;
            align-items: top;
            }
        .latest-posts__post{
            border: 1px solid #298d0663;
            background: #F8F8F8;
            border-radius: 20px;
            }
        .portfolio_posts__info{
            padding: 20px;
         }
        .portfolio_feature_image img{
            width: 100%;
            border-top-right-radius:20px;
            border-top-left-radius:20px;
        }
        .portfolio_category_container{
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .portfolio_post_category{
            display: flex;
            flex-wrap: wrap;
            gap: 0px;
        }
        .portfolio_post_category a{
            font-size: 18px;
            color: #298D06;
            font-family: "Open Sans";
            font-weight: 600;
        }
        .portfolio_post_title {
            font-size: 28px;
            font-family: "Open Sans";
            font-weight: 500;
            color: #010711;
            opacity: 0.8;
            line-height: 34px;
            transition: color .4s;
            margin: 10px 0px !important;
            display: inline-block;
        
        }

        .portfolio_post_excerpt{
            font-size: 18px;
            font-weight: 400;
            font-family: "Open Sans";
            line-height: 28px;
            color: #4A4E55;
            margin-bottom: 10px !important;
        }
        .portfolio_post_btn svg {
            background: #298D06;
            padding: 10px;
            width: 35px;
            height: 35px;
            border-radius: 74px;
            transition:0.3s;
        }
        .portfolio_post_btn:hover svg{
            background: #85B303;
        }
        .portfolio_post_btn {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 500;
            font-family: "Open Sans";
            color: #298D06;
            transition:0.3s;
        }
        .portfolio_post_btn:hover{
            color: #85B303;
        }
        .cf-case-studies__result_not_match .__result_not_match-text{
            font-size: 18px;
            font-weight: 500;
            font-family: "Open Sans";
            color: #010711b5;
            line-height:1.5em;
            text-align:center;
        }

        /* paginate links style */
        .wp-pagenavi {
            margin-top: 30px;
            text-align: center;
        }
        .wp-pagenavi a {
            font-size: 20px;
            font-weight: 500;
            font-family: Gilroy;
            color: #010711;
            margin: 0px 10px;
            transition: all 0.3s; 
        }
        .wp-pagenavi a:hover{
            color: #298D06;
        }
        .wp-pagenavi span {
            font-size: 20px;
            font-weight: 500;
            font-family: Gilroy;
            color: #010711;
            margin: 0px 10px;
        }
        .wp-pagenavi .current {
            font-size: 20px;
            font-weight: 500;
            font-family: Gilroy;
            color: #298D06;
        }

        @media only screen and (min-width: 333px) {
            .portfolio_post_category{
                gap: 10px;
            }
            
        }

        @media only screen and (max-width: 768px) {
            .latest-posts__row{
                grid-template-columns: repeat(1, 1fr);
        
            }
            .portfolio_post_title {
                font-size: 24px;
            }
        }


        </style>
        <?php
    }
}