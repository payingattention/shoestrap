<?php

// require_once locate_template( '/lib/customizer/functions/extras.php' );                   // Extra Functions for the customizer
require_once locate_template( '/lib/customizer/custom-builder/components/customizer-settings.php' ); // Create Customizer Settings
require_once locate_template( '/lib/customizer/custom-builder/components/customizer-controls.php' ); // Create Customizer Controls

/*
 * The content below is a copy of bootstrap's variables.less file.
 * 
 * Some options are user-configurable and stored as theme mods.
 * We try to minimize the options and simplify the user environment.
 * In order to do that, we 'll have to provide a minimum amount of options 
 * and calculate the rest based on the user's selections.
 * 
 * based on the text_color and body_bg, we can calculate the following options:
 * @black, @grayDarker, @grayDark, @gray, @grayLight, @grayLighter, @white
 * 
 * based on the baseBorderRadius we can calculate the borderRadiusLarge and borderRadiusSmall.
 * 
 * Only one option per button color is necessary.
 * 
 * The forms and dropdowns can both be derived from the text and background colors.
 * baseLineHeight can also be calculated from the baseFontSize,
 * but it's preferable to have a separate setting for that,
 * since some fonts have weird line height (especially if using Google Webfonts.)
 * 
 * Responsive and layouts in general are a bit trickier.
 * We allow the user to choose the width for Wide, Normal and Narrow
 * as well as gutter widths for narrow/normal and wide.
 * After that, we calculate all the other values based on these.
 */
