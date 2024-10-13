<?php
class Elementor_animated_circle extends \Elementor\Widget_Base {

    public function get_name() {
        return 'team_member';
    }
    public function get_title() {
        return esc_html__( 'Zet Animated Button', 'axiusweb-plugin' );
    }
    public function get_icon() {
        return 'eicon-circle-o';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'animated', 'text' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'axiusweb-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'start', 'axiusweb-plugin' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'axiusweb-plugin' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'start', 'axiusweb-plugin' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .button-spin' => 'justify-content: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'spnning_image',
			[
				'label' => esc_html__( 'Spinning Image', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'button_spin_image',
			[
				'label' => esc_html__( 'Sipn Button Icon', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Button Icon Size', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .button-spin__img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'spiner_width',
			[
				'label' => esc_html__( 'Spinner Image Size', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .button-spin__img--spinning' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'wrapper_link',
			[
				'label' => esc_html__( 'Link', 'axiusweb-plugin' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings_for_display(); 
   ?>
    <div class="button-spin">
       <a href="<?php echo $settings['wrapper_link']['url']?>" class="buttton-spin__wrap">
          <img class="button-spin__img--spinning" src="<?php echo $settings['spnning_image']['url'] ?>"/>
          <div class="button-spin__action">
            <img class="button-spin__img" src='<?php echo $settings['button_spin_image']['url'] ?>'/>
           </div>
        </a>
</div>

<style>
    .button-spin{
		display: flex;
		box-shadow: 0px 0px 80px 0px #d1d1d1;
		width: 160px;
		border-radius: 100%;
		justify-content: center !important;
		height: 160px;
		padding: 6px;
    }
    .buttton-spin__wrap {
    display: block;
    position: relative;
}
.button-spin__action {
    position: absolute;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
img.button-spin__img {
    /* width: 60%; */
	transition: all 0.4s;
}
a.buttton-spin__wrap {
    display: inline-block;
}
/* Button image spinner */
.button-spin__img--spinning {
    animation: rotateAnimation 30s linear infinite;
    background-size: cover;
}

@keyframes rotateAnimation {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}
</style>
<?php
}
}