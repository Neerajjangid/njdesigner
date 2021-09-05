<?php

/**
 * njdesigner class.
 *
 * @category   Class
 * @package    NJDESIGNER
 * @subpackage WordPress
 * @author     njdesigner <neerajdesignrj007@gmail.com>
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.benmarshall.me/build-custom-elementor-widgets/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9
 */


namespace NJDESIGNER\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class pricing_table extends \Elementor\Widget_Base {

    /**
     * Class constructor.
     *
     * @param array $data Widget data.
     * @param array $args Widget arguments.
     */
    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );

        // wp_register_style( 'awesomesauce', plugins_url( '/assets/css/awesomesauce.css', ELEMENTOR_AWESOMESAUCE ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'pricing_table';
    }

    public function get_title() {
        return esc_html__('Pricing Table', 'nj-pricing-table' );
  }
  
  public function get_icon() {
    return 'eicon-slideshow';
  }

  // public function get_categories() {
  //       return array( 'wbcom-elementor-category' );
  //  }

    protected function _register_controls() {

         /**
         * Call to Action Content Settings
         */
        $this->start_controls_section(
            'wbcom_section_cta_content_settings',
            [
                'label' => esc_html__('Content Settings', 'NJDESIGNER'),
            ]
        );

        /**
         * Condition: 'wbcom_cta_type' => 'cta-basic'
         */
        $this->add_responsive_control(
            'wbcom_cta_content_type',
            [
                'label' => esc_html__('Alignment', 'NJDESIGNER'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'label_block' => false,
                'options' => [
                    'default' => esc_html__('Left', 'NJDESIGNER'),
                    'center' => esc_html__('Center', 'NJDESIGNER'),
                    'right' => esc_html__('Right', 'NJDESIGNER'),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        /**
         * Condition: 'wbcom_cta_type' => 'cta-icon-flex'
         */
         $this->add_control(
            'wbcom_cta_title',
            [
                'label' => esc_html__('Title', 'NJDESIGNER'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('The Wbcom Essential For Elementor', 'NJDESIGNER'),
                'dynamic' => ['active' => true],
            ]
        );

         $this->add_control(
            'wbcom_cta_title_content_type',
            [
                'label' => __('Content Type', 'NJDESIGNER'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Add a strong one liner supporting the heading above and giving users a reason to click on the button below.', 'NJDESIGNER'),
            ]
        );

        // primary button
        $this->add_control(
            'wbcom_cta_btn_text',
            [
                'label' => esc_html__('Button Text', 'NJDESIGNER'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => esc_html__('Contact Us', 'NJDESIGNER'),
            ]
        );

        $this->add_control(
            'wbcom_cta_btn_link',
            [
                'label' => esc_html__('Button Link', 'NJDESIGNER'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => [
                    'url' => 'http://',
                    'is_external' => '',
                ],
                'show_external' => true,
                'separator' => 'after',
            ]
        );

       $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Cta Title Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wbcom_section_cta_style_settings',
            [
                'label' => esc_html__('Call to Action Style', 'NJDESIGNER'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wbcom_cta_bg_color',
            [
                'label' => esc_html__('Background Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f4f4f4',
                'selectors' => [
                    '{{WRAPPER}} .wbcom_call_to_action' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wbcom_cta_container_padding',
            [
                'label' => esc_html__('Padding', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wbcom_call_to_action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wbcom_cta_container_margin',
            [
                'label' => esc_html__('Margin', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wbcom_call_to_action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wbcom_cta_border',
                'label' => esc_html__('Border', 'NJDESIGNER'),
                'selector' => '{{WRAPPER}} .wbcom_call_to_action',
            ]
        );

        $this->add_control(
            'wbcom_cta_border_radius',
            [
                'label' => esc_html__('Border Radius', 'NJDESIGNER'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wbcom_call_to_action' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wbcom_cta_shadow',
                'selector' => '{{WRAPPER}} .wbcom_call_to_action',
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Cta Title Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wbcom_section_cta_title_style_settings',
            [
                'label' => esc_html__('Color &amp; Typography ', 'NJDESIGNER'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wbcom_cta_title_heading',
            [
                'label' => esc_html__('Title Style', 'NJDESIGNER'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'wbcom_cta_title_color',
            [
                'label' => esc_html__('Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wbcom_cta_title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'wbcom_cta_title_margin',
            [
                'label' => esc_html__('Space', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // content
        $this->add_control(
            'wbcom_cta_content_heading',
            [
                'label' => esc_html__('Content Style', 'NJDESIGNER'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wbcom_cta_content_color',
            [
                'label' => esc_html__('Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .content_typography, {{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wbcom_cta_content_typography',
                'selector' => '{{WRAPPER}} .content_typography, {{WRAPPER}} p',
            ]
        );

         $this->add_responsive_control(
            'wbcom_cta_content_margin',
            [
                'label' => esc_html__('Content Space', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content_typography, {{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Primary Button Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'wbcom_section_cta_btn_style_settings',
            [
                'label' => esc_html__('Primary Button Style', 'NJDESIGNER'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wbcom_cta_btn_padding',
            [
                'label' => esc_html__('Padding', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wbcom_cta_btn_margin',
            [
                'label' => esc_html__('Margin', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cta-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wbcom_cta_btn_typography',
                'selector' => '{{WRAPPER}} .cta-button',
            ]
        );

        $this->add_control(
            'wbcom_cta_btn_is_used_gradient_bg',
            [
                'label' => __( 'Use Gradient Background', 'NJDESIGNER' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'yes', 'NJDESIGNER' ),
                'label_off' => __( 'No', 'NJDESIGNER' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_controls_tabs('wbcom_cta_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('wbcom_cta_btn_normal', ['label' => esc_html__('Normal', 'NJDESIGNER')]);

        $this->add_control(
            'wbcom_cta_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4d4d4d',
                'selectors' => [
                    '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wbcom_cta_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'wbcom_cta_btn_is_used_gradient_bg' => ''
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wbcom_cta_btn_normal_gradient_bg_color',
                'label' => __( 'Background', 'NJDESIGNER' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cta-button:not(.cta-secondary-button)',
                'condition' => [
                    'wbcom_cta_btn_is_used_gradient_bg' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wbcom_cat_btn_normal_border',
                'label' => esc_html__('Border', 'NJDESIGNER'),
                'selector' => '{{WRAPPER}} .cta-button:not(.cta-secondary-button)',
            ]
        );

        $this->add_control(
            'wbcom_cta_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'NJDESIGNER'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('wbcom_cta_btn_hover', ['label' => esc_html__('Hover', 'NJDESIGNER')]);

        $this->add_control(
            'wbcom_cta_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wbcom_cta_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'NJDESIGNER'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3F51B5',
                'selectors' => [
                    '{{WRAPPER}} .cta-button:after:not(.cta-secondary-button)' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'wbcom_cta_btn_is_used_gradient_bg' => ''
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wbcom_cta_btn_hover_gradient_bg_color',
                'label' => __( 'Background', 'NJDESIGNER' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)',
                'condition' => [
                    'wbcom_cta_btn_is_used_gradient_bg' => 'yes'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
  }



    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        ?>
        <div class="wbcom_call_to_action">
        <div class="wbcom_cta_flex">
        <div class="wbcom_left_cta">
        <div class="wbcom_contact_text">
        <h2 class="title"><?php echo $settings ['wbcom_cta_title'] ;?></h2>
        <div class="content_typography"><?php echo $settings ['wbcom_cta_title_content_type'] ;?></div>
        </div>
        </div>
        <div class="wbcom_right_cta">
        <div class="wbcom_contact_button">

        <a target="_blank" href="<?php echo $settings['eael_cta_btn_link']['url'] ;?>" class="button cta-button"><?php echo $settings ['wbcom_cta_btn_text'] ;?></a>
        </div>
        </div>
        </div>
        </div>
        <?php
    }


}