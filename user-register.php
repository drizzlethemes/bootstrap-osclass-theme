<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('login');

// Custom meta title
osc_add_filter('meta_title_filter', 'drizzle_customMetaTitle');
function drizzle_customMetaTitle($data){
    return __('Register', 'bootstrap').' - '.osc_page_title();
}

osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php') ;
?>
<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container text-center">
            <h2><?php _e('Register', 'bootstrap'); ?></h2>
            <p class="lead"><?php _e('Create an account for free', 'bootstrap'); ?></p>
        </div>
    </section>

    <section class="mt-5 mb-5 pt-5 pb-5">
        <div class="container">
            <div class="form-container w-50 mx-auto">
                <form name="register" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="register" />
                    <input type="hidden" name="action" value="register_post" />
                    <ul class="list-unstyled" id="error_list"></ul>
                    <div class="form-group">
                        <label class="control-label" for="name"><?php _e('Name', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::name_text(); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_text(); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password"><?php _e('Password', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::password_text(); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password-2"><?php _e('Repeat password', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::check_password_text(); ?>
                            <p id="password-error" style="display:none;">
                                <?php _e("Passwords don't match", 'bootstrap'); ?>
                            </p>
                        </div>
                    </div>
                    <?php osc_run_hook('user_register_form'); ?>
                    <div class="form-group">
                        <div class="controls">
                            <?php osc_show_recaptcha('register'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php _e("Create", 'bootstrap'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php UserForm::js_validation(); ?>
<?php osc_current_web_theme_path('footer.php'); ?>