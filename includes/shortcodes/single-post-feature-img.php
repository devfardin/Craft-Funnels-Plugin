<?php
function render_cf_single_post_feature_image(){
    ob_start();
?>

<div class='cf_single_post_feature_image'>
    <style>
        .cf_single_post_feature_image .attachment-medium_large{
            border-radius:20px ;
            width: 100%;
        }
    </style>
    <?php if( is_single() ) : ?>
        <?php echo the_post_thumbnail('medium_large'); ?>
    <?php endif; ?>
</div>
<?php
return ob_get_clean();
}
add_shortcode('cf_single_post_feature_image', 'render_cf_single_post_feature_image');