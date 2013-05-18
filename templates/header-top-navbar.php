<?php if ( get_theme_mod( 'navbar_position' ) == 1 ) $navbar_class = 'navbar navbar-fixed-top';
elseif ( get_theme_mod( 'navbar_position' ) == 2 ) $navbar_class = 'navbar navbar-fixed-bottom';
else $navbar_class = 'navbar navbar-static-top'; ?>

<header id="banner" class="topnavbar <?php echo $navbar_class; ?>" role="banner">

  <?php if ( get_theme_mod( 'fluid' ) != 1 ) : ?>
    <div class="container">
  <?php endif; ?>

    <a class="btn navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <?php if ( get_theme_mod( 'navbar_brand' ) != 0 ) : ?>
      <a class="navbar-brand" href="<?php echo home_url(); ?>/">
        <?php if ( get_theme_mod( 'navbar_logo' ) == 1 ) : ?>
          <?php shoestrap_logo(); ?>
        <?php else : ?>
          <?php bloginfo('name'); ?>
        <?php endif; ?>
      </a>
    <?php endif; ?>

    <?php do_action( 'shoestrap_primary_nav_top_left' ); ?>
    <?php do_action( 'shoestrap_nav_top_left' ); ?>

    <nav id="nav-main" class="nav-main nav-collapse collapse" role="navigation">
      <?php if ( has_nav_menu( 'primary_navigation' ) ) : ?>
          <?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => shoestrap_nav_class_pull() ) ); ?>
      <?php endif; ?>
    </nav>

    <?php do_action( 'shoestrap_nav_top_right' ); ?>
  <?php if ( get_theme_mod( 'fluid' ) != 1 ) : ?>
    </div>
  <?php endif; ?>

  <?php do_action( 'shoestrap_nav_top_bottom' ); ?>
</header>