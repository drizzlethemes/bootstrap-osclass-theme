<?php if( osc_comments_enabled() ) { ?>
    <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
    <div id="comments" class="mt-4">
        <h3><?php _e('Comments', 'bootstrap'); ?></h3>
        <ul class="m-0 " id="comment_error_list"></ul>
        <?php CommentForm::js_validation(); ?>
        <?php if( osc_count_item_comments() >= 1 ) { ?>
            <div class="comments_list">
                <?php while ( osc_has_item_comments() ) { ?>
                    <div class="comment bg-light border rounded mt-3 p-3">
                        <div class="comment-inner">
                            <h5 class="mt-0 mb-0"><?php echo osc_comment_title(); ?></h5>
                            <em class="text-muted"><?php _e("by", 'bootstrap'); ?> <strong><?php echo osc_comment_author_name(); ?></strong></em>
                            <hr>
                            <div class="pt-3 pb-3"><?php echo nl2br( osc_comment_body() ); ?> </div>
                            <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                            <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', 'bootstrap'); ?>"><?php _e('Delete', 'bootstrap'); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="paginate">
                    <?php echo osc_comments_pagination(); ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="no-comments mb-5 mt-4 text-muted">
                <?php _e('There are no comments yet.', 'bootstrap'); ?>
            </div>
        <?php } ?>
        <div class="bg-light border rounded pt-3 pl-5 pr-5 pb-5">
            <h3 class="mb-4"><?php _e('Leave a comment', 'bootstrap'); ?></h3>
            <div class="alert alert-warning">
                <?php _e('Leave your comment (spam and offensive messages will be removed)', 'bootstrap'); ?>
            </div>
            <div class="resp-wrapper">
                <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                    <input type="hidden" name="action" value="add_comment" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                    <?php if(osc_is_web_user_logged_in()) { ?>
                        <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                        <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                    <?php } else { ?>
                        <div class="form-group">
                            <label for="authorName"><?php _e('Your name', 'bootstrap'); ?></label>
                            <?php CommentForm::author_input_text(); ?>
                        </div>
                        <div class="form-group">
                            <label for="authorEmail"><?php _e('Your e-mail', 'bootstrap'); ?></label>
                            <?php CommentForm::email_input_text(); ?>
                        </div>
                    <?php }; ?>
                    <div class="form-group">
                        <label for="title"><?php _e('Title', 'bootstrap'); ?></label>
                        <?php CommentForm::title_input_text(); ?>
                    </div>
                    <div class="form-group">
                        <label for="body"><?php _e('Comment', 'bootstrap'); ?></label>
                        <?php CommentForm::body_input_textarea(); ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php _e('Send', 'bootstrap'); ?></button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>