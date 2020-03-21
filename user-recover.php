<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('recover-password');

// Custom meta title
osc_add_filter('meta_title_filter', 'drizzle_customMetaTitle');
function drizzle_customMetaTitle($data){
    return __('Recover password', 'bootstrap').' - '.osc_page_title();
}

osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="jumbotron pt-4 pb-4">
        <div class="container text-center">
            <h2><?php _e('Recover password', 'bootstrap'); ?></h2>
        </div>
    </section>

    <section class="mt-5 mb-5 pt-5 pb-5">
        <div class="container">
            <div class="form-container w-50 mx-auto">
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                <input type="hidden" name="page" value="login" />
                <input type="hidden" name="action" value="recover_post" />
                <div class="form-group">
                    <label for="email"><?php _e('E-mail', 'bootstrap'); ?></label>
                    <?php UserForm::email_text(); ?>
                </div>
                <?php osc_show_recaptcha('recover_password'); ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><?php _e("Send a new password", 'bootstrap');?></button>
                </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>