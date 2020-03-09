<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\bodyClass;

/*
* Body Class
*/
if(!function_exists('drizzle_addBodyClassConstruct')) {
    function drizzle_addBodyClassConstruct($classes){
        $bodyClass = bodyClass::newInstance();
        $classes = array_merge($classes, $bodyClass->get());
        return $classes;
    }
}
if(!function_exists('drizzle_bodyClass')) {
    function drizzle_bodyClass($echo = true){
        /**
        * Print body classes.
        *
        * @param string $echo Optional parameter.
        * @return print string with all body classes concatenated
        */
        osc_add_filter('drizzle_bodyClass','drizzle_addBodyClassConstruct');
        $classes = osc_apply_filter('drizzle_bodyClass', array());
        if($echo && count($classes)){
            echo 'class="'.implode(' ',$classes).'"';
        } else {
            return $classes;
        }
    }
}
if(!function_exists('drizzle_addBodyClass')) {
    function drizzle_addBodyClass($class) {
        /**
        * Add new body class to body class array.
        *
        * @param string $class required parameter.
        */
        $bodyClass = bodyClass::newInstance();
        $bodyClass->add($class);
    }
}

/*
* Logo
*/
if( !function_exists('drizzle_themeLogo') ) {
    function drizzle_themeLogo() {
         $logo = osc_get_preference('logo','bender');
         $html = '<img alt="' . osc_page_title() . '" src="' . drizzle_logoUrl() . '">';
         if( $logo!='' && file_exists( osc_uploads_path() . $logo ) ) {
            return $html;
         } else {
            return osc_page_title();
        }
    }
}
if( !function_exists('drizzle_logoUrl') ) {
    function drizzle_logoUrl() {
        $logo = osc_get_preference('logo','bender');
        if( $logo ) {
            return osc_uploads_url($logo);
        }
        return false;
    }
}

/*
* Category list
*/
if( !function_exists('drizzle_categoryList') ) {
    function drizzle_categoryList() {
        osc_goto_first_category(); ?>
        <div class="d-flex row flex-row flex-wrap">
        <?php while ( osc_has_categories() ) {
            $parentCategoryId = osc_category_id(); ?>
            <div class="col-12 col-sm-6 col-md-3 navbar-expand-lg">
            <h4>
                <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name(); ?></a>
                <span class="text-muted">(<?php echo osc_category_total_items(); ?>)</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryList<?php echo osc_category_id(); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </h4>
            <?php if ( osc_count_subcategories() > 0 ) { ?>
            <div class="collapse navbar-collapse" id="categoryList<?php echo $parentCategoryId; ?>">
                <ul class="list-unstyled">
                    <?php while ( osc_has_subcategories() ) { ?>
                        <li>
                            <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name(); ?></a>
                            <span class="text-muted">(<?php echo osc_category_total_items(); ?>)</span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
            </div>
        <?php } ?>
        </div>
    <?php }
}

/*
* Follow Construct
*/
if(!function_exists('drizzle_noFollowConstruct')) {
    /**
    * Hook for header, meta tags robots nofollos
    */
    function drizzle_noFollowConstruct() {
        echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . PHP_EOL;
        echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . PHP_EOL;

    }
}
if( !function_exists('drizzle_followConstruct') ) {
    /**
    * Hook for header, meta tags robots follow
    */
    function drizzle_followConstruct() {
        echo '<meta name="robots" content="index, follow" />' . PHP_EOL;
        echo '<meta name="googlebot" content="index, follow" />' . PHP_EOL;

    }
}