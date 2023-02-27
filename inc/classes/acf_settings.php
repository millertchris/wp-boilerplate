<?php

class acf_settings {
    //======================================================================
    // CREATE BLOCK TYPES
    //======================================================================
    static function block_types() {
        // Check function exists.
        if (function_exists('acf_register_block_type')) {
            register_block_type(get_template_directory() . '/blocks/_example_block');
            register_block_type(get_template_directory() . '/blocks/accordions');
            register_block_type(get_template_directory() . '/blocks/basic_content');
            register_block_type(get_template_directory() . '/blocks/cards');
            register_block_type(get_template_directory() . '/blocks/carousel');
            register_block_type(get_template_directory() . '/blocks/cta');
            register_block_type(get_template_directory() . '/blocks/features');
            register_block_type(get_template_directory() . '/blocks/gallery');
            register_block_type(get_template_directory() . '/blocks/hero_1');
            register_block_type(get_template_directory() . '/blocks/listing');
            register_block_type(get_template_directory() . '/blocks/slider');
            register_block_type(get_template_directory() . '/blocks/stats');
            register_block_type(get_template_directory() . '/blocks/testimonials');
            register_block_type(get_template_directory() . '/blocks/web_form');
        }
    }

    static function block_categories($block_categories, $editor_context) {
        if (!empty($editor_context->post)) {
            array_unshift(
                $block_categories,
                array(
                    'slug'  => 'custom-blocks',
                    'title' => __('Custom Blocks'),
                    'icon'  => null,
                )
            );
        }
        return $block_categories;
    }

    //======================================================================
    // CUSTOMIZE ACF JSON SAVE FOLDER
    //======================================================================
    static function json_save_folder($path) {

        // update path
        $path = get_stylesheet_directory() . '/inc/acf/json/';

        // return
        return $path;
    }

    //======================================================================
    // CUSTOMIZE ACF JSON LOAD FOLDER
    //======================================================================
    static function json_load_folder($paths) {

        // remove original path (optional)
        unset($paths[0]);

        // append path
        $paths[] = get_stylesheet_directory() . '/inc/acf/json/';

        // return
        return $paths;
    }

    //======================================================================
    // ADD OPTIONS PAGE
    //======================================================================
    static function add_option_page() {
        if (function_exists('acf_add_options_page')) {

            acf_add_options_page(array(
                'page_title'    => 'Site Options',
                'menu_title'    => 'Site Options',
                'menu_slug'     => 'acf-site-options',
                'capability'    => 'edit_posts',
                'redirect'        => false,
            ));
        }
    }
}
