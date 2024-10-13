<?php
function rander_cf_plugin_case_studies() {
    ob_start(); ?>

    <?php
        wp_enqueue_style('case-studies_style');
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'case-study',
            'post_status' => 'publish',
            'paged' => $paged,
        );
        $query = new \WP_Query($args);
    ?>

<section class="studies-posts">
             <div class="container">
                  <?php if ($query->have_posts()): ?>
                    <div class="studies-posts__row">
                     <?php while ($query->have_posts()):
                         $query->the_post(); ?>

                    <article class="studies-posts__post">
                             <div class="lastes-post__media">
                                    <a href="<?php echo get_the_permalink(); ?>" rel="bookmark"
                                        aria-label="More about <?php echo get_the_title(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                             </div>

                             <div class='studies-posts__info'>
                                    <div class='post_category'>
                                            <!-- Sliced first 2 category name  -->
                                            <?php
                                                $categories = get_the_terms( get_the_ID(), 'case-study-category' );
                                                if($categories){
                                                    $first_three_categories = array_slice($categories, 0, 1, false);
                                                    foreach ($first_three_categories as $category) :
                                                        $link = get_term_link($category, 'case-study-category');?>
                                                        <a class='blog_post_category' href="<?php echo esc_url($link) ?>"><?php echo esc_html($category->name) ?></a>
                                                        <?php
                                                    endforeach;
                                                 }
                                               ?>
                                    </div>

                                    <div>
                                        <?php $post_time = get_post_time() ;?>
                                        <a class='studies_date_time'> <?php echo date("d M Y", $post_time ); ?> </a>
                                    </div>


                             </div>



                            <div class="studies-posts__info">

                                <div class='studies-posts__text'>
                                    <h3 class="studies-posts__post__title">
                                        <?php echo substr(get_the_title(), 0, 35) . '...'; ?>
                                    </h3>
                                </div>

                                <a class="studies-posts__post__btn" href="<?php the_permalink(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7326 0.886719L15.4158 2.47055C15.1456 3.82218 14.7489 5.94315 14.6171 8.25066C14.4843 10.5745 14.627 12.9895 15.3677 14.9645C15.5792 15.5286 15.2933 16.1574 14.7293 16.3689C14.1651 16.5805 13.5363 16.2947 13.3247 15.7305C12.429 13.3419 12.2989 10.5751 12.4388 8.12619C12.4924 7.18955 12.5864 6.28503 12.6976 5.44799L2.02664 16.1189C1.60062 16.5449 0.909888 16.5449 0.483862 16.1189C0.0578359 15.6928 0.0578359 15.0021 0.483862 14.5761L11.1829 3.87707C10.2483 4.0004 9.23658 4.10602 8.20269 4.16398C5.72964 4.30266 2.97447 4.18028 0.825522 3.25931C0.271743 3.02197 0.0152148 2.38065 0.252547 1.82687C0.489881 1.2731 1.1312 1.01657 1.68498 1.2539C3.35422 1.96929 5.68994 2.11964 8.08053 1.98559C10.4385 1.85337 12.6993 1.45547 14.1451 1.18438L15.7326 0.886719Z" fill="#010101"/>
                                    </svg>
                                </a>

                            </div>


                         </article>

                     <?php
                 endwhile; ?>
                     <?php wp_reset_postdata(); ?>
                 </div>
                 <div class='wp-pagenavi' role='navigation'>

                        <?php
                        $big = 999999999; // need an unlikely integer
                        $translated = __( '', 'extracatchy' ); // Supply translatable string
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $query->max_num_pages,
                                'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
                        ) ); ?>
                    </div>

             <?php else :  ?>
                <h1 class='studies_no_post_message'> No posts are available at the moment </h1>
                <?php
                endif;
                ?>

         </div>
     </section>

     <?php
     return ob_get_clean();
}
add_shortcode('case_studies', 'rander_cf_plugin_case_studies');
