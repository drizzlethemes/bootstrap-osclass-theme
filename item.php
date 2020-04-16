<?php
if( osc_item_is_spam() || osc_premium_is_spam() ) {
    osc_add_hook('header', 'drizzle_noFollowConstruct');
} else {
    osc_add_hook('header', 'drizzle_followConstruct');
}
drizzle_addBodyClass('item-show');

/* Location */
$location = array();
if( osc_item_city_area() !== '' ) {
    $location[] = osc_item_city_area();
}
if( osc_item_city() !== '' ) {
    $location[] = osc_item_city();
}
if( osc_item_region() !== '' ) {
    $location[] = osc_item_region();
}
if( osc_item_country() !== '' ) {
    $location[] = osc_item_country();
}

//osc_enqueue_script('fancybox');
//osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php'); ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container">
            <h2 class="item-title">
                <?php if( osc_price_enabled_at_items() ) { ?>
                    <span class="float-right text-primary price"><?php echo osc_item_formated_price(); ?></span>
                <?php } ?>
                <?php echo osc_item_title(); ?>
            </h2>
            <p class="text-muted">
                <?php if ( osc_item_pub_date() !== '' ) { printf( __('<strong class="publish_date">Published date</strong>: %1$s', 'bootstrap'), osc_format_date( osc_item_pub_date() ) ); } ?>
                <?php if ( osc_item_mod_date() !== '' ) { ?>
                &nbsp;&middot;&nbsp;
                <?php printf( __('<strong class="publish_update">Modified date:</strong> %1$s', 'bootstrap'), osc_format_date( osc_item_mod_date() ) ); } ?>
            </p>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <!-- Images -->
                    <?php if( osc_images_enabled_at_items() ) {
                    if( osc_count_item_resources() > 0 ) { $i = 0; ?>
                    <div class="item-photos mb-4">
                        <a href="<?php echo osc_resource_url(); ?>" class="main-photo" title="<?php _e('Image', 'bootstrap'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                            <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                        </a>
                        <div class="thumbs">
                            <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                            <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php _e('Image', 'bootstrap'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
                                <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" />
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    } ?>

                    <!-- Detail -->
                    <div class="item-description">
                        <?php echo osc_item_description(); ?>
                        <?php if( osc_count_item_meta() >= 1 ) { ?>
                        <div class="item-custom-fields">
                            <?php while ( osc_has_item_meta() ) { ?>
                                <?php if(osc_item_meta_value()!='') { ?>
                                    <div class="meta">
                                        <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>

                    <?php osc_run_hook('item_detail', osc_item() ); ?>

                    <hr />

                    <div class="item-location">
                        <?php if (count($location)>0) { ?>
                            <strong><?php _e("Location", 'bootstrap'); ?></strong>: <?php echo implode(', ', $location); ?>
                        <?php } ?>
                        <?php osc_run_hook('location'); ?>
                    </div>

                    <hr />

                    <?php include('item-comment.php'); ?>
                </div>
                <div class="col-3 ml-auto">
                    <?php include('item-sidebar.php'); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php osc_current_web_theme_path('footer.php'); ?>
