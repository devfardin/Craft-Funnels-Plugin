<?php
class Elementor_single_post_categories extends \Elementor\Widget_Base {

    public function get_name() {
        return 'single_categories';
    }
    public function get_title() {
        return esc_html__( 'Single Post Categories', 'cf-plugin' );
    }
    public function get_icon() {
        return 'eicon-product-categories';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'single category','cf-plugin' ];
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
				'default' => esc_html__( 'categories', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Trams Name Here', 'cf-plugin' ),
			]
		);
        $this->add_control(
			'cf_number_terms',
			[
				'label' => esc_html__( 'Number Of Terms', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '2', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Trams number', 'cf-plugin' ),
			]
		);
        $this->end_controls_section();
    }

    protected function render() {

        $this->render_inline_styles(); 
        $settings = $this->get_settings_for_display();
        $terms_name= $settings['cf_terms_name'];  
        $number_of_terms= $settings['cf_number_terms'];  ?>

        <div class='cf_single_post_category'>
            <?php
                $categories = get_the_terms( get_the_ID(), $terms_name );
                if (is_array($categories) ): 
                    $first_three_categories = array_slice( $categories, 0, $number_of_terms, false );
                        foreach ( $first_three_categories as $category ) :
                            $link = get_term_link( $category, $terms_name );?>
                            <a href="<?php echo esc_url( $link ) ?>"><?php echo esc_html( $category->name ) ?></a>
                            <?php 
                        endforeach;
                endif; ?>
        </div>
    <?php
    }
    protected function render_inline_styles(){ ?>
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
    }
}