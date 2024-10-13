<?php
function render_cf_searched_posts(){
    ob_start(); ?>

    <?php wp_enqueue_style('case-studies_style'); ?>

    <section class="studies-posts section_padding">
        <div class="container">
                <!-- check If have post on the search -->
                <?php if( have_posts() ): ?>
                <div class="studies-posts__row">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <article class="studies-posts__post">
                            <!-- Blog Post Thumbnail Image and post link -->
                            <div class="post__media">
                                <a href="<?php echo get_the_permalink(); ?>" rel="bookmark"
                                    aria-label="More about <?php echo get_the_title(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                            <div class="studies-posts__info">
                                <!-- Blog Post Title and post link -->
                                <a href='<?php echo get_the_permalink() ?>' class="studies-posts__post__title">
                                        <?php echo get_the_title(); ?>
                                </a>
                            </div>
                    </article>
                    <?php endwhile; ?>
                    <div class='wp-pagenavi' role='navigation'>
                            <?php
                            global $wp_query;
                            $big = 999999999; // need an unlikely integer
                            $translated = __( '', 'extracatchy' ); // Supply translatable string
                            echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages,
                                'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
                            ) ); ?>
                    </div>
                </div>
                <!-- if not have any post show this message -->
                <?php endif; //if( have_posts() ) ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('cf_searched_posts', 'render_cf_searched_posts');