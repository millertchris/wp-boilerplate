<?php

class theme_settings {
    // =========================================================================
    // ENABLES 100% JPEG QUALITY
    // Wordpress compresses uploads 90% of their original size
    // =========================================================================
    static function high_jpg_quality() {
        return 100;
    }

    // =========================================================================
    // REGISTER & ENQUEUE
    // =========================================================================
    static function resources() {
        wp_enqueue_style('wp-boilerplate', get_template_directory_uri() . '/dist/main.css');
        // wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);
        wp_enqueue_script('font-awesome', '//kit.fontawesome.com/efae0a992b.js');
        wp_enqueue_script('wp-boilerplate', get_template_directory_uri() . '/dist/app.js', '', '', true);
    }

    // =========================================================================
    // TITLE TAG - RECOMMENDED
    // =========================================================================
    // Since Version 4.1, themes should use add_theme_support()
    static function setup_theme_slug() {
        add_theme_support('title-tag');
    }

    // =========================================================================
    // REGISTER MENUS
    // =========================================================================
    static function register_nav_menus() {
        register_nav_menus(array(
            'action-menu' => __('Action Menu', 'text_domain'),
            'main-menu' => __('Main Menu', 'text_domain'),
            'footer-menu'  => __('Footer Menu', 'text_domain'),
            'social-menu' => __('Social Menu', 'text_domain'),
        ));
    }

    //======================================================================
    // ADD RESPONSIVE CONTAINER TO EMBEDS
    //======================================================================
    static function embed_wrapper($html) {
        return '<div class="video-wrapper">' . $html . '</div>';
    }

    //======================================================================
    // CHANGE EXCERPT
    //======================================================================
    static function change_excerpt($more) {
        global $post;
        return '...';
    }

    //======================================================================
    // ALLOW SVG UPLOADS
    // =========================================================================
    static function mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['json'] = 'text/plain';
        return $mimes;
    }

    // =========================================================================
    // ENABLE THUMBNAILS SUPPORT
    // =========================================================================
    static function enable_thumbnails() {
        add_theme_support('post-thumbnails');
    }

    // =========================================================================
    // REGISTERING SIDEBAR
    // =========================================================================
    static function add_sidebar() {
        if (function_exists('register_sidebar')) {
            register_sidebar([
                'name' => 'Sidebar Widgets',
                'id'   => 'sidebar-widgets',
                'description'   => 'These are widgets for the sidebar.',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2>',
                'after_title'   => '</h2>'
            ]);
        }
    }
}
