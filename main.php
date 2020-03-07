<?php
osc_add_hook('header', 'drizzle_followConstruct');
drizzle_addBodyClass('home');

osc_current_web_theme_path('header.php'); ?>

<main>
	Home
</main>

<?php osc_current_web_theme_path('footer.php'); ?>