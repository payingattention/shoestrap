<?php

/*
 * Creates the section, settings and the controls for the customizer
 */
function shoestrap_social_customizer( $wp_customize ){
  
  $sections   = array();
  $sections[] = array( 'slug' => 'shoestrap_social', 'title' => __( 'Social Links', 'shoestrap' ), 'priority' => 8 );

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
  $settings[] = array( 'slug' => 'shoestrap_single_social_position',    'default' => 'none' );  
  
  foreach( $settings as $setting ){
    $wp_customize->add_setting( $setting['slug'], array( 'default' => $setting['default'], 'type' => 'theme_mod', 'capability' => 'edit_theme_options' ) );
  }

  $checkbox_controls = array();
  $checkbox_controls[] = array( 'setting' => 'shoestrap_facebook_on_posts',     'label' => __( 'Share Buttons on Posts: Facebook', 'shoestrap' ),    'section' => 'shoestrap_social',  'priority' => 5 );
  $checkbox_controls[] = array( 'setting' => 'shoestrap_twitter_on_posts',      'label' => __( 'Share Buttons on Posts: Twitter', 'shoestrap' ),     'section' => 'shoestrap_social',  'priority' => 6 );
  $checkbox_controls[] = array( 'setting' => 'shoestrap_gplus_on_posts',        'label' => __( 'Share Buttons on Posts: Google Plus', 'shoestrap' ), 'section' => 'shoestrap_social',  'priority' => 7 );
  $checkbox_controls[] = array( 'setting' => 'shoestrap_linkedin_on_posts',     'label' => __( 'Share Buttons on Posts: Linkedin', 'shoestrap' ),    'section' => 'shoestrap_social',  'priority' => 8 );
  $checkbox_controls[] = array( 'setting' => 'shoestrap_pinterest_on_posts',    'label' => __( 'Share Buttons on Posts: Pinterest', 'shoestrap' ),   'section' => 'shoestrap_social',  'priority' => 9 );
  $checkbox_controls[] = array( 'setting' => 'shoestrap_digg_on_posts',         'label' => __( 'Share Buttons on Posts: Digg', 'shoestrap' ),        'section' => 'shoestrap_social',  'priority' => 9 );

  $select_controls = array();
  $select_controls[] = array( 'setting' => 'shoestrap_single_social_position',  'label' => __( 'Location of social shares', 'shoestrap' ),           'section' => 'shoestrap_social',  'priority' => 10,'choises' => array( 'top' => __( 'Top', 'shoestrap' ), 'bottom' => __( 'Bottom', 'shoestrap' ), 'both' => __( 'Both', 'shoestrap' ), 'none' => __( 'None', 'shoestrap' ) ) );

  $text_controls = array();
  $text_controls[]  = array( 'setting' => 'shoestrap_facebook_link',            'label' => __( 'Facebook Page Link', 'shoestrap' ),                  'section' => 'shoestrap_social',  'priority' => 1 );
  $text_controls[]  = array( 'setting' => 'shoestrap_twitter_link',             'label' => __( 'Twitter URL or @username', 'shoestrap' ),            'section' => 'shoestrap_social',  'priority' => 2 );
  $text_controls[]  = array( 'setting' => 'shoestrap_google_plus_link',         'label' => __( 'Google+ Profile Link', 'shoestrap' ),                'section' => 'shoestrap_social',  'priority' => 3 );
  $text_controls[]  = array( 'setting' => 'shoestrap_pinterest_link',           'label' => __( 'Pinterest Profile Link', 'shoestrap' ),              'section' => 'shoestrap_social',  'priority' => 4 );
  $text_controls[]  = array( 'setting' => 'shoestrap_single_social_text',       'label' => __( 'Single Social Text', 'shoestrap' ),                  'section' => 'shoestrap_social',  'priority' => 10 );

  foreach ( $checkbox_controls as $control ) {
    $wp_customize->add_control( $control['setting'], array(
      'label'       => $control['label'],
      'section'     => $control['section'],
      'settings'    => $control['setting'],
      'type'        => 'checkbox',
      'priority'    => $control['priority'],
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
add_action( 'customize_register', 'shoestrap_social_customizer' );

/*
 * Prints the social links on the primary navbar
 */
function shoestrap_add_social_links_primary_navbar() {
  
  $mavbar_social  = get_theme_mod( 'shoestrap_navbar_social' );
  $facebook_link  = get_theme_mod( 'shoestrap_facebook_link' );
  $twitter_link   = get_theme_mod( 'shoestrap_twitter_link' );
  $gplus_link     = get_theme_mod( 'shoestrap_google_plus_link' );
  $pinterest_link = get_theme_mod( 'shoestrap_pinterest_link' );
  
  if ( $mavbar_social != 0 ) {
    echo '<ul class="nav nav-collapse pull-right">';
    if ( !empty( $facebook_link ) )   { shoestrap_social_links( 'fb' ); }
    if ( !empty( $twitter_link ) )    { shoestrap_social_links( 'tw' ); }
    if ( !empty( $gplus_link ) )      { shoestrap_social_links( 'gp' ); }
    if ( !empty( $pinterest_link ) )  { shoestrap_social_links( 'pi' ); }
    echo '</ul>';
  }
}
add_action( 'shoestrap_nav_top_right', 'shoestrap_add_social_links_primary_navbar' );

/*
 * Prints the social links on the secondary navbar
 */
function shoestrap_add_social_links_secondary_navbar() {
  
  $navbar_social  = get_theme_mod( 'shoestrap_navbar2_social' );
  $facebook_link  = get_theme_mod( 'shoestrap_facebook_link' );
  $twitter_link   = get_theme_mod( 'shoestrap_twitter_link' );
  $gplus_link     = get_theme_mod( 'shoestrap_google_plus_link' );
  $pinterest_link = get_theme_mod( 'shoestrap_pinterest_link' );
  
  if ( $navbar_social != 0 ) {
    echo '<ul class="nav nav-collapse pull-right">';
    if ( !empty( $facebook_link ) )   { shoestrap_social_links( 'fb' ); }
    if ( !empty( $twitter_link ) )    { shoestrap_social_links( 'tw' ); }
    if ( !empty( $gplus_link ) )      { shoestrap_social_links( 'gp' ); }
    if ( !empty( $pinterest_link ) )  { shoestrap_social_links( 'pi' ); }
    echo '</ul>';
  }
}
add_action( 'shoestrap_secondary_nav_top_right', 'shoestrap_add_social_links_secondary_navbar' );

/*
 * Prints the social links on the extra header
 */
function shoestrap_add_social_links_header() {
  
  $header_social  = get_theme_mod( 'shoestrap_header_social' );
  $facebook_link  = get_theme_mod( 'shoestrap_facebook_link' );
  $twitter_link   = get_theme_mod( 'shoestrap_twitter_link' );
  $gplus_link     = get_theme_mod( 'shoestrap_google_plus_link' );
  $pinterest_link = get_theme_mod( 'shoestrap_pinterest_link' );
  
  if ( $header_social != 0 ) {
    echo '<ul class="pull-right social-networks">';
    if ( !empty( $facebook_link ) )   { shoestrap_social_links( 'fb' ); }
    if ( !empty( $twitter_link ) )    { shoestrap_social_links( 'tw' ); }
    if ( !empty( $gplus_link ) )      { shoestrap_social_links( 'gp' ); }
    if ( !empty( $pinterest_link ) )  { shoestrap_social_links( 'pi' ); }
    echo '</ul>';
  }
}
add_action( 'shoestrap_branding_branding_right', 'shoestrap_add_social_links_header' );

/*
 * Echoes the social network links
 */
function shoestrap_social_links( $network = '' ) {
  
  $facebook_link  = get_theme_mod( 'shoestrap_facebook_link' );
  $twitter_link   = get_theme_mod( 'shoestrap_twitter_link' );
  $gplus_link     = get_theme_mod( 'shoestrap_google_plus_link' );
  $pinterest_link = get_theme_mod( 'shoestrap_pinterest_link' );
  
  // Sanitizing twitter links and making them compatible with @username
  
  if( strpos ( $twitter_link, 'twitter.'  ) !== false ) {
    $newvalue = esc_url( $twitter_link );
  } else {
    $twitter_link = ltrim( $twitter_link, '@');
    $twitter_link = 'http://twitter.com/' . $twitter_link;
  }
  
  // Sanitizing Facebook links
  $facebook_link = esc_url( $facebook_link );

  // Sanitizing Google+ links
  $gplus_link = esc_url( $gplus_link );

  // Sanitizing Pinterest links
  $pinterest_link = esc_url( $pinterest_link );

  // Echoing the links
  if ( $network == 'fb' ){ ?>
    <li class="social-networks"><a href="<?php echo $facebook_link; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
  <?php }
  elseif ( $network == 'tw' ) { ?>
    <li class="social-networks"><a href="<?php echo $twitter_link; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
  <?php }
  elseif ( $network == 'gp' ) { ?>
    <li class="social-networks"><a href="<?php echo $gplus_link; ?>" target="_blank"><i class="icon-googleplus"></i></a></li>
  <?php }
  elseif ( $network == 'pi' ) { ?>
    <li class="social-networks"><a href="<?php echo $pinterest_link; ?>" target="_blank"><i class="icon-pinterest"></i></a></li>
  <?php }
}

/*
 * Alters the content to add social share buttons.
 * The buttons will be on the top, bottom or both of single entries.
 */
function shoestrap_social_share_singular( $content ) { 
  global $post; ?>
  <div id="social-sharing">
    <div class="shareme" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?> <?php the_permalink(); ?>"></div>
  </div>
  <?php
}

function shoestrap_social_share_add_actions() { 
  $location     = get_theme_mod( 'shoestrap_single_social_position' );

  if ( $location == 'top' ) {
    add_action( 'shoestrap_before_the_content', 'shoestrap_social_share_singular');
  } elseif ( $location == 'bottom' ) {
    add_action( 'shoestrap_after_the_content', 'shoestrap_social_share_singular');
  } elseif ( $location == 'both' ) {
    add_action( 'shoestrap_before_the_content', 'shoestrap_social_share_singular');
    add_action( 'shoestrap_after_the_content', 'shoestrap_social_share_singular');
  }
}
add_action( 'wp', 'shoestrap_social_share_add_actions' );

function shoestrap_social_share_script() {
  $googleplus   = get_theme_mod( 'shoestrap_gplus_on_posts' );
  $facebook     = get_theme_mod( 'shoestrap_facebook_on_posts' );
  $twitter      = get_theme_mod( 'shoestrap_twitter_on_posts' );
  $linkedin     = get_theme_mod( 'shoestrap_linkedin_on_posts' );
  $pinterest    = get_theme_mod( 'shoestrap_pinterest_on_posts' );
  $digg         = get_theme_mod( 'shoestrap_digg_on_posts' );
  
  $social_text  = get_theme_mod( 'shoestrap_single_social_text' );
  $location     = get_theme_mod( 'shoestrap_single_social_position' );

  $social_template = '<div class="box"><div class="left">' . $social_text . '</div><div class="middle">';

  if ( $googleplus == 1 )
    $social_template .= '<a href="#" class="googlePlus"><i class="glyphicon glyphicon-googleplus"></i></a>';

  if ( $facebook == 1 )
    $social_template .= '<a href="#" class="facebook"><i class="glyphicon glyphicon-facebook"></i></a>';

  if ( $twitter == 1 )
    $social_template .= '<a href="#" class="twitter"><i class="glyphicon glyphicon-twitter"></i></a>';

  if ( $linkedin == 1 )
    $social_template .= '<a href="#" class="linkedin"><i class="glyphicon glyphicon-linkedin"></i></a>';

  if ( $pinterest == 1 )
    $social_template .= '<a href="#" class="pinterest"><i class="glyphicon glyphicon-pinterest"></i></a>';

  if ( $digg == 1 )
    $social_template .= '<a href="#" class="digg"><i class="glyphicon glyphicon-digg"></i></a>';

  $social_template .= '</div><div class="right">{total}</div></div>';
  
  $script = '<script>';
  $script .= "$('.shareme').sharrre({";
  $script .= 'share: {';

  if ( $googleplus == 1 )
    $script .= 'googlePlus: true,';

  if ( $twitter == 1 )
    $script .= 'twitter: true,';

  if ( $facebook == 1 )
    $script .= 'facebook: true,';

  if ( $linkedin == 1 )
    $script .= 'linkedin: true,';

  if ( $pinterest == 1 )
    $script .= 'pinterest: true,';

  if ( $digg == 1 )
    $script .= 'digg: true,';

  $script .= '},';
  $script .= "template: '" . $social_template . "',";
  $script .= 'enableHover: false,';
  $script .= 'enableTracking: true,';

  // If curl is present, then load the PHP file.
  if ( function_exists( 'curl_init' ) ) {
    $script .= "urlCurl: '" . get_template_directory_uri() . "/assets/js/vendor/sharrre.php',";
  } else {
    $script .= "urlCurl: '',";
  }

  $script .= 'render: function(api, options){';

  if ( $googleplus == 1 )
    $script .= "$(api.element).on('click', '.googlePlus', function() { api.openPopup('googlePlus'); });";

  if ( $twitter == 1 )
    $script .= "$(api.element).on('click', '.twitter', function() { api.openPopup('twitter'); });";

  if ( $facebook == 1 )
    $script .= "$(api.element).on('click', '.facebook', function() { api.openPopup('facebook'); });";

  if ( $linkedin == 1 )
    $script .= "$(api.element).on('click', '.linkedin', function() { api.openPopup('linkedin'); });";

  if ( $pinterest == 1 )
    $script .= "$(api.element).on('click', '.pinterest', function() { api.openPopup('pinterest'); });";

  if ( $digg == 1 )
    $script .= "$(api.element).on('click', '.digg', function() { api.openPopup('digg'); });";

  $script .= '}});</script>';

  echo $script;
}
add_action( 'wp_footer', 'shoestrap_social_share_script' );