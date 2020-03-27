<?php
if( osc_item_is_spam() || osc_premium_is_spam() ) {
    osc_add_hook('header', 'drizzle_noFollowConstruct');
} else {
    osc_add_hook('header', 'drizzle_followConstruct');
}
drizzle_addBodyClass('item-show');

/* Location */
$location = array();
if( osc_item_city_area() !== '' ) {
    $location[] = osc_item_city_area();
}
if( osc_item_city() !== '' ) {
    $location[] = osc_item_city();
}
if( osc_item_region() !== '' ) {
    $location[] = osc_item_region();
}
if( osc_item_country() !== '' ) {
    $location[] = osc_item_country();
}

//osc_enqueue_script('fancybox');
//osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container">
            <h2 class="font-weight-bold">
                <?php if( osc_price_enabled_at_items() ) { ?><span class="float-right font-weight-normal price"><?php echo osc_item_formated_price(); ?></span><?php } ?>
                <?php echo osc_item_title(); ?>
            </h2>
            <p class="text-muted">
                <?php if ( osc_item_pub_date() !== '' ) { printf( __('<strong class="publish">Published date</strong>: %1$s', 'bootstrap'), osc_format_date( osc_item_pub_date() ) ); } ?>
                &nbsp;&middot;&nbsp;
                <?php if ( osc_item_mod_date() !== '' ) { printf( __('<strong class="update">Modified date:</strong> %1$s', 'bootstrap'), osc_format_date( osc_item_mod_date() ) ); } ?>
            </p>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <!-- Images -->
                    <?php if( osc_images_enabled_at_items() ) {
                    if( osc_count_item_resources() > 0 ) { $i = 0; ?>
                    <div class="item-photos">
                        <a href="<?php echo osc_resource_url(); ?>" class="main-photo" title="<?php _e('Image', 'bootstrap'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                            <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                        </a>
                        <div class="thumbs">
                            <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                            <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php _e('Image', 'bootstrap'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    } ?>

                    <!-- Detail -->
                    <div class="item-description">
                        <?php echo osc_item_description(); ?>
                        <?php if( osc_count_item_meta() >= 1 ) { ?>
                        <div class="item-custom-fields">
                            <?php while ( osc_has_item_meta() ) { ?>
                                <?php if(osc_item_meta_value()!='') { ?>
                                    <div class="meta">
                                        <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>

                    <?php osc_run_hook('item_detail', osc_item() ); ?>

                    <div class="item-location">
                        <?php if (count($location)>0) { ?>
                            <strong><?php _e("Location", 'bootstrap'); ?></strong>: <?php echo implode(', ', $location); ?>
                        <?php } ?>
                        <?php osc_run_hook('location'); ?>
                    </div>

                    <?php if( osc_comments_enabled() ) { ?>
                        <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
                        <div id="comments">
                            <h4><?php _e('Comments', 'bootstrap'); ?></h4>
                            <ul class="m-0 " id="comment_error_list"></ul>
                            <?php CommentForm::js_validation(); ?>
                            <?php if( osc_count_item_comments() >= 1 ) { ?>
                                <div class="comments_list">
                                    <?php while ( osc_has_item_comments() ) { ?>
                                        <div class="comment">
                                            <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'bootstrap'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
                                            <p><?php echo nl2br( osc_comment_body() ); ?> </p>
                                            <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                                            <p>
                                                <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'bootstrap'); ?>"><?php _e('Delete', 'bootstrap'); ?></a>
                                            </p>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div class="paginate" style="text-align: right;">
                                        <?php echo osc_comments_pagination(); ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-container form-horizontal">
                                <div class="header">
                                    <p><?php _e('Leave your comment (spam and offensive messages will be removed)', 'bootstrap'); ?></p>
                                </div>
                                <div class="resp-wrapper">
                                    <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                                        <fieldset>

                                            <input type="hidden" name="action" value="add_comment" />
                                            <input type="hidden" name="page" value="item" />
                                            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                            <?php if(osc_is_web_user_logged_in()) { ?>
                                                <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                                <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                                            <?php } else { ?>
                                                <div class="control-group">
                                                    <label class="control-label" for="authorName"><?php _e('Your name', 'bootstrap'); ?></label>
                                                    <div class="controls">
                                                        <?php CommentForm::author_input_text(); ?>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="authorEmail"><?php _e('Your e-mail', 'bootstrap'); ?></label>
                                                    <div class="controls">
                                                        <?php CommentForm::email_input_text(); ?>
                                                    </div>
                                                </div>
                                            <?php }; ?>
                                            <div class="control-group">
                                                <label class="control-label" for="title"><?php _e('Title', 'bootstrap'); ?></label>
                                                <div class="controls">
                                                    <?php CommentForm::title_input_text(); ?>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="body"><?php _e('Comment', 'bootstrap'); ?></label>
                                                <div class="controls textarea">
                                                    <?php CommentForm::body_input_textarea(); ?>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit"><?php _e('Send', 'bootstrap'); ?></button>
                                            </div>

                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="col-3">
                </div>
            </div>
        </div>
    </section>
</main>
<?php osc_current_web_theme_path('footer.php'); ?>
