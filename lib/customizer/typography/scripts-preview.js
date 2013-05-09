( function( $ ){
  // Creates the proper stylesheets on the preview page
  function initGoogleWebFonts() {
    $('#shoestrap_google_webfonts_style').remove();
    $('#shoestrap_google_webfonts_style_css').remove();
    var api = parent.wp.customize,
        font = api.instance('shoestrap_google_webfonts').get(),
        weight = api.instance('shoestrap_webfonts_weight').get(),
        character = api.instance('shoestrap_webfonts_character_set').get(),
        assigned = api.instance('shoestrap_webfonts_assign').get();

    var href = "http://fonts.googleapis.com/css?family=";
    if (font == "")
      return;
    else
      href += font.replace(" ","+");
    if (weight != "")
      href += ":"+weight;
    if (character != "")
      href += "&subset="+character;

    // Now what should this font apply to?
    var classes = "body, input, button, select, textarea, .search-query";
    if (assigned == 'sitename') {
      classes = ".navbar-brand";
    }
    if (assigned == 'headers') {
      classes = ".navbar-brand, h1, h2, h3, h4, h5";
    }
    $('head').append('<style id="shoestrap_google_webfonts_style_css">'+classes+' {font-family:'+font+';}</style>');
    $('head').append('<link id="shoestrap_google_webfonts_style" rel="stylesheet" href="'+href+'" type="text/css" />');

  }
  initGoogleWebFonts();
  wp.customize( "shoestrap_google_webfonts", function( value ) {
    value.bind( function( to ) {
      initGoogleWebFonts();
    });
  });
  wp.customize( "shoestrap_webfonts_weight", function( value ) {
    value.bind( function( to ) {
      initGoogleWebFonts();
    });
  });
  wp.customize( "shoestrap_webfonts_character_set", function( value ) {
    value.bind( function( to ) {
      initGoogleWebFonts();
    });
  });
  wp.customize( "shoestrap_webfonts_assign", function( value ) {
    value.bind( function( to ) {
      initGoogleWebFonts();
    });
  });
} )( jQuery )