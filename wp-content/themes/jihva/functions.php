<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Overwrite parent theme background defaults and registers support for WordPress features.
add_action( 'after_setup_theme', 'lalita_background_setup' );
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => '222422',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'auto',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		)
	);
}

// Overwrite theme URL
function lalita_theme_uri_link() {
	return 'https://wpkoi.com/jihva-wpkoi-wordpress-theme/';
}

// Overwrite parent theme's blog header function
add_action( 'lalita_after_header', 'lalita_blog_header_image', 11 );
function lalita_blog_header_image() {

	if ( ( is_front_page() && is_home() ) || ( is_home() ) ) { 
		$blog_header_image 			=  lalita_get_setting( 'blog_header_image' ); 
		$blog_header_title 			=  lalita_get_setting( 'blog_header_title' ); 
		$blog_header_text 			=  lalita_get_setting( 'blog_header_text' ); 
		$blog_header_button_text 	=  lalita_get_setting( 'blog_header_button_text' ); 
		$blog_header_button_url 	=  lalita_get_setting( 'blog_header_button_url' ); 
		if ( $blog_header_image != '' ) { ?>
		<div class="page-header-image grid-parent page-header-blog" style="background-image: url('<?php echo esc_url($blog_header_image); ?>') !important;">
        	<div class="page-header-noiseoverlay"></div>
        	<div class="page-header-blog-inner">
                <div class="page-header-blog-content-h grid-container">
                    <div class="page-header-blog-content">
                    <?php if ( $blog_header_title != '' ) { ?>
                        <div class="page-header-blog-text">
                            <?php if ( $blog_header_title != '' ) { ?>
                            <h2><?php echo wp_kses_post( $blog_header_title ); ?></h2>
                            <div class="clearfix"></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="page-header-blog-content page-header-blog-content-b">
                	<?php if ( $blog_header_text != '' ) { ?>
                	<div class="page-header-blog-text">
						<?php if ( $blog_header_title != '' ) { ?>
                        <p><?php echo wp_kses_post( $blog_header_text ); ?></p>
                        <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="page-header-blog-button">
                        <?php if ( $blog_header_button_text != '' ) { ?>
                        <a class="read-more button" href="<?php echo esc_url( $blog_header_button_url ); ?>"><?php echo esc_html( $blog_header_button_text ); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
		<?php
		}
	}
}

// Extra cutomizer functions
if ( ! function_exists( 'jihva_customize_register' ) ) {
	add_action( 'customize_register', 'jihva_customize_register' );
	function jihva_customize_register( $wp_customize ) {
				
		// Add Jihva customizer section
		$wp_customize->add_section(
			'jihva_layout_effects',
			array(
				'title' => __( 'Jihva Effects', 'jihva' ),
				'priority' => 24,
			)
		);
		
		// Blog image effect
		$wp_customize->add_setting(
			'jihva_settings[img_effect]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'jihva_settings[img_effect]',
			array(
				'type' => 'select',
				'label' => __( 'Blog image effect', 'jihva' ),
				'choices' => array(
					'enable' => __( 'Enable', 'jihva' ),
					'disable' => __( 'Disable', 'jihva' )
				),
				'settings' => 'jihva_settings[img_effect]',
				'section' => 'jihva_layout_effects',
				'priority' => 10
			)
		);
		
		// Header border
		$wp_customize->add_setting(
			'jihva_settings[header_border]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'jihva_settings[header_border]',
			array(
				'type' => 'select',
				'label' => __( 'Header border', 'jihva' ),
				'choices' => array(
					'enable' => __( 'Enable', 'jihva' ),
					'disable' => __( 'Disable', 'jihva' )
				),
				'settings' => 'jihva_settings[header_border]',
				'section' => 'jihva_layout_effects',
				'priority' => 20
			)
		);
		
		// Unique scrollbar
		$wp_customize->add_setting(
			'jihva_settings[unique_scrollbar]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'jihva_settings[unique_scrollbar]',
			array(
				'type' => 'select',
				'label' => __( 'Unique scrollbar', 'jihva' ),
				'choices' => array(
					'enable' => __( 'Enable', 'jihva' ),
					'disable' => __( 'Disable', 'jihva' )
				),
				'settings' => 'jihva_settings[unique_scrollbar]',
				'section' => 'jihva_layout_effects',
				'priority' => 30
			)
		);
		
		// Type effect
		$wp_customize->add_setting(
			'jihva_settings[type_effect]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'jihva_settings[type_effect]',
			array(
				'type' => 'select',
				'label' => __( 'Type effect', 'jihva' ),
				'choices' => array(
					'enable' => __( 'Enable', 'jihva' ),
					'disable' => __( 'Disable', 'jihva' )
				),
				'settings' => 'jihva_settings[type_effect]',
				'section' => 'jihva_layout_effects',
				'priority' => 40
			)
		);
		
		// Jihva effect colors
		$wp_customize->add_setting(
			'jihva_settings[jihva_color_1]', array(
				'default' => '#757155',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'jihva_settings[jihva_color_1]',
				array(
					'label' => __( 'Effect color', 'jihva' ),
					'section' => 'jihva_layout_effects',
					'settings' => 'jihva_settings[jihva_color_1]',
					'priority' => 45
				)
			)
		);
		
		$wp_customize->add_setting(
			'jihva_settings[jihva_color_2]', array(
				'default' => '#ffffff',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'jihva_settings[jihva_color_2]',
				array(
					'label' => __( 'Effect color 2', 'jihva' ),
					'section' => 'jihva_layout_effects',
					'settings' => 'jihva_settings[jihva_color_2]',
					'priority' => 46
				)
			)
		);
		
		$wp_customize->add_setting(
			'jihva_settings[jihva_color_3]', array(
				'default' => '#222422',
				'type' => 'option',
				'sanitize_callback' => 'jihva_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'jihva_settings[jihva_color_3]',
				array(
					'label' => __( 'Effect color 3', 'jihva' ),
					'section' => 'jihva_layout_effects',
					'settings' => 'jihva_settings[jihva_color_3]',
					'priority' => 47
				)
			)
		);
	}
}

//Sanitize choices.
if ( ! function_exists( 'jihva_sanitize_choices' ) ) {
	function jihva_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

// Sanitize colors. Allow blank value.
if ( ! function_exists( 'jihva_sanitize_hex_color' ) ) {
	function jihva_sanitize_hex_color( $color ) {
	    if ( '' === $color ) {
	        return '';
		}

	    // 3 or 6 hex digits, or the empty string.
	    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
	        return $color;
		}

	    return '';
	}
}

// Jihva effects colors css
if ( ! function_exists( 'jihva_effect_colors_css' ) ) {
	function jihva_effect_colors_css() {
		// Get Customizer settings
		$jihva_settings = get_option( 'jihva_settings' );
		
		$jihva_color_1  	 = '#757155';
		$jihva_color_2  	 = '#ffffff';
		$jihva_color_3  	 = '#222422';
		if ( isset( $jihva_settings['jihva_color_1'] ) ) {
			$jihva_color_1 = $jihva_settings['jihva_color_1'];
		}
		if ( isset( $jihva_settings['jihva_color_2'] ) ) {
			$jihva_color_2 = $jihva_settings['jihva_color_2'];
		}
		if ( isset( $jihva_settings['jihva_color_3'] ) ) {
			$jihva_color_3 = $jihva_settings['jihva_color_3'];
		}
		
		$lalita_settings = wp_parse_args(
			get_option( 'lalita_settings', array() ),
			lalita_get_color_defaults()
		);
		
		$jihva_extracolors = '.jihva-unique-scrollbar::-webkit-scrollbar-track {background: ' . esc_attr( $jihva_color_3 ) . ';}.jihva-unique-scrollbar::-webkit-scrollbar-thumb {background: ' . esc_attr( $jihva_color_1 ) . ';border-color: ' . esc_attr( $jihva_color_3 ) . ';}.jihva-unique-scrollbar::-webkit-scrollbar-thumb:hover {background: ' . esc_attr( $jihva_color_2 ) . ';}.jihva-header-border .header-content-h {border-color: ' . esc_attr( $jihva_color_1 ) . '}';
		
		return $jihva_extracolors;
	}
}

// The dynamic styles of the parent theme added inline to the parent stylesheet.
// For the customizer functions it is better to enqueue after the child theme stylesheet.
if ( ! function_exists( 'jihva_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'jihva_remove_parent_dynamic_css' );
	function jihva_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

// Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
if ( ! function_exists( 'jihva_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'jihva_enqueue_parent_dynamic_css', 50 );
	function jihva_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css() .jihva_effect_colors_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

//Adds custom classes to the array of body classes.
if ( ! function_exists( 'jihva_body_classes' ) ) {
	add_filter( 'body_class', 'jihva_body_classes' );
	function jihva_body_classes( $classes ) {
		// Get Customizer settings
		$jihva_settings = get_option( 'jihva_settings' );
		
		$img_effect 	  = 'enable';
		$type_effect  	  = 'enable';
		$header_border  = 'enable';
		$unique_scrollbar     = 'enable';
		
		if ( isset( $jihva_settings['img_effect'] ) ) {
			$img_effect = $jihva_settings['img_effect'];
		}
		
		if ( isset( $jihva_settings['type_effect'] ) ) {
			$type_effect = $jihva_settings['type_effect'];
		}
		
		if ( isset( $jihva_settings['header_border'] ) ) {
			$header_border = $jihva_settings['header_border'];
		}
		
		if ( isset( $jihva_settings['unique_scrollbar'] ) ) {
			$unique_scrollbar = $jihva_settings['unique_scrollbar'];
		}
		
		// Blog image effect
		if ( $img_effect != 'disable' ) {
			$classes[] = 'jihva-img-effect';
		}
		
		// Type effect
		if ( $type_effect != 'disable' ) {
			$classes[] = 'jihva-type-effect';
		}
		
		// Header border
		if ( $header_border != 'disable' ) {
			$classes[] = 'jihva-header-border';
		}
		
		// Unique scrollbar
		if ( $unique_scrollbar != 'disable' ) {
			$classes[] = 'jihva-unique-scrollbar';
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'jihva_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'jihva_scripts' );
	/**
	 * Enqueue script
	 */
	function jihva_scripts() {
		
		$jihva_settings = get_option( 'jihva_settings' );
		
		$type_effect		 = 'enable';
		if ( isset( $jihva_settings['type_effect'] ) ) {
			$type_effect = $jihva_settings['type_effect'];
		}
		
		if ( $type_effect != 'disable' ) {
			wp_enqueue_script( 'jihva-t', esc_url( get_stylesheet_directory_uri() ) . "/js/t.min.js", array( 'jquery'), LALITA_VERSION, true );
		}

	}
}
