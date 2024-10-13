<?php
class Elementor_terms_nav extends \Elementor\Widget_Base {

    public function get_name() {
        return 'terms_nav';
    }
    public function get_title() {
        return esc_html__( 'Terms', 'cf-plugin' );
    }
    public function get_icon() {
        return 'eicon-alert';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'terms','cf-plugin' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'cf-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );$this->add_control(
			'cf_terms_name',
			[
				'label' => esc_html__( 'Terms Name', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'category', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Trams Name Here', 'cf-plugin' ),
			]
		);
        $this->end_controls_section();
    }

    protected function render() {

        $this->render_inline_styles(); 

        $settings = $this->get_settings_for_display();
        $terms_name= $settings['cf_terms_name'];


        $all_categories = get_categories( array(
            'taxonomy' => $terms_name,
            'orderby' => 'post',
            'order'   => 'ASC'
        ) );

        $current_posts_categories = get_the_terms( get_the_ID(), $terms_name ) ;
        $current_posts_first_category_id=null;
        
        if( is_array( $current_posts_categories )) :
            $current_posts_first_category_id = $current_posts_categories[0]->term_id;
        endif; ?>
        <ul class='cf_single_post_categories'> 
            <?php foreach( $all_categories as $category ):  ?>
                <li>
                    <a href="<?php echo get_term_link( $category, 'case-study-category' )  ?>" class="<?php echo ( $category->term_id ==          $current_posts_first_category_id ) ? 'single_post_category_active': 'single_post_category' ?>">
                        <?php echo $category->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php
    }

    protected function render_inline_styles(){ ?>
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
        <?php
    }
}