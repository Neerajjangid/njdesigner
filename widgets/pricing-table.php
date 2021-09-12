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

        $this->start_controls_section(
            'pricing_table_icon_section',
            array(
                'label' => __( 'Heading', 'elementor-njdesigner' ),
            )
        );

        $this->add_control(
            'pricing_table_icon',
            [
                'label' => __( 'Icon', 'NJDESIGNER' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );


        // $this->add_control(
		// 	'pricing_table_title',
		// 	[
		// 		'label'   => esc_html__( 'Title', 'NJDESIGNER' ),
		// 		'type'    => Controls_Manager::TEXT,
		// 		'default' => __( 'Unlimited', ' NJDESIGNER' ),
		// 	]
		// );


        $this->add_control(
            'pricing_table_heading_tag',
            [
                'label'  => __('Heading', 'NJDESIGNER'),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Unlimited', ' NJDESIGNER' ),
			]
		);


        $this->add_control(
            'pricing_table_description',
            [
                'label' => esc_html__('Description', 'NJDESIGNER'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Free trial 30 days.', 'NJDESIGNER'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pricing_table_price',
            array(
                'label' => __( 'Price', 'NJDESIGNER' ),
            )
        );

        $this->add_control(
            'pricing_table_currency_symbol',
            [
                'label' => esc_html__('Currency Symbol', 'NJDESIGNER'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    ''             => __( 'None', 'NJDESIGNER' ),
					'&#36'         => __( '&#36 dollar', 'NJDESIGNER' ),
					'&#128'        => __( '&#128 euro', 'NJDESIGNER' ),
					'&#3647'       => __( '&#3647 Baht', 'NJDESIGNER' ),
					'&#8355'       => __( '&#8355 Franc', 'NJDESIGNER' ),
					'&fnof'        => __( '&fnof Guilder', 'NJDESIGNER' ),
					'kr'           => __( 'kr Krona', 'NJDESIGNER' ),
					'&#8356'       => __( '&#8356 Lira', 'NJDESIGNER' ),
					'&#8359'       => __( '&#8359 Peseta', 'NJDESIGNER' ),
					'&#8369'       => __( '&#8369 Peso', 'NJDESIGNER' ),
					'&#163'        => __( '&#163 Pound Sterling', 'NJDESIGNER' ),
					'R$'           => __( 'R$ Real', 'NJDESIGNER' ),
					'&#8381'       => __( '&#8381 Ruble', 'NJDESIGNER' ),
					'&#8360'       => __( '&#8360 Rupee', 'NJDESIGNER' ),
					'&#8377'       => __( '&#8377 Rupee (Indian)', 'NJDESIGNER' ),
					'&#8362'       => __( '&#8362 Shekel', 'NJDESIGNER' ),
					'&#165'        => __( '&#165 Yen/Yuan', 'NJDESIGNER' ),
					'&#2547'       => __( '&#2547 Taka', 'NJDESIGNER' ),
					'&#8361'       => __( '&#8361 Won', 'NJDESIGNER' ),
					'custom'       => __( 'Custom', 'NJDESIGNER' ),
				],
                'default' => '&#36',
            ]
        );

        $this->add_control(
            'pricing_table_currency_symbol_custom',
            [
                'label' => esc_html__('Custom Symbol ', 'NJDESIGNER'),
                'type'      => Controls_Manager::TEXT,
				'condition' => [
					'pricing_table_currency_symbol' => 'custom',
				],
            ]
        );

        
        $this->add_control(
            'pricing_table_price_value',
            [
                'label' => esc_html__('Price', 'NJDESIGNER'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('49', 'NJDESIGNER'),
            ]
        );

        $this->add_control(
            'pricing_table_sale',
            [
                'label' => esc_html__('Sale ', 'NJDESIGNER'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'NJDESIGNER' ),
				'label_off' => __( 'Hide', 'NJDESIGNER' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->add_control(
            'pricing_table_sale_value',
            [
                'label' => esc_html__('Main Price ', 'NJDESIGNER'),
                'type'      => Controls_Manager::NUMBER,
				'condition' => [
					'pricing_table_sale' => 'yes',
				],
            ]
        );


        $this->add_control(
            'pricing_table_period',
            [
                'label' => esc_html__('Period', 'NJDESIGNER'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Monthly', 'NJDESIGNER'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pricing_table_features',
            [
                'label' => __( 'Features', 'NJDESIGNER' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'pricing_table_features_list_icon', [
                'label' => __( 'Icon', 'NJDESIGNER' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'pricing_table_features_icon_color',
            [
                'label' => __( 'Color', 'NJDESIGNER' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
            ]
        );

        $repeater->add_control(
            'pricing_table_features_list_text', [
                'label' => __( 'List Item', 'NJDESIGNER' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'List Item', 'NJDESIGNER' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'pricing_table_features_list',
            [
                'label' => __( 'Repeater List', 'NJDESIGNER' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [   
                        'pricing_table_features_list_icon' => __( 'List Item Icon', 'NJDESIGNER' ),
                        'pricing_table_features_list_text' => __( 'List Item', 'NJDESIGNER' ),
                    ],
                ],
                'title_field' => '{{{ pricing_table_features_list_text }}}',
            ]
        );

        $this->end_controls_section();

        
        /**
         * Call to Action Content Settings
         */
        $this->start_controls_section(
            'pricing_table_footer',
            [
                'label' => esc_html__('Footer', 'NJDESIGNER'),
            ]
        );

        
        // $this->add_responsive_control(
        //     'pricing_table_alignment',
        //     [
        //         'label' => esc_html__('Alignment', 'NJDESIGNER'),
        //         'type' => Controls_Manager::SELECT,
        //         'default' => 'default',
        //         'label_block' => false,
        //         'options' => [
        //             'default' => esc_html__('Left', 'NJDESIGNER'),
        //             'center' => esc_html__('Center', 'NJDESIGNER'),
        //             'right' => esc_html__('Right', 'NJDESIGNER'),
        //         ],
        //         'devices' => [ 'desktop', 'tablet', 'mobile' ],
        //         'prefix_class' => 'elementor%s-align-',
        //     ]
        // );

        // primary button
        $this->add_control(
            'pricing_table_button_text',
            [
                'label' => esc_html__('Button Text', 'NJDESIGNER'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('Select Plan', 'NJDESIGNER'),
            ]
        );

        $this->add_control(
            'pricing_table_button_link',
            [
                'label' => esc_html__('Button Link', 'NJDESIGNER'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => [
                    'url' => 'https://',
                    'is_external' => '',
                ],
                'show_external' => true,
            ]
        );

        $this->add_responsive_control(
			'pricing_table_button_align',
			[
				'label'        => esc_html__( 'Alignment', 'NJDESIGNER' ),
				'type'         => Controls_Manager::CHOOSE,
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'NJDESIGNER' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'NJDESIGNER' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'NJDESIGNER' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'NJDESIGNER' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
			]
		);

		$this->add_control(
			'pricing_table_button_icon',
			[
				'label'       => esc_html__( 'Icon', 'NJDESIGNER' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin' => 'inline'
			]
		);

        $this->add_control(
			'pricing_table_button_icon_align',
			[
				'label' => __( 'Icon Position', 'NJDESIGNER' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'NJDESIGNER' ),
					'right' => __( 'After', 'NJDESIGNER' ),
				],
				'condition' => [
					'icon!' => 'pricing_table_button_icon',
				],
			]
		);

       $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Cta Title Style)
         * -------------------------------------------
         */
        // $this->start_controls_section(
        //     'wbcom_section_cta_style_settings',
        //     [
        //         'label' => esc_html__('Call to Action Style', 'NJDESIGNER'),
        //         'tab' => Controls_Manager::TAB_STYLE,
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_bg_color',
        //     [
        //         'label' => esc_html__('Background Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#f4f4f4',
        //         'selectors' => [
        //             '{{WRAPPER}} .wbcom_call_to_action' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );
        // $this->add_responsive_control(
        //     'wbcom_cta_container_padding',
        //     [
        //         'label' => esc_html__('Padding', 'NJDESIGNER'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', 'em', '%'],
        //         'selectors' => [
        //             '{{WRAPPER}} .wbcom_call_to_action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // $this->add_responsive_control(
        //     'wbcom_cta_container_margin',
        //     [
        //         'label' => esc_html__('Margin', 'NJDESIGNER'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', 'em', '%'],
        //         'selectors' => [
        //             '{{WRAPPER}} .wbcom_call_to_action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Border::get_type(),
        //     [
        //         'name' => 'wbcom_cta_border',
        //         'label' => esc_html__('Border', 'NJDESIGNER'),
        //         'selector' => '{{WRAPPER}} .wbcom_call_to_action',
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_border_radius',
        //     [
        //         'label' => esc_html__('Border Radius', 'NJDESIGNER'),
        //         'type' => Controls_Manager::SLIDER,
        //         'range' => [
        //             'px' => [
        //                 'max' => 500,
        //             ],
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .wbcom_call_to_action' => 'border-radius: {{SIZE}}px;',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Box_Shadow::get_type(),
        //     [
        //         'name' => 'wbcom_cta_shadow',
        //         'selector' => '{{WRAPPER}} .wbcom_call_to_action',
        //     ]
        // );

        // $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Cta Title Style)
         * -------------------------------------------
         */
        // $this->start_controls_section(
        //     'wbcom_section_cta_title_style_settings',
        //     [
        //         'label' => esc_html__('Color &amp; Typography ', 'NJDESIGNER'),
        //         'tab' => Controls_Manager::TAB_STYLE,
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_title_heading',
        //     [
        //         'label' => esc_html__('Title Style', 'NJDESIGNER'),
        //         'type' => Controls_Manager::HEADING,
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_title_color',
        //     [
        //         'label' => esc_html__('Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '',
        //         'selectors' => [
        //             '{{WRAPPER}} .title' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name' => 'wbcom_cta_title_typography',
        //         'selector' => '{{WRAPPER}} .title',
        //     ]
        // );

        // $this->add_responsive_control(
        //     'wbcom_cta_title_margin',
        //     [
        //         'label' => esc_html__('Space', 'NJDESIGNER'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', 'em', '%'],
        //         'selectors' => [
        //             '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // // content
        // $this->add_control(
        //     'wbcom_cta_content_heading',
        //     [
        //         'label' => esc_html__('Content Style', 'NJDESIGNER'),
        //         'type' => Controls_Manager::HEADING,
        //         'separator' => 'before',
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_content_color',
        //     [
        //         'label' => esc_html__('Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '',
        //         'selectors' => [
        //             '{{WRAPPER}} .content_typography, {{WRAPPER}} p' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name' => 'wbcom_cta_content_typography',
        //         'selector' => '{{WRAPPER}} .content_typography, {{WRAPPER}} p',
        //     ]
        // );

        //  $this->add_responsive_control(
        //     'wbcom_cta_content_margin',
        //     [
        //         'label' => esc_html__('Content Space', 'NJDESIGNER'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', 'em', '%'],
        //         'selectors' => [
        //             '{{WRAPPER}} .content_typography, {{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );

        // $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style (Primary Button Style)
         * -------------------------------------------
         */
        $this->start_controls_section(
            'pricing_table_btn_style',
            [
                'label' => esc_html__('Footer', 'NJDESIGNER'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

       $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'footer_bg_color',
				'selector' => '{{WRAPPER}} .price-table-footer',
			]
		);     

        $this->add_responsive_control(
            'pricing_table_footer_padding_section',
            [
                'label' => esc_html__('Padding', 'NJDESIGNER'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pricing_table_footer_padding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
			'pricing_table_footer_button',
			[
				'label'     => __( 'Button', 'NJDESIGNER' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pricing_table_button_size',
			[
				'label'   => __( 'Size', 'NJDESIGNER' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'md' => __( 'Default', 'NJDESIGNER' ),
					'sm' => __( 'Small', 'NJDESIGNER' ),
					'xs' => __( 'Extra Small', 'NJDESIGNER' ),
					'lg' => __( 'Large', 'NJDESIGNER' ),
					'xl' => __( 'Extra Large', 'NJDESIGNER' ),
				],
				'condition' => [
					'pricing_table_button_text' => '',
				],
			]
		);
        
        
        
        
        
        
        
        
        

        // $this->add_responsive_control(
        //     'wbcom_cta_btn_margin',
        //     [
        //         'label' => esc_html__('Margin', 'NJDESIGNER'),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => ['px', 'em', '%'],
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //     ]
        // );
        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name' => 'wbcom_cta_btn_typography',
        //         'selector' => '{{WRAPPER}} .cta-button',
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_btn_is_used_gradient_bg',
        //     [
        //         'label' => __( 'Use Gradient Background', 'NJDESIGNER' ),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => __( 'yes', 'NJDESIGNER' ),
        //         'label_off' => __( 'No', 'NJDESIGNER' ),
        //         'return_value' => 'yes',
        //     ]
        // );

        // $this->start_controls_tabs('wbcom_cta_button_tabs');

        // Normal State Tab

        // $this->start_controls_tab('wbcom_cta_btn_normal', ['label' => esc_html__('Normal', 'NJDESIGNER')]);

        // $this->add_control(
        //     'wbcom_cta_btn_normal_text_color',
        //     [
        //         'label' => esc_html__('Text Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#4d4d4d',
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_btn_normal_bg_color',
        //     [
        //         'label' => esc_html__('Background Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#f9f9f9',
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'wbcom_cta_btn_is_used_gradient_bg' => ''
        //         ]
        //     ]
        // );
        // $this->add_group_control(
        //     \Elementor\Group_Control_Background::get_type(),
        //     [
        //         'name' => 'wbcom_cta_btn_normal_gradient_bg_color',
        //         'label' => __( 'Background', 'NJDESIGNER' ),
        //         'types' => [ 'classic', 'gradient' ],
        //         'selector' => '{{WRAPPER}} .cta-button:not(.cta-secondary-button)',
        //         'condition' => [
        //             'wbcom_cta_btn_is_used_gradient_bg' => 'yes'
        //         ]
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Border::get_type(),
        //     [
        //         'name' => 'wbcom_cat_btn_normal_border',
        //         'label' => esc_html__('Border', 'NJDESIGNER'),
        //         'selector' => '{{WRAPPER}} .cta-button:not(.cta-secondary-button)',
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_btn_border_radius',
        //     [
        //         'label' => esc_html__('Border Radius', 'NJDESIGNER'),
        //         'type' => Controls_Manager::SLIDER,
        //         'range' => [
        //             'px' => [
        //                 'max' => 100,
        //             ],
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button:not(.cta-secondary-button)' => 'border-radius: {{SIZE}}px;',
        //         ],
        //     ]
        // );

        // $this->end_controls_tab();

        // // Hover State Tab
        // $this->start_controls_tab('wbcom_cta_btn_hover', ['label' => esc_html__('Hover', 'NJDESIGNER')]);

        // $this->add_control(
        //     'wbcom_cta_btn_hover_text_color',
        //     [
        //         'label' => esc_html__('Text Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#f9f9f9',
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'wbcom_cta_btn_hover_bg_color',
        //     [
        //         'label' => esc_html__('Background Color', 'NJDESIGNER'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#3F51B5',
        //         'selectors' => [
        //             '{{WRAPPER}} .cta-button:after:not(.cta-secondary-button)' => 'background: {{VALUE}};',
        //             '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)' => 'background: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'wbcom_cta_btn_is_used_gradient_bg' => ''
        //         ]
        //     ]
        // );
        // $this->add_group_control(
        //     \Elementor\Group_Control_Background::get_type(),
        //     [
        //         'name' => 'wbcom_cta_btn_hover_gradient_bg_color',
        //         'label' => __( 'Background', 'NJDESIGNER' ),
        //         'types' => [ 'classic', 'gradient' ],
        //         'selector' => '{{WRAPPER}} .cta-button:hover:not(.cta-secondary-button)',
        //         'condition' => [
        //             'wbcom_cta_btn_is_used_gradient_bg' => 'yes'
        //         ]
        //     ]
        // );

        // $this->end_controls_tab();

        // $this->end_controls_tabs();

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

        <div class="">

            <div class="">

                <div class="">icon<div>
                 
                <div>
                    <h3><?php echo $settings['pricing_table_title']; ?></h3>
                    <p><?php echo $settings['pricing_table_description']; ?></p>
                </div>

                <div class="">
                    <div class=""><?php echo $settings['pricing_table_currency_symbol']; ?> <?php echo $settings['pricing_table_price_value']; ?></div>
                    <div class=""><?php echo $settings['pricing_table_period']; ?></div>
                </div>

                <div class="list">
                    <?php 
                        if ( $settings['pricing_table_features_list'] ) {
                            echo '<ul>';
                                foreach (  $settings['pricing_table_features_list'] as $item ) {
                                    echo '<li class="elementor-repeater-item-' . $item['_id'] . '">' . $item['pricing_table_features_list_text'] . '</li>';
                                }
                                echo '</ul>';
                            }
                    ?>
                </div>

                <div class="price-table-footer pricing_table_footer_padding"><a href="#" class="pricing_table_button_align" ><?php echo $settings['pricing_table_button_text']; ?></a></div>


            </div>

        </div>



        <!-- <div class="wbcom_call_to_action">

            <div class="wbcom_cta_flex">

                <div class="wbcom_left_cta">

                    <div class="wbcom_contact_text">

                        <div><?php // \Elementor\Icons_Manager::render_icon( $settings['pricing_table_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>    

                        <h2 class="title"><?php // echo $settings ['pricing_table_title'] ;?></h2>

                        <div><?php // echo $settings ['pricing_table_description'] ;?></div>

                        <div>
                           <?php 
                            //     if ( $settings['list'] ) {
                            // echo '<dl>';
                            // foreach (  $settings['list'] as $item ) {
                            //     echo '<dt class="elementor-repeater-item-' . $item['_id'] . '">' . $item['list_title'] . '</dt>';
                            //     echo '<dd>' . $item['list_content'] . '</dd>';
                            // }
                            // echo '</dl>';
                            ?> 

                        </div>

                        <div class="content_typography"><?php // echo  $settings ['wbcom_cta_title_content_type'] ;?></div>

                    </div>

                </div>



                <div class="wbcom_right_cta">

                    <div class="wbcom_contact_button">

                        <a href="<?php // echo $settings['wbcom_cta_btn_link']['url'] ;?>" class="button cta-button"><?php // echo $settings ['wbcom_cta_btn_text'] ;?></a>

                    </div>

                </div>

            </div>
        </div> -->
        <?php
    }


}


