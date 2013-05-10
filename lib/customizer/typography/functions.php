<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function shoestrap_typography_customizer( $wp_customize ){

  $sections   = array();
  $sections[] = array( 'slug' => 'shoestrap_typography',        'title' => __( 'Typography', 'shoestrap' ),       'priority' => 7 );

  foreach( $sections as $section ){
    $wp_customize->add_section( $section['slug'], array( 'title' => $section['title'], 'priority' => $section['priority'] ) );
  }

  $settings   = array();

  // Color Settings
  $settings[] = array( 'slug' => 'shoestrap_text_color',                'default' => '#333333' );
  $settings[] = array( 'slug' => 'shoestrap_link_color',                'default' => '#0088cc' );
  $settings[] = array( 'slug' => 'shoestrap_google_webfonts',           'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_webfonts_weight',           'default' => '400' );
  $settings[] = array( 'slug' => 'shoestrap_webfonts_character_set',    'default' => 'latin' );
  $settings[] = array( 'slug' => 'shoestrap_webfonts_assign',           'default' => 'all' );

  foreach( $settings as $setting ){
    $wp_customize->add_setting( $setting['slug'], array(
        'default' => $setting['default'],
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage'
      ) );
  }

  // Color Controls
  $color_controls   = array();
  $color_controls[] = array( 'setting' => 'shoestrap_text_color',             'label' => __( 'Text Color', 'shoestrap' ),              'section' => 'shoestrap_typography',  'priority' => 1 );
  $color_controls[] = array( 'setting' => 'shoestrap_link_color',             'label' => __( 'Links Color', 'shoestrap' ),             'section' => 'shoestrap_typography',  'priority' => 2 );

  // Dropdown (Select) Controls
  $select_controls = array();
  $select_controls[] = array( 'setting' => 'shoestrap_webfonts_weight',         'label' => __( 'Webfont weight:', 'shoestrap' ),         'section' => 'shoestrap_typography',  'priority' => 4, 'choises' => array( '200' => __( '200', 'shoestrap' ), '300' => __( '300', 'shoestrap' ), '400' => __( '400', 'shoestrap' ), '600' => __( '600', 'shoestrap' ), '700' => __( '700', 'shoestrap' ), '800' => __( '800', 'shoestrap' ), '900' => __( '900', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'shoestrap_webfonts_character_set',  'label' => __( 'Webfont character set:', 'shoestrap' ),  'section' => 'shoestrap_typography',  'priority' => 5, 'choises' => array( 'cyrillic' => __( 'Cyrillic', 'shoestrap' ), 'cyrillic-ext' => __( 'Cyrillic Extended', 'shoestrap' ), 'greek' => __( 'Greek', 'shoestrap' ), 'greek-ext' => __( 'Greek Extended', 'shoestrap' ), 'latin' => __( 'Latin', 'shoestrap' ), 'latin-ext' => __( 'Latin Extended', 'shoestrap' ), 'vietnamese' => __( 'Vietnamese', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'shoestrap_webfonts_assign',         'label' => __( 'Apply Webfont to:', 'shoestrap' ),       'section' => 'shoestrap_typography',  'priority' => 6, 'choises' => array( 'sitename' => __( 'Site Name', 'shoestrap' ), 'headers' => __( 'Headers', 'shoestrap' ), 'all' => __( 'Everywhere', 'shoestrap' ) ) );

  foreach( $color_controls as $control ){
    $wp_customize->add_control( new WP_Customize_Color_Control(
      $wp_customize,
      $control['setting'],
      array(
        'label'     => $control['label'],
        'section'   => $control['section'],
        'settings'  => $control['setting'],
        'priority'  => $control['priority'],
      )
    ));
  }

  foreach ( $select_controls as $control ) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => $control['label'],
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'select',
      'priority'    => $control['priority'],
      'choices'     => $control['choises']
    ));
  }

  // Content of the Google Font
  $wp_customize->add_control( new Shoestrap_Google_WebFont_Control( $wp_customize, 'shoestrap_google_webfont', array(
    'label'       => 'Google Webfont',
    'section'     => 'shoestrap_typography',
    'settings'    => 'shoestrap_google_webfonts',
    'priority'    => 3,
  )));

  //if ( $wp_customize->is_preview() && ! is_admin() )
    //add_action( 'wp_footer', 'shoestrap_customizer_typography_preview', 21 );
}
add_action( 'customize_register', 'shoestrap_typography_customizer' );



/**
 * Used by shoestrap_typography_customizer
 *
 * Adds extra javascript actions to the theme customizer editor
 */
function shoestrap_customizer_typography_controls()
{
  wp_register_script('theme_customizer', get_template_directory_uri() . '/lib/customizer/typography/scripts-customizer.js', false, null, true);
  wp_enqueue_script('theme_customizer');
}
add_action( 'customize_controls_init', 'shoestrap_customizer_typography_controls' );


/**
 * Used by shoestrap_typography_customizer
 *
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shoestrap_customizer_typography_preview()
{
  wp_register_script('theme_customizer', get_template_directory_uri() . '/lib/customizer/typography/scripts-preview.js', false, null, true);
  wp_enqueue_script('theme_customizer');
}
add_action( 'customize_preview_init', 'shoestrap_customizer_typography_preview' );
