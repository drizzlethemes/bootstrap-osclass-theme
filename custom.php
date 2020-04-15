<?php 
drizzle_addBodyClass('page custom');
osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="mt-5 mb-5">
		<?php osc_render_file(); ?>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>