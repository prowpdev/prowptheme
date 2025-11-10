<?php
/**
 * 
 * Theme functions and definitionsThis file is the main theme functions file.
 * @package ProWPDev
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PROWPDEV_THEME_PATH', get_template_directory() );
define( 'PROWPDEV_THEME_URL', get_template_directory_uri() );

function prowpdev() {
    // Theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);

    // Register a main menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'prowpdev'),
    ]);
}
add_action('after_setup_theme', 'prowpdev');

function prowpdev_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'prowpdev-style',
        get_template_directory_uri() . '/dist/css/style.css',
        [],
        $theme_version
    );

    wp_enqueue_script(
        'prowpdev-scripts',
        get_template_directory_uri() . '/dist/js/main.js',
        [],
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'prowpdev_enqueue_assets');


add_action('acf/init', function() {
    if( !function_exists('acf_register_block_type') ) return;

    $blocks_dir = get_template_directory() . '/blocks';
    $block_folders = glob($blocks_dir . '/*', GLOB_ONLYDIR);

    foreach ($block_folders as $folder) {
        $name = basename($folder);
        $json_file = $folder . '/block.json';

        if (file_exists($json_file)) {
            // Read block.json and override/add absolute paths
            $block_data = json_decode(file_get_contents($json_file), true);

            // Ensure render_template uses absolute path
            if (isset($block_data['acf']['renderTemplate'])) {
                $block_data['render_template'] = $folder . '/render.php';
            }

            // Enqueue style if exists
            $style_file = $folder . '/style.css';
            if (file_exists($style_file)) {
                $block_data['enqueue_style'] = get_template_directory_uri() . "/blocks/{$name}/style.css";
            }

            // Set default required fields if missing
            if (!isset($block_data['name'])) $block_data['name'] = $name;
            if (!isset($block_data['title'])) $block_data['title'] = ucfirst(str_replace('-', ' ', $name));
            if (!isset($block_data['category'])) $block_data['category'] = 'layout';
            if (!isset($block_data['icon'])) $block_data['icon'] = 'admin-customizer';
            if (!isset($block_data['keywords'])) $block_data['keywords'] = [$name, 'acf'];

            acf_register_block_type($block_data);

        } else {
            // If no block.json, create a default block registration
            acf_register_block_type([
                'name'              => $name,
                'title'             => ucfirst(str_replace('-', ' ', $name)),
                'render_template'   => $folder . '/render.php',
                'category'          => 'layout',
                'icon'              => 'admin-customizer',
                'keywords'          => [$name, 'acf'],
                'mode'              => 'preview',
                'supports'          => [
                    'align' => true,
                    'anchor' => true,
                    'jsx' => true,
                ],
                'enqueue_style'     => file_exists($folder . '/style.css') ? get_template_directory_uri() . "/blocks/{$name}/style.css" : null,
            ]);
        }
    }
});


