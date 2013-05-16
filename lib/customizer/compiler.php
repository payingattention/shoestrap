<?php

// Prevent Direct Access with homepage redirect
if ( !defined( 'DB_NAME' ) ) {
  header('Location: http://'.$_SERVER['SERVER_NAME'].'/');
}

/*
 * Gets the css path or url to the stylesheet
 * If $target = 'path', return the path
 * If $target = 'url', return the url
 *
 * If echo = true then print the path or url.
 */
function shoestrap_css( $target = 'path', $echo = false ) {
  $cssid = null;
  // If this is a multisite installation, append the blogid to the filename
  if ( is_multisite() ) {
    global $blog_id;
    if ( $blog_id > 1 )
      $cssid = '_id-' . $blog_id;
    else
      $cssid = null;
  }

  if ( $target == 'url' )
    $css_path = get_template_directory_uri() . '/assets/css/style' . $cssid. '.css';
  else
    $css_path = get_template_directory() . '/assets/css/style' . $cssid. '.css';

  if ( $echo )
    echo $css_path;
  else
    return $css_path;
}

/*
 * This function can be used to compile a less file to css using the lessphp compiler
 */
function shoestrap_phpless_compiler() {
  
  if ( !class_exists( 'lessc' ) )
    require_once locate_template( '/lib/less_compiler/lessc.inc.php' );

  $less = new lessc;
  
  if ( get_option( 'shoestrap_minimize_css' ) == 1 )
    $less->setFormatter( "compressed" );

  $less->setImportDir( array(
    get_template_directory() . '/assets/less',
    get_template_directory() . '/assets/less/bootstrap',
    get_template_directory() . '/assets/fonts',
  ) );
  $css = $less->compile( shoestrap_complete_less() );

  return $css;
}

function shoestrap_compile_css( $method = 'php' ) {

  if ( $method == 'php' ) {
    $content = '/********* Do not edit this file *********/

';
    $content .= shoestrap_phpless_compiler();
    $makecss = file_put_contents( shoestrap_css(), $content );
    $css = $makecss;
  } else {
    // Run a function that will handle the less.js compiler
  }
  return $css;
}

/*
 * Write the CSS to file
 */
function shoestrap_makecss() {
  shoestrap_compile_css();
}
add_action( 'wp', 'shoestrap_makecss' );

/*
 * The content below is a copy of bootstrap's variables.less file.
 * 
 * Some options are user-configurable and stored as theme mods.
 * We try to minimize the options and simplify the user environment.
 * In order to do that, we 'll have to provide a minimum amount of options 
 * and calculate the rest based on the user's selections.
 * 
 */
