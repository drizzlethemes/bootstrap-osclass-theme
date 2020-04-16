<?php $size = explode('x', osc_thumbnail_dimensions()); ?>
<div class="listing-card card mb-2 <?php echo $class; ?> premium-card">
    <div class="row no-gutters">
        <div class="col-4">
        <?php if( osc_images_enabled_at_items() ) { ?>
            <a href="<?php echo osc_premium_url() ; ?>">
            <?php if(osc_count_premium_resources()) { ?>
                <img src="<?php echo osc_resource_thumbnail_url(); ?>" class="card-img" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
            <?php } else { ?>
                <img src="<?php echo osc_current_web_theme_url('images/no_photo.jpg'); ?>" class="card-img" alt="<?php echo osc_esc_html(osc_premium_title()) ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
            <?php } ?>
            </a>
        <?php } ?>
        </div>
        <div class="col">
            <div class="card-body">
                <h5 class="card-title mb-1">
                    <a href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_esc_html(osc_premium_title()) ; ?>"><?php echo osc_premium_title() ; ?></a>
                </h5>
                <div class="card-text mb-2 text-muted">
                    <span class="badge badge-info category"><?php echo osc_premium_category() ; ?></span>
                    <span class="badge badge-secondary location"><?php echo osc_premium_city(); ?> <?php if(osc_premium_region()!='') { ?>(<?php echo osc_premium_region(); ?>)<?php } ?></span>
                    <span class="badge badge-light"><?php echo osc_format_date(osc_premium_pub_date()); ?></span>
                </div>
                <p class="card-text"><?php echo osc_highlight( osc_premium_description(), 180 ); ?></p>
                <?php if( osc_price_enabled_at_items() ) { ?><strong class="currency-value text-success"><?php echo osc_format_price(osc_premium_price(),osc_premium_currency_symbol()); ?></strong><?php } ?>
                <?php if($admin){ ?>
                <span class="admin-options">
                    <a href="<?php echo osc_premium_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'bootstrap'); ?></a>
                    <span>|</span>
                    <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bootstrap')); ?>')" href="<?php echo osc_premium_delete_url();?>" ><?php _e('Delete', 'bootstrap'); ?></a>
                    <?php if(osc_premium_is_inactive()) {?>
                    <span>|</span>
                    <a href="<?php echo osc_premium_activate_url();?>" ><?php _e('Activate', 'bootstrap'); ?></a>
                    <?php } ?>
                </span>
                <?php } ?>
            </div>
        </div>
    </div>
</div>