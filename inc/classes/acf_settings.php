<?php

class acf_settings {
    //======================================================================
    // CREATE BLOCK TYPES
    //======================================================================
    static function block_types() {

        // Check function exists.
        if (function_exists('acf_register_block_type')) {

            acf_register_block_type(array(
                'name'              => 'hero',
                'title'             => __('Hero'),
                'description'       => __('A custom block.'),
                'render_template'   => 'blocks/hero.php',
                'category'          => 'custom-blocks',
                'icon'              => 'block-default',
                'keywords'          => array('hero'),
                'supports' => array(
                    'align' => false,
                ),
                'example'  => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => array(
                            'preview_image_help' => get_stylesheet_directory_uri() . '/blocks/previews/hero.png',
                        )
                    )
                )
            ));
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
