<?php get_header(); ?>
<main id="main">
<header class="mb-3">
    
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-1"></i>
                </a>
            </header>
            <div class="page-heading">
            <section class="section section-post">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="main-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


                <nav class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a> &gt;
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category = $categories[0];
                        echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> &gt; ';
                    }
                    ?>
                    <span>
                        <?php 
                        $title = wp_trim_words(get_the_title(), 6, '...');
                        echo $title; 
                        ?>
                    </span>
                </nav>
                <!-- Post Title -->
                <h1 class="post-title"><?php the_title(); ?></h1>

                <!-- Post Meta Information -->
                <div class="post-meta">
                    <?php if (get_theme_mod('show_post_author', true)) : ?>
                        <span class="post-author">
                            <span class="author-badge-check">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9.99999" cy="9.99999" r="5.29412" fill="white"></circle>
                        <path d="M16.6375 7.10082C16.6567 6.95582 16.6667 6.81082 16.6667 6.66666C16.6667 4.68416 14.8809 3.09332 12.8992 3.36249C12.3217 2.33499 11.2217 1.66666 10 1.66666C8.77835 1.66666 7.67835 2.33499 7.10085 3.36249C5.11502 3.09332 3.33335 4.68416 3.33335 6.66666C3.33335 6.81082 3.34335 6.95582 3.36252 7.10082C2.33502 7.67916 1.66669 8.77916 1.66669 9.99999C1.66669 11.2208 2.33502 12.3208 3.36252 12.8992C3.3433 13.0431 3.33355 13.1881 3.33335 13.3333C3.33335 15.3158 5.11502 16.9025 7.10085 16.6375C7.67835 17.665 8.77835 18.3333 10 18.3333C11.2217 18.3333 12.3217 17.665 12.8992 16.6375C14.8809 16.9025 16.6667 15.3158 16.6667 13.3333C16.6667 13.1892 16.6567 13.0442 16.6375 12.8992C17.665 12.3208 18.3334 11.2208 18.3334 9.99999C18.3334 8.77916 17.665 7.67916  16.6375 7.10082ZM9.12919 13.68L6.07335 10.585L7.26002 9.41499L9.14085 11.32L12.7467 7.74166L13.92 8.92499L9.12919 13.68V13.68Z" fill="#568AF5"></path>
                         </svg>
                            </span>
                            <?php the_author(); ?>
                        </span>
                    <?php endif; ?>
                    <?php if (get_theme_mod('show_post_date', true)) : ?>
                        <span>/</span>
                        <span class="post-date"><?php the_date(); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Thumbnail / Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Post Content -->
                <div class="post-content" style="color: <?php echo esc_attr(get_theme_mod('single_post_content_color', '#333333')); ?>; font-size: <?php echo esc_attr(get_theme_mod('single_post_content_font_size', '16')) . 'px;'; ?>">
                    <?php the_content(); ?>
                </div>
                
                <!-- Post Tags -->
                <div class="post-tags">
                    <?php the_tags('<p>Tags: ', ' ', '</p>'); ?>
                </div>
            </article>
            
            <!-- Navigation for Previous and Next Post -->
            <div class="post-navigation">
                <div class="nav-previous"><?php previous_post_link('%link', 'Previous Post'); ?></div>
                <div class="nav-next"><?php next_post_link('%link', 'Next Post'); ?></div>
            </div>
            
            <!-- Author Bio -->
            <div class="author-bio">
                <div class="author-info">
                    <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                    <div class="author-description">
                        <h4><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></h4>
                        <p><?php the_author_meta('description'); ?></p>
                    </div>
                </div>
            </div>

            <?php
            // Mendapatkan kategori dari post saat ini
            $current_post_id = get_the_ID();
            $categories = wp_get_post_categories($current_post_id);

            if ($categories) {
                // Menyiapkan query untuk artikel terkait
                $related_args = array(
                    'category__in' => $categories,        // Berdasarkan kategori yang sama
                    'post__not_in' => array($current_post_id),  // Tidak termasuk post saat ini
                    'posts_per_page' => 3,               // Jumlah artikel terkait yang ingin ditampilkan
                    'orderby' => 'rand',                 // Acak
                );

                $related_query = new WP_Query($related_args);

                // Memeriksa apakah ada post terkait
                if ($related_query->have_posts()) {
                    echo '<div class="related-posts">';
                    echo '<h3>Artikel Terkait</h3>';
                    echo '<div class="related-articles-grid">';

                    while ($related_query->have_posts()) : $related_query->the_post(); ?>
                        <div class="article-item">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="article-thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                <h4 class="article-title"><?php the_title(); ?></h4>
                            </a>
                        </div>
                    <?php endwhile;

                    echo '</div>';
                    echo '</div>';
                }
                wp_reset_postdata();
            }
            ?>

            <?php
            if (get_theme_mod('show_post_comments', true) && (comments_open() || get_comments_number())) {
                comments_template(); // This will include the comments.php file
            }
            ?>

        <?php endwhile; else : ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>


   </section>
        </div>
<?php get_footer(); ?>
