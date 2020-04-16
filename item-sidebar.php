<div id="sidebar">
    <?php if(!osc_is_web_user_logged_in() || osc_logged_user_id()!=osc_item_user_id()) { ?>
    <div class="card mb-4">
        <div class="card-body p-2 alert alert-warning mb-0">
            <form action="<?php echo osc_base_url(true); ?>" method="post" name="mask_as_form" id="mask_as_form">
                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                <input type="hidden" name="as" value="spam" />
                <input type="hidden" name="action" value="mark" />
                <input type="hidden" name="page" value="item" />
                <select name="as" id="as" class="mark_as">
                        <option><?php _e("Mark as...", 'bootstrap'); ?></option>
                        <option value="spam"><?php _e("Mark as spam", 'bootstrap'); ?></option>
                        <option value="badcat"><?php _e("Mark as misclassified", 'bootstrap'); ?></option>
                        <option value="repeated"><?php _e("Mark as duplicated", 'bootstrap'); ?></option>
                        <option value="expired"><?php _e("Mark as expired", 'bootstrap'); ?></option>
                        <option value="offensive"><?php _e("Mark as offensive", 'bootstrap'); ?></option>
                </select>
            </form>
        </div>
    </div>
    <?php } ?>

    <?php if( osc_get_preference('sidebar-300x250', 'bootstrap') != '') {?>
    <!-- sidebar ad 350x250 -->
    <div class="ads_300">
        <?php echo osc_get_preference('sidebar-300x250', 'bootstrap'); ?>
    </div>
    <!-- /sidebar ad 350x250 -->
    <?php } ?>
    <div class="card mb-4">
        <h6 class="card-header"><?php _e("Contact publisher", 'bootstrap'); ?></h6>
        <div class="card-body">
        <?php if( osc_item_is_expired () ) { ?>
            <p class="alert alert-danger">
                <?php _e("The listing is expired. You can't contact the publisher.", 'bootstrap'); ?>
            </p>
        <?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
            <p class="alert alert-info">
                <?php _e("It's your own listing, you can't contact the publisher.", 'bootstrap'); ?>
            </p>
        <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
            <p class="alert alert-warning">
                <?php _e("You must log in or register a new account in order to contact the advertiser", 'bootstrap'); ?>

            </p>
            <p class="buttons">
            <a class="btn btn-block btn-sm btn-info" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'bootstrap'); ?></a>
            <a class="btn btn-block btn-sm btn-info" href="<?php echo osc_register_account_url(); ?>"><?php _e('Register', 'bootstrap'); ?></a></p>
        <?php } else { ?>
            <?php if( osc_item_user_id() != null ) { ?>
                <label><?php _e('Name', 'bootstrap') ?>:</label>
                <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a>
            <?php } else { ?>
                <label><?php _e('Name', 'bootstrap') ?>:</label>
                <?php echo osc_item_contact_name(); ?>
            <?php } ?>
            <?php if( osc_item_show_email() ) { ?>
                <p class="email"><?php printf(__('E-mail: %s', 'bootstrap'), osc_item_contact_email()); ?></p>
            <?php } ?>
            <?php if ( osc_user_phone() != '' ) { ?>
                <p class="phone"><?php printf(__("Phone: %s", 'bootstrap'), osc_user_phone()); ?></p>
            <?php } ?>
            <ul id="error_list"></ul>
            <form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form" <?php if(osc_item_attachment()) { echo 'enctype="multipart/form-data"'; };?> >
                <?php osc_prepare_user_info(); ?>
                 <input type="hidden" name="action" value="contact_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                <div class="form-group">
                    <label for="yourName"><?php _e('Your name', 'bootstrap'); ?>:</label>
                    <?php ContactForm::your_name(); ?>
                </div>
                <div class="form-group">
                    <label for="yourEmail"><?php _e('Your e-mail address', 'bootstrap'); ?>:</label>
                    <?php ContactForm::your_email(); ?>
                </div>
                <div class="form-group">
                    <label for="phoneNumber"><?php _e('Phone number', 'bootstrap'); ?> (<?php _e('optional', 'bootstrap'); ?>):</label>
                    <?php ContactForm::your_phone_number(); ?>
                </div>

                <div class="form-group">
                    <label for="message"><?php _e('Message', 'bootstrap'); ?>:</label>
                    <?php ContactForm::your_message(); ?>
                </div>

                <?php if(osc_item_attachment()) { ?>
                    <div class="form-group">
                        <label for="attachment"><?php _e('Attachment', 'bootstrap'); ?>:</label>
                        <?php ContactForm::your_attachment(); ?>
                    </div>
                <?php }; ?>

                <?php osc_run_hook('item_contact_form', osc_item_id()); ?>
                <?php osc_show_recaptcha(); ?>
                <button type="submit" class="btn btn-primary btn-block"><?php _e("Send", 'bootstrap');?></button>
            </form>
            <?php ContactForm::js_validation(); ?>
        <?php } ?>
        </div>
    </div>
</div><!-- /sidebar -->