function shoestrap_variables_less() {

  $body_bg          = '#' . str_replace( '#', '', get_theme_mod( 'color_body_bg' ) );
  $brand_primary    = '#' . str_replace( '#', '', get_theme_mod( 'color_brand_primary' ) );
  $brand_success    = '#' . str_replace( '#', '', get_theme_mod( 'color_brand_success' ) );
  $brand_warning    = '#' . str_replace( '#', '', get_theme_mod( 'color_brand_warning' ) );
  $brand_danger     = '#' . str_replace( '#', '', get_theme_mod( 'color_brand_danger' ) );
  $brand_info       = '#' . str_replace( '#', '', get_theme_mod( 'color_brand_info' ) );
  $text_color       = '#' . str_replace( '#', '', get_theme_mod( 'color_text' ) );
  $link_color       = '#' . str_replace( '#', '', get_theme_mod( 'color_links' ) );
  $sans_serif       = get_theme_mod( 'typography_sans_serif' );
  $serif            = get_theme_mod( 'typography_serif' );
  $font_size_base   = filter_var( get_theme_mod( 'typography_font_size_base', '14' ), FILTER_SANITIZE_NUMBER_INT );
  $font_headings    = get_theme_mod( 'typography_headings' );
  $border_radius    = filter_var( get_theme_mod( 'general_border_radius', '4' ), FILTER_SANITIZE_NUMBER_INT );
  $navbar_color     = '#' . str_replace( '#', '', get_theme_mod( 'navbar_color' ) );
  $navbar_bg        = '#' . str_replace( '#', '', get_theme_mod( 'navbar_bg' ) );
  $jumbotron_bg     = '#' . str_replace( '#', '', get_theme_mod( 'jumbotron_bg' ) );
  $jumbotron_color  = '#' . str_replace( '#', '', get_theme_mod( 'jumbotron_color' ) );
  $screen_tiny      = filter_var( get_theme_mod( 'layout_screen_tiny' ), FILTER_SANITIZE_NUMBER_INT );
  $screen_small     = filter_var( get_theme_mod( 'layout_screen_small' ), FILTER_SANITIZE_NUMBER_INT );
  $screen_medium    = filter_var( get_theme_mod( 'layout_screen_medium' ), FILTER_SANITIZE_NUMBER_INT );
  $screen_large     = filter_var( get_theme_mod( 'layout_screen_large' ), FILTER_SANITIZE_NUMBER_INT );
  $gutter           = filter_var( get_theme_mod( 'layout_gutter' ), FILTER_SANITIZE_NUMBER_INT );

  // Calculate the gray shadows based on the body background.
  // We basically create 2 "presets": light and dark.
  if ( shoestrap_get_brightness( $body_bg ) > 80 ) {
    $gray_darker  = 'lighten(#000, 13.5%)';
    $gray_dark    = 'lighten(#000, 20%)';
    $gray         = 'lighten(#000, 33.5%)';
    $gray_light   = 'lighten(#000, 60%)';
    $gray_lighter = 'lighten(#000, 93.5%)';
  } else {
    $gray_darker  = 'darken(#fff, 13.5%)';
    $gray_dark    = 'darken(#fff, 20%)';
    $gray         = 'darken(#fff, 33.5%)';
    $gray_light   = 'darken(#fff, 60%)';
    $gray_lighter = 'darken(#fff, 93.5%)';
  }

  if ( shoestrap_get_brightness( $link_color ) > 50 )
    $link_hover_color = 'darken(@link-color, 15%)';
  else
    $link_hover_color = 'lighten(@link-color, 15%)';

  if ( shoestrap_get_brightness( $link_color ) > 50 ) {
    $table_bg_accent      = 'darken(@body-bg, 2.5%)';
    $table_bg_hover       = 'darken(@body-bg, 4%)';
    $table_border_color   = 'darken(@body-bg, 13.35%)';
    $input_border         = 'darken(@body-bg, 20%)';
    $dropdown_divider_top = 'darken(@body-bg, 10.2%)';
  } else {
    $table_bg_accent      = 'lighten(@body-bg, 2.5%)';
    $table_bg_hover       = 'lighten(@body-bg, 4%)';
    $table_border_color   = 'lighten(@body-bg, 13.35%)';
    $input_border         = 'lighten(@body-bg, 20%)';
    $dropdown_divider_top = 'lighten(@body-bg, 10.2%)';
  }

  if ( shoestrap_get_brightness( $navbar_bg ) > 80 ) {
    $navbar_link_hover_color    = 'darken(@navbar-color, 26.5%)';
    $navbar_link_active_bg      = 'darken(@navbar-bg, 10%)';
    $navbar_link_disabled_color = 'darken(@navbar-bg, 6.5%)';
    $navbar_brand_hover_color   = 'darken(@navbar-link-color, 10%)';
  } else {
    $navbar_link_hover_color    = 'lighten(@navbar-color, 26.5%)';
    $navbar_link_active_bg      = 'lighten(@navbar-bg, 10%)';
    $navbar_link_disabled_color = 'lighten(@navbar-bg, 6.5%)';
    $navbar_brand_hover_color   = 'lighten(@navbar-link-color, 10%)';
  }

  $variables = '//
// Variables
// --------------------------------------------------


// Global values
// --------------------------------------------------


// Grays
// -------------------------

@gray-darker:            ' . $gray_darker . ';
@gray-dark:              ' . $gray_dark . ';
@gray:                   ' . $gray . ';
@gray-light:             ' . $gray_light . ';
@gray-lighter:           ' . $gray_lighter . ';

// Brand colors
// -------------------------

@brand-primary:         ' . $brand_primary . ';
@brand-success:         ' . $brand_success . ';
@brand-warning:         ' . $brand_warning . ';
@brand-danger:          ' . $brand_danger . ';
@brand-info:            ' . $brand_info . ';

// Scaffolding
// -------------------------

@body-bg:               ' . $body_bg . ';
@text-color:            ' . $text_color . ';

// Links
// -------------------------

@link-color:            ' . $link_color . ';
@link-hover-color:      ' . $link_hover_color . ';

// Typography
// -------------------------

@font-family-sans-serif:  ' . $sans_serif . ';
@font-family-serif:       ' . $serif . ';
@font-family-monospace:   Monaco, Menlo, Consolas, "Courier New", monospace;
@font-family-base:        @font-family-sans-serif;

@font-size-base:          ' . $font_size_base . 'px;
@font-size-large:         ceil(@font-size-base * 1.25); // ~18px
@font-size-small:         ceil(@font-size-base * 0.85); // ~12px
@font-size-mini:          ceil(@font-size-base * 0.75); // ~11px

@line-height-base:        1.428; // 20/14
@line-height-computed:    ceil(@font-size-base * @line-height-base); // ~20px
@line-height-headings:    1.1;

@headings-font-family:    ' . $font_headings . ';
@headings-font-weight:    500;


// Components
// -------------------------
// Based on 14px font-size and 1.5 line-height

@padding-large:           11px 14px; // 44px
@padding-small:           2px 10px;  // 26px
@padding-mini:            0 6px;   // 22px

@border-radius-base:      ' . $border_radius . 'px;
@border-radius-large:     ceil(@border-radius-base * 1.5);
@border-radius-small:     floor(@border-radius-base * 0.75);

@component-active-bg:            @brand-primary;


// Tables
// -------------------------

@table-bg:                           transparent; // overall background-color
@table-bg-accent:                    ' . $table_bg_accent . '; // for striping
@table-bg-hover:                     ' . $table_bg_hover . '; // for hover

@table-border-color:                 ' . $table_border_color . '; // table and cell border


// Buttons
// -------------------------

@btn-default-color:              #fff;
@btn-default-bg:                 #a7a9aa;
@btn-default-border:             @btn-default-bg;

@btn-primary-color:              @btn-default-color;
@btn-primary-bg:                 @brand-primary;
@btn-primary-border:             @btn-primary-bg;

@btn-success-color:              @btn-default-color;
@btn-success-bg:                 @brand-success;
@btn-success-border:             @btn-success-bg;

@btn-warning-color:              @btn-default-color;
@btn-warning-bg:                 @brand-warning;
@btn-warning-border:             @btn-warning-bg;

@btn-danger-color:               @btn-default-color;
@btn-danger-bg:                  @brand-danger;
@btn-danger-border:              @btn-danger-bg;

@btn-info-color:                 @btn-default-color;
@btn-info-bg:                    @brand-info;
@btn-info-border:                @btn-info-bg;



// Forms
// -------------------------

@input-bg:                       ' . $body_bg . ';
@input-bg-disabled:              @gray-lighter;

@input-border:                   ' . $input_border . ';
@input-border-radius:            @border-radius-base;

@input-color-placeholder:        @gray-light;

@input-height-base:              (@line-height-computed + 14px); // base line-height + 12px vertical padding + 2px top/bottom border
@input-height-large:             (@line-height-computed + 24px); // base line-height + 22px vertical padding + 2px top/bottom border
@input-height-small:             (@line-height-computed + 6px);  // base line-height + 4px vertical padding + 2px top/bottom border

@form-actions-bg:                 ' . $table_bg_hover . ';


// Dropdowns
// -------------------------

@dropdown-bg:                    ' . $body_bg . ';
@dropdown-border:                rgba(0,0,0,.15);
@dropdown-divider-top:           ' . $dropdown_divider_top . ';
@dropdown-divider-bottom:        ' . $body_bg . ';

@dropdown-link-active-color:     ' . $body_bg . ';
@dropdown-link-active-bg:        @component-active-bg;

@dropdown-link-color:            @gray-dark;
@dropdown-link-hover-color:      ' . $body_bg . ';
@dropdown-link-hover-bg:         @dropdown-link-active-bg;


// COMPONENT VARIABLES
// --------------------------------------------------


// Z-index master list
// -------------------------
// Used for a birds eye view of components dependent on the z-axis
// Try to avoid customizing these :)

@zindex-dropdown:          1000;
@zindex-popover:           1010;
@zindex-tooltip:           1030;
@zindex-navbar-fixed:      1030;
@zindex-modal-background:  1040;
@zindex-modal:             1050;


// Glyphicons font path
// -------------------------
@glyphicons-font-path:          "../fonts";


// Navbar
// -------------------------

// Basics of a navbar
@navbar-height:                    50px;
@navbar-color:                     ' . $navbar_color . ';
@navbar-bg:                        ' . $navbar_bg . ';

// Navbar links
@navbar-link-color:                @navbar-color;
@navbar-link-hover-color:          ' . $navbar_link_hover_color . ';
@navbar-link-hover-bg:             transparent;
@navbar-link-active-color:         mix(@navbar-color, @navbar-link-hover-color, 50%);
@navbar-link-active-bg:            ' . $navbar_link_active_bg . ';
@navbar-link-disabled-color:       ' . $navbar_link_disabled_color . ';
@navbar-link-disabled-bg:          transparent;

// Navbar brand label
@navbar-brand-color:               @navbar-link-color;
@navbar-brand-hover-color:         ' . $navbar_brand_hover_color . ';
@navbar-brand-hover-bg:            transparent;

// Inverted navbar
@navbar-inverse-color:                       @gray-light;
@navbar-inverse-bg:                         #222;

// Inverted navbar links
@navbar-inverse-link-color:                 @gray-light;
@navbar-inverse-link-hover-color:           #fff;
@navbar-inverse-link-hover-bg:              transparent;
@navbar-inverse-link-active-color:          @navbar-inverse-link-hover-color;
@navbar-inverse-link-active-bg:             darken(@navbar-inverse-bg, 10%);
@navbar-inverse-link-disabled-color:        #444;
@navbar-inverse-link-disabled-bg:           transparent;

// Inverted navbar brand label
@navbar-inverse-brand-color:                @navbar-inverse-link-color;
@navbar-inverse-brand-hover-color:          #fff;
@navbar-inverse-brand-hover-bg:             transparent;

// Inverted navbar search
// Normal navbar needs no special styles or vars
@navbar-inverse-search-bg:                  lighten(@navbar-inverse-bg, 25%);
@navbar-inverse-search-bg-focus:            #fff;
@navbar-inverse-search-border:              @navbar-inverse-bg;
@navbar-inverse-search-placeholder-color:   #ccc;


// Pagination
// -------------------------

@pagination-bg:                        ' . $body_bg . ';
@pagination-border:                    ' . $table_border_color . ';
@pagination-active-bg:                 ' . $table_bg_hover . ';


// Jumbotron
// -------------------------

@jumbotron-bg:                   ' . $jumbotron_bg . ';
@jumbotron-heading-color:        ' . $jumbotron_color . ';
@jumbotron-lead-color:           @jumbotron-heading-color;


// Form states and alerts
// -------------------------

@state-warning-text:             #c09853;
@state-warning-bg:               #fcf8e3;
@state-warning-border:           darken(spin(@state-warning-bg, -10), 3%);

@state-danger-text:              #b94a48;
@state-danger-bg:                #f2dede;
@state-danger-border:            darken(spin(@state-danger-bg, -10), 3%);

@state-success-text:             #468847;
@state-success-bg:               #dff0d8;
@state-success-border:           darken(spin(@state-success-bg, -10), 5%);

@state-info-text:                #3a87ad;
@state-info-bg:                  #d9edf7;
@state-info-border:              darken(spin(@state-info-bg, -10), 7%);


// Tooltips and popovers
// -------------------------
@tooltip-color:               ' . $body_bg . ';
@tooltip-bg:                  rgba(0,0,0,.9);
@tooltip-arrow-width:         5px;
@tooltip-arrow-color:         @tooltip-bg;

@popover-bg:                  ' . $body_bg . ';
@popover-arrow-width:         10px;
@popover-arrow-color:         ' . $body_bg . ';
@popover-title-bg:            darken(@popover-bg, 3%);

// Special enhancement for popovers
@popover-arrow-outer-width:   (@popover-arrow-width + 1);
@popover-arrow-outer-color:   rgba(0,0,0,.25);


// Labels
// -------------------------
@label-success-bg:            @brand-success;
@label-info-bg:               @brand-info;
@label-warning-bg:            @brand-warning;
@label-danger-bg:             @brand-danger;


// Modals
// -------------------------
@modal-inner-padding:         20px;

@modal-title-padding:         15px;
@modal-title-line-height:     @line-height-base;

// Alerts
// -------------------------
@alert-bg:                    @state-warning-bg;
@alert-text:                  @state-warning-text;
@alert-border:                @state-warning-border;
@alert-border-radius:         @border-radius-base;

@alert-success-bg:            @state-success-bg;
@alert-success-text:          @state-success-text;
@alert-success-border:        @state-success-border;

@alert-danger-bg:             @state-danger-bg;
@alert-danger-text:           @state-danger-text;
@alert-danger-border:         @state-danger-border;

@alert-info-bg:               @state-info-bg;
@alert-info-text:             @state-info-text;
@alert-info-border:           @state-info-border;


// Progress bars
// -------------------------
@progress-bg:                 ' . $table_bg_hover . ';
@progress-bar-bg:             @brand-primary;
@progress-bar-success-bg:     @brand-success;
@progress-bar-warning-bg:     @brand-warning;
@progress-bar-danger-bg:      @brand-danger;
@progress-bar-info-bg:        @brand-info;


// List group
// -------------------------
@list-group-bg:               ' . $body_bg . ';
@list-group-border:           ' . $table_border_color . ';
@list-group-border-radius:    @border-radius-base;

@list-group-hover-bg:         ' . $table_bg_hover . ';
@list-group-active-color:     ' . $body_bg . ';
@list-group-active-bg:        @component-active-bg;
@list-group-active-border:    @list-group-active-bg;

// Panels
// -------------------------
@panel-bg:                    ' . $body_bg . ';
@panel-border:                @list-group-border;
@panel-border-radius:         @border-radius-base;
@panel-heading-bg:            @list-group-hover-bg;

@panel-primary-text:          ' . $body_bg . ';
@panel-primary-border:        @brand-primary;
@panel-primary-heading-bg:    @brand-primary;

@panel-success-text:          @state-success-text;
@panel-success-border:        @state-success-border;
@panel-success-heading-bg:    @state-success-bg;

@panel-warning-text:          @state-warning-text;
@panel-warning-border:        @state-warning-border;
@panel-warning-heading-bg:    @state-warning-bg;

@panel-danger-text:           @state-danger-text;
@panel-danger-border:         @state-danger-border;
@panel-danger-heading-bg:     @state-danger-bg;

@panel-info-text:             @state-info-text;
@panel-info-border:           @state-info-border;
@panel-info-heading-bg:       @state-info-bg;


// Thumbnails
// -------------------------
@thumbnail-caption-color:     @text-color;
@thumbnail-bg:                @body-bg;
@thumbnail-border:            @list-group-border;
@thumbnail-border-radius:     @border-radius-base;


// Wells
// -------------------------
@well-bg:                     @panel-heading-bg;


// Miscellaneous
// -------------------------

// Hr border color
@hr-border:                   @gray-lighter;

// Horizontal forms & lists
@component-offset-horizontal: 180px;


// Media queries breakpoints
// --------------------------------------------------

// Tiny screen / phone
@screen-tiny:                ' . $screen_tiny . 'px;
@screen-phone:               @screen-tiny;

// Small screen / tablet
@screen-small:               ' . $screen_small . 'px;
@screen-tablet:              @screen-small;

// Medium screen / desktop
@screen-medium:              ' . $screen_medium . 'px;
@screen-desktop:             @screen-medium;

// So media queries dont overlap when required, provide a maximum
@screen-small-max:           (@screen-medium - 1);
@screen-tablet-max:          @screen-small-max;

// Large screen / wide desktop
@screen-large:               ' . $screen_large . ' px;
@screen-large-desktop:       @screen-large;


// Grid system
// --------------------------------------------------

// Number of columns in the grid system
@grid-columns:              12;
// Padding, to be divided by two and applied to the left and right of all columns
@grid-gutter-width:         ' . $gutter . 'px;
// Point at which the navbar stops collapsing
@grid-float-breakpoint:     @screen-tablet;
';

  return $variables;
}

function shoestrap_complete_less() {
  $bootstrap_less = shoestrap_variables_less() . '
/*!
 * Bootstrap v3.0.0
 *
 * Copyright 2013 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world by @mdo and @fat.
 */

// Core variables and mixins
// @import "variables";
@import "mixins";

// Reset
@import "normalize";
@import "print";

// Core CSS
@import "scaffolding";
@import "type";
@import "code";
@import "grid";

@import "tables";
@import "forms";
@import "buttons";

// Components: common
@import "component-animations";
@import "elusive-webfont";
@import "dropdowns";
@import "list-group";
@import "panels";
@import "wells";
@import "close";

// Components: Nav
@import "navs";
@import "navbar";
@import "button-groups";
@import "breadcrumbs";
@import "pagination";
@import "pager";

// Components: Popovers
@import "modals";
@import "tooltip";
@import "popovers";

// Components: Misc
@import "alerts";
@import "thumbnails";
@import "media";
@import "labels";
@import "badges";
@import "progress-bars";
@import "accordion";
@import "carousel";
@import "jumbotron";

// Utility classes
@import "utilities"; // Has to be last to override when necessary
@import "responsive-utilities";

@import "app"; // Custom Shoestrap less-css
';

  return $bootstrap_less;
}
