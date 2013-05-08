<?php

function shoestrap_register_builder_controls( $wp_customize ){
  // Determine if the user is using the advanced builder or not
  $advanced_builder = get_option('shoestrap_advanced_compiler');
  if ( is_multisite() && !is_super_admin() ) { $advanced_builder == ''; }

  $text_controls    = array();
  
  $text_controls[]  = array( 'setting' => 'strp_cb_sansfont',           'label' => __( 'Sans Font Family', 'shoestrap' ),              'section' => 'shoestrap_typography',  'priority' => 21 );
  $text_controls[]  = array( 'setting' => 'strp_cb_serifont',           'label' => __( 'Serif Font Family', 'shoestrap' ),             'section' => 'shoestrap_typography',  'priority' => 22 );
  $text_controls[]  = array( 'setting' => 'strp_cb_monofont',           'label' => __( 'Mono Font Family', 'shoestrap' ),              'section' => 'shoestrap_typography',  'priority' => 23 );
  $text_controls[]  = array( 'setting' => 'strp_cb_basefontsize',       'label' => __( 'Base Font Size', 'shoestrap' ),                'section' => 'shoestrap_typography',  'priority' => 24 );
  $text_controls[]  = array( 'setting' => 'strp_cb_baselineheight',     'label' => __( 'Base Line Height', 'shoestrap' ),              'section' => 'shoestrap_typography',  'priority' => 25 );
  $text_controls[]  = array( 'setting' => 'strp_cb_fontsizelarge',      'label' => __( 'Font Size Large', 'shoestrap' ),               'section' => 'shoestrap_typography',  'priority' => 26 );
  $text_controls[]  = array( 'setting' => 'strp_cb_fontsizesmall',      'label' => __( 'Font Size Small', 'shoestrap' ),               'section' => 'shoestrap_typography',  'priority' => 27 );
  $text_controls[]  = array( 'setting' => 'strp_cb_fontsizemini',       'label' => __( 'Font Size Mini', 'shoestrap' ),                'section' => 'shoestrap_typography',  'priority' => 28 );
  $text_controls[]  = array( 'setting' => 'strp_cb_baseborderradius',   'label' => __( 'Base Border Radius', 'shoestrap' ),            'section' => 'shoestrap_advanced',    'priority' => 29 );
  $text_controls[]  = array( 'setting' => 'strp_cb_gridwidth_normal',   'label' => __( 'Grid Width - Normal', 'shoestrap' ),           'section' => 'shoestrap_layout',      'priority' => 30 );
  $text_controls[]  = array( 'setting' => 'strp_cb_gridwidth_wide',     'label' => __( 'Grid Width - Wide', 'shoestrap' ),             'section' => 'shoestrap_layout',      'priority' => 31 );
  $text_controls[]  = array( 'setting' => 'strp_cb_gridwidth_narrow',   'label' => __( 'Grid Width - Narrow', 'shoestrap' ),           'section' => 'shoestrap_layout',      'priority' => 32 );
  $text_controls[]  = array( 'setting' => 'strp_cb_gridgutter_normal',  'label' => __( 'Grid Gutter - Normal & Narrow', 'shoestrap' ), 'section' => 'shoestrap_layout',      'priority' => 33 );
  $text_controls[]  = array( 'setting' => 'strp_cb_gridgutter_wide',    'label' => __( 'Grid Gutter - Wide', 'shoestrap' ),            'section' => 'shoestrap_layout',      'priority' => 34 );

  foreach ( $text_controls as $control) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => $control['label'],
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'text',
      'priority'    => $control['priority']
    ));
  }
}
add_action( 'customize_register', 'shoestrap_register_builder_controls' );
