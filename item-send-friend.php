<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('item-sendtofriend');

osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container">
            <h2><?php _e('Send to friend', 'bootstrap'); ?></h2>
            <p class="lead"><?php echo osc_item_title(); ?></p>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="form-container w-50">
                <ul id="error_list"></ul>
                <form name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="action" value="send_friend_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                    <?php if(osc_is_web_user_logged_in()) { ?>
                                    <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                    <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
                    <?php } else { ?>
                    <div class="form-group">
                        <label for="yourName"><?php _e("Your name",'bootstrap'); ?></label>
                        <?php SendFriendForm::your_name(); ?>
                    </div>
                    <div class="form-group">
                        <label for="yourEmail"><?php _e("Your e-mail",'bootstrap'); ?></label>
                        <?php SendFriendForm::your_email(); ?>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="friendName"><?php _e("Your friend's name",'bootstrap'); ?></label>
                        <?php SendFriendForm::friend_name(); ?>
                    </div>
                    <div class="form-group">
                        <label for="friendEmail"><?php _e("Your friend's e-mail address", 'bender'); ?></label> </label>
                        <?php SendFriendForm::friend_email(); ?>
                    </div>
                    <div class="form-group">
                        <label for="subject"><?php _e('Subject', 'bootstrap'); ?> <span class="text-muted">(<?php _e('optional', 'bootstrap'); ?>)</span></label>
                        <?php ContactForm::the_subject(); ?>
                    </div>
                    <div class="form-group">
                        <label for="message"><?php _e('Message', 'bootstrap'); ?></label>
                        <?php SendFriendForm::your_message(); ?>
                    </div>
                    <?php osc_run_hook('contact_form'); ?>
                    <?php osc_show_recaptcha(); ?>
                    
                    <button type="submit" class="btn btn-primary"><?php _e("Send", 'bootstrap');?></button>
                    <?php osc_run_hook('admin_contact_form'); ?>
                </form>
                <?php SendFriendForm::js_validation(); ?>
            </div>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php'); ?>