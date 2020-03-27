<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');

$pageClass = 'page '.osc_static_page_slug();
drizzle_addBodyClass($pageClass);

osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container">
            <h2><?php echo osc_static_page_title(); ?></h2>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <?php echo osc_static_page_text(); ?>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>