<?php get_header(); ?>
<main id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                
            </header>
            <section class="section">

            <?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => get_theme_mod('posts_per_page', 9), // Jumlah post per halaman
    'paged'          => $paged, // Halaman yang akan ditampilkan
);

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
    <ul class="post-list">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
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
                    echo '<p>in <a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></p>'; // Menampilkan kategori pertama dengan link
                }
                ?>
            </div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php echo mb_substr(get_the_excerpt(), 0, 75) . '...'; ?></p>               
                <span class="updt-post">
                    <div class="update-post-date">
                        <p>Updated</p>
                    </div>
                    <?php 
                    $modified_date = get_the_modified_time('U');
                    if ($modified_date) {
                        echo date('M j, Y', $modified_date);
                    } else {
                        echo "No update date available";
                    }
                    ?>
                </span>
            </li>
        <?php endwhile; ?>
    </ul>

    <!--  Paginasi  -->
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total'        => $query->max_num_pages,
            'current'      => $paged,
            'prev_text'    => __('« Previous'),
            'next_text'    => __('Next »'),
        ));
        ?>
    </div>

<?php else : ?>
    <p>No posts found.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
   </section>
    </div>

<?php get_footer(); ?>
