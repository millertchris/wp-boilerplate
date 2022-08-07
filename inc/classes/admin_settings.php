<?php

class admin_settings {
    // =========================================================================
    // EXTEND OR MODIFY WORDPRESS ADMIN
    // =========================================================================
    static function gutenberg_styles() {
        wp_enqueue_style('gutenberg_styles', get_theme_file_uri('/dist/admin.css'), false, '1.0', 'all');
        // wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700;800&display=swap', array(), null);
        wp_enqueue_script('font-awesome', '//kit.fontawesome.com/efae0a992b.js');
        wp_enqueue_script('gutenberg_scripts', get_template_directory_uri() . '/dist/app.js', ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-editor'], '1.0', true);
    }
}
