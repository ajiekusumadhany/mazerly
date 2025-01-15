<?php


function mazer_customize_register($wp_customize) {
    $wp_customize->add_setting('footer_custom_text', array(
        'default' => 'Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a href="https://ajiekusumadhany.com">Ajie Kusumadhany</a>',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer', 'mazer'),
        'priority' => 30,
    ));

    $wp_customize->add_control('footer_custom_text_control', array(
        'label' => __('Footer Text', 'mazer'),
        'section' => 'footer_section',
        'settings' => 'footer_custom_text',
        'type' => 'textarea',
    ));

    // Menambahkan pengaturan untuk logo navbar
    $wp_customize->add_setting('navbar_logo', array(
        'default' => get_template_directory_uri() . '/assets/compiled/svg/logo.svg',
        'sanitize_callback' => 'esc_url',
    ));

    // Menambahkan kontrol untuk logo navbar
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'navbar_logo_control', array(
        'label' => __('Logo', 'mazerly'),
        'section' => 'title_tagline',
        'settings' => 'navbar_logo',
    )));
}

add_action('customize_register', 'mazer_customize_register');

// Mendaftarkan lokasi menu
function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'), // Ganti dengan nama lokasi menu yang sesuai
        )
    );
}
add_action('init', 'register_my_menus');

class Custom_Sidebar_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Kelas default untuk <li>
        $li_classes = 'sidebar-item';
        if (in_array('current-menu-item', $item->classes)) {
            $li_classes .= ' active'; // Tambahkan kelas 'active' jika item sedang aktif
        }
        if ($args->walker->has_children) {
            $li_classes .= ' has-sub'; // Tambahkan kelas 'has-sub' jika item memiliki submenu
        }

        // Output <li> dengan kelas yang sesuai
        $output .= '<li class="' . esc_attr($li_classes) . '">';

        // Output <a> dengan kelas 'sidebar-link'
        $output .= '<a href="' . esc_url($item->url) . '" class="sidebar-link">';

        // Output ikon dan teks menu (gunakan wp_kses_post untuk mengizinkan tag HTML)
        $output .= wp_kses_post($item->title);

        // Tutup <a>
        $output .= '</a>';
    }

    function start_lvl(&$output, $depth = 0, $args = null) {
        // Output <ul> untuk submenu
        $output .= '<ul class="submenu">';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // Tutup <ul> untuk submenu
        $output .= '</ul>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Tutup <li>
        $output .= '</li>';
    }
}
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/static/js/components/sidebar.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
function enqueue_bootstrap_icons() {
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css');
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_icons');


?>