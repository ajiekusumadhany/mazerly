<?php get_header(); ?>
<main id="main">
<header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <section class="section">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="main-page" id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

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
                <h1 class="page-title"><?php the_title(); ?></h1>

                <!-- Thumbnail / Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <!-- page Content -->
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
                
            </article>
        <?php endwhile; endif; ?>

   </section>

<?php get_footer(); ?>
