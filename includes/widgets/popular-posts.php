<?php
class Elementor_most_popular_posts extends \Elementor\Widget_Base {

    public function get_name() {
        return 'cf_most_popular_posts';
    }
    public function get_title() {
        return esc_html__( 'Popular posts', 'cf-plugin' );
    }
    public function get_icon() {
        return 'eicon-posts-grid';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'posts','popular','cf-plugin' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Most Popular Posts', 'cf-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );$this->add_control(
			'cf_post_type_name',
			[
				'label' => esc_html__( 'Post Type', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'post', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Post Type Here', 'cf-plugin' ),
			]
		);$this->add_control(
			'cf_post_category_name',
			[
				'label' => esc_html__( 'Post Category', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'category', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Post Type Here', 'cf-plugin' ),
			]
		);
        $this->add_control(
			'cf_number_post',
			[
				'label' => esc_html__( 'Number Of post', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '3', 'cf-plugin' ),
				'placeholder' => esc_html__( 'number of post show', 'cf-plugin' ),
			]
		);
        $this->end_controls_section();
    }

    protected function render() {

        $this->render_inline_styles(); 
        $settings = $this->get_settings_for_display();
        $post_type= $settings['cf_post_type_name'];  
        $number_of_post= $settings['cf_number_post'];
        $post_category_name= $settings['cf_post_category_name'];

            $popularpost  = new WP_Query(array(
                'posts_per_page' => $number_of_post,
                'post_type' => $post_type,
                'post_status' => 'publish',
                'orderby' => 'meta_value_num',
                'meta_key' => 'post_views_count',
                'order' => 'DESC'
            ));
        ?>

    <section class="most_popular_posts_row most-popular__<?php echo $post_type ?>">
         <?php if ($popularpost->have_posts()):  
                while ($popularpost->have_posts()):
                    $popularpost->the_post(); ?>
                  <article class="most_popular_post">
                            <div class="popular_post_thumb">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"
                                    aria-label="More about <?php echo get_the_title(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            </div>

                            <div class="latest-posts__info">
                                    <div class='latest-posts__text'>
                                        <a href="<?php the_permalink(); ?>" class="most-popular-posts__post__title">
                                            <?php echo substr(get_the_title(), 0, 30 ); ?>
                                        </a>
                                    <div>
                                        <?php
                                            $categories = get_the_terms( get_the_ID(), $post_category_name );
                                            if (is_array( $categories ) ) {
                                            $first_three_categories = array_slice( $categories, 0, 1, false );
                                            foreach ( $first_three_categories as $category ) :
                                                $link = get_term_link( $category, $post_category_name );?>
                                                <a  class='portfolio_post_category' href="<?php echo esc_url($link) ?>"><?php echo esc_html( $category->name ) ?></a>
                                            <?php
                                            endforeach;  };  ?>
                                    </div>

                                    <div class='most_popular_post_info_box'>
                                        <div class='most_popular_post_author_profile'>
                                            <?php $author_id= get_the_author_meta('ID'); ?>

                                            <a href="<?php  echo get_author_posts_url( $author_id ); ?>" class='author_box'>
                                                <img  class='most-popular-post__author_avatar' src="<?php echo get_avatar_url($author_id)?>" alt="<?php echo get_the_author_meta('display_name', $author_id) ?>"/>
                                                <h3 class='auther_display_name'><?php
                                                    $display_name=get_the_author_meta('display_name', $author_id);
                                                echo  strlen($display_name) > 5 ? substr($display_name, 0, 5) . '..' : $display_name; ?>
                                                    </h3>
                                            </a>
                                        </div>

                                        <div class='post_published_time'>
                                            <?php $post_time = get_post_time() ;?>
                                            <h3> <?php echo date("M d, Y", $post_time ); ?> </h3>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                <?php endif; ?>
        </section>
    <?php
    }
    protected function render_inline_styles(){ ?>
         <style>
             .most_popular_post{
                display: flex;
                gap: 15px;
                justify-content: space-between;
                align-items: center;
            }

            .most_popular_post{
                border: 1px solid #005CEF30;
                border-radius: 10px;
                padding: 10px;
            }

            .most_popular_posts_row {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                gap: 15px;
                align-items: center;
            }
            .popular_post_thumb img{
                border-radius: 6px;
            }
            .latest-posts__text{
                display: flex;
                flex-direction: column;
                gap: 0px;
            }
            .latest-posts__info {
                flex-grow: 1;
            }
            a.most-popular-posts__post__title {
                color:  #010101;
                font-family: Gilroy;
                font-size: 15px;
                font-weight: 400;
                transition: all .4s;
                line-height: 1em;
            }
            .most-popular-posts__post__title:hover{
                color: #298D06;
            }
            .portfolio_post_category{
                color:  #010101 !important;
                font-family: Gilroy;
                font-size: 14px;
                font-weight: 400;
                line-height: 100%;
                border-radius: 40px;
                border: 1px solid rgba(0, 0, 0, 0.15);
                background: rgba(0, 0, 0, 0.10);
                padding: 4px 10px;
                margin-top: 5px;
                display: inline-block;
            }

            .most_popular_post_info_box{
                display: none;
            }


            .post_published_time h3{
                color: #908E8E;
                font-family: Gilroy;
                font-size: 12px;
                font-style: normal;
                font-weight: 400;
                line-height: 100%;
                margin: 0;
            }

            .most_popular_post_author_profile img{
                width: 20px;
                height: 20px;
                object-fit: cover;
                border-radius: 30px;
            }
            .author_box{
                display: flex;
                gap:4px;
                align-items: center;

            }
            .auther_display_name{
            color: var(--Black, #010711);
            font-family: Gilroy;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: 100%; /* 16px */
            opacity: 0.8;
            margin: 0;
            }

            /* Hide Autho form case study single page */
            .most-popular__case-study .most_popular_post_author_profile {
                display: none;
            }

            @media only screen and (min-width: 414px) {
                .most_popular_post_info_box {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 10px;
                    margin-top: 10px;
                }
            }
            @media only screen and (min-width: 540px) {
                .most_popular_post{
                    justify-content: flex-start;
                }
                .most_popular_post_info_box{
                    justify-content: space-between;
                }
            }

            @media only screen and (min-width: 768px) {
                .most_popular_posts_row {
                    grid-template-columns: repeat(2, 1fr);
                }
            
                
            }

            @media only screen and (min-width: 992px) {
            
            }
            @media only screen and (min-width: 1024px) {
                .most_popular_posts_row {
                    grid-template-columns: repeat(1, 1fr);
                }
            }
        </style>
        <?php
    }
}