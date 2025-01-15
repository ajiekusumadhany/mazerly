
<?php
// WordPress Comment Section

?>

<div class="post-comments">
    <?php
    // Set comment date format
    if (!function_exists('custom_comment_date_format')) {
        function custom_comment_date_format($date, $d, $comment) {
            return mysql2date('d/m/Y', $comment->comment_date);
        }
        add_filter('get_comment_date', 'custom_comment_date_format', 10, 3);
    }

    // Load comments template
    if (have_comments()) {
        wp_list_comments();
    }

    // Comment form
    comment_form();
    ?>
</div>
