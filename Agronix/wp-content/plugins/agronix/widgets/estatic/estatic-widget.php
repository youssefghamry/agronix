<?php

namespace BdevsElement\Widget;


use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;


defined('ABSPATH') || die();

class Estatic extends BDevs_El_Widget
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
        return 'estatic';
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
        return __('Static', 'bdevselement');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/widgets/gradient-heading/';
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
        return 'eicon-t-letter';
    }

    public function get_keywords()
    {
        return ['gradient', 'advanced', 'heading', 'title', 'colorful'];
    }

    protected function register_content_controls()
    {

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Design Style', 'bdevselement' ),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevselement'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
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


        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_20'
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
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
                'placeholder' => 'http://elementor.bdevs.net/',
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
                'default' => 'before',
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
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls(){
       
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

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'section-title bdevs-el-title  bdevs-el-btn');

        $this->add_inline_editing_attributes('button_text', 'none');
        $this->add_render_attribute('button_text', 'class', '');
        $this->add_render_attribute('button', 'class', 'z-btn z-btn-border ');

        if (!empty($settings['button_link'])) {
            $this->add_link_attributes('button', $settings['button_link']);
        }

        $title = bdevs_element_kses_basic($settings['title']);

        ?>
        <?php if ($settings['design_style'] === 'style_3'):
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>
        <div class="title-area-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="section-title section__title-3 bdevs-el-content">
                            <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>
                            <?php if ($settings['description']) : ?>
                                <p class="wow fadeInUp2" data-wow-delay=".4s">
                                    <?php echo bdevs_element_kses_intermediate($settings['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($settings['design_style'] === 'style_2'): 
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'brand__title' );    
    ?>


      <!-- video-area-2-start -->
      <div class="video-area-2 position-relative mt-50">
         <div class="video-area play-area" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/video-bg-2.jpg">
            <div class="play-btn">
               <a href="https://www.youtube.com/watch?v=L4CpMr5BNls" class="play-text popup-video"><i class="fal fa-play"></i></a>
            </div>
         </div>
         <div class="row g-0 justify-content-end">
            <div class="col-xl-6 col-lg-6 video-col col-md-6 col-12">
               <div class="video-box theme-bg pt-120 pb-90">
                  <div class="video-content pl-120" >
                     <div class="tp-section-wrap tp-section-wrap-video">
                        <span><i class="flaticon-grass"></i></span>
                        <h3 class="tp-section-title">High Quality Growing Organic Foods</h3>
                        <p>Agriculture was a family business not too long ago. Now a days, automation, scientific advances and better transportation have allowed for industrialization.</p>
                     </div>
                     <div class="video-features-list mt-50">
                        <div class="row">
                           <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                              <div class="video-features-item mb-30">
                                 <i class="flaticon-save"></i>
                                 <h5 class="video-features-title">Organic Vegetables</h5>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                              <div class="video-features-item mb-30">
                                 <i class="flaticon-digging"></i>
                                 <h5 class="video-features-title">Pure Soil Making</h5>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                              <div class="video-features-item mb-30">
                                 <i class="flaticon-wheat-1"></i>
                                 <h5 class="video-features-title">Organic Crops</h5>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-6 col-md-6 col-6">
                              <div class="video-features-item mb-30">
                                 <i class="flaticon-box"></i>
                                 <h5 class="video-features-title">Food Delivery</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="video-bg-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/bg-img-1.png" alt="img">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- video-area-2-end -->

      <!-- tp-testimonila-tabs -->
      <div class="tp-testimonila-tabs tp-testimonila-tabs-2 pt-240 pb-120 theme-bg-common">
         <div class="container">
            <div class="tp-testimonial-full">
               <div class="tab-content-pos-bg">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/strobery.png" alt="img">
               </div>
            </div>
            <div class="testimonial__slider p-relative pl-90 pr-90 pt-120 white-bg">
               <span class="tabs-icon"><i class="flaticon-grass"></i></span>
               <div class="row justify-content-center">
                  <div class="col-xxl-12">
                     <div class="testimoinial__slider-text swiper-container">
                        <div class="swiper-wrapper">
                           <div class="testimonial__content swiper-slide text-center">
                              <p>“ Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur. This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch.”</p>
                           </div>
                           <div class="testimonial__content swiper-slide text-center">
                              <p>“ This is due to their excellent service, competitive pricing and customer
                                 support.  It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum
                                 is simply free text irure dolor in reprehenderit in esse nulla pariatur. ”</p>
                           </div>
                           <div class="testimonial__content swiper-slide text-center">
                              <p>“ This is due to their excellent service, competitive pricing and customer
                                 support.  It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum
                                 is simply free text irure dolor in reprehenderit in esse nulla pariatur. ”</p>
                           </div>
                           <div class="testimonial__content swiper-slide text-center">
                              <p>“ It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum
                                 is simply free text irure dolor in reprehenderit in esse nulla pariatur.  This is due to their excellent service, competitive pricing and customer support.”</p>
                           </div>
                        </div>
                     </div>
                     <div class="row justify-content-center">
                        <div class="col-xxl-10 col-xl-12 col-lg-12">
                           <div class="testimonial__slider-nav swiper-container">
                              <div class="testimonial__nav swiper-wrapper">
                                 <div class="testimonial__avater swiper-slide d-flex align-items-center">
                                    <div class="testimonial__avater-img mr-30">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/client-1.png" alt="img">
                                    </div>
                                    <div class="testimonial__avater-content">
                                       <h4>Miranda H. Halim</h4>
                                       <span>Founder</span>
                                    </div>
                                 </div>
                                 <div class="testimonial__avater swiper-slide d-flex align-items-center">
                                    <div class="testimonial__avater-img mr-30">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/client-2.png" alt="img">
                                    </div>
                                    <div class="testimonial__avater-content">
                                       <h4>Shahnewaz Sakil</h4>
                                       <span>Founder</span>
                                    </div>
                                 </div>
                                 <div class="testimonial__avater swiper-slide d-flex align-items-center">
                                    <div class="testimonial__avater-img mr-30">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/client-3.png" alt="img">
                                    </div>
                                    <div class="testimonial__avater-content">
                                       <h4>Steve Paul</h4>
                                       <span>Founder</span>
                                    </div>
                                 </div>
                                 <div class="testimonial__avater swiper-slide d-flex align-items-center">
                                    <div class="testimonial__avater-img mr-30">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/client-4.png" alt="img">
                                    </div>
                                    <div class="testimonial__avater-content">
                                       <h4>Basun Dhora</h4>
                                       <span>Founder</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="tp-testimonial-full">
               <div class="tab-content-pos-bg2">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/client/tomato.png" alt="img">
               </div>
            </div>
         </div>
      </div>
      <!-- tp-testimonila-tabs -->

      <!-- subscrive-area-start -->
      <div class="subscrive-area pt-90 pb-65">
         <div class="container">
            <div class="row">
               <div class="col-xl-7">
                  <div class="tp-section-wrap tp-section-wrap-subscrive tp-section-wrap-7">
                     <span><i class="flaticon-grass"></i></span>
                     <h3 class="tp-section-title">Subscribe To Newsletter</h3>
                  </div>
               </div>
               <div class="col-xl-5">
                  <form action="#">
                     <input type="email" name="EMAIL" placeholder="Enter your email" required="">
                     <button type="submit">Subscribe <i class="fal fa-arrow-right"></i></button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- subscrive-area-end -->

      <!-- latest-news-area -->
      <div class="latest-news-area-2 latest-news-area pt-120 pb-90 fix">
         <div class="container container-fluid">
            <div class="row">
               <div class="col-xl-4 col-lg-4">
                  <div class="tp-section-wrap blog-slider-content mb-30">
                     <span><i class="flaticon-grass"></i></span>
                     <h3 class="tp-section-title">Blog Insights</h3>
                     <p>Agriculture was a family business not too long ago. Now a days, automation, scientific advances & better transportation have allowed</p>
                  </div>
               </div>
               <div class="col-xl-8 col-lg-8">
                  <div class="blog-slider blog-slider_active  owl-carousel">
                     <div class="latest-blog mb-30">
                        <div class="latest-blog-img">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog-6.jpg" class="img-fluid" alt="img"></a>
                              <div class="top-catagory">
                                 <a href="/wp/agronix/product/badhakopi-cabbage/" class="postbox__meta">organic</a>
                              </div>    
                        </div>
                        <div class="latest-blog-content">
                           <div class="latest-post-meta mb-15">
                              <span class="blog-date"><a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">november 21, 2021 </a></span>
                           </div>
                           <h3 class="latest-blog-title">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Keep them a Green Out the Potato house in here.</a>
                           </h3>
                           <div class="blog-btn mt-20">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Read More</a>
                           </div>
                        </div>
                     </div>
                     <div class="latest-blog mb-30">
                        <div class="latest-blog-img">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog-7.jpg" class="img-fluid" alt="img"></a>
                              <div class="top-catagory">
                                 <a href="/wp/agronix/product/badhakopi-cabbage/" class="postbox__meta">crops</a>
                              </div>    
                        </div>
                        <div class="latest-blog-content">
                           <div class="latest-post-meta mb-15">
                              <span class="blog-date"><a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">november 21, 2021 </a></span>
                           </div>
                           <h3 class="latest-blog-title">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Although these terms are often used interchangeably</a>
                           </h3>
                           <div class="blog-btn mt-20">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Read More</a>
                           </div>
                        </div>
                     </div>
                     <div class="latest-blog mb-30">
                        <div class="latest-blog-img">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog-8.jpg" class="img-fluid" alt="img"></a>
                              <div class="top-catagory">
                                 <a href="/wp/agronix/product/badhakopi-cabbage/" class="postbox__meta">vegetable</a>
                              </div>    
                        </div>
                        <div class="latest-blog-content">
                           <div class="latest-post-meta mb-15">
                              <span class="blog-date"><a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">november 21, 2021 </a></span>
                           </div>
                           <h3 class="latest-blog-title">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Its have different meanings. Organic foods are grown</a>
                           </h3>
                           <div class="blog-btn mt-20">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Read More</a>
                           </div>
                        </div>
                     </div>
                     <div class="latest-blog mb-30">
                        <div class="latest-blog-img">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog-6.jpg" class="img-fluid" alt="img"></a>
                              <div class="top-catagory">
                                 <a href="/wp/agronix/product/badhakopi-cabbage/" class="postbox__meta">organic</a>
                              </div>    
                        </div>
                        <div class="latest-blog-content">
                           <div class="latest-post-meta mb-15">
                              <span class="blog-date"><a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">november 21, 2021 </a></span>
                           </div>
                           <h3 class="latest-blog-title">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Keep them a Green Out the Potato house in here.</a>
                           </h3>
                           <div class="blog-btn mt-20">
                              <a href="/wp/agronix/they-are-so-hospitable-that-everybody-gets-impressed/">Read More</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- latest-news-area -->

      <!-- shop modal start -->
      <div class="modal fade" id="productModalId" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered product__modal" role="document">
            <div class="modal-content">
               <div class="product__modal-wrapper p-relative">
                     <div class="product__modal-close p-absolute">
                        <button data-bs-dismiss="modal"><i class="fal fa-times"></i></button>
                     </div>
                     <div class="product__modal-inner">
                        <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                           <div class="product__modal-box">
                                 <div class="tab-content" id="modalTabContent">
                                    <div class="tab-pane fade show active" id="nav1" role="tabpanel" aria-labelledby="nav1-tab">
                                       <div class="product__modal-img w-img">
                                             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/quick-view-1.jpg" alt="img">
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav2" role="tabpanel" aria-labelledby="nav2-tab">
                                       <div class="product__modal-img w-img">
                                             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/quick-view-2.jpg" alt="img">
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav3" role="tabpanel" aria-labelledby="nav3-tab">
                                       <div class="product__modal-img w-img">
                                             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/quick-view-3.jpg" alt="img">
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav4" role="tabpanel" aria-labelledby="nav4-tab">
                                       <div class="product__modal-img w-img">
                                             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/quick-view-4.jpg" alt="img">
                                       </div>
                                    </div>
                                 </div>
                                 <ul class="nav nav-tabs" id="modalTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link active" id="nav1-tab" data-bs-toggle="tab" data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1" aria-selected="true">
                                             <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/nav/quick-nav-1.jpg" alt="img">
                                       </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link" id="nav2-tab" data-bs-toggle="tab" data-bs-target="#nav2" type="button" role="tab" aria-controls="nav2" aria-selected="false">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/nav/quick-nav-2.jpg" alt="img">
                                       </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link" id="nav3-tab" data-bs-toggle="tab" data-bs-target="#nav3" type="button" role="tab" aria-controls="nav3" aria-selected="false">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/nav/quick-nav-3.jpg" alt="img">
                                       </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link" id="nav4-tab" data-bs-toggle="tab" data-bs-target="#nav4" type="button" role="tab" aria-controls="nav4" aria-selected="false">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product/quick-view/nav/quick-nav-4.jpg" alt="img">
                                       </button>
                                    </li>
                                 </ul>
                           </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                           <div class="product__modal-content">
                                 <h4><a href="/wp/agronix/product/badhakopi-cabbage/">Smashed Potato with green chili Regular (± 50 gm)</a></h4>
                                 <div class="product__modal-des mb-40">
                                    <p>Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt </p>
                                 </div>
                                 <div class="product__stock">
                                    <span>Availability :</span>
                                    <span>In Stock</span>
                                 </div>
                                 <div class="product__stock sku mb-30">
                                    <span>SKU:</span>
                                    <span>Samsung C49J89: £875, Debenhams Plus</span>
                                 </div>
                                 <div class="product__review d-sm-flex">
                                    <div class="rating rating__shop mb-15 mr-35">
                                    <ul>
                                       <li><a href="#"><i class="fal fa-star"></i></a></li>
                                       <li><a href="#"><i class="fal fa-star"></i></a></li>
                                       <li><a href="#"><i class="fal fa-star"></i></a></li>
                                       <li><a href="#"><i class="fal fa-star"></i></a></li>
                                       <li><a href="#"><i class="fal fa-star"></i></a></li>
                                    </ul>
                                    </div>
                                    <div class="product__add-review mb-15">
                                    <span><a href="/wp/agronix/product/badhakopi-cabbage/">1 Review</a></span>
                                    <span><a href="/wp/agronix/product/badhakopi-cabbage/">Add Review</a></span>
                                    </div>
                                 </div>
                                 <div class="product__price">
                                    <span>$560.00</span>
                                 </div>
                                 <div class="product__modal-form">
                                    <form action="#">
                                    <div class="pro-quan-area d-lg-flex align-items-center">
                                       <div class="product-quantity mr-20 mb-25">
                                             <div class="cart-plus-minus p-relative"><input type="text" value="1" /></div>
                                       </div>
                                       <div class="pro-cart-btn mb-25">
                                             <button class="tp-btn-h1" type="submit">Add to cart</button>
                                       </div>
                                    </div>
                                    </form>
                                 </div>
                                 <div class="product__modal-links">
                                    <ul>
                                    <li><a href="/wp/agronix/wishlist/" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="/wp/agronix/product/badhakopi-cabbage/" title="Compare"><i class="far fa-sliders-h"></i></a></li>
                                    <li><a href="/wp/agronix/cart/" title="Print"><i class="fal fa-print"></i></a></li>
                                    <li><a href="/wp/agronix/checkout/" title="Share"><i class="fal fa-share-alt"></i></a></li>
                                    </ul>
                                 </div>
                           </div>
                        </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
      <!-- shop modal end -->



    <?php else:
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title' );
    ?>


      <!-- banner-area-start -->
      <div class="banner-area pt-200 pb-180" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/hero-2.jpg">
         <div class="container">
             <div class="row justify-content-start">
               <div class="col-xl-5 col-lg-7 col-md-9 col-12 col-xm">
                  <div class="banner-content banner-content-2">
                     <div class="banner-info text-center">
                        <div class="baner-icon">
                           <i class="flaticon-grass"></i>
                        </div>
                        <p>since from 2000</p>
                        <h3 class="banner-title-h1 banner-title">High Quality Firm Products</h3>
                        <div class="banner-button mt-30">
                           <a href="/wp/agronix/about/" class="tp-btn-h1">Get Started Now</a>
                           <a href="https://www.youtube.com/watch?v=cIQNea_Jxjg" class="tp-btn-play-b banner-play-icon popup-video"><i class="fas fa-play"></i></a>
                        </div>
                     </div>
                     <div class="banner-shape-bg">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/banner-bg-shape.png" alt="img">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner-area-end -->

      <!-- about-area-start-->
      <div class="tp-about-area about-area-2 pt-110 pb-45">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xxl-4 col-xl-4 col-lg-4">
                  <div class="tp-section-wrap">
                     <span><i class="flaticon-grass"></i></span>
                     <h3 class="tp-section-title">Farm Ecology Products</h3>
                  </div>
               </div> 
               <div class="col-xl-1 col-lg-1 d-none d-lg-block">
                  <span class="line-bar"></span>
               </div>
               <div class="col-xxl-7 col-xl-7 col-lg-7 align-items-end">
                  <div class="tp-about-content-1">
                     <p>Smells racy free announcing than durable zesty smart exotic far feel. Screamin' affordable
                        secret way absolutely. Evulates vast a real proven works discount secure care. Market
                        invigorate a awesome handcrafted bigger comes newer recommended lifetime.</p>
                        <div class="author-info mt-20">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/author.jpg" alt="img">
                           <div class="author-content">
                              <h5>Alexis G. Gikon</h5>
                              <span>Founder</span>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about-area-end -->

      <!-- tp-features-list-area-start -->
      <div class="tp-features-list-area mb-90">
         <div class="container">
            <div class="row justify-content-end">
               <div class="col-xl-7 col-lg-8">
                  <div class="tp-features-list">
                     <div class="tp-list-item mb-30">
                        <i class="flaticon-wheat-1"></i>
                        <h5 class="features-title">Agriculture Products</h5>
                     </div>
                     <div class="tp-list-item mb-30">
                        <i class="flaticon-vegetable"></i>
                        <h5 class="features-title">Fresh Vegetables</h5>
                     </div>
                     <div class="tp-list-item mb-30">
                        <i class="flaticon-cow"></i>
                        <h5 class="features-title">Cow Meat <br> & Milk</h5>
                     </div>
                     <div class="tp-list-item mb-30">
                        <i class="flaticon-house"></i>
                        <h5 class="features-title">Warehouse <br> & Stock</h5>
                     </div>
                     <div class="tp-list-item mb-30">
                        <i class="flaticon-tractor-1"></i>
                        <h5 class="features-title">Professional Tools</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- tp-features-list-area-end -->

      <!-- orgainc-product-start -->
      <div class="orgainc-product pt-120 pb-120 h2-gray-bg position-relative">
         <div class="project-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/project/project-bg.png" class="img-fluid" alt="img">
         </div>
         <div class="overlay-bg">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/img/project/product-bg-o.jpg" alt="img">
         </div>
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-6 col-lg-6">
                  <div class="organic-image">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/img/project/organic-01.jpg" class="img-fluid" alt="img">
                     <div class="organic-meta">
                        <h5>30</h5>
                        <span>Years Of Experience</span>
                        <i class="fal fa-arrow-up"></i>
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="organic-product-content pl-80 mt-50">
                     <div class="tp-section-wrap">
                        <span><i class="flaticon-grass"></i></span>
                        <h3 class="tp-section-title">Agriculture & Organic Product Form</h3>
                        <p>Organic food is grown without the use of synthetic chemicals, such as human-made pesticides and fertilizers.</p>
                     </div>
                     <h5 class="organic-product-title mt-40">Fram Value</h5>
                     <div class="row g-0">
                        <div class="col-xl-6 col-lg-6">
                           <p class="organic-features-info">As a result, the village Kamalpur and its adjacent Upazillas are being turned into an academic-cum commercial center through which the people.</p>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                           <div class="organic-features-list">
                              <a href="#">-   Best Food Awards 2021</a>
                              <a href="#">-   Design Reward 2000</a>
                              <a href="#">-   Aptitude for Technology</a>
                              <a href="#">-   An amazing project in mind</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- orgainc-product-end -->

      <!-- company-features-start -->
      <div class="company-features pt-120 pb-90">
         <div class="container">
            <div class="tp-section-wrap text-center">
               <span><i class="flaticon-grass"></i></span>
               <h3 class="tp-section-title">Our Company Features</h3>
               <p>Agriculture was a family business not too long ago. Now a days, automation, scientific advances and better transportation have allowed for industrialization.</p>
            </div>
            <div class="company-features-list mt-50">
               <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <div class="company-features-item mb-30">
                        <div class="features-item text-center">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/img/features/features-icon-img-1.png" alt="img">
                           <h4 class="features-item-title">The Best Ingredients</h4>
                           <p>In order to have a comprehensive guideline as to how to setup agro.</p>
                        </div>
                        <div class="features-item-btton">
                           <a href="/wp/agronix/service-details/" class="features-btn">Read More <i class="fal fa-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <div class="company-features-item mb-30">
                        <div class="features-item text-center">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/img/features/features-icon-img-2.png" alt="img">
                           <h4 class="features-item-title">Best Equipments In Firm</h4>
                           <p>Guideline as to how to setup agro,In order to have a comprehensive.</p>
                        </div>
                        <div class="features-item-btton">
                           <a href="/wp/agronix/service-details/" class="features-btn">Read More <i class="fal fa-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <div class="company-features-item mb-30">
                        <div class="features-item text-center">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/img/features/features-icon-img-3.png" alt="img">
                           <h4 class="features-item-title">World Class Meat & Egg</h4>
                           <p>How to setup agro, In order to have a comprehensive guideline as to.</p>
                        </div>
                        <div class="features-item-btton">
                           <a href="/wp/agronix/service-details/" class="features-btn">Read More <i class="fal fa-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- company-features-end -->

      <!-- promo-area-start -->
      <div class="tp-promo-area promo-area-1">
         <div class="container">
            <div class="row">
                  <div class="col-xl-7 col-lg-6">
                     <div class="tp-promo-info mb-20">
                        <i class="fal fa-phone-alt"></i>
                        <div class="tp-support">
                              <p>Get Quick Support</p>
                              <h3><a href="tel:3796868">(212) 379 6868</a></h3>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-5 col-lg-6">
                     <div class="tp-promo-info right mb-20">
                        <div class="tp-support bar">
                              <p>Make Online Order</p>
                              <h3><a href="mailto:info@webmail.com">info@webmail.com</a></h3>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <!-- promo-area-end -->

      <!-- experice-area-start -->
      <div class="experience-area theme-bg-primary-h1 pt-120 pb-175 d-none">
         <div class="container">
            <div class="tp-section-wrap text-center">
               <span><i class="flaticon-grass"></i></span>
               <h3 class="tp-section-title">Our Company Features</h3>
               <p>Agriculture was a family business not too long ago. Now a days, automation, scientific advances and better transportation have allowed for industrialization.</p>
            </div>
            <div class="experience-list mt-50">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="experience-item text-center mb-40">
                        <div class="progress-circular mb-30">
                           <input type="text" class="knob" value="0" data-rel="90" data-linecap="round"
                              data-width="150" data-height="150" data-bgcolor="#e6e4dc" data-fgcolor="#31512a" data-thickness=".07" data-readonly="true" disabled/>
                        </div>
                        <h5 class="experience-item-title">Organic Food</h5>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit volupt ateaccu</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">  
                     <div class="experience-item text-center mb-40">
                        <div class="progress-circular mb-30">
                           <input type="text" class="knob" value="0" data-rel="61" data-linecap="round"
                              data-width="150" data-height="150" data-bgcolor="#e6e4dc" data-fgcolor="#31512a" data-thickness=".07" data-readonly="true" disabled/>
                        </div>
                        <h5 class="experience-item-title">Worldwide Basement</h5>
                        <p>Lorem ium dolor sit ametad pisicing elit sed simply do ut autem vel eum</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="experience-item text-center mb-40">
                        <div class="progress-circular mb-30">
                           <input type="text" class="knob" value="0" data-rel="50" data-linecap="round"
                              data-width="150" data-height="150" data-bgcolor="#e6e4dc" data-fgcolor="#31512a" data-thickness=".07" data-readonly="true" disabled/>
                        </div>
                        <h5 class="experience-item-title">1000+ Active Customer</h5>
                        <p> Nor again is there anyone who loves or pursues or desires to obtain</p>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="experience-item text-center mb-40">
                        <div class="progress-circular mb-30">
                           <input type="text" class="knob" value="0" data-rel="67" data-linecap="round"
                              data-width="150" data-height="150" data-bgcolor="#e6e4dc" data-fgcolor="#31512a" data-thickness=".07" data-readonly="true" disabled/>
                        </div>
                        <h5 class="experience-item-title">100+ Team Mates</h5>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- experice-area-end -->

      <!-- client area start -->
      <div class="tp-supporter__area tp-supporter__area-3 d-none">
         <div class="container">
            <div class="tp-supporter__area-2-inner bg-white">
               <div class="row no-gutters align-items-center">
                  <div class="col-xl-4">
                     <div class="tp-section-wrap">
                        <span><i class="flaticon-grass"></i></span>
                        <h3 class="tp-section-title">100+ <br> Trusted Company</h3>
                     </div>
                  </div>
                  <div class="col-xl-8">
                     <div class="tp-supporter__slider tp-supporter__slider-2  owl-carousel text-center">
                        <div class="tp-supporter__thumb">
                           <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-5.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                           <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-6.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                           <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-7.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                           <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-5.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                           <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-7.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-6.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-7.png" alt="client-1"></a>
                        </div>
                        <div class="tp-supporter__thumb">
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supporters/supporter-5.png" alt="client-1"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- client area end -->



    <?php endif; ?>

        <?php
    }
}
