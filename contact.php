<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('page contact');

osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container">
            <h2><?php _e('Contact', 'bootstrap'); ?></h2>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="form-container w-50">
                <ul id="error_list"></ul>
                <form name="contact_form" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="contact" />
                    <input type="hidden" name="action" value="contact_post" />
                    <div class="form-group">
                        <label for="yourName"><?php _e('Name', 'bootstrap'); ?>
                        <span class="text-muted">(<?php _e('optional', 'bootstrap'); ?>)</span></label>
                        <?php ContactForm::your_name(); ?>
                    </div>
                    <div class="form-group">
                        <label for="yourEmail"><?php _e('Email address', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php ContactForm::your_email(); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="subject">
                        <?php _e('Subject', 'bootstrap'); ?>
                        <span class="text-muted">(<?php _e('optional', 'bootstrap'); ?>)</span></label>
                        <?php ContactForm::the_subject(); ?>
                    </div>
                    <div class="form-group">
                        <label for="message"><?php _e('Message', 'bootstrap'); ?></label>
                        <?php ContactForm::your_message(); ?>
                    </div>
                    <?php osc_run_hook('contact_form'); ?>
                    <?php osc_show_recaptcha(); ?>
                    <button type="submit" class="btn btn-primary"><?php _e("Send", 'bootstrap');?></button>
                    <?php osc_run_hook('admin_contact_form'); ?>
                </form>
                <?php ContactForm::js_validation(); ?>
            </div>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>