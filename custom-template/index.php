<!-- <?php echo get_template_directory_uri(); ?>
http://localhost/wordpress-custom/wp-content/themes/nik-template1 -->

<?php
get_header();
?>

<div id="content" class="site-content">
    <div class="blog-container">
        <div class="blog-wholebox">
            <div id="primary" class="blog-content-area primary ast-grid-3 ast-grid-md-1 ast-grid-sm-1">
                <div class="my-3 blog-tag-sec">
                    <div class="mx-2">
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">All(<?php echo wp_count_posts()->publish; ?>)</a>
                    </div>
                    <?php
                    // $tags = get_the_tags();   // only fetch tags associated with the current post(s), 
                    // $tags = wp_get_post_terms(get_the_ID(), 'post_tag');   // only fetch tags associated with the current post(s), 
                    $tags = get_tags(['hide_empty' => false]);    // shows all tags even if no post is linked to it
                    $tags = get_tags();
                    // echo '<pre>';   print_r($tags); echo '</pre>';
                    if ($tags) {
                        foreach ($tags as $tag) {
                            echo '<div class="mx-2">
                                    <a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '(' . $tag->count . ')</a>
                                </div>';
                        }
                    }
                    ?>
                </div>
                <div class="p-5 blog-items" id="blog-main">
                    <div class="row">
                        <?php
                        while (have_posts()) {
                            the_post();

                            $thumbnail_path = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            // print_r($thumbnail_path);

                            // Get the post content and word count
                            $content = strip_tags(get_the_content());
                            $word_count = str_word_count($content);
                            $reading_time = ceil($word_count / 200); // Assuming 200 words per minute

                        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="card blog-card">
                                    <div class="mb-2">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="https://www.conversios.io/wp-content/uploads/2025/02/Why-Conversios-Is-the-Best-Choice-for-Server-Side-Tagging-for-WooCommerce-1024x576.png" class="card-img-top" alt="Blog Image">
                                            <!-- <img src="<?php echo $thumbnail_path[0]; ?>" class="card-img-top" alt="<?php the_title(); ?>"> -->
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php the_title(); ?></h5>
                                        <p class="card-text"><?php the_excerpt(); ?></p>
                                        <div class="blog-meta">
                                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                                            <span class="read-time">🕒 <?php echo $reading_time; ?> min<?php echo ($reading_time > 1) ? 's' : ''; ?> of reading</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="pagination">
                    <?php echo wp_pagenavi(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>