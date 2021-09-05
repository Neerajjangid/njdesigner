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

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * njdesigner widget class.
 *
 * @since 1.0.0
 */
class njdesigner extends Widget_Base {
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

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'awesomesauce';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Awesomesauce', 'elementor-njdesigner' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-pencil';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function categories_registered() {
		return array( 'wbcom-elementor-category' );
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'njdesigner' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-njdesigner' ),
			)
		);

		 $this->add_responsive_control(
            'wbcom_cta_content_type',
            [
                'label' => esc_html__('Alignment', 'wbcom-elementor-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'label_block' => false,
                'options' => [
                    'default' => esc_html__('Left', 'wbcom-elementor-addon'),
                    'center' => esc_html__('Center', 'wbcom-elementor-addon'),
                    'right' => esc_html__('Right', 'wbcom-elementor-addon'),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );


		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementor-njdesigner' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Title', 'elementor-njdesigner' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'elementor-njdesigner' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Description', 'elementor-njdesigner' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'elementor-njdesigner' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'elementor-njdesigner' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_2',
			array(
				'label' => __( 'Content 2', 'elementor-njdesigner' ),
			)
		);

		$this->add_control(
			'content_2',
			array(
				'label'   => __( 'Content 2', 'elementor-njdesigner' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'elementor-njdesigner' ),
			)
		);

		$this->end_controls_section();

		/**
	     * -------------------------------------------
	     * Tab Style (Cta Title Style)
	     * -------------------------------------------
	     */

		 $this->start_controls_section(
	            'wbcom_section_cta_btn_style_settings',
	            [
	                'label' => esc_html__('Primary Button Style', 'wbcom-elementor-addon'),
	                'tab' => Controls_Manager::TAB_STYLE,
	            ]
	        );

		 $this->add_control(
		        'wbcom_cta_bg_color',
		        [
		            'label' => esc_html__('Background Color', 'wbcom-elementor-addon'),
		            'type' => Controls_Manager::COLOR,
		            'default' => '#f4f4f4',
		            'selectors' => [
		                '{{WRAPPER}} .wbcom_call_to_action' => 'background-color: {{VALUE}};',
		            ],
		        ]
		    );


		 $this->end_controls_section();	


	}

	



	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="<?php echo $settings['wbcom_cta_content_type'] ; ?>">
		<h2 class="wbcom_call_to_action"><?php echo $settings['title'] ; ?></h2>
		<div><?php echo $settings ['description'] ; ?></div>
		<div><?php echo $settings ['content'] ; ?></div>
		<div><?php echo $settings ['content_2'] ; ?></div>
		</div>
		<?php
	}

}
