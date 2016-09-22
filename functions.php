<?php

define('HOOR_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once HOOR_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new Hoor\Vendor\Psr4ClassLoader();
$loader->addPrefix('Hoor', HOOR_PATH . 'library');
$loader->addPrefix('Hoor', HOOR_PATH . 'source/php/');
$loader->register();

new Hoor\App();

// Dequeue Styles from municipio
function hoor_dequeue_unnecessary_styles() {
    wp_dequeue_style( 'hbg-prime' );
    wp_deregister_style( 'hbg-prime' );

    wp_dequeue_style( 'municipio' );
    wp_deregister_style( 'municipio' );

}
add_action( 'wp_print_styles', 'hoor_dequeue_unnecessary_styles' );


// Add Format button to TinyMCE toolbar
add_filter( 'mce_buttons_2', 'editor_buttons' );
function editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

// Add Styles to the Format TinyMCE toolbar
add_filter( 'tiny_mce_before_init', 'editor_buttons_before_init' );

function editor_buttons_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Introduction',
            'selector' => 'p',
            'classes' => 'o-lead'
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}

// Register editor stylesheet for the theme.
function hoor_add_editor_styles() {
    add_editor_style( 'assets/dist/css/editor-style.css' );
}
add_action( 'admin_init', 'hoor_add_editor_styles' );

// Wrap embeds in an div to be able to make videos responsive
add_filter('embed_oembed_html', 'site_embed_oembed_html', 99, 4);
function site_embed_oembed_html($html, $url, $attr, $post_id) {
    return '<div class="o-embed-container">' . $html . '</div>';
}

// Unregister stale and unused WordPress widgets
function hoor_unregister_widgets() {
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Text');

    //unregister_widget('WP_Widget_Pages');
    //unregister_widget('WP_Nav_Menu_Widget');
    //unregister_widget('WP_Widget_RSS');
}
add_action( 'widgets_init', 'hoor_unregister_widgets' );
