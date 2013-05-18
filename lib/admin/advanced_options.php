<?php

/*
 * Adds the Advanced menu item
 */
function shoestrap_admin_main_nav_item_advanced() {
  global $pagenow;
  if ( $pagenow == 'themes.php' && $_GET['page'] == 'shoestrap_options' && $_GET['tab'] == 'advanced' ) { 
    echo '<a class="nav-tab nav-tab-active" href="?page=shoestrap_options&tab=advanced">' . __( 'Advanced Theme Options', 'Shoestrap') . '</a>';
  } else {
    echo '<a class="nav-tab" href="?page=shoestrap_options&tab=advanced">' . __( 'Advanced Theme Options', 'Shoestrap') . '</a>';
  }
}
add_action( 'shoestrap_admin_main_nav_tab', 'shoestrap_admin_main_nav_item_advanced', 10 );


/*
 * Adds the Content to the Licencing menu page
 */
function shoestrap_admin_advanced_page_content() {
  global $pagenow;
  if ( $pagenow == 'themes.php' && $_GET['page'] == 'shoestrap_options' && $_GET['tab'] == 'advanced' ) {
    add_action( 'shoestrap_admin_content', 'shoestrap_dev_mode_toggle', 10 );
  }
}
add_action( 'shoestrap_admin_content', 'shoestrap_admin_advanced_page_content', 1 );

add_action( 'admin_init', 'shoestrap_dev_mode_register_options', 11 );
function shoestrap_dev_mode_register_options() {
  // creates our settings in the options table
  register_setting( 'shoestrap_advanced', 'shoestrap_minimize_css' );
  register_setting( 'shoestrap_advanced', 'shoestrap_advanced_compiler' );

  register_setting( 'shoestrap_advanced', 'shoestrap_root_relative_urls' );
  register_setting( 'shoestrap_advanced', 'shoestrap_rewrite_urls' );

  register_setting( 'shoestrap_advanced', 'shoestrap_load_scripts_on_footer' );

  register_setting( 'shoestrap_advanced', 'shoestrap_use_default_js_version' );

  register_setting( 'shoestrap_advanced', 'shoestrap_use_lessjs_compiler' );
}

