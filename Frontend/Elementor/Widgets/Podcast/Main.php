<?php
/**
 * Main.php
 *
 * Handles the main logic for the Elementor widget 'Podcast'.
 *
 * @package EBFP\Frontend\Elementor\Widgets\Podcast
 * @since 1.0.0
 */
namespace EBFP\Frontend\Elementor\Widgets\Podcast;

/**
 * Class Main
 *
 * This class extends the Elementor Widget_Base class to create a custom widget
 * for displaying podcasts in the Elementor plugin. It includes methods for 
 * defining the widget's name, title, icon, and other attributes and functionalities.
 *
 * @package EBFP\Frontend\Elementor\Widgets\Podcast
 * @since 1.0.0
 */

class Main extends \Elementor\Widget_Base
{

	public function get_name(): string
	{
		return 'ebfp-podcast';
	}

	public function get_title(): string
	{
		return esc_html__('Podcast', 'event-business-formula');
	}

	public function get_icon(): string
	{
		return 'eicon-speakerphone';
	}

	public function get_categories(): array
	{
		return ['basic'];
	}

	public function get_keywords(): array
	{
		return ['podcast', 'audio'];
	}

	public function get_style_depends()
	{
		return ['ebfp-style'];
	}

	protected function register_controls(): void
	{


		// Layout Section Start
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__('Layout', 'event-business-formula'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__('Posts Per Page', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
				'min' => 2,
				'max' => 20,
				'step' => 2,
			]
		);

		$this->add_responsive_control(
			'grid_columns',
			[
				'label' => esc_html__('Grid Columns', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => esc_html__('1 Column', 'event-business-formula'),
					'2' => esc_html__('2 Columns', 'event-business-formula'),
					'3' => esc_html__('3 Columns', 'event-business-formula'),
					'4' => esc_html__('4 Columns', 'event-business-formula'),
				],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label' => esc_html__('Gap Between Items', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'load_more_button',
			[
				'label' => esc_html__('Load More Button', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Show', 'event-business-formula'),
				'label_off' => esc_html__('Hide', 'event-business-formula'),
			]
		);

		$this->end_controls_section();
		// Layout Section End


		// Style Tab Start
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => esc_html__('Box', 'event-business-formula'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'label' => esc_html__('Background', 'event-business-formula'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .ebfp-podcast-grid-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'event-business-formula'),
				'selector' => '{{WRAPPER}} .ebfp-podcast-grid-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'event-business-formula'),
				'selector' => '{{WRAPPER}} .ebfp-podcast-grid-item',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_gap',
			[
				'label' => esc_html__('Gap Between Items', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_thumbnail_style',
			[
				'label' => esc_html__('Thumbnail', 'event-business-formula'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumbnail_border_radius',
			[
				'label' => esc_html__('Border Radius', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-single-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'event-business-formula'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-grid-item-content-title a' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'event-business-formula'),
				'selector' => '{{WRAPPER}} .ebfp-podcast-grid-item-content-title a',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'event-business-formula'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'button_space',
			[
				'label' => esc_html__('Space', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_alignment',
			[
				'label' => esc_html__('Alignment', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'event-business-formula'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'event-business-formula'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'event-business-formula'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-button' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'event-business-formula'),
				'selector' => '{{WRAPPER}} .ebfp-podcast-load-more',
			]
		);


		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__('Width', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__('Background Color', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => esc_html__('Hover Background Color', 'event-business-formula'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ebfp-podcast-load-more:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		require EBFP_ELEMENTOR_PATH . '/Widgets/Podcast/Renderview.php';
	}

}
