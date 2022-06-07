<?php
//======================================================================
// WORDPRESS ACTIONS
//======================================================================
add_action('wp_enqueue_scripts', 'theme_settings::resources');
add_action('after_setup_theme', 'theme_settings::setup_theme_slug');
add_action('after_setup_theme', 'theme_settings::register_nav_menus', 0);
add_action('enqueue_block_editor_assets', 'admin_settings::gutenberg_styles');
// add_action('init', 'cpt_settings::product', 0);

//======================================================================
// WORDPRESS FILTERS
//======================================================================
add_filter('embed_oembed_html', 'theme_settings::embed_wrapper', 10, 3);
add_filter('video_embed_html', 'theme_settings::embed_wrapper');
add_filter('excerpt_more', 'theme_settings::change_excerpt');
add_filter('jpg_quality', 'theme_settings::high_jpg_quality');
add_filter('upload_mimes', 'theme_settings::mime_types'); // Allowing SVG uploads to WP

//======================================================================
// WORDPRESS SUPPORT
//======================================================================
theme_settings::enable_thumbnails();
theme_settings::add_sidebar();

//======================================================================
// ACF ACTIONS
//======================================================================
add_action('acf/init', 'acf_settings::block_types');

//======================================================================
// ACF FILTERS
//======================================================================
add_filter('acf/settings/remove_wp_meta_box', '__return_true');
add_filter('acf/settings/save_json', 'acf_settings::json_save_folder');
add_filter('acf/settings/load_json', 'acf_settings::json_load_folder');
add_filter('block_categories_all', 'acf_settings::block_categories', 10, 2);
acf_settings::add_option_page();




// add_theme_support('editor-styles');
