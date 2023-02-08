<?php 
namespace BdevsElement;

class Helper {

    /** 
    * Get widgets list
    */
    public static function get_widgets() {

        return [
            'hero' => [
                'title' => __( 'hero', 'bdevselement' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],

            'cta' => [
                'title' => __( 'CTA', 'bdevselement' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ], 
            
            'faq' => [
                'title' => __( 'FAQ', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],                                                        

            'about' => [
                'title' => __( 'About', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ], 

            'brand' => [
                'title' => __( 'Brand', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],
            'service' => [
                'title' => __( 'Service', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],          

            'cf7' => [
                'title' => __( 'Contact Form 7', 'bdevselement' ),
                'icon' => 'fa fa-form',
            ],

            'heading' => [
                'title' => __( 'Heading Title', 'bdevselement' ),
                'icon' => 'fa fa-icon-box',
            ],

            'infobox' => [
                'title' => __( 'Info Box', 'bdevselement' ),
                'icon' => 'fa fa-blog-content',
            ],

            'icon_box' => [
                'title' => __( 'Icon Box', 'bdevselement' ),
                'icon' => 'fa fa-blog-content',
            ],

            'member-slider' => [
                'title' => __( 'Team Member Slider', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ],             

            'member-details' => [
                'title' => __( 'Member Details', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ], 

            'fact' => [
                'title' => __( 'Fact', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ],

            'slider' => [
                'title' => __( 'Slider', 'bdevselement' ),
                'icon' => 'fa fa-image-slider',
            ],

            'featured-list' => [
                'title' => __( 'Featured List', 'bdevselement' ),
                'icon' => 'fa fa-flip-card',
            ],            

            'post-list' => [
                'title' => __( 'Post List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],

            'post-tab' => [
                'title' => __( 'Post Tab', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ], 

            'project' => [
                'title' => __( 'Project Gallery', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ], 

            'project-slider' => [
                'title' => __( 'Project Slider', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ],            

            'testimonial-slider' => [
                'title' => __( 'Testimonial Slider', 'bdevselement' ),
                'icon' => 'fa fa-testimonial',
                'css' => ['testimonial'],
                'js' => [],
                'vendor' => [
                    'css' => [],
                    'js' => [],
                ],
            ],

            'woo-product' => [
                'title' => __( 'Woo Product', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
            'woo-product-cat' => [
                'title' => __( 'Woo Product cat', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
            'woo-product-tab' => [
                'title' => __( 'Woo Product Tab', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],

            'video-info' => [
                'title' => __( 'Video Info', 'bdevselement' ),
                'icon' => 'fa fa-blog-content',
            ],

            'skill' => [
                'title' => __( 'Skill', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ], 
        ];
    }


    /**
    *  Get Tutor Course widgets list   
    **/

    public static function get_tutor_course_widgets() { 
        return [
            'course-list' => [
                'title' => __('Tutor Course List', 'bdevselement'),
                'icon' => 'fa fa-post-list',
            ],

            'course-tab' => [
                'title' => __('Tutor Course Tab', 'bdevselement'),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }


    /**
    *  Get Learpress Course widgets list   
    **/

    public static function get_learnpress_course_widgets() { 
        return [
            'learnpress-course-list' => [
                'title' => __( 'LearnPress Course List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],
            'learnpress-course-tab' => [
                'title' => __( 'LearnPress Course Tab', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }


    /**
    *  Get Leardash Course widgets list   
    **/

    public static function get_learndash_course_widgets() { 
        return [
            'learndash-course-list' => [
                'title' => __( 'Learndash Course List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],
            'learndash-course-tab' => [
                'title' => __( 'Learndash Course Tab', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }

    
    /**
    *  Get WooCommerce widgets list   
    **/
    public static function get_woo_widgets() { 

        return [
            'woo-product' => [
                'title' => __( 'Woo Product', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ]

        ];
    }
}


