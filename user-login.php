<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('login');

osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="jumbotron pt-4 pb-4">
        <div class="container text-center">
            <h2><?php _e('Login', 'bootstrap'); ?></h2>
            <p class="lead"><?php _e('Access to your account', 'bootstrap'); ?></p>
        </div>
    </section>

    <section class="mt-5 mb-5 pt-5 pb-5">
        <div class="container">
            <div class="form-container w-50 mx-auto">
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login_post" />

                    <div class="form-group">
                        <label class="control-label" for="email"><?php _e('E-mail', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::email_login_text(); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password"><?php _e('Password', 'bootstrap'); ?></label>
                        <div class="controls">
                            <?php UserForm::password_login_text(); ?>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <?php UserForm::rememberme_login_checkbox();?>
                        <label for="remember"><?php _e('Remember me', 'bootstrap'); ?></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php _e("Log in", 'bootstrap');?></button>
                    </div>
                    <div class="actions">
                        <a href="<?php echo osc_register_account_url(); ?>"><?php _e("Register for a free account", 'bootstrap'); ?></a><br /><a href="<?php echo osc_recover_user_password_url(); ?>"><?php _e("Forgot password?", 'bootstrap'); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php'); ?>