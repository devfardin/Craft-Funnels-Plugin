<?php
function cf_render_single_post_comments(){
    ob_start(); ?>
    <div class='cf_single_post_comments'>
        <style>
            .comment-form label {
                color: var(--Black, #010101);
                font-family: Gilroy;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 28px; /* 155.556% */
            }

            .comment-form input,textarea {
                border-radius: 8px;
                border: 1px solid rgba(0, 0, 0, 0.10);
                background: rgba(0, 0, 0, 0.05);
                color: #6a6969;
                font-family: Gilroy;
                font-size: 18px;
                font-style: normal;
                font-weight: 400;
                line-height: 28px; /* 155.556% */
                padding: 10px 20px;
                outline:none;
            }

            p.comment-form-author, .comment-form-email, .comment-form-url {
                display: flex;
                flex-direction: column;
                gap: 6px;

            }

            .comment-form .submit {
                display: flex;
                padding: 16px 50px;
                justify-content: center;
                color:#ffffff;
                align-items: center;
                border-radius: 8px;
                background: #298D06;
                border:1px solid #298D06;
                transition: all .3s;
            }
            .comment-form .submit:hover{
                color: #fff;
                opacity: 1;
                border:1px solid #85B303;
                background: #85B303;
            }
            .comment-author.vcard {
                display: flex;
                align-items: center;
                gap: 11px;
            }

            .comment-author.vcard .fn a {
                color: #010101c4;
                font-family: Gilroy;
                font-size: 21px;
                font-style: normal;
                font-weight: 500;
                line-height: 30px; /* 125% */
            }
            .comment-author.vcard img {
                border-radius: 50%;
            }
            .comment-metadata a {
                color: #010101c7;
                font-family: Gilroy;
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
                line-height: 30px; /* 125% */
            }
        </style>

        <?php
            // global $post;
            // var_dump( $post );
        ?>
        <?php  comments_template('/comments.php', true ); ?>

    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cf_single_post_comments', 'cf_render_single_post_comments');

function set_my_comment_title( $defaults ){
    $defaults['title_reply'] = __('Comments  here', 'customizr-child');
    return $defaults;
   }
add_filter('comment_form_defaults', 'set_my_comment_title', 20);
