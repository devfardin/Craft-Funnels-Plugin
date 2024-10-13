<?php
function cf_render_most_popular_posts(){
    ob_start();
    wp_enqueue_style('most_popular_post');
        $popularpost  = new WP_Query(array(
            'posts_per_page' => 4,
            'post_type' => 'case-study',
            'post_status' => 'publish',
            'orderby' => 'meta_value_num',
            'meta_key' => 'post_views_count',
            'order' => 'DESC'

        ));
         ?>

        <section class="most_popular_posts_row">
                <?php if ($popularpost->have_posts()):
                    ?>
                        <?php while ($popularpost->have_posts()):
                            $popularpost->the_post(); ?>
                     <article class="most_popular_post">
                                <div class="popular_post_thumb">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"
                                        aria-label="More about <?php echo get_the_title(); ?>">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </a>
                                </div>

                                <div class="latest-posts__info">
                                    <div class='latest-posts__text'>
                                        <a href="<?php the_permalink(); ?>" class="most-popular-posts__post__title">
                                                <?php echo get_the_title(); ?>
                                        </a>

                                        <div>
                                            <?php
                                                $categories = get_the_terms( get_the_ID(), 'case-study-category' );
                                                if (is_array($categories) ) {
                                                $first_three_categories = array_slice($categories, 0, 1, false);
                                                foreach ($first_three_categories as $category) :
                                                    $link = get_term_link($category, 'category');?>
                                                    <a  class='portfolio_post_category' href="<?php echo esc_url($link) ?>"><?php echo esc_html($category->name) ?></a>
                                                <?php
                                                endforeach;  };  ?>
                                           </div>

                                           <div class='most_popular_post_info_box'>
                                                    <div class='most_popular_post_author_profile'>
                                                            <?php $author_id= get_the_author_meta('ID'); ?>

                                                            <a href="<?php  echo(get_author_posts_url( $author_id, get_the_author_meta('display_name', $author_id))); ?>" class='author_box'>
                                                                <img  class='most-popular-post__author_avatar' src="<?php echo get_avatar_url($author_id)?>" alt="<?php echo get_the_author_meta('display_name', $author_id) ?>"/>
                                                                <h3 class='auther_display_name'><?php
                                                                 $display_name=get_the_author_meta('display_name', $author_id);
                                                                echo  strlen($display_name) > 5 ? substr($display_name, 0, 5) . '..' : $display_name; ?>
                                                                 </h3>
                                                            </a>
                                                    </div>

                                                    <div class='post_published_time'>
                                                        <?php $post_time = get_post_time() ;?>
                                                        <h3> <?php echo date("M d, Y", $post_time ); ?> </h3>
                                                    </div>
                                           </div>

                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                <?php endif; ?>
        </section>
    <?php
    return  ob_get_clean();
}
add_shortcode( 'single_most_popular_posts', 'cf_render_most_popular_posts' );