function shoestrap_dev_mode_toggle() {
  $footer_scripts     = get_option( 'shoestrap_load_scripts_on_footer' );
  $override_js        = get_option( 'shoestrap_use_default_js_version' );
  $less_js_compiler   = get_option( 'shoestrap_use_lessjs_compiler' );

  $current_url        = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $customizeurl       = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() );
  if ( get_option( 'shoestrap_dev_mode' ) != 1 ) {
    $disabled         = 'disabled';
    // Disable the advanced customizer if developer mode is disabled
    if ( $advanced == 1 ) {
      update_option( 'shoestrap_advanced_compiler', '' );
    }
  } else {
    $disabled         = '';
  }
  $root_relative_urls = get_option( 'shoestrap_root_relative_urls' );
  $rewrite_urls       = get_option( 'shoestrap_rewrite_urls' );
  
  $submit_text        = __( 'Save', 'shoestrap' );
  $activationurl      = admin_url( 'themes.php?page=theme_activation_options' );
  
  ?>
  <div class="postbox">
    <h3 class="hndle" style="padding: 7px 10px;"><span><?php _e( 'Advanced Theme Options', 'shoestrap' ); ?></span></h3>
    <div class="inside">

      <form method="post" action="options.php">
        <?php settings_fields( 'shoestrap_advanced' ); ?>

        <div class="shoestrap_use_lessjs_compiler">
          <input id="shoestrap_use_lessjs_compiler" name="shoestrap_use_lessjs_compiler" <?php echo $disabled; ?> type="checkbox" value="1" <?php checked('1', get_option('shoestrap_use_lessjs_compiler')); ?> />
          <label class="description" for="shoestrap_use_lessjs_compiler">
            <?php _e( 'Use less.js (javascript) compiler for LESS files instead of the PHP-CSS Compiler', 'shoestrap' ); ?>
          </label>
        </div>

        <div class="shoestrap_minimize_toggling">
          <input id="shoestrap_minimize_css" name="shoestrap_minimize_css" <?php echo $disabled; ?> type="checkbox" value="1" <?php checked('1', get_option('shoestrap_minimize_css')); ?> />
          <label class="description" for="shoestrap_minimize_css">
            <?php _e( 'Minimize CSS', 'shoestrap' ); ?>
          </label>
          <p>
            <?php _e( 'In Production sites this option should be turned ON. Stylesheets will then be minimized. Keep in mind that stylesheets will only be re-compiled when there has been a change in their corresponding less files. So in order for the minification to take effect, you\'ll have to open and then save the less files again.', 'shoestrap' ); ?>
          </p>
        </div>

        <div class="shoestrap_use_default_js_version">
          <input id="shoestrap_use_default_js_version" name="shoestrap_use_default_js_version" <?php echo $disabled; ?> type="checkbox" value="1" <?php checked('1', get_option('shoestrap_use_default_js_version')); ?> />
          <label class="description" for="shoestrap_use_default_js_version">
            <?php _e( 'Use the default WordPress version of jQuery', 'shoestrap' ); ?>
          </label>
          <p>
            <?php _e( 'Use the WordPress default version of jQuery instead of the latest version.', 'shoestrap' ); ?>
            <?php _e( 'Enable this option if you have encountered any incompatibilities.', 'shoestrap' ); ?>
          </p>
        </div>
        <hr />

        <h4><?php _e( 'Enable Root Relative URLs', 'shoestrap' ); ?></h4>
        <input id="shoestrap_root_relative_urls" name="shoestrap_root_relative_urls" type="checkbox" value="1" <?php checked('1', get_option('shoestrap_root_relative_urls')); ?> />
        <label class="description" for="shoestrap_root_relative_urls">
          <?php _e( 'Enable Root Relative URLs', 'shoestrap' ); ?>
        </label>
        <p><?php _e( 'Return URLs such as', 'shoestrap' ); ?> <code>/assets/css/app-responsive.css</code> <?php _e( 'instead of', 'shoestrap' ); ?> <code>http://example.com/assets/css/app-responsive.css</code></p>
        <p>
          <strong><?php _e( 'After you enable the above option, you have to visit', 'shoestrap' ); ?> <a href="<?php echo $activationurl; ?>"><?php _e( 'this link', 'shoestrap' ); ?></a></strong>
          <?php _e( 'to write the appropriate changes to your .htaccess file', 'shoestrap' ); ?>
        </p>
        <p>
          <?php _e( 'Please note that if you decide to de-activate this option you will have to manually revert the changes to your .htaccess file. It is therefore recommended that you keep a backup of this file BEFORE applying your changes.', 'shoestrap' ); ?>
        </p>
        <hr />

        <h4><?php _e( 'Enable URL Rewrites', 'shoestrap' ); ?></h4>
        <input id="shoestrap_rewrite_urls" name="shoestrap_rewrite_urls" type="checkbox" value="1" <?php checked('1', get_option('shoestrap_rewrite_urls')); ?> />
        <label class="description" for="shoestrap_rewrite_urls">
          <?php _e( 'Enable URL Rewrites', 'shoestrap' ); ?>
        </label>
        <p><?php _e( 'Using this feature, URLs are rewritten like the following examples:', 'shoestrap' ); ?> </p>
        <p><code>/wp-content/themes/themename/assets/css/</code> <?php _e( 'to', 'shoestrap' ); ?> <code>/assets/css/</code></p>
        <p><code>/wp-content/themes/themename/assets/js/</code> <?php _e( 'to', 'shoestrap' ); ?> <code>/assets/js/</code></p>
        <p><code>/wp-content/themes/themename/assets/img/</code> <?php _e( 'to', 'shoestrap' ); ?> <code>/assets/img/</code></p>
        <p><code>/wp-content/plugins/</code> <?php _e( 'to', 'shoestrap' ); ?> <code>/plugins/</code></p>
        <p>
          <strong><?php _e( 'After you enable the above option, you have to visit', 'shoestrap' ); ?> <a href="<?php echo $activationurl; ?>"><?php _e( 'this link', 'shoestrap' ); ?></a></strong>.
          <?php _e( 'When you do so, HTML5 Boilerplate\'s .htaccess and the above rewrite rules are copied to your .htaccess file', 'shoestrap' ); ?>
        </p>
        <p><?php _e( 'Please make sure that your', 'shoestrap' ); ?> <code>.htaccess</code> <?php _e( 'file is writable by the webserver before visiting the above link', 'shoestrap' ); ?>.</p>
        <p>
          <?php _e( 'Please note that if you decide to de-activate this option you will have to manually revert the changes to your .htaccess file. It is therefore recommended that you keep a backup of this file BEFORE applying your changes.', 'shoestrap' ); ?>
        </p>
        <hr />


        <?php submit_button(); ?>
        
      </form>
    </div>
  </div>
  <?php
}
