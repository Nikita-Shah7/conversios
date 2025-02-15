<?php
get_header();
the_post();
?>

<?php
$thumbnail_path = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
// print_r($thumbnail_path);

// removes images, bold text, subheadings, etc.
$content = strip_tags(get_the_content());
// Get the word count
$word_count = str_word_count($content);
$reading_time = ceil($word_count / 200); // Assuming 200 words per minute
?>


<div id="content" class="site-content">
    <div class="single-blog-container">
        <div class="blog-image">
            <img src="<?php echo $thumbnail_path[0]; ?>" alt="<?php the_title(); ?>">
        </div>
        <div class="single-blog-content">
            <h2><?php the_title(); ?></h2>
            <h4><?php the_author(); ?></h4>
            <div>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>