<?php get_header(); ?>
<main id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <section class="section">
   <!-- Menampilkan nama kategori di atas daftar post -->
   <div class="category-title-container">
        <h1 class="category-title"><?php echo single_cat_title('', false); ?></h1>
    </div>
    <?php
// Mendapatkan objek tag saat ini
$current_tag = get_queried_object();
?>


<?php
// Query untuk menampilkan hanya postingan di tag saat ini
$args = array(
    'posts_per_page' => 9,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    'tag_id'         => $current_tag->term_id, // Filter berdasarkan tag saat ini
);

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
    <ul class="post-list">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <li class="post-item">
                <!-- Thumbnail Postingan -->
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </a>
                <?php endif; ?>

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

    <!-- Pagination -->
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total'        => $query->max_num_pages,
            'current'      => max(1, get_query_var('paged')),
            'prev_text'    => __('« Previous'),
            'next_text'    => __('Next »'),
        ));
        ?>
    </div>

<?php else : ?>
    <p>No posts found with this tag.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
   </section>
    </div>

<?php get_footer(); ?>
