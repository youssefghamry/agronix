<?php
/**
 * agronix customizer
 *
 * @package agronix
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function agronix_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'agronix_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Agronix Customizer', 'agronix' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Topbar Setting', 'agronix' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'agronix' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'agronix' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'agronix' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Side Info', 'agronix' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'agronix' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'agronix' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'agronix' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'agronix' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'agronix' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'course_settings', [
        'title'       => esc_html__( 'Course Settings ', 'agronix' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'learndash_course_settings', [
        'title'       => esc_html__( 'Learndash Course Settings ', 'agronix' ),
        'description' => '',
        'priority'    => 20,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'agronix' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'agronix' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'agronix_customizer',
    ] );

}

add_action( 'customize_register', 'agronix_customizer_panels_sections' );

function _header_top_fields( $fields ) {
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_header_social',
        'label'    => esc_html__( 'Show Social', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_preloader',
        'label'    => esc_html__( 'Preloader On/Off', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_search',
        'label'    => esc_html__( 'Serach On/Off', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_email',
        'label'    => esc_html__( 'Email ID', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'info@webmail.com', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_address',
        'label'    => esc_html__( 'Office Address', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '13/A, New Hawk Tower, NYC', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'agronix_address_link',
        'label'    => esc_html__( 'Address URL', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_phone',
        'label'    => esc_html__( 'Phone Number', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '897-985-564-45', 'agronix' ),
        'priority' => 10,
    ];

    // button
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_button_text',
        'label'    => esc_html__( 'Button Text', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Get A Quote', 'agronix' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agronix_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'agronix_button_link',
        'label'    => esc_html__( 'Button URL', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agronix_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_signup_button_text',
        'label'    => esc_html__( 'Button Text', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Sign Up', 'agronix' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agronix_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'link',
        'settings' => 'agronix_signup_button_link',
        'label'    => esc_html__( 'Button URL', 'agronix' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'agronix_header_right',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
 */
