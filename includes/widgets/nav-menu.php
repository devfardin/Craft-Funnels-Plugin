<?php
class Elementor_nav_menu extends \Elementor\Widget_Base {

    public function get_name() {
        return 'nav_menu';
    }
    public function get_title() {
        return esc_html__( 'Nav Menu', 'cf-plugin' );
    }
    public function get_icon() {
        return 'eicon-menu-bar';
    }
    public function get_categories() {
        return [ 'basic' ];
    }
    public function get_keywords() {
        return [ 'nav_menu','cf-plugin' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'cf-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );$this->add_control(
			'cf_nav_menu_id',
			[
				'label' => esc_html__( 'Menu Id', 'cf-plugin' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'cf-plugin' ),
				'placeholder' => esc_html__( 'Your Menu Id Here', 'cf-plugin' ),
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    ?>
        <?php $this->render_inline_styles(); ?>
        <div id='cf-navigation'>
            <?php
                wp_nav_menu( array(
                    'menu' => $settings['cf_nav_menu_id'],
                    'container'=> ''
                    )
                );
            ?>
            <a id="btn--mobile-menu-trigger" href="javascript:;">
                <span class="__open">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M3 4H21V6H3V4ZM7 19H21V21H7V19ZM3 14H21V16H3V14ZM7 9H21V11H7V9Z"></path></svg>
                </span>
                <span class="__close">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M10.5859 12L2.79297 4.20706L4.20718 2.79285L12.0001 10.5857L19.793 2.79285L21.2072 4.20706L13.4143 12L21.2072 19.7928L19.793 21.2071L12.0001 13.4142L4.20718 21.2071L2.79297 19.7928L10.5859 12Z"></path></svg>
                </span>
            </a>
        </div>
        <?php $this->render_inline_scripts(); ?>
    <?php
    }

    protected function render_inline_styles(){
        ?>
        <style>
            /** To Fix Navigation width issues on Mobile */
            /* #cfx-header{
                position: relative;
            } */
            #cfx-header .elementor-column,
            #cfx-header .elementor-widget-wrap,
            #cfx-header .elementor-widget{
                position: static;
            }

            /** Navigation Styles */
            #cf-navigation .menu{
                display: none;
                padding: 30px;
                gap: 15px;
            }
            @media all and (min-width: 1025px){
                #cf-navigation .menu{
                    display: flex;
                    gap: 30px;
                    justify-content: center;
                    align-items: center;
                    padding: 0;
                }
            }
            #cf-navigation ul{
                list-style-type: none;
                padding: 0;
            }
            #cf-navigation #btn--mobile-menu-trigger{
                cursor: pointer;
                display: flex;
                justify-content: flex-end;
            }
            @media all and (min-width: 1025px){
                #cf-navigation #btn--mobile-menu-trigger{
                    display: none;
                }
            }

            #cf-navigation #btn--mobile-menu-trigger .__close{
                display: none;
            }
            #cf-navigation.show--mobile-navigation #btn--mobile-menu-trigger .__close{
                display: flex;
            }
            #cf-navigation.show--mobile-navigation #btn--mobile-menu-trigger .__open{
                display: none;
            }

            #cf-navigation #btn--mobile-menu-trigger svg{
                width: 30px;
                height: auto;
                color: #298D06;
            }

            #cf-navigation.show--mobile-navigation .menu{
                display: flex;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 90px;
                left: 0;
                z-index: 999;
                background: #ffffff;
            }
            #cf-navigation .menu .menu-item a{
                color:  #010101;
                font-family: Gilroy;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 32px;
                transition: all 0.3s;
            }
            #cf-navigation .menu .menu-item a:hover{
                color:  #298D06;
            }
            #cf-navigation .menu .current-menu-parent > a{
                color: #298D06;
            }
            #cf-navigation .menu .current-menu-item a{
                color: #298D06;
            }
            /** Dropdown */
            #cf-navigation .menu-item-has-children{
                position: relative;
            }
            #cf-navigation .menu-item-has-children > a:first-child{
                display: flex;
                align-items: center;
                gap: 5px;
            }
            #cf-navigation .menu-item-has-children > a:first-child::after{
                content: "";
                width: 5px;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 5px solid currentColor;
                display: inline-block;
                margin-left: 5px;
                margin-bottom: -1px;
                position: static;
                opacity: 1 !important;
                background-color: #0000 !important;
                transition: none;
            }
            #cf-navigation .menu-item .sub-menu{
                 display:none;
                 flex-direction: column;
                 gap: 15px;
                 padding-left: 15px;
                 transition: all .9s ease-in-out;
            }
            #cf-navigation .menu-item.show--sub-menu .sub-menu{
                display: flex;
            }
			@media all and (min-width: 1025px){
                .header_btn{
                    display:none !important;
                }
            }
            .cf-primary__btn a {
                background: #298D06;
                display: inline-block !important;
                text-align: center;
                padding: 9px 30px;
                border-radius: 100px;
                color: #fff !important;
                font-weight: 500 !important;
                transition:all 0.3s;
            }
            .cf-primary__btn a:hover{
                background: #85B303;                
            }
			
            @media all and (min-width: 1025px){
                #cf-navigation .menu-item.show--sub-menu .sub-menu{
                    position: absolute;
                    top: 73px;
                    left: 0;
                    width: 300px;
                    background: #ffffff;
                    z-index: 9999;
                    box-shadow:  0px 0px 40px 0px rgba(0, 0, 0, 0.15);
                    padding: 0px;
                    border-radius: 4px;
                    gap:0;
                }
                #cf-navigation .menu-item.show--sub-menu .sub-menu li{
                    border-bottom:1px solid rgba(0, 0, 0, 0.10);
                    padding:15px 20px;
                }
                #cf-navigation .menu-item.show--sub-menu .sub-menu li:last-child{
                    border-bottom:none;
                }
            }
        </style>
        <?php
    }

    protected function render_inline_scripts()
    {
        ?>
        <script>
            const btnMobileMenuTrigger = document.getElementById('btn--mobile-menu-trigger');
            const navigationContainer = document.getElementById('cf-navigation');

            btnMobileMenuTrigger.addEventListener("click", function(e){
                e.preventDefault();
                navigationContainer.classList.toggle('show--mobile-navigation');
            });

            // Dropdown
            let navItemWithChrildren = document.querySelectorAll('#cf-navigation .menu-item-has-children');
            navItemWithChrildren.forEach((item) => {
                item.addEventListener("click", (event) => {
                    item.classList.toggle("show--sub-menu");
                });
            });
        </script>
        <?php
    }


}