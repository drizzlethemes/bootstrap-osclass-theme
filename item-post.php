<?php
osc_add_hook('header', 'drizzle_noFollowConstruct');
drizzle_addBodyClass('item-post');

// Item action
$action = 'item_add_post';
$edit = false;
if(Params::getParam('action') == 'item_edit') {
    $action = 'item_edit_post';
    $edit = true;
}

osc_enqueue_script('jquery-validate');
osc_current_web_theme_path('header.php');

// Location
if (drizzle_locationShowAs() == 'dropdown') {
    ItemForm::location_javascript();
} else {
    ItemForm::location_javascript_new();
} ?>

<main class="mb-4">
    <section class="bg-light pt-4 pb-4">
        <div class="container text-center">
            <h2><?php _e('Publish a listing', 'bootstrap'); ?></h2>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="form-container w-50 mx-auto">
                <ul id="error_list"></ul>
                <form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data" id="item-post">
                    <input type="hidden" name="action" value="<?php echo $action; ?>" />
                    <input type="hidden" name="page" value="item" />
                    <?php if($edit){ ?>
                        <input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
                        <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
                    <?php } ?>

                    <h4><?php _e('General Information', 'bootstrap'); ?></h4>
                    <div class="form-group">
                        <label for="select_1"><?php _e('Category', 'bootstrap'); ?></label>
                        <?php ItemForm::category_select(null, null, __('Select a category', 'bootstrap')); ?>
                    </div>
                    <div class="form-group">
                        <label for="title[<?php echo osc_current_user_locale(); ?>]"><?php _e('Title', 'bootstrap'); ?></label>
                        <?php ItemForm::title_input('title',osc_current_user_locale(), osc_esc_html( drizzle_itemTitle() )); ?>
                    </div>
                    <div class="form-group">
                        <label for="description[<?php echo osc_current_user_locale(); ?>]"><?php _e('Description', 'bootstrap'); ?></label>
                        <?php ItemForm::description_textarea('description', osc_current_user_locale(), osc_esc_html( drizzle_itemDescription() )); ?>
                    </div>
                    <?php if( osc_price_enabled_at_items() ) { ?>
                    <div class="form-group control-group-price">
                        <label for="price"><?php _e('Price', 'bootstrap'); ?></label>
                        <div class="row">
                            <div class="col">
                            <?php ItemForm::price_input_text(); ?>
                            </div>
                            <div class="col-4">
                            <?php ItemForm::currency_select(); ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Photos -->
                    <?php if( osc_images_enabled_at_items() ) { ?>
                    <div class="mt-4">
                    <?php ItemForm::ajax_photos(); ?>
                    </div>
                    <?php } ?>

                    <!-- Plugin Hook -->
                    <?php if($edit) {
                        ItemForm::plugin_edit_item();
                    } else {
                        ItemForm::plugin_post_item();
                    } ?>

                    <!-- Listing location -->
                    <h4 class="mt-4"><?php _e('Listing Location', 'bootstrap'); ?></h4>
                    <?php if(count(osc_get_countries()) > 1) { ?>
                    <div class="form-group">
                        <label for="country"><?php _e('Country', 'bootstrap'); ?></label>
                        <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                    </div>
                    <div class="form-group">
                        <label for="regionId"><?php _e('Region', 'bootstrap'); ?></label>
                        <?php if (drizzle_locationShowAs() == 'dropdown') {
                            if($edit) {
                                ItemForm::region_select(osc_get_regions(osc_item_country_code()), osc_item());
                            } else {
                                ItemForm::region_select(osc_get_regions(osc_user_field('fk_c_country_code')), osc_user());
                            }
                        } else {
                            if($edit) {
                                ItemForm::region_text(osc_item());
                            } else {
                                ItemForm::region_text(osc_user());
                            }
                        } ?>
                    </div>
                    <?php
                    } else {
                    $aCountries = osc_get_countries();
                    $aRegions = osc_get_regions($aCountries[0]['pk_c_code']); ?>
                    <input type="hidden" id="countryId" name="countryId" value="<?php echo osc_esc_html($aCountries[0]['pk_c_code']); ?>"/>
                    <div class="form-group">
                        <label for="region"><?php _e('Region', 'bootstrap'); ?></label>
                        <?php if (drizzle_locationShowAs() == 'dropdown') {
                            if($edit) {
                                ItemForm::region_select($aRegions, osc_item());
                            } else {
                                ItemForm::region_select($aRegions, osc_user());
                            }
                        } else {
                            if($edit) {
                                ItemForm::region_text(osc_item());
                            } else {
                                ItemForm::region_text(osc_user());
                            }
                        } ?>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="city"><?php _e('City', 'bootstrap'); ?></label>
                        <?php if (drizzle_locationShowAs() == 'dropdown') {
                            if($edit) {
                                ItemForm::city_select(null, osc_item());
                            } else { // add new item
                                ItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user());
                            }
                        } else {
                            ItemForm::city_text(osc_user());
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="cityArea"><?php _e('City Area', 'bootstrap'); ?></label>
                        <?php ItemForm::city_area_text(osc_user()); ?>
                    </div>
                    <div class="form-group">
                        <label for="address"><?php _e('Address', 'bootstrap'); ?></label>
                        <?php ItemForm::address_text(osc_user()); ?>
                    </div>

                    <!-- Seller information -->
                    <?php if(!osc_is_web_user_logged_in() ) { ?>
                    <h4 class="mt-4"><?php _e("Seller's information", 'bootstrap'); ?></h4>
                    <div class="form-group">
                        <label class="control-label" for="contactName"><?php _e('Name', 'bootstrap'); ?></label>
                        <?php ItemForm::contact_name_text(); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="contactEmail"><?php _e('E-mail', 'bootstrap'); ?></label>
                        <?php ItemForm::contact_email_text(); ?>
                    </div>
                    <div class="form-group form-check">
                        <?php ItemForm::show_email_checkbox(); ?>
                        <label for="showEmail"><?php _e('Show e-mail on the listing page', 'bootstrap'); ?></label>
                    </div>
                    <?php } ?>

                    <!-- Captcha -->
                    <?php if( osc_recaptcha_items_enabled() ) { ?>
                    <div class="form-group">
                        <?php osc_show_recaptcha(); ?>
                    </div>
                    <?php }?>

                    <button type="submit" class="btn btn-primary"><?php if($edit) { _e("Update", 'bootstrap'); } else { _e("Publish", 'bootstrap'); } ?></button>
                </form>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
$('#price').bind('hide-price', function(){
    $('.control-group-price').hide();
});

$('#price').bind('show-price', function(){
    $('.control-group-price').show();
});

<?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
$().ready(function(){
    $("#price").blur(function(event) {
        var price = $("#price").prop("value");
        <?php if(osc_locale_thousands_sep()!='') { ?>
        while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
            price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
        }
        <?php } ?>
        <?php if(osc_locale_dec_point()!='') { ?>
        var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
        if(tmp.length>2) {
            price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
        }
        <?php } ?>
        $("#price").prop("value", price);
    });
});
<?php } ?>
</script>
<?php osc_current_web_theme_path('footer.php'); ?>
