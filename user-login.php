<?php
osc_add_hook('header','drizzle_noFollowConstruct');
drizzle_addBodyClass('login');

osc_current_web_theme_path('header.php'); ?>

<main>
    <div class="container">
        Login
    </div>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>