function _header_social_fields( $fields ) {
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'agronix' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'agronix' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'agronix' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'agronix' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'agronix' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'agronix' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
Header Settings
 */
function _header_header_fields( $fields ) {


    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'agronix' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'agronix' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'agronix' ),
        'description' => esc_html__( 'Upload Your Logo.', 'agronix' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'agronix' ),
        'description' => esc_html__( 'Header Logo Black', 'agronix' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'preloader_icon',
        'label'       => esc_html__( 'Preloader Icon', 'agronix' ),
        'description' => esc_html__( 'Upload Preloader Icon.', 'agronix' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/favicon.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'preloader_logo',
        'label'       => esc_html__( 'Preloader Logo', 'agronix' ),
        'description' => esc_html__( 'Upload Preloader Logo.', 'agronix' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/preloder.png',
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_search_hide',
        'label'    => esc_html__( 'Side Search On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_extra_text_hide',
        'label'    => esc_html__( 'Side Extra Text On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_map_hide',
        'label'    => esc_html__( 'Side Map On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_gallery_hide',
        'label'    => esc_html__( 'Side Gallery On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_contact_info_hide',
        'label'    => esc_html__( 'Side Contact Info On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_side_social_hide',
        'label'    => esc_html__( 'Side Social On/Off', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agronix_side_logo',
        'label'       => esc_html__( 'Logo Side', 'agronix' ),
        'description' => esc_html__( 'Logo Side', 'agronix' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agronix_extra_text',
        'label'    => esc_html__( 'Sidebar Extra Desc', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Sidebar Extra Desc..', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agronix_extra_map_url',
        'label'    => esc_html__( 'Sidebar Map URL', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Type Map URL here', 'agronix' ),
        'priority' => 10,
    ];
    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_contact_title',
        'label'    => esc_html__( 'Contact Title', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Title', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_extra_address',
        'label'    => esc_html__( 'Office Address', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '123/A, Miranda City Likaoli Prikano, Dope United States', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_extra_phone',
        'label'    => esc_html__( 'Phone Number', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '+0989 7876 9865 9', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_extra_email',
        'label'    => esc_html__( 'Email ID', 'agronix' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'info@basictheme.net', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'repeater',
        'label'    => esc_html__( 'Gallery Repeater', 'agronix' ),
        'section'  => 'header_side_setting',
        'row_label'=> [
        'type'     => 'text',
        'value'    => esc_html__( 'Client', 'agronix' ),
    ],
        
    'button_label' => esc_html__('Add new Photo', 'agronix' ),
    'settings'     => 'clients_setting',
        'fields' => [
        'image_client' => [
            'type'         => 'image',
            'label'        => esc_html__( 'Gallery Image', 'agronix' ),
            'description'  => esc_attr__( 'Upload Gallery Image', 'agronix' ),
            ]
        ]
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {
    // Breadcrumb Setting

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_breadcrumb_shape_switch',
        'label'    => esc_html__( 'Shape Show/Hide', 'agronix' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'agronix' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'agronix' ),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/page-title/page-title.jpg',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'agronix' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'agronix' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'agronix' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'agronix' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'agronix' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'agronix' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
            'footer-style-3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'agronix' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'agronix' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'agronix' ),
            '3' => esc_html__( 'Widget Number 3', 'agronix' ),
            '2' => esc_html__( 'Widget Number 2', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_footer_menu_switch',
        'label'    => esc_html__( 'Footer Menu On/Off', 'agronix' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agronix_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'agronix' ),
        'description' => esc_html__( 'Footer Background Image.', 'agronix' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'agronix' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'agronix' ),
        'section'     => 'footer_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agronix_footer_logo',
        'label'       => esc_html__( 'Footer Logo', 'agronix' ),
        'description' => esc_html__( 'Footer Logo', 'agronix' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'agronix_footer_copyright_img',
        'label'       => esc_html__( 'Footer Copyright Image', 'agronix' ),
        'description' => esc_html__( 'Footer Copyright Image', 'agronix' ),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/img/service/payment.png',
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_copyright',
        'label'    => esc_html__( 'Copy Right', 'agronix' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2021 Theme_Pure. All Rights Reserved', 'agronix' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'footer_copyright_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function agronix_color_fields( $fields ) {
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_color_option',
        'label'       => __( 'Theme Color', 'agronix' ),
        'description' => esc_html__( 'This is a Theme color control.', 'agronix' ),
        'section'     => 'color_setting',
        'default'     => '#2b4eff',
        'priority'    => 10,
    ];
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_color_option_2',
        'label'       => __( 'Primary Color', 'agronix' ),
        'description' => esc_html__( 'This is a Primary color control.', 'agronix' ),
        'section'     => 'color_setting',
        'default'     => '#f2277e',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_color_option_3',
        'label'       => __( 'Secondary Color', 'agronix' ),
        'description' => esc_html__( 'This is a Secondary color control.', 'agronix' ),
        'section'     => 'color_setting',
        'default'     => '#30a820',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_color_option_3_2',
        'label'       => __( 'Secondary Color 2', 'agronix' ),
        'description' => esc_html__( 'This is a Secondary color 2 control.', 'agronix' ),
        'section'     => 'color_setting',
        'default'     => '#ffb352',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'agronix_color_scrollup',
        'label'       => __( 'ScrollUp Color', 'agronix' ),
        'description' => esc_html__( 'This is a ScrollUp colo control.', 'agronix' ),
        'section'     => 'color_setting',
        'default'     => '#2b4eff',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'agronix_color_fields' );

// 404
function agronix_404_fields( $fields ) {

    // 404 settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_error_404_text',
        'label'    => esc_html__( '404 Title', 'agronix' ),
        'section'  => '404_page',
        'default'  => esc_html__( '404', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_error_title',
        'label'    => esc_html__( 'Not Found Title', 'agronix' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'agronix_error_desc',
        'label'    => esc_html__( '404 Description Text', 'agronix' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'agronix' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'agronix' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'agronix' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'agronix_404_fields' );

// course_settings
function agronix_course_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'course_style',
        'label'       => esc_html__( 'Select Course Style', 'agronix' ),
        'section'     => 'course_settings',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'agronix' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'standard'   => get_template_directory_uri() . '/inc/img/course/course-1.jpg',
            'course_with_sidebar' => get_template_directory_uri() . '/inc/img/course/course-2.jpg',
            'course_solid'  => get_template_directory_uri() . '/inc/img/course/course-3.jpg',
        ],
        'default'     => 'standard',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_search_switch',
        'label'    => esc_html__( 'Show search?', 'agronix' ),
        'section'  => 'course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_latest_post_switch',
        'label'    => esc_html__( 'Show latest post?', 'agronix' ),
        'section'  => 'course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_category_switch',
        'label'    => esc_html__( 'Show category filter?', 'agronix' ),
        'section'  => 'course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_skill_switch',
        'label'    => esc_html__( 'Show skill filter?', 'agronix' ),
        'section'  => 'course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}

if ( class_exists( 'LearnPress' ) ) {
add_filter( 'kirki/fields', 'agronix_course_fields' );
}


// course_settings
function agronix_learndash_fields( $fields ) {

    $fields[] = [
        'type'     => 'number',
        'settings' => 'agronix_learndash_post_number',
        'label'    => esc_html__( 'Learndash Post Per page', 'agronix' ),
        'section'  => 'learndash_course_settings',
        'default'  => 6,
        'priority' => 10,
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'agronix_learndash_order',
        'label'       => esc_html__( 'Post Order', 'agronix' ),
        'section'     => 'learndash_course_settings',
        'default'     => 'DESC',
        'placeholder' => esc_html__( 'Select an option...', 'agronix' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'ASC' => esc_html__( 'ASC', 'agronix' ),
            'DESC' => esc_html__( 'DESC', 'agronix' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'agronix_learndash_related',
        'label'    => esc_html__( 'Show Related?', 'agronix' ),
        'section'  => 'learndash_course_settings',
        'default'  => 1,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'agronix' ),
            'off' => esc_html__( 'Disable', 'agronix' ),
        ],
    ];

    return $fields;

}

if ( class_exists( 'SFWD_LMS' ) ) {
add_filter( 'kirki/fields', 'agronix_learndash_fields' );
}

/**
 * Added Fields
 */
function agronix_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'agronix' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'agronix_typo_fields' );




/**
 * Added Fields
 */
function agronix_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_sv_slug',
        'label'    => esc_html__( 'Service Slug', 'agronix' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'oureservices', 'agronix' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'agronix_project_slug',
        'label'    => esc_html__( 'Project Slug', 'agronix' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourproject', 'agronix' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'agronix_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function AGRONIX_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'agronix' ) ) {
        $value = Kirki::get_option( agronix_get_theme(), $name );
    }

    return apply_filters( 'AGRONIX_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function agronix_get_theme() {
    return 'agronix';
}