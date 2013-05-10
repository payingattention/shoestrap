<?php


add_action( 'shoestrap_admin_content', 'shoestrap_backup_page', 10 );
function shoestrap_backup_page() {
  $license      = get_option( 'shoestrap_backup_key' );
  $status       = get_option( 'shoestrap_backup_key_status' );
  $submit_text  = __( 'Save & activate licence', 'shoestrap' );
  $current_url  = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $customizeurl = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() );

  ?>
  <div class="postbox">
    <h3 class="hndle" style="padding: 7px 10px;"><span><?php _e( 'Theme Backup', 'shoestrap' ); ?></span></h3>
    <div class="inside">
      <?
      $presets = glob(SHOESTRAP_THEME_ROOT."/lib/presets/*");

      foreach ($presets as $preset) {
        $name = explode("/", $preset);
        $name = $name[count($name)-1];
        $name = explode(".", $name);
        $name = $name[0];
        echo $name;
      }

      //$mods = json_decode(file_get_contents());
//$mods = get_theme_mods();
echo json_encode($mods);
      ?>

      <strong>This theme is an OpenSource project and is provided free of charge.</strong><br />
      If you wish to enable automatic updates, you can visit <a href="http://shoestrap.org/downloads/shoestrap/" target="_blank">this page</a>
      and get a free licence. By entering and <strong>activating</strong> it, whenever a new version is available you will be notified in your dashboard.
      If you wish to help this project, you can do so by helping out on the <a href="https://github.com/aristath/shoestrap" target="_blank">github project page</a>
      <br>
      <p>To configure the options for this theme, please visit the <a href="<?php  echo $customizeurl ?>">Customizer</a></p>

      <form method="post" action="options.php">
        <?php settings_fields( 'shoestrap_backup' ); ?>

        <?php _e( 'License Key:', 'shoestrap' ); ?>

        <input id="shoestrap_backup_key" name="shoestrap_backup_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
        <label class="description" for="shoestrap_backup_key">
          <?php _e( 'Enter your license key', 'shoestrap' ); ?>
          (
          <?php if( false !== $license ) { ?>
            <?php if( $status !== false && $status == 'valid' ) { ?>
              <span style="color:green;"><?php _e( 'active', 'shoestrap' ); ?></span>
            <?php } else { ?>
              <span style="color:red;"><?php _e( 'inactive', 'shoestrap' ); ?></span>
            <?php } ?>
          <?php } ?>
          )

        </label>

        <?php submit_button( $submit_text ); ?>

      </form>
    </div>
  </div>
  <?php
}

// Check for and create backup folder for saving theme options
function shoestrap_backup_init() {
  $theme_root = get_template_directory();
  if (!file_exists(SHOESTRAP_THEME_ROOT."/cache")) {
    mkdir(SHOESTRAP_THEME_ROOT."/cache", 0755);
  } else {
    // Cache directory exists, check for preview get
    if ($_GET['preset_preview']) {


    } else {
      if (!file_exists(SHOESTRAP_THEME_ROOT."/cache/current.json") {
        // Load presets from old
        unlink(SHOESTRAP_THEME_ROOT."/cache/current.json");
      }
    }
/*
  If Preview {
    If variable cache file exists {
      if POST {
        delete cache file, save current settings
      } else {
        Load Preset or user_preset
      }
    } else {
      Create variable cache file
      Load Preset or user_preset
    }
  } else {
    if variable cache file exists {
      reload variables from cache
      delete cache file
    }
  }
*/
    // If preview

    // else
        //
      //If file doesn't exist
      // If file does exist
    // else, unlink and reset to current

    if (!file_exists(SHOESTRAP_THEME_ROOT."/cache/current.json") && $_GET['preview'] != true) {
      unlink (SHOESTRAP_THEME_ROOT."/cache/current.json");
    } else if ($_GET['preview'] == true) {
        file_put_contents(SHOESTRAP_THEME_ROOT."/cache/current.json", json_encode(get_theme_mods()));
    }
  }
}
add_action( 'admin_init', 'shoestrap_backup_init' );


function shoestrap_backup_file() {
  $license_key = trim( get_option( 'shoestrap_backup_key' ) );
  if ( strlen( $license_key ) < 7 )
    return;
  if ( strlen( $license_key ) < 7 )
    return;

  if( get_option( 'shoestrap_backup_key_status' ) == 'valid' )
    return;

  $license = trim( get_option( 'shoestrap_backup_key' ) );

  // data to send in our API request
  $api_params = array(
    'edd_action'=> 'activate_license',
    'license'   => $license,
    'item_name' => urlencode( SHOESTRAP_THEME_NAME )
  );

  // Call the custom API.
  $response = wp_remote_get( add_query_arg( $api_params, SHOESTRAP_STORE_URL ) );

  // make sure the response came back okay
  if ( is_wp_error( $response ) )
    return false;

  // decode the license data
  $license_data = json_decode( wp_remote_retrieve_body( $response ) );

  update_option( 'shoestrap_backup_key_status', $license_data->license );

}
add_action( 'admin_init', 'shoestrap_backup_file' );