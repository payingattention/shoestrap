<?php

function shoestrap_customizer_settings( $wp_customize ) {
  // Background Color hack
  $background_color = get_theme_mod( 'background_color' );
  $background_color = '#' . str_replace( '#', '', $background_color );
  set_theme_mod( 'background_color', get_theme_mod( 'color_body_bg' ) );

  $settings   = array();
  $settings[] = array( 'slug' => 'advanced_head',               'default' => '' );
  $settings[] = array( 'slug' => 'advanced_footer',             'default' => '' );

  $settings[] = array( 'slug' => 'color_body_bg',               'default' => '#ffffff' );
  $settings[] = array( 'slug' => 'color_brand_primary',         'default' => '#428bca' );
  $settings[] = array( 'slug' => 'color_brand_success',         'default' => '#5cb85c' );
  $settings[] = array( 'slug' => 'color_brand_warning',         'default' => '#f0ad4e' );
  $settings[] = array( 'slug' => 'color_brand_danger',          'default' => '#d9534f' );
  $settings[] = array( 'slug' => 'color_brand_info',            'default' => '#5bc0de' );
  $settings[] = array( 'slug' => 'color_text',                  'default' => '#333333' );
  $settings[] = array( 'slug' => 'color_links',                 'default' => '#428bca' );

  $settings[] = array( 'slug' => 'layout_layout',               'default' => 'mp' );
  $settings[] = array( 'slug' => 'layout_primary_width',        'default' => '4' );
  $settings[] = array( 'slug' => 'layout_secondary_width',      'default' => '3' );
  $settings[] = array( 'slug' => 'layout_sidebar_on_front',     'default' => 'hide' );
  $settings[] = array( 'slug' => 'layout_fluid',                'default' => '0' );
  $settings[] = array( 'slug' => 'layout_screen_tiny',          'default' => 480 );
  $settings[] = array( 'slug' => 'layout_screen_small',         'default' => 768 );
  $settings[] = array( 'slug' => 'layout_screen_medium',        'default' => 992 );
  $settings[] = array( 'slug' => 'layout_screen_large',         'default' => 1200 );
  $settings[] = array( 'slug' => 'layout_gutter',               'default' => 30 );

  $settings[] = array( 'slug' => 'feat_img_archive',            'default' => '1' );
  $settings[] = array( 'slug' => 'feat_img_post',               'default' => '1' );
  $settings[] = array( 'slug' => 'feat_img_archive_width',      'default' => 550 );
  $settings[] = array( 'slug' => 'feat_img_archive_height',     'default' => 330 );
  $settings[] = array( 'slug' => 'feat_img_post_width',         'default' => 550 );
  $settings[] = array( 'slug' => 'feat_img_post_height',        'default' => 330 );

  $settings[] = array( 'slug' => 'footer_bg',                   'default' => '' );
  $settings[] = array( 'slug' => 'footer_text',                 'default' => get_bloginfo( 'name' ) );
  $settings[] = array( 'slug' => 'footer_color',                'default' => '' );
  
  $settings[] = array( 'slug' => 'general_flat',                'default' => '' );
  $settings[] = array( 'slug' => 'general_border_radius',       'default' => '4' );

  $settings[] = array( 'slug' => 'jumbotron_bg_img',            'default' => '' );
  $settings[] = array( 'slug' => 'jumbotron_bg',                'default' => '#EEEEEE' );
  $settings[] = array( 'slug' => 'jumbotron_color',             'default' => '#333333' );
  $settings[] = array( 'slug' => 'jumbotron_visibility',        'default' => 'front' );
  $settings[] = array( 'slug' => 'jumbotron_title_fit',         'default' => '' );
  $settings[] = array( 'slug' => 'jumbotron_center',            'default' => '' );

  $settings[] = array( 'slug' => 'logo',                        'default' => '' );

  $settings[] = array( 'slug' => 'navbar_toggle',               'default' => '1' );
  $settings[] = array( 'slug' => 'navbar_brand',                'default' => '1' );
  $settings[] = array( 'slug' => 'navbar_logo',                 'default' => '1' );
  $settings[] = array( 'slug' => 'navbar_bg',                   'default' => '#EEEEEE' );
  $settings[] = array( 'slug' => 'navbar_color',                'default' => '#777777' );
  $settings[] = array( 'slug' => 'navbar_social',               'default' => '1' );
  $settings[] = array( 'slug' => 'navbar_search',               'default' => '' );
  $settings[] = array( 'slug' => 'navbar_nav_right',            'default' => '' );
  $settings[] = array( 'slug' => 'navbar_position',             'default' => '' );
  $settings[] = array( 'slug' => 'navbar_usermenu',             'default' => '' );
  $settings[] = array( 'slug' => 'navbar_altmenu',              'default' => '' );
  $settings[] = array( 'slug' => 'navbar_height',               'default' => '' );

  $settings[] = array( 'slug' => 'typography_google_webfont',   'default' => 'Open Sans' );
  $settings[] = array( 'slug' => 'typography_webfont_weight',   'default' => '400' );
  $settings[] = array( 'slug' => 'typography_webfont',          'default' => 'latin' );
  $settings[] = array( 'slug' => 'typography_webfont_assign',   'default' => 'all' );
  $settings[] = array( 'slug' => 'typography_sans_serif',       'default' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
  $settings[] = array( 'slug' => 'typography_serif',            'default' => 'Georgia, "Times New Roman", Times, serif' );
  $settings[] = array( 'slug' => 'typography_font_size_base',   'default' => '14' );
  $settings[] = array( 'slug' => 'typography_headings',         'default' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );

  foreach( $settings as $setting ){
    $wp_customize -> add_setting( $setting[ 'slug' ],
      array( 
        'default'     => $setting[ 'default' ],
        'type'        => 'theme_mod',
        'capability'  => 'edit_theme_options'
      ) );
  }
}
add_action( 'customize_register', 'shoestrap_customizer_settings' );
