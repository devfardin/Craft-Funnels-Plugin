<?php
function render_social_post_share(){
    ob_start(); ?>

    <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink();?>" title="Share on Facebook." target="_blank"> <img src="/img/facebook-blue.png" alt="Share this on facebook!" /></a>

<?php
 return ob_get_clean();
}
add_shortcode( 'social_post_share', 'render_social_post_share');