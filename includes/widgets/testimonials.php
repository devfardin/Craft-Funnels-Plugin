<?php
class Elementor_testimonial extends \Elementor\Widget_Base {

    public function get_name() {
		return 'Testimonial';
	}
	public function get_title() {
		return esc_html__('Testimonial', 'cf-plugin');
	}
	public function get_icon() {
		return 'eicon-post-slider';
	}
	public function get_categories() {
		return ['basic'];
	}
	public function get_keywords() {
		return ['testimonial', 'slider', 'zetblock'];
	}

	protected function register_controls() {
		$this->Start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Testimonial', 'cf-plugin' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
			);
			$this->add_control(
				'display_list',
				[
					'label' => esc_html__( 'Display List', 'cf-plugin' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'cf-plugin' ),
					'label_off' => esc_html__( 'yes', 'cf-plugin' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( '', 'cf-plugin' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => [
						[
							'name' => 'list_title',
							'label' => esc_html__( 'Client Name', 'cf-plugin' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'label_block'=> true,
							'default'=>'John Doe',
							'placeholder' => esc_html__( 'Type your title here', 'cf-plugin' ),
						],
						[
							'name' => 'position',
							'label' => esc_html__( 'Client position', 'cf-plugin' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'label_block'=> true,
							'default'=>'Project Manager',
							'placeholder' => esc_html__( 'Type your title here', 'cf-plugin' ),
						],
                        [
							'name' => 'comment',
							'label' => esc_html__( 'Content', 'cf-plugin' ),
							'type' => \Elementor\Controls_Manager::TEXTAREA,
							'default'=> 'Working with this team has been a game-changer for our marketing strategy. Their expertise and dedication have consistently exceeded our expectations.',
							'placeholder' => esc_html__( 'Type your comment here', 'cf-plugin' ),
						],
						[
							'name' => 'profile_photo',
							'label' => esc_html__( 'Choose Image', 'cf-plugin' ),
							'type' => \Elementor\Controls_Manager::MEDIA,
							'default' => [
								'url' => \Elementor\Utils::get_placeholder_image_src(),
							],
						],
					],
					'condition' => [
						'display_list' => 'yes',
					],
				]
			);
		$this->end_controls_section();
	}

	protected function render() {
		wp_enqueue_style( 'testimonial_style' );
		wp_enqueue_script('testimonial_swiper_slider_style');
		wp_enqueue_style('testimonial_swiper_slider_script');
		wp_enqueue_script('testimonial_script');
		$settings = $this->get_settings_for_display();

		if( $settings['list'] ) : ?>
			<div class="swiper cf-slider-swiper">
				<div class="swiper-wrapper">
					<?php foreach( $settings['list'] as $item) : ?>
						<div class="cf-slide swiper-slide">
							<!-- Slider Content -->
							<div class='cf-slide__content'>
								<h2> <?php echo $item['list_title']; ?> </h2>
								<h3 class='client_position'> <?php echo $item['position']; ?></h3>
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M2.57812 15.0293V25.3125L7.70874 20.1777L12.8394 15.043V9.89454V4.74609H7.70874H2.57812V15.0293ZM17.1606 15.0293V25.3125L22.2913 20.1777L27.4219 15.043V9.89454V4.74609H22.2913H17.1606V15.0293Z" fill="#010101"/>
								</svg>
								<p> <?php echo $item['comment']; ?> </p>
							</div>

							<!-- Slider Media -->
							<div class='cf-slide__media'>
								<div class='cf-slide__media-wrapper'>
									<img src="<?php echo $item['profile_photo']['url']; ?>" alt='<?php echo $item['profile_photo']['alt']?>'>
									<span class='cf-slide__media-frame'></span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!--/.swiper-wrapper-->

				
				<?php if( count( $settings['list'] ) > 1 ) : ?>
				<div class='cf-slide__pagination'>
					<div class='button-prev'>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
								<path d="M13.6914 15.9951L22.6573 24.6147C22.9041 24.8515 23.04 25.1681 23.04 25.5056C23.04 25.8433 22.9041 26.1597 22.6573 26.3969L21.8716 27.1518C21.6251 27.3893 21.2956 27.52 20.9445 27.52C20.5934 27.52 20.2643 27.3893 20.0176 27.1518L9.34227 16.8894C9.09461 16.6515 8.95899 16.3336 8.95997 15.9957C8.95899 15.6563 9.09441 15.3388 9.34226 15.1007L20.0077 4.84829C20.2544 4.61077 20.5835 4.48002 20.9348 4.48002C21.2859 4.48002 21.615 4.61077 21.8619 4.84829L22.6473 5.60317C23.1584 6.09451 23.1584 6.89435 22.6473 7.38549L13.6914 15.9951Z" fill="#010101"/>
						</svg>
					</div>

					<div class='cf-slide__pagination'>
						<span class="swiper-pagination"></span>
					</div>


					<div class='button-next'>
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
							<path d="M18.3086 16.0049L9.34273 7.38527C9.09585 7.1485 8.96004 6.83194 8.96004 6.49439C8.96004 6.15666 9.09585 5.84028 9.34273 5.60314L10.1284 4.84825C10.3749 4.61073 10.7044 4.47998 11.0555 4.47998C11.4066 4.47998 11.7357 4.61073 11.9824 4.84825L22.6577 15.1106C22.9054 15.3485 23.041 15.6664 23.04 16.0043C23.041 16.3437 22.9056 16.6612 22.6577 16.8993L11.9923 27.1517C11.7456 27.3892 11.4165 27.52 11.0652 27.52C10.7141 27.52 10.385 27.3892 10.1381 27.1517L9.35267 26.3968C8.84157 25.9055 8.84157 25.1057 9.35267 24.6145L18.3086 16.0049Z" fill="#010101"/>
						</svg>
					</div>
				</div>
				<?php endif; ?>


			</div>
		<?php
		endif; //if( $settings['list']
	}
}