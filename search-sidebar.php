<?php
// Category
$category = __get("category");
if(!isset($category['pk_i_id']) ) {
    $category['pk_i_id'] = null;
} ?>

<div class="col-12 col-md-3">
	<div class="search-sidebar bg-light">
		<?php //osc_alert_form(); ?>
		<div class="widget">
			<div class="widget-content widget-category-filter p-3">
				<h5><?php _e('Category', 'bootstrap') ; ?></h5>
				<?php drizzle_searchSidebarCategory($category['pk_i_id']); ?>
			</div>
		</div>
		<!-- /Category filter -->
		<div class="widget">
			<div class="widget-content widget-search-filter p-3">
				<h5><?php _e('Filter', 'bootstrap') ; ?></h5>
	    		<form action="<?php echo osc_base_url(true); ?>" method="get" class="nocsrf">
			        <input type="hidden" name="page" value="search"/>
			        <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
			        <?php foreach(osc_search_user() as $userId) { ?>
			        <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>"/>
			        <?php } ?>

			        <div class="form-group">
			        	<label><?php _e('Location', 'bootstrap'); ?></label>
			        	<input type="hidden" id="sRegion" name="sRegion" value="<?php echo osc_esc_html(Params::getParam('sRegion')); ?>" />
                		<input type="text" id="sCity" name="sCity" value="<?php echo osc_esc_html(osc_search_city()); ?>" class="form-control" placeholder="<?php echo osc_esc_html(__('City', 'bootstrap')); ?>" />
			        </div>
			        <?php if( osc_images_enabled_at_items() ) { ?>
			        <div class="form-group form-check">
			        	<input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?> />
                		<label for="withPicture"><?php _e('listings with pictures', 'bootstrap') ; ?></label>
			        </div>
			        <?php } ?>
			        <?php if( osc_price_enabled_at_items() ) { ?>
			        <div class="form-group">
			        	<label><?php _e('Price', 'bootstrap') ; ?></label>
			        	<div class="row">
			        		<div class="col">
			        			<input type="text" id="priceMin" name="sPriceMin" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6" class="form-control" placeholder="<?php echo osc_esc_html(__('Min.', 'bootstrap')); ?>" />
			        		</div>
			        		<div class="col">
			        			<input type="text" id="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="6" class="form-control" placeholder="<?php echo osc_esc_html(__('Max.', 'bootstrap')); ?>" />
			        		</div>
			        	</div>
			        </div>
			        <?php } ?>
			        <div class="plugin-hooks">
		            <?php if(osc_search_category_id()) {
		                osc_run_hook('search_form', osc_search_category_id()) ;
		            } else {
		                osc_run_hook('search_form') ;
		            } ?>
			        </div>
			        <?php $aCategories = osc_search_category();
			        foreach($aCategories as $cat_id) { ?>
			        <input type="hidden" name="sCategory[]" value="<?php echo osc_esc_html($cat_id); ?>"/>
			        <?php } ?>

			        <button type="submit" class="btn btn-block mt-4 btn-primary"><?php _e('Apply', 'bootstrap') ; ?></button>
			    </form>
			</div>
		</div>
		<!-- /Search filter -->
	</div>

    
</div>