function shoestrap_custom_builder_rewrite_variables() {
  // main body & text colors
  $body_bg              = get_theme_mod( 'shoestrap_background_color', '#fff' );
  $text_color           = get_theme_mod( 'shoestrap_text_color', '#333' );
  $link_color           = get_theme_mod( 'shoestrap_link_color', '#428bca' );

  // fonts
  $font_family_sans_serif = get_theme_mod( 'strp_cb_sansfont', '"Helvetica Neue", Helvetica, Arial, sans-serif' );
  $font_family_serif      = get_theme_mod( 'strp_cb_serifont', 'Georgia, "Times New Roman", Times, serif' );
  $font_family_monospace  = get_theme_mod( 'strp_cb_monofont', 'Monaco, Menlo, Consolas, "Courier New", monospace' );
  $font_size_base         = get_theme_mod( 'strp_cb_basefontsize', '14' );
  $line_height_base       = get_theme_mod( 'strp_cb_baselineheight', '20' );
  
  // border
  $border_radius_base     = get_theme_mod( 'strp_cb_baseborderradius', '4' );
  
  // grids
  $gridWidthNormal      = get_theme_mod( 'strp_cb_gridwidth_normal', '940' );
  $gridWidthWide        = get_theme_mod( 'strp_cb_gridwidth_wide', '1200' );
  $gridWidthNarrow      = get_theme_mod( 'strp_cb_gridwidth_narrow', '768' );
  $gridGutterNormal     = get_theme_mod( 'strp_cb_gridgutter_normal', '20' );
  $gridGutterWide       = get_theme_mod( 'strp_cb_gridgutter_wide', '30' );
  $gridColumns          = 12;
  
  // calculate shadows of gray, depending on background and text_color
  if ( shoestrap_get_brightness( $body_bg ) >= 128 ) {
    $gray_darker  = 'lighten(#000, 13.5%)';
    $gray_dark    = 'lighten(#000, 20%)';
    $gray         = 'lighten(#000, 33.5%)';
    $gray_light   = 'lighten(#000, 60%)';
    $gray_lighter = 'lighten(#000, 93.5%)';
  } else {
    $gray_darker  = 'darken(#000, 13.5%)';
    $gray_dark    = 'darken(#000, 20%)';
    $gray         = 'darken(#000, 33.5%)';
    $gray_light   = 'darken(#000, 60%)';
    $gray_lighter = 'darken(#000, 93.5%)';
  }

  // Link color (on hover) based on background brightness
  if ( shoestrap_get_brightness( $body_bg ) >= 50 ) {
    $linkColorHover = 'darken(@link-color, 15%)';
  } else {
    $linkColorHover = 'lighten(@link-color, 15%)';
  }
  
  // Table accents and border based on body_bg
  if ( shoestrap_get_brightness( $body_bg ) >= 50 ) {
    $table_bg_accent    = 'lighten(@body-bg, 5%)';
    $table_bg_hover     = 'lighten(@body-bg, 7%)';
    $table_border_color = 'lighten(@body-bg, 13%)';
  } else {
    $table_bg_accent    = 'darken(@body-bg, 5%)';
    $table_bg_hover     = 'darken(@body-bg, 7%)';
    $table_border_color = 'darken(@body-bg, 13%)';
  }
  
  // width of input elements
//  $horizontalComponentOffset = 3 * $gridColumnNormal;
  
  // NavBar width
  $navbarCollapseWidth = ( ( $gridWidthNormal + ( 2 * $gridGutterNormal ) ) - 1 );
  
  // locate the variables file
  $variables_file = locate_template( 'assets/less/bootstrap/variables.less' );
  // open the variables file
  $fh = fopen($variables_file, 'w');
  // the content of the variables file
  $variables_content = '//
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

@brand-primary:         ' . $link_color . ';
@brand-success:         #5cb85c;
@brand-warning:         #f0ad4e;
@brand-danger:          #d9534f;
@brand-info:            #5bc0de;

// Scaffolding
// -------------------------

@body-bg:               ' . $body_bg . ';
@text-color:            ' . $text_color . ';

// Links
// -------------------------

@link-color:            @brand-primary;
@link-hover-color:      darken(@link-color, 15%);

// Typography
// -------------------------

@font-family-sans-serif:  ' . $font_family_sans_serif . ';
@font-family-serif:       ' . $font_family_serif . ';
@font-family-monospace:   ' . $font_family_monospace . ';
@font-family-base:        @font-family-sans-serif;

@font-size-base:          ' . $font_size_base . 'px;
@font-size-large:         (@font-size-base * 1.25); // ~18px
@font-size-small:         (@font-size-base * 0.85); // ~12px
@font-size-mini:          (@font-size-base * 0.75); // ~11px

@line-height-base:        ' . $line_height_base . 'px;

@headings-font-family:    inherit; // empty to use BS default, @font-family-base
@headings-font-weight:    500;


// Components
// -------------------------
// Based on 14px font-size and 1.5 line-height

@padding-large:           11px 14px; // 44px
@padding-small:           2px 10px;  // 26px
@padding-mini:            0 6px;   // 22px

@border-radius-base:      ' . $border_radius_base . 'px;
@border-radius-large:     ' . ( $border_radius_base * 1.5 ) . 'px;
@border-radius-small:     ' . ( $border_radius_base * 0.75 ) . 'px;

@component-active-bg:            @brand-primary;


// Tables
// -------------------------

@table-bg:                           transparent; // overall background-color
@table-bg-accent:                    ' . $table_bg_accent . '; // for striping
@table-bg-hover:                     ' . $table_bg_hover . ';// for hover

@table-border-color:                 ' . $table_border_color . '; // table and cell border


// Buttons
// -------------------------

@btn-color:                      #fff;
@btn-bg:                         #a7a9aa;
@btn-border:                     @btn-bg;

@btn-primary-bg:                 @brand-primary;
@btn-primary-border:             @btn-primary-bg;

@btn-success-bg:                 @brand-success;
@btn-success-border:             @btn-success-bg;

@btn-warning-bg:                 @brand-warning;
@btn-warning-border:             @btn-warning-bg;

@btn-danger-bg:                  @brand-danger;
@btn-danger-border:              @btn-danger-bg;

@btn-info-bg:                    @brand-info;
@btn-info-border:                @btn-info-bg;



// Forms
// -------------------------

@input-bg:                       lighten(@body-bg, 3%);
@input-bg-disabled:              @gray-lighter;

@input-border:                   @gray-lighter;
@input-border-radius:            @border-radius-base;

@input-color-placeholder:        @gray-light;

@input-height-base:              (@line-height-base + 14px); // base line-height + 12px vertical padding + 2px top/bottom border
@input-height-large:             (@line-height-base + 24px); // base line-height + 22px vertical padding + 2px top/bottom border
@input-height-small:             (@line-height-base + 6px);  // base line-height + 4px vertical padding + 2px top/bottom border

@form-actions-bg:                 darken(@input-bg, 2%);


// Dropdowns
// -------------------------

@dropdown-bg:                    @body-bg;
@dropdown-border:                rgba(0,0,0,.15);
@dropdown-divider-top:           @gray-lighter;
@dropdown-divider-bottom:        @body-bg;

@dropdown-link-active-color:     @body-bg;
@dropdown-link-active-bg:        @component-active-bg;

@dropdown-link-color:            @gray-dark;
@dropdown-link-hover-color:      @body-bg;
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
@navbar-color:                     #777;
@navbar-bg:                        #eee;

// Navbar links
@navbar-link-color:                #777;
@navbar-link-hover-color:          #333;
@navbar-link-hover-bg:             transparent;
@navbar-link-active-color:         #555;
@navbar-link-active-bg:            darken(@navbar-bg, 10%);
@navbar-link-disabled-color:       #ccc;
@navbar-link-disabled-bg:          transparent;

// Navbar brand label
@navbar-brand-color:               @navbar-link-color;
@navbar-brand-hover-color:         darken(@navbar-link-color, 10%);
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

@pagination-bg:                        @body-bg;
@pagination-border:                    @gray_lighter;
@pagination-active-bg:                 darken(@body-bg, 2%);


// Jumbotron
// -------------------------

@jumbotron-bg:                   @gray-lighter;
@jumbotron-heading-color:        inherit;
@jumbotron-lead-color:           inherit;


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
@tooltip-color:               @body-bg;
@tooltip-bg:                  rgba(0,0,0,.9);
@tooltip-arrow-width:         5px;
@tooltip-arrow-color:         @tooltip-bg;

@popover-bg:                  @body-bg;
@popover-arrow-width:         10px;
@popover-arrow-color:         @body-bg;
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
@progress-bg:                 #f5f5f5;
@progress-bar-bg:             @brand-primary;
@progress-bar-success-bg:     @brand-success;
@progress-bar-warning-bg:     @brand-warning;
@progress-bar-danger-bg:      @brand-danger;
@progress-bar-info-bg:        @brand-info;


// List group
// -------------------------
@list-group-bg:               @body-bg;
@list-group-border:           #ddd;
@list-group-border-radius:    @border-radius-base;

@list-group-hover-bg:         #f5f5f5;
@list-group-active-text:      @body-bg;
@list-group-active-bg:        @component-active-bg;
@list-group-active-border:    @list-group-active-bg;

// Panels
// -------------------------
@panel-bg:                    @body-bg;
@panel-border:                #ddd;
@panel-border-radius:         @border-radius-base;
@panel-heading-bg:            #f5f5f5;

@panel-primary-text:          @body-bg;
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
@thumbnail-border:            #ddd;
@thumbnail-border-radius:     @border-radius-base;


// Wells
// -------------------------
@well-bg:                     #f5f5f5;


// Miscellaneous
// -------------------------

// Hr border color
@hr-border:                   @gray-lighter;

// Horizontal forms & lists
@component-offset-horizontal: 180px;


// Media queries breakpoints
// --------------------------------------------------

// Tiny screen / phone
@screen-tiny:                480px;
@screen-phone:               @screen-tiny;

// Small screen / tablet
@screen-small:               768px;
@screen-tablet:              @screen-small;

// Medium screen / desktop
@screen-medium:              992px;
@screen-desktop:             @screen-medium;

// So media queries dont overlap when required, provide a maximum
@screen-small-max:           (@screen-medium - 1);
@screen-tablet-max:          @screen-small-max;

// Large screen / wide desktop
@screen-large:               1200px;
@screen-large-desktop:       @screen-large;


// Grid system
// --------------------------------------------------

// Number of columns in the grid system
@grid-columns:              12;
// Padding, to be divided by two and applied to the left and right of all columns
@grid-gutter-width:         30px;
// Point at which the navbar stops collapsing
@grid-float-breakpoint:     @screen-tablet;

';
  
  // write the content to the variations file
  fwrite( $fh, $variables_content );
  // close the file
  fclose( $fh );
}
add_action( 'customize_preview_init', 'shoestrap_custom_builder_rewrite_variables' );
