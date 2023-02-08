<?php

namespace BdevsElement\Widget;

Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class About extends BDevs_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'about';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('About', 'bdevselement');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-single-post';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'about', 'content'];
    }

    /**
     * Register content related controls
     */
    protected function register_content_controls()
    {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevselement'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevselement'),
                    'style_2' => __('Style 2', 'bdevselement'),
                    'style_3' => __('Style 3', 'bdevselement'),
                    'style_4' => __('Style 4', 'bdevselement'),
                    'style_5' => __('Style 5', 'bdevselement'),
                    'style_6' => __('Style 6', 'bdevselement'),
                    'style_7' => __('Style 7', 'bdevselement'),
                    'style_8' => __('Style 8', 'bdevselement'),
                    'style_9' => __('Style 9', 'bdevselement'),
                    'style_10' => __('Style 10', 'bdevselement'),
                    'style_11' => __('Style 11', 'bdevselement'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_switch',
            [
                'label' => __('Icon Show/Hide', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4'],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevselement'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2','style_5', 'style_6', 'style_7', 'style_8', 'style_10'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevselement'),
                'placeholder' => __('Type Info Box Title', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title2',
            [
                'label' => __('Title 02', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevselement'),
                'placeholder' => __('Type Info Box Title', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_9'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevselement'),
                'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevselement'),
                'placeholder' => __('Type info box description', 'bdevselement'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_2','style_3','style_4','style_5','style_6','style_8','style_9','style_10','style_11'],
                ],
            ]
        );

        $this->add_control(
            'description2',
            [
                'label' => __('Description 02', 'bdevselement'),
                'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here 2', 'bdevselement'),
                'placeholder' => __('Type info box description 2', 'bdevselement'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_5', 'style_8', 'style_9', 'style_11'],
                ],
            ]
        );

        $this->add_control(
            'author_name',
            [
                'label' => __('Author Name', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Alexis G. Gikon', 'bdevselement'),
                'placeholder' => __('Type Author Name', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'author_designation',
            [
                'label' => __('Author Designation', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Founder', 'bdevselement'),
                'placeholder' => __('Type Author Designation', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('30', 'bdevselement'),
                'placeholder' => __('Type Number', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_5'],
                ],
            ]
        );

        $this->add_control(
            'experience',
            [
                'label' => __('Experience', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Years Of Experience', 'bdevselement'),
                'placeholder' => __('Type Experience', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'value',
            [
                'label' => __('Value', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Fram Value', 'bdevselement'),
                'placeholder' => __('Type Value', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => __( 'Video URL', 'bdevselement' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'bdevs video url goes here', 'bdevselement' ),
                'placeholder' => __( 'Set Video URL', 'bdevselement' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3', 'style_7', 'style_9'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevselement'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevselement'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevselement'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevselement'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevselement'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevselement'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevselement'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevselement'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevselement'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // img
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Big Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2','style_3', 'style_4', 'style_6', 'style_7', 'style_9', 'style_10', 'style_11'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_4'],
                ],
            ]
        );

        $this->add_control(
            'image2',
            [
                'label' => __('Image 02', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4'],
                ],
            ]
        );

        $this->add_control(
            'shape_image',
            [
                'label' => __('Shape Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2','style_3'],
                ],
            ]
        );

        $this->add_control(
            'author_image',
            [
                'label' => __('Athor Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_5'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features_list',
            [
                'label' => __('Features List', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2','style_3', 'style_4', 'style_6', 'style_7', 'style_10'],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevselement'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_2' => __('Style 2', 'bdevselement'),
                    'style_3' => __('Style 3', 'bdevselement'),
                    'style_4' => __('Style 4', 'bdevselement'),
                    'style_6' => __('Style 6', 'bdevselement'),
                    'style_7' => __('Style 7', 'bdevselement'),
                    'style_10' => __('Style 10', 'bdevselement'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'type',
            [
                'label' => __('Media Type', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'bdevselement'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __('Image', 'bdevselement'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'type' => 'icon'
                    ],
                ]
            );
        }

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevselement'),
                'placeholder' => __('Type title here', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Description', 'bdevselement'),
                'placeholder' => __('Type Description here', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_4', 'style_6'],
                ],
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'label' => __( 'Slide URL', 'bdevselement' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'bdevs slide url goes here', 'bdevselement' ),
                'placeholder' => __( 'Set slide URL', 'bdevselement' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_4', 'style_8'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevselement'),
                'placeholder' => __('Type button text here', 'bdevselement'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevselement'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevselement'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevselement'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //button 2
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __( 'Button 2', 'bdevselement' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_20'],
                ],
            ]
        );
        // 2nd btn
        $this->add_control(
            'button_text2',
            [
                'label' => __( 'Button Text 2', 'bdevselement' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text 2',
                'placeholder' => __( 'Type button text here', 'bdevselement' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link2',
            [
                'label' => __( 'Link', 'bdevselement' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_icon2',
                [
                    'label' => __( 'Icon', 'bdevselement' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon2',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position2',
            [
                'label' => __( 'Icon Position', 'bdevselement' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevselement' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevselement' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing2',
            [
                'label' => __( 'Icon Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevselement' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevselement' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // List Title    
        $this->add_control(
            '_heading_listtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'List Title', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'listtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-listtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'listtitle_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-listtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'listtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-listtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevselement' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );


        $this->end_controls_section();

        
        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevselement' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevselement' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevselement' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = bdevs_element_kses_basic($settings['title']);
        ?>
        <?php if ($settings['design_style'] === 'style_4'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['image2']['id'])) {
            $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');

        $this->add_render_attribute('button', 'class', 'btn-ab-2 bdevs-el-btn');
        $this->add_render_attribute('button', 'data-wow-delay', '');
        $this->add_link_attributes('button', $settings['button_link']);

        ?>

        <div class="tp-about-area">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-5 col-xl-6 col-lg-6">
                     <div class="tp-about-image">
                        <?php if (!empty($bg_image)): ?>
                        <img class="left-side-image" src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>

                        <?php if (!empty($image)): ?>
                        <div class="tp-upper-img">
                           <img src="<?php echo esc_url($image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($image2)): ?>
                        <div class="tp-circle-shape">
                           <img src="<?php echo esc_url($image2); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image2), '_wp_attachment_image_alt', true); ?>">
                        </div>
                        <?php endif; ?>
                     </div>
                  </div> 
                  <div class="col-xxl-7 col-xl-6 col-lg-6">
                     <div class="tp-about-content pl-40">
                        <div class="tp-section-wrap bdevs-el-content">
                            <?php if (!empty($settings['icon_switch'])): ?>
                            <span><i class="flaticon-cow-4"></i></span>
                            <?php endif; ?>
                            
                           <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>

                           <?php if ($settings['description']): ?>
                            <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row no-gutters">
                           <?php foreach ($settings['slides'] as $slide): ?>
                           <div class="col-xl-6 col-md-6">
                              <div class="tp-about-list mt-30">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                                 <div class="tp-about-list-text bdevs-el-content">
                                    <h5 class="tp-about-list-title bdevs-el-listtitle"><?php echo bdevs_element_kses_basic($slide['title']); ?></h5>
                                    <p><?php echo bdevs_element_kses_basic($slide['description']); ?></p>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>

                        <?php if (!empty($settings['button_text'])): ?> 
                        <div class="tp-about-btn  mt-30">
                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s href="%3$s">%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text']),
                                    esc_url($settings['button_link']['url'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>>
                                        <span><?php echo esc_html($settings['button_text']); ?></span>
                                        <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    </a>
                                <?php
                                endif;
                            endif; ?>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>

    <?php elseif ($settings['design_style'] === 'style_5'):

        $this->add_render_attribute('title', 'class', 'tp-section-title-h3 tp-section-title bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if (!empty($settings['author_image']['id'])) {
            $author_image = wp_get_attachment_image_url($settings['author_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <div class="serivces-cta pt-75 pb-75 theme-bg-primary-h3">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-8 col-lg-8">
                     <div class="tp-section-wrap tp-section-wrap-h3">
                        <?php if ($settings['sub_title']): ?>
                        <span class="service-catagory bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>

                       <?php printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>

                     </div>
                     <div class="serivces-cta-info bdevs-el-content">
                        <a href="#" class="client-img"><img src="<?php echo esc_url($author_image); ?>" alt="img"></a>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?> <a href="tel:<?php echo esc_url( $settings['number'] ); ?>"> <?php echo bdevs_element_kses_intermediate($settings['number']); ?> </a> - <?php echo bdevs_element_kses_intermediate($settings['description2']); ?></p>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4">
                     <div class="serivces-cta-icon">
                        <i class="flaticon-pumpkin-1"></i>
                     </div>
                  </div>
               </div>
            </div>
        </div>

    <?php elseif ($settings['design_style'] === 'style_6'):

        $this->add_render_attribute('title', 'class', 'tp-section-title tp-section-title-h3-d tp-section-title-ab-3 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <!-- about-area-start -->
        <div class="tp-about-area">
            <div class="container">
               <div class="row align-items-center">
                  <?php if (!empty($bg_image)): ?>
                  <div class="col-xxl-5 col-xl-5 col-lg-5">
                     <div class="tp-about-image pr-30">
                        <img class="left-side-image" src="<?php echo esc_url($bg_image); ?>" alt="img">
                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="col-xxl-7 col-xl-7 col-lg-7">
                     <div class="tp-about-content tp-about-content-h3">
                        <div class="tp-section-wrap tp-section-wrap-h3 bdevs-el-content">
                           <?php if ($settings['sub_title']): ?>
                           <span class="asub-title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                           <?php endif; ?>

                           <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>

                            <?php if ($settings['description']): ?>
                            <p class="description"><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row no-gutters mt-50">
                           <?php foreach ($settings['slides'] as $slide): ?>
                           <div class="col-xl-6 col-md-6 col-sm-6 col-12">
                              <div class="tp-about-list tp-about-list-2 mt-20">
                                 <div class="tp-about-list-text bdevs-el-content">
                                    <h5 class="ab-list-title ab-list-title-2 bdevs-el-listtitle"><?php echo bdevs_element_kses_basic($slide['title']); ?></h5>
                                    <p><?php echo bdevs_element_kses_basic($slide['description']); ?></p>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
        <!-- about-area-end -->


    <?php elseif ($settings['design_style'] === 'style_7'):

        $this->add_render_attribute('title', 'class', 'tp-section-title tp-section-title-h3-d bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <div class="chosse-us-area h3-gray-bg pt-120 pb-90">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6">
                     <div class="chosse-main-info">
                        <div class="tp-section-wrap tp-section-wrap-h3 text-center">
                           <?php if ($settings['sub_title']): ?>
                           <span class="asub-title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                           <?php endif; ?>

                           <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>
                        </div>
                        <div class="row mt-80">
                           <?php foreach ($settings['slides'] as $slide): ?>
                           <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                              <div class="chosse-list bg-white text-center mb-30">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                                <h5 class="chosse-list-title bdevs-el-listtitle"><?php echo bdevs_element_kses_basic($slide['title']); ?></h5>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="chosse-video">
                        <?php if (!empty($bg_image)): ?>
                        <div class="chosse-video-bg position-relative">
                           <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
                           <a href="<?php echo esc_url( $settings['video_url'] ); ?>" class="play-icon-3 play-icon popup-video"><i class="fas fa-play"></i></a>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>


    <?php elseif ($settings['design_style'] === 'style_8'):

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        $this->add_render_attribute('button', 'class', 'tp-btn-ab bdevs-el-btn');
        $this->add_render_attribute('button', 'data-wow-delay', '');
        $this->add_link_attributes('button', $settings['button_link']);

        ?>

        <div class="about-area">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-6">
                     <div class="tp-section-wrap">
                        <?php if ($settings['sub_title']): ?>
                        <span class="asub-title grace-span bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>

                       <?php printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="about-info bdevs-el-content">
                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>

                        <?php if ($settings['description2']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description2']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($settings['button_text'])): ?> 
                        <div class="about-button mt-30">
                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s href="%3$s">%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text']),
                                    esc_url($settings['button_link']['url'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>>
                                        <span><?php echo esc_html($settings['button_text']); ?></span>
                                        <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    </a>
                                <?php
                                endif;
                            endif; ?>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>

    <?php elseif ($settings['design_style'] === 'style_9'):

        $this->add_render_attribute('title', 'class', '');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <div class="collaborative-area pt-120 pb-55">
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 col-lg-6">
                     <div class="cp-info-right mb-30 bdevs-el-content">
                        <?php if ($settings['title']): ?>
                        <h4 class="cp-title mb-15 bdevs-el-title"><?php echo bdevs_element_kses_intermediate($settings['title']); ?></h4>
                        <?php endif; ?>

                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <div class="cp-info-left bdevs-el-content">
                        <?php if ($settings['title2']): ?>
                        <h4 class="cp-title mb-15 bdevs-el-title"><?php echo bdevs_element_kses_intermediate($settings['title2']); ?></h4>
                        <?php endif; ?>

                        <?php if ($settings['description2']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description2']); ?></p>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>
        <!-- collaborative-area-end -->

        <!-- video-area-start -->
        <div class="video-area-ab">
            <div class="container">
               <div class="chosse-video">
                  <?php if (!empty($bg_image)): ?>
                  <div class="chosse-video-bg position-relative">
                     <img src="<?php echo esc_url($bg_image); ?>" alt="img">
                     <a href="<?php echo esc_url( $settings['video_url'] ); ?>" class="play-icon play-icon-ab popup-video"><i class="fas fa-play"></i></a>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
        </div>



    <?php elseif ($settings['design_style'] === 'style_10'):

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <div class="award-area">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-5 col-lg-5">
                    <?php if (!empty($bg_image)): ?>
                    <div class="award-image text-center">
                        <img src="<?php echo esc_url($bg_image); ?>" alt="img" class="img-fluid">
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-xl-7 col-lg-7">
                     <div class="tp-section-wrap tp-section-wrap-6 bdevs-el-content">
                        <?php if ($settings['sub_title']): ?>
                        <span class="asub-title grace-span bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                        <?php endif; ?>


                       <?php printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>

                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="awards-lists mt-50">
                        <div class="row">
                           <?php foreach ($settings['slides'] as $slide): ?>
                           <div class="col-xl-3 col-lg-6 col-md-6">
                              <div class="award-item text-center mb-30">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                                <h5 class="award-title mt-15 bdevs-el-listtitle"><?php echo bdevs_element_kses_basic($slide['title']); ?></h5>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>

    <?php elseif ($settings['design_style'] === 'style_11'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <div class="guiderline-area">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-6 col-lg-6">
                    <div class="guideline-content bdevs-el-content">
                        <?php if ($settings['title']): ?>
                        <h6 class="guideline-title mb-35 bdevs-el-title"><?php echo bdevs_element_kses_intermediate($settings['title']); ?></h6>
                        <?php endif; ?>

                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                        <?php if ($settings['description2']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description2']); ?></p>
                        <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6">
                     <?php if (!empty($bg_image)): ?>
                     <div class="guideline-image">
                        <img src="<?php echo esc_url($bg_image); ?>" alt="img" class="img-fluid">
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
        </div>


    <?php elseif ($settings['design_style'] === 'style_3'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['shape_image']['id'])) {
            $shape_image = wp_get_attachment_image_url($settings['shape_image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '');
        ?>


      <div class="video-area-2 position-relative">
         <?php if (!empty($bg_image)): ?>
         <div class="video-area play-area" data-background="<?php echo esc_url($bg_image); ?>">
            <div class="play-btn">
               <a href="<?php echo esc_url( $settings['video_url'] ); ?>" class="play-text popup-video"><i class="fal fa-play"></i></a>
            </div>
         </div>
         <?php endif; ?>

         <div class="row g-0 justify-content-end">
            <div class="col-xl-6 col-lg-6 video-col col-md-6 col-12">
               <div class="video-box theme-bg pt-120 pb-90">
                  <div class="video-content pl-120" >
                     <div class="tp-section-wrap tp-section-wrap-video bdevs-el-content">
                        <?php if (!empty($settings['icon_switch'])): ?>
                        <span><i class="flaticon-grass"></i></span>
                        <?php endif; ?>
                       <?php printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>
                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="video-features-list mt-50">
                        <div class="row">
                           <?php foreach ($settings['slides'] as $slide): ?>
                           <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                              <div class="video-features-item mb-30">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                                 <h5 class="video-features-title bdevs-el-listtitle"><?php echo bdevs_element_kses_basic($slide['title']); ?></h5>
                              </div>
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                     <?php if (!empty($shape_image)): ?>
                     <div class="video-bg-image">
                        <img src="<?php echo esc_url($shape_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($shape_image), '_wp_attachment_image_alt', true); ?>">
                     </div>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>


    <?php elseif ($settings['design_style'] === 'style_2'):
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }
        if (!empty($settings['shape_image']['id'])) {
            $shape_image = wp_get_attachment_image_url($settings['shape_image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');

        ?>

      <!-- orgainc-product-start -->
      <div class="orgainc-product pt-120 pb-120 h2-gray-bg position-relative">
         <?php if (!empty($shape_image)): ?>
         <div class="project-bg">
            <img src="<?php echo esc_url($shape_image); ?>" class="img-fluid" alt="<?php echo get_post_meta(attachment_url_to_postid($shape_image), '_wp_attachment_image_alt', true); ?>">
         </div>
         <?php endif; ?>

         <?php if (!empty($bg_image)): ?>
         <div class="overlay-bg">
            <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
         </div>
         <?php endif; ?>

         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6">
                  <div class="organic-image">
                     <?php if (!empty($image)): ?>
                     <img src="<?php echo esc_url($image); ?>" class="img-fluid" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>">
                     <?php endif; ?>

                    <?php if ($settings['number']): ?>
                     <div class="organic-meta">
                        <h5><?php echo bdevs_element_kses_intermediate($settings['number']); ?></h5>

                        <?php if ($settings['experience']): ?>
                        <span><?php echo bdevs_element_kses_intermediate($settings['experience']); ?></span>
                        <?php endif; ?>
                        <i class="fal fa-arrow-up"></i>
                     </div>
                    <?php endif; ?>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="organic-product-content pl-80 mt-50">
                     <div class="tp-section-wrap bdevs-el-content">
                        <?php if (!empty($settings['icon_switch'])): ?>
                        <span><i class="flaticon-grass"></i></span>
                        <?php endif; ?>

                       <?php printf('<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>
                       <?php if ($settings['description']): ?>
                            <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                     </div>

                     <?php if ($settings['value']): ?>
                     <h5 class="organic-product-title mt-40"><?php echo bdevs_element_kses_intermediate($settings['value']); ?></h5>
                     <?php endif; ?>

                     <div class="row g-0">
                        <?php if ($settings['description2']): ?>
                        <div class="col-xl-6 col-lg-6">
                           <p class="organic-features-info"><?php echo bdevs_element_kses_intermediate($settings['description2']); ?></p>
                        </div>
                        <?php endif; ?>

                        <div class="col-xl-6 col-lg-6">
                           <div class="organic-features-list">
                            <?php foreach ($settings['slides'] as $slide): ?>
                                <?php if (!empty($slide['title'])) : ?>
                                <a class="bdevs-el-listtitle" href="<?php echo esc_url( $slide['slide_url'] ); ?>"><?php echo bdevs_element_kses_basic($slide['title']); ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                           </div>
                        </div>        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- orgainc-product-end -->
     
    <?php else:
        if (!empty($settings['author_image']['id'])) {
            $author_image = wp_get_attachment_image_url($settings['author_image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'tp-section-title bdevs-el-title');

        ?>

      <div class="tp-about-area about-area-2">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xxl-4 col-xl-4 col-lg-4">
                  <div class="tp-section-wrap">
                    <?php if (!empty($settings['icon_switch'])): ?>
                    <span><i class="flaticon-grass"></i></span>
                    <?php endif; ?>

                    <?php printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        $title
                    ); ?>
                  </div>
               </div> 
               <div class="col-xl-1 col-lg-1 d-none d-lg-block">
                  <span class="line-bar"></span>
               </div>
               <div class="col-xxl-7 col-xl-7 col-lg-7 align-items-end">
                  <div class="tp-about-content-1 bdevs-el-content">
                        <?php if ($settings['description']): ?>
                        <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                        <div class="author-info mt-20">
                            <?php if (!empty($author_image)): ?>
                            <img src="<?php echo esc_url($author_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($author_image), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                           <div class="author-content">
                              <?php if ($settings['author_name']): ?>
                              <h5><?php echo bdevs_element_kses_intermediate($settings['author_name']); ?></h5>
                              <?php endif; ?>

                              <?php if ($settings['author_designation']): ?>
                              <span><?php echo bdevs_element_kses_intermediate($settings['author_designation']); ?></span>
                              <?php endif; ?>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    <?php endif; ?>
        <?php
    }
}
