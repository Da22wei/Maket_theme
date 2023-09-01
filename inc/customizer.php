<?php
/**
 * Grocery Supermarket Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Grocery Supermarket
 */

if ( ! defined( 'GROCERY_SUPERMARKET_URL' ) ) {
    define( 'GROCERY_SUPERMARKET_URL', esc_url( 'https://www.themagnifico.net/themes/supermarket-wordpress-theme/', 'grocery-supermarket') );
}
if ( ! defined( 'GROCERY_SUPERMARKET_TEXT' ) ) {
    define( 'GROCERY_SUPERMARKET_TEXT', __( 'Grocery Supermarket Pro','grocery-supermarket' ));
}
if ( ! defined( 'GROCERY_SUPERMARKET_BUY_TEXT' ) ) {
    define( 'GROCERY_SUPERMARKET_BUY_TEXT', __( 'Buy Grocery Supermarket Pro','grocery-supermarket' ));
}

use WPTRT\Customize\Section\Grocery_Supermarket_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Grocery_Supermarket_Button::class );

    $manager->add_section(
        new Grocery_Supermarket_Button( $manager, 'grocery_supermarket_pro', [
            'title'       => esc_html( GROCERY_SUPERMARKET_TEXT,'grocery-supermarket' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'grocery-supermarket' ),
            'button_url'  => esc_url( GROCERY_SUPERMARKET_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'grocery-supermarket-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'grocery-supermarket-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function grocery_supermarket_customize_register($wp_customize){

    // Pro Version
    class Grocery_Supermarket_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( GROCERY_SUPERMARKET_BUY_TEXT,'grocery-supermarket' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Grocery_Supermarket_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // General Settings
     $wp_customize->add_section('grocery_supermarket_general_settings',array(
        'title' => esc_html__('General Settings','grocery-supermarket'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('grocery_supermarket_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'grocery_supermarket_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'grocery_supermarket_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'grocery-supermarket' ),
        'section'        => 'grocery_supermarket_general_settings',
        'settings'       => 'grocery_supermarket_preloader_hide',
        'type'           => 'checkbox',
    )));

    //TopBar
    $wp_customize->add_section('grocery_supermarket_topbar',array(
        'title' => esc_html__('Topbar Option','grocery-supermarket')
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_about_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_about_button',array(
        'label' => esc_html__('Button Text 1','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_about_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_about_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_about_url',array(
        'label' => esc_html__('Button Url 1','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_about_url',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_wishlist_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_wishlist_button',array(
        'label' => esc_html__('Button Text 2','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_wishlist_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_wishlist_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_wishlist_url',array(
        'label' => esc_html__('Button Url 2','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_wishlist_url',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_order_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_order_button',array(
        'label' => esc_html__('Button Text 3','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_order_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_order_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_order_url',array(
        'label' => esc_html__('Button Url 3','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_order_url',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar_text',array(
        'label' => esc_html__('Topbar Text','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar1_wishlist_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar1_wishlist_button',array(
        'label' => esc_html__('Wishlist button','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar1_wishlist_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_topbar1_wishlist_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_topbar1_wishlist_url',array(
        'label' => esc_html__('Wishlist url','grocery-supermarket'),
        'section' => 'grocery_supermarket_topbar',
        'setting' => 'grocery_supermarket_topbar1_wishlist_url',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_topbar_setting', array(
        'sanitize_callback' => 'Grocery_Supermarket_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Grocery_Supermarket_Customize_Pro_Version ( $wp_customize,'pro_version_topbar_setting', array(
        'section'     => 'grocery_supermarket_topbar',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'grocery-supermarket' ),
        'description' => esc_url( GROCERY_SUPERMARKET_URL ),
        'priority'    => 100
    )));


    //Header
    $wp_customize->add_section('grocery_supermarket_header',array(
        'title' => esc_html__('Header Option','grocery-supermarket')
    ));

    $wp_customize->add_setting('grocery_supermarket_header_deals_button',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_header_deals_button',array(
        'label' => esc_html__('Button Text','grocery-supermarket'),
        'section' => 'grocery_supermarket_header',
        'setting' => 'grocery_supermarket_header_deals_button',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_header_deals_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_header_deals_url',array(
        'label' => esc_html__('Button Url','grocery-supermarket'),
        'section' => 'grocery_supermarket_header',
        'setting' => 'grocery_supermarket_header_deals_url',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('grocery_supermarket_header_phone_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_header_phone_number',array(
        'label' => esc_html__('Phone Number','grocery-supermarket'),
        'section' => 'grocery_supermarket_header',
        'setting' => 'grocery_supermarket_header_phone_number',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Grocery_Supermarket_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Grocery_Supermarket_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'grocery_supermarket_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'grocery-supermarket' ),
        'description' => esc_url( GROCERY_SUPERMARKET_URL ),
        'priority'    => 100
    )));

     //Slider
    $wp_customize->add_section('grocery_supermarket_top_slider',array(
        'title' => esc_html__('Slider Settings','grocery-supermarket'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1400 x 550 px','grocery-supermarket')
    ));

    for ( $grocery_supermarket_count = 1; $grocery_supermarket_count <= 3; $grocery_supermarket_count++ ) {

        $wp_customize->add_setting( 'grocery_supermarket_top_slider_page' . $grocery_supermarket_count, array(
            'default'           => '',
            'sanitize_callback' => 'grocery_supermarket_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'grocery_supermarket_top_slider_page' . $grocery_supermarket_count, array(
            'label'    => __( 'Select Slide Page', 'grocery-supermarket' ),
            'section'  => 'grocery_supermarket_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Grocery_Supermarket_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Grocery_Supermarket_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'grocery_supermarket_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'grocery-supermarket' ),
        'description' => esc_url( GROCERY_SUPERMARKET_URL ),
        'priority'    => 100
    )));

    // Best Sells Product
    $wp_customize->add_section('grocery_supermarket_best_sells',array(
        'title' => esc_html__('Best Sells Option','grocery-supermarket')
    ));

    $wp_customize->add_setting('grocery_supermarket_best_sells_section_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_best_sells_section_heading',array(
        'label' => __('Heading','grocery-supermarket'),
        'section' => 'grocery_supermarket_best_sells',
        'setting' => 'grocery_supermarket_best_sells_section_heading',
        'type'    => 'text'
    ));  

    $wp_customize->add_setting('grocery_supermarket_best_sells_section_sub_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_best_sells_section_sub_heading',array(
        'label' => __('Sub Heading','grocery-supermarket'),
        'section' => 'grocery_supermarket_best_sells',
        'setting' => 'grocery_supermarket_best_sells_section_sub_heading',
        'type'    => 'text'
    )); 

    $wp_customize->add_setting('grocery_supermarket_tab_number',array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('grocery_supermarket_tab_number',array(
        'label'   => __('Types of Kitchen to show','grocery-supermarket'),
        'section' => 'grocery_supermarket_best_sells',
        'setting' => 'grocery_supermarket_tab_number',
        'type'    => 'number'
    ));

    $increse =  get_theme_mod('grocery_supermarket_tab_number');


    for($i=1; $i<= $increse; $i++) {
    

        $wp_customize->add_setting('grocery_supermarket_slideproduct_tab1title'.$i,array(
          'default' => '',
          'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('grocery_supermarket_slideproduct_tab1title'.$i,array(
          'label' => __('Tab Heading','grocery-supermarket').$i,
          'section' => 'grocery_supermarket_best_sells',
          'setting' => 'grocery_supermarket_slideproduct_tab1title'.$i,
          'type'  => 'text'
        ));
        $args = array(
           'type'                     => 'product',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'term_group',
            'order'                    => 'ASC',
            'hide_empty'               => false,
            'hierarchical'             => 1,
            'number'                   => '',
            'taxonomy'                 => 'product_cat',
            'pad_counts'               => false
        );
      $categories = get_categories($args);
      $cat_posts = array();
      $m = 0;
      $cat_posts[]='Select';
      foreach($categories as $product){
        if($m==0){
          $default = $product->slug;
          $m++;
        }
        $cat_posts[$product->slug] = $product->name;
      }

      $wp_customize->add_setting('grocery_supermarket_cate_tab'.$i,array(
        'default' => 'select',
        'sanitize_callback' => 'grocery_supermarket_sanitize_choices',
      ));

      $wp_customize->add_control('grocery_supermarket_cate_tab'.$i,array(
        'type'    => 'select',
        'choices' => $cat_posts,
        'label' => __('Select category to display products ','grocery-supermarket').$i,
        'section' => 'grocery_supermarket_best_sells',
      ));
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_best_seller_setting', array(
        'sanitize_callback' => 'Grocery_Supermarket_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Grocery_Supermarket_Customize_Pro_Version ( $wp_customize,'pro_version_best_seller_setting', array(
        'section'     => 'grocery_supermarket_best_sells',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'grocery-supermarket' ),
        'description' => esc_url( GROCERY_SUPERMARKET_URL ),
        'priority'    => 100
    )));
    
    // Footer
    $wp_customize->add_section('grocery_supermarket_site_footer_section', array(
        'title' => esc_html__('Footer', 'grocery-supermarket'),
    ));

    $wp_customize->add_setting('grocery_supermarket_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('grocery_supermarket_footer_text_setting', array(
        'label' => __('Replace the footer text', 'grocery-supermarket'),
        'section' => 'grocery_supermarket_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Grocery_Supermarket_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Grocery_Supermarket_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'grocery_supermarket_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'grocery-supermarket' ),
        'description' => esc_url( GROCERY_SUPERMARKET_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'grocery_supermarket_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function grocery_supermarket_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function grocery_supermarket_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function grocery_supermarket_customize_preview_js(){
    wp_enqueue_script('grocery-supermarket-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'grocery_supermarket_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function grocery_supermarket_panels_js() {
    wp_enqueue_style( 'grocery-supermarket-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'grocery-supermarket-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'grocery_supermarket_panels_js' );