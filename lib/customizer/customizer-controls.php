<?php

function shoestrap_customizer_controls( $wp_customize ) {
  // Remove the default "background" control
  $wp_customize->remove_control( 'background_color' );
  $wp_customize->remove_control( 'header_textcolor');
  
  $color_controls   = array();
  $color_controls[] = array( 'setting' => 'color_body_bg',        'label' => __( 'Background Color', 'shoestrap' ),             'section' => 'colors',    'priority' => 1 );
  $color_controls[] = array( 'setting' => 'color_brand_primary',  'label' => __( '"Primary" Color', 'shoestrap' ),              'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_brand_success',  'label' => __( '"Success" Color', 'shoestrap' ),              'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_brand_warning',  'label' => __( '"Warning" Color', 'shoestrap' ),              'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_brand_danger',   'label' => __( '"Danger" Color', 'shoestrap' ),               'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_brand_info',     'label' => __( '"Info" Color', 'shoestrap' ),                 'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_text',           'label' => __( 'Text Color', 'shoestrap' ),                   'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'color_links',          'label' => __( 'Links Color', 'shoestrap' ),                  'section' => 'colors',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'footer_bg',            'label' => __( 'Footer Background Color', 'shoestrap' ),      'section' => 'footer',    'priority' => 1 );
  $color_controls[] = array( 'setting' => 'footer_color',         'label' => __( 'Footer Text Color', 'shoestrap' ),            'section' => 'footer',    'priority' => 2 );
  $color_controls[] = array( 'setting' => 'jumbotron_bg',         'label' => __( 'Hero Region Background Color', 'shoestrap' ), 'section' => 'jumbotron', 'priority' => 7 );
  $color_controls[] = array( 'setting' => 'jumbotron_color',      'label' => __( 'Hero Region Text Color', 'shoestrap' ),       'section' => 'jumbotron', 'priority' => 8 );
  $color_controls[] = array( 'setting' => 'navbar_bg',            'label' => __( 'Navbar Color', 'shoestrap' ),                 'section' => 'navbar',    'priority' => 5 );
  $color_controls[] = array( 'setting' => 'navbar_color',         'label' => __( 'Navbar Text Color', 'shoestrap' ),            'section' => 'navbar',    'priority' => 40 );
  
   // Checkbox Controls
  $checkbox_controls   = array();
  $checkbox_controls[] = array( 'setting' => 'feat_img_archive',      'label' => __( 'Show featured images on archives', 'shoestrap' ),       'section' => 'featured_image',  'priority' => 1 );
  $checkbox_controls[] = array( 'setting' => 'feat_img_post',         'label' => __( 'Show featured images on single posts', 'shoestrap' ),   'section' => 'featured_image',  'priority' => 2 );
  $checkbox_controls[] = array( 'setting' => 'general_flat',          'label' => __( 'No Gradients - Flat look', 'shoestrap' ),               'section' => 'general',         'priority' => 1 );
  $checkbox_controls[] = array( 'setting' => 'jumbotron_title_fit',   'label' => __( 'Use FitText for the Title', 'shoestrap' ),              'section' => 'jumbotron',       'priority' => 2 );
  $checkbox_controls[] = array( 'setting' => 'jumbotron_center',      'label' => __( 'Center the content', 'shoestrap' ),                     'section' => 'jumbotron',       'priority' => 10 );
  $checkbox_controls[] = array( 'setting' => 'navbar_toggle',         'label' => __( 'Display NavBar on the top of the page', 'shoestrap' ),  'section' => 'navbar',          'priority' => 1 );
  $checkbox_controls[] = array( 'setting' => 'navbar_brand',          'label' => __( 'Display Branding (Sitename or Logo)', 'shoestrap' ),    'section' => 'navbar',          'priority' => 2 );
  $checkbox_controls[] = array( 'setting' => 'navbar_logo',           'label' => __( 'Use Logo (if available) for branding', 'shoestrap' ),   'section' => 'navbar',          'priority' => 3 );
  $checkbox_controls[] = array( 'setting' => 'navbar_social',         'label' => __( 'Display Social Links in the Navbar', 'shoestrap' ),     'section' => 'navbar',          'priority' => 6 );
  $checkbox_controls[] = array( 'setting' => 'navbar_search',         'label' => __( 'Display Search', 'shoestrap' ),                         'section' => 'navbar',          'priority' => 7 );
  $checkbox_controls[] = array( 'setting' => 'navbar_nav_right',      'label' => __( 'Menu on the Right', 'shoestrap' ),                      'section' => 'navbar',          'priority' => 15 );
  $checkbox_controls[] = array( 'setting' => 'navbar_usermenu',       'label' => __( 'Show Login/Logout Link', 'shoestrap' ),                 'section' => 'navbar',          'priority' => 5 );
  $checkbox_controls[] = array( 'setting' => 'navbar_altmenu',        'label' => __( '"Alternative" Menu styling', 'shoestrap' ),             'section' => 'navbar',          'priority' => 37 );
  $checkbox_controls[] = array( 'setting' => 'layout_fluid',          'label' => __( 'Fluid Layout', 'shoestrap' ),                           'section' => 'layout',          'priority' => 7 );

  // Text Controls
  $text_controls   = array();
  $text_controls[] = array( 'setting' => 'general_border_radius',     'label' => __( 'Border Radius (px)', 'shoestrap' ),           'section' => 'general',         'priority' => 3 );
  $text_controls[] = array( 'setting' => 'feat_img_archive_width',    'label' => __( 'Image width (archives)', 'shoestrap' ),       'section' => 'featured_image',  'priority' => 4 );
  $text_controls[] = array( 'setting' => 'feat_img_archive_height',   'label' => __( 'Image height (archives)', 'shoestrap' ),      'section' => 'featured_image',  'priority' => 5 );
  $text_controls[] = array( 'setting' => 'feat_img_post_width',       'label' => __( 'Image width (single posts)', 'shoestrap' ),   'section' => 'featured_image',  'priority' => 7 );
  $text_controls[] = array( 'setting' => 'feat_img_post_height',      'label' => __( 'Image height (single posts)', 'shoestrap' ),  'section' => 'featured_image',  'priority' => 8 );
  $text_controls[] = array( 'setting' => 'footer_text',               'label' => __( 'Footer Text', 'shoestrap' ),                  'section' => 'footer',          'priority' => 3 );
  $text_controls[] = array( 'setting' => 'navbar_height',             'label' => __( 'Navbar Height (px)', 'shoestrap' ),           'section' => 'navbar',          'priority' => 40 );
  $text_controls[] = array( 'setting' => 'typography_sans_serif',     'label' => __( 'Sans Serif Font Family', 'shoestrap' ),       'section' => 'typography',      'priority' => 3 );
  $text_controls[] = array( 'setting' => 'typography_serif',          'label' => __( 'Serif Font Family', 'shoestrap' ),            'section' => 'typography',      'priority' => 3 );
  $text_controls[] = array( 'setting' => 'typography_headings',       'label' => __( 'Headings Font Family', 'shoestrap' ),         'section' => 'typography',      'priority' => 3 );
  $text_controls[] = array( 'setting' => 'typography_font_size_base', 'label' => __( 'Sans Serif Font Family', 'shoestrap' ),       'section' => 'typography',      'priority' => 3 );
  $text_controls[] = array( 'setting' => 'layout_screen_tiny',        'label' => __( 'Tiny Screen Size (px)', 'shoestrap' ),        'section' => 'layout',          'priority' => 3 );
  $text_controls[] = array( 'setting' => 'layout_screen_small',       'label' => __( 'Small Screen Size (px)', 'shoestrap' ),       'section' => 'layout',          'priority' => 3 );
  $text_controls[] = array( 'setting' => 'layout_screen_medium',      'label' => __( 'Medium Screen Size (px)', 'shoestrap' ),      'section' => 'layout',          'priority' => 3 );
  $text_controls[] = array( 'setting' => 'layout_screen_large',       'label' => __( 'Large Screen Size (px)', 'shoestrap' ),       'section' => 'layout',          'priority' => 3 );
  $text_controls[] = array( 'setting' => 'layout_gutter',             'label' => __( 'Gutter', 'shoestrap' ),                       'section' => 'layout',          'priority' => 3 );
  
  // Dropdown (Select) Controls
  $select_controls   = array();
  $select_controls[] = array( 'setting' => 'jumbotron_visibility',      'label' => __( 'Hero Region Visibility', 'shoestrap' ), 'section' => 'jumbotron',   'priority' => 9,  'choises' => array( 'front' => __( 'Frontpage', 'shoestrap' ), 'site' => __( 'Site-Wide', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'navbar_position',           'label' => __( 'NavBar Positioning', 'shoestrap' ),     'section' => 'navbar',      'priority' => 32, 'choises' => array( 0 => __( 'Normal', 'shoestrap' ), 1 => __( 'Fixed to Top', 'shoestrap' ), 2 => __( 'Fixed to Bottom', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'typography_webfont_weight', 'label' => __( 'Webfont weight:', 'shoestrap' ),        'section' => 'typography',  'priority' => 4,  'choises' => array( '200' => __( '200', 'shoestrap' ), '300' => __( '300', 'shoestrap' ), '400' => __( '400', 'shoestrap' ), '600' => __( '600', 'shoestrap' ), '700' => __( '700', 'shoestrap' ), '800' => __( '800', 'shoestrap' ), '900' => __( '900', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'typography_webfont',        'label' => __( 'Webfont character set:', 'shoestrap' ), 'section' => 'typography',  'priority' => 5,  'choises' => array( 'cyrillic' => __( 'Cyrillic', 'shoestrap' ), 'cyrillic-ext' => __( 'Cyrillic Extended', 'shoestrap' ), 'greek' => __( 'Greek', 'shoestrap' ), 'greek-ext' => __( 'Greek Extended', 'shoestrap' ), 'latin' => __( 'Latin', 'shoestrap' ), 'latin-ext' => __( 'Latin Extended', 'shoestrap' ), 'vietnamese' => __( 'Vietnamese', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'typography_webfont_assign', 'label' => __( 'Apply Webfont to:', 'shoestrap' ),      'section' => 'typography',  'priority' => 6,  'choises' => array( 'sitename' => __( 'Site Name', 'shoestrap' ), 'headers' => __( 'Headers', 'shoestrap' ), 'all' => __( 'Everywhere', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'layout_layout',             'label' => __( 'Layout', 'shoestrap' ),                          'section' => 'layout',  'priority' => 2, 'choises' => array( 'm' => __( 'Main only', 'shoestrap' ), 'mp' => __( 'Main-Primary', 'shoestrap' ), 'pm' => __( 'Primary-Main', 'shoestrap' ), 'ms' => __( 'Main-Secondary', 'shoestrap' ), 'sm' => __( 'Secondary-Main', 'shoestrap' ), 'mps' => __( 'Main-Primary-Secondary', 'shoestrap' ), 'msp' => __( 'Main-Secondary-Primary', 'shoestrap' ), 'pms' => __( 'Primary-Main-Secondary', 'shoestrap' ), 'psm' => __( 'Primary-Secondary-Main', 'shoestrap' ), 'smp' => __( 'Secondary-Main-Primary', 'shoestrap' ), 'spm' => __( 'Secondary-Primary-Main', 'shoestrap' ) ) );
  $select_controls[] = array( 'setting' => 'layout_primary_width',      'label' => __( 'Primary Sidebar Width', 'shoestrap' ),           'section' => 'layout',  'priority' => 3, 'choises' => array( '2' => '2/12', '3' => '3/12', '4' => '4/12', '5' => '5/12', '6' => '6/12' ) );
  $select_controls[] = array( 'setting' => 'layout_secondary_width',    'label' => __( 'Secondary Sidebar Width', 'shoestrap' ),         'section' => 'layout',  'priority' => 5, 'choises' => array( '2' => '2/12', '3' => '3/12', '4' => '4/12' ) );
  $select_controls[] = array( 'setting' => 'layout_sidebar_on_front',   'label' => __( 'Show sidebars on the Home Page', 'shoestrap' ),  'section' => 'layout',  'priority' => 6, 'choises' => array( 'show' => __( 'Show', 'shoestrap' ), 'hide' => __( 'Hide', 'shoestrap' ) ) );

  // Image Controls
  $image_controls   = array();
  $image_controls[] = array( 'setting' => 'jumbotron_bg_img', 'label' => __( 'Hero Background Image', 'shoestrap' ),  'section' => 'jumbotron', 'priority' => 6 );
  $image_controls[] = array( 'setting' => 'logo',             'label' => __( 'Logo Image', 'shoestrap' ),             'section' => 'logo',      'priority' => 2 );

 foreach ( $text_controls as $control) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => $control['label'],
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'text',
      'priority'    => $control['priority']
    ));
  }

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

  foreach ( $image_controls as $control ) {
    $wp_customize->add_control( new WP_Customize_Image_Control(
      $wp_customize,
      $control['setting'],
      array(
        'label'     => $control['label'],
        'section'   => $control['section'],
        'settings'  => $control['setting'],
        'priority'  => $control['priority']
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

  foreach ( $checkbox_controls as $control ) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => $control['label'],
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'checkbox',
      'priority'    => $control['priority'],
    ));
  }
  // Header scripts (css/js)
  $wp_customize->add_control( new Shoestrap_Customize_Textarea_Control( $wp_customize, 'advanced_head', array(
    'label'       => 'Header Scripts (CSS/JS)',
    'section'     => 'advanced',
    'settings'    => 'advanced_head',
    'priority'    => 1,
  )));

  // Footer scripts (css/js)
  $wp_customize->add_control( new Shoestrap_Customize_Textarea_Control( $wp_customize, 'advanced_footer', array(
    'label'       => 'Footer Scripts (CSS/JS)',
    'section'     => 'advanced',
    'settings'    => 'advanced_footer',
    'priority'    => 3,
  )));
}
add_action( 'customize_register', 'shoestrap_customizer_controls' );
