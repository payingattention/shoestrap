<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function shoestrap_presets_customizer( $wp_customize ){

  $sections   = array();
  $sections[] = array( 'slug' => 'shoestrap_presets', 'title' => __( 'Templates/Presets', 'shoestrap' ), 'priority' => -61 );

  foreach( $sections as $section ){
    $wp_customize->add_section( $section['slug'], array( 'title' => $section['title'], 'priority' => $section['priority'] ) );
  }

  $settings   = array();
  $settings[] = array( 'slug' => 'shoestrap_facebook_link',             'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_twitter_link',              'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_google_plus_link',          'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_pinterest_link',            'default' => '' );

  $settings[] = array( 'slug' => 'shoestrap_facebook_on_posts',         'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_twitter_on_posts',          'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_gplus_on_posts',            'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_linkedin_on_posts',         'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_pinterest_on_posts',        'default' => '' );
  $settings[] = array( 'slug' => 'shoestrap_digg_on_posts',             'default' => '' );

  $settings[] = array( 'slug' => 'shoestrap_single_social_text',        'default' => 'Share' );
  $settings[] = array( 'slug' => 'shoestrap_preset_preview',    'default' => 'none' );

  foreach( $settings as $setting ){
    $wp_customize->add_setting( $setting['slug'], array( 'default' => $setting['default'], 'type' => 'theme_mod', 'capability' => 'edit_theme_options' ) );
  }


  $select_controls = array();
  $select_controls[] = array( 'setting' => 'shoestrap_preset_preview',  'label' => 'Select a preset to preview',           'section' => 'shoestrap_presets',  'priority' => 10,'choises' => array( '' => __( '', 'shoestrap' ), 'top' => __( 'Top', 'shoestrap' ), 'bottom' => __( 'Bottom', 'shoestrap' ), 'both' => __( 'Both', 'shoestrap' ) ) );


  foreach ( $select_controls as $control ) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => __( $control['label'], 'shoestrap' ),
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'select',
      'priority'    => $control['priority'],
      'choices'     => $control['choises']
    ));
  }

}
add_action( 'customize_register', 'shoestrap_presets_customizer' );

