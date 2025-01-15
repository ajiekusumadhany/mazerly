<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
        
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/compiled/css/app-dark.css">
    <?php wp_head(); ?>
    <?php wp_site_icon(); ?>
</head>

<body <?php body_class(); ?>>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                $navbar_logo = get_theme_mod('navbar_logo', get_template_directory_uri() . '/assets/compiled/svg/logo.svg');
                if ($navbar_logo) {
                    echo '<img src="' . esc_url($navbar_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="navbar-logo">';
                } else {
                    echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/compiled/svg/logo.svg') . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="navbar-logo">';
                }
                ?>
            </a>
    </div>  

            
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
<ul class="menu">
    <?php
    // Menampilkan menu WordPress
    if (has_nav_menu('primary')) {
        wp_nav_menu(array(
            'theme_location' => 'primary', // Lokasi menu
            'container' => false, // Hapus container default
            'items_wrap' => '%3$s', // Biarkan output tanpa <ul> tambahan
            'walker' => new Custom_Sidebar_Menu_Walker(), // Gunakan custom walker
            'echo' => true // Pastikan menu di-echo
        ));
    } else {
        echo '<li class="sidebar-item"><span>Silahkan tambahkan menu</span></li>';
    }
    ?>
</ul>
    </div>
</div>
        </div>
            

    </section>
</div>



