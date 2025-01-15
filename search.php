<?php get_header(); ?>
<main id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <section class="section">
            <div class="title-search-container">
    <div class="title-search">
    <h2><?php printf(__('Hasil pencarian untuk:')); ?></h2>
    <p><?php echo sprintf('"%s"', get_search_query()); ?></p>
    </div>
    </div>

    <?php if (have_posts()) : ?>
        <ul class="post-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large', array('srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'large'))); ?>
                        </a>
                    <?php endif; ?>

                    <!-- Menampilkan kategori utama -->
                    <div class="post-category">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<p>in <a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></p>';
                        }
                        ?>
                    </div>

                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                    <span>
                        <div class="update-post-date">
                            <p>Updated</p>
                        </div>
                        <?php echo date('M j, Y', strtotime(get_the_modified_date())); ?>
                    </span>
                </li>
            <?php endwhile; ?>
        </ul>

        <!-- Paginasi -->
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total'        => $wp_query->max_num_pages,
                'current'      => max(1, get_query_var('paged')),
                'prev_text'    => __('« Previous'),
                'next_text'    => __('Next »'),
            ));
            ?>
        </div>

    <?php else : ?>
        <p>No posts found for "<strong><?php echo get_search_query(); ?></strong>". Try another search.</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

   </section>
    </div>

<?php get_footer(); ?>
