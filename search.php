<?php
if( osc_count_items() == 0 || stripos($_SERVER['REQUEST_URI'], 'search') ) {
    osc_add_hook('header','drizzle_noFollowConstruct');
} else {
    osc_add_hook('header','drizzle_followConstruct');
}
drizzle_addBodyClass('search');

osc_current_web_theme_path('header.php'); ?>

<main>
    <section class="jumbotron pt-4 pb-4">
        <div class="container">
            <h2 class="mb-0"><?php echo search_title(); ?></h2>
            <?php if(osc_count_items() > 0) { ?>
            <span class="counter-search text-muted">
                <?php $search_number = drizzle_searchNumber();
                printf(__('%1$d - %2$d of %3$d listings', 'bender'), $search_number['from'], $search_number['to'], $search_number['of']); ?>
            </span>
            <?php } ?>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <?php osc_current_web_theme_path('search-sidebar.php'); ?>
                <div class="col-9">
                    <?php $i = 0;
                    osc_get_premiums();
                    if(osc_count_premiums() > 0) {
                        echo '<h5>'.__('Premium listings','bootstrap').'</h5>';
                        View::newInstance()->_exportVariableToView("listType", 'premiums');
                        View::newInstance()->_exportVariableToView("listClass",$listClass.' premium-list');
                        osc_current_web_theme_path('loop.php');
                        echo '<div style="clear:both;"></div><br/>';
                    } ?>

                    <?php if(osc_count_items() > 0) {
                        echo '<h5>'.__('Listings','bootstrap').'</h5>';
                        View::newInstance()->_exportVariableToView("listType", 'items');
                        View::newInstance()->_exportVariableToView("listClass",$listClass);
                        osc_current_web_theme_path('loop.php');
                    ?>

                    <div class="paginate mt-4">
                        <?php echo osc_search_pagination(); ?>
                    </div>

                    <?php } else { ?>
                        <p class="empty" ><?php printf(__('There are no results matching "%s"', 'bender'), osc_search_pattern()) ; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php osc_current_web_theme_path('footer.php') ; ?>