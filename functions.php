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
            <div class="col-12 col-sm-6 col-md-3 mb-4 category-container navbar-expand-lg">
            <h5>
                <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name(); ?></a>
                <span class="category-count text-muted">(<?php echo osc_category_total_items(); ?>)</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryList<?php echo osc_category_id(); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </h5>
            <?php if ( osc_count_subcategories() > 0 ) { ?>
            <div class="collapse navbar-collapse sub-categories-container" id="categoryList<?php echo $parentCategoryId; ?>">
                <ul class="list-unstyled">
                    <?php while ( osc_has_subcategories() ) { ?>
                        <li>
                            <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name(); ?></a>
                            <span class="category-count text-muted">(<?php echo osc_category_total_items(); ?>)</span>
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

function drizzle_searchSidebarCategory($catId = null) {
    $aCategories = array();
    if($catId==null) {
        $aCategories[] = Category::newInstance()->findRootCategoriesEnabled();
    } else {
        // if parent category, only show parent categories
        $aCategories = Category::newInstance()->toRootTree($catId);
        end($aCategories);
        $cat = current($aCategories);
        // if is parent of some category
        $childCategories = Category::newInstance()->findSubcategoriesEnabled($cat['pk_i_id']);
        if(count($childCategories) > 0) {
            $aCategories[] = $childCategories;
        }
    }

    if(count($aCategories) == 0) {
        return "";
    }

    drizzle_printSearchSidebarCategory($aCategories, $catId);
}

function drizzle_printSearchSidebarCategory($aCategories, $current_category = null, $i = 0) {
    $class = '';
    if(!isset($aCategories[$i])) {
        return null;
    }

    if($i===0) {
        $class = 'class="category"';
    }

    $c   = $aCategories[$i];
    $i++;
    if(!isset($c['pk_i_id'])) {
        echo '<ul '.$class.'>';
        if($i==1) {
            echo '<li><a href="'.osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))).'">'.__('All categories', 'bender')."</a></li>";
        }
        foreach($c as $key => $value) {
    ?>
            <li>
                <a id="cat_<?php echo osc_esc_html($value['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $value['pk_i_id'], 'iPage'=>null))); ?>">
                <?php if(isset($current_category) && $current_category == $value['pk_i_id']){ echo '<strong>'.$value['s_name'].'</strong>'; }
                else{ echo $value['s_name']; } ?>
                </a>

            </li>
    <?php
        }
        if($i==1) {
        echo "</ul>";
        } else {
        echo "</ul>";
        }
    } else {
    ?>
    <ul <?php echo $class;?>>
        <?php if($i==1) { ?>
        <li><a href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))); ?>"><?php _e('All categories', 'bender'); ?></a></li>
        <?php } ?>
            <li>
                <a id="cat_<?php echo osc_esc_html($c['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $c['pk_i_id'], 'iPage'=>null))); ?>">
                <?php if(isset($current_category) && $current_category == $c['pk_i_id']){ echo '<strong>'.$c['s_name'].'</strong>'; }
                      else{ echo $c['s_name']; } ?>
                </a>
                <?php drizzle_printSearchSidebarCategory($aCategories, $current_category, $i); ?>
            </li>
        <?php if($i==1) { ?>
        <?php } ?>
    </ul>
<?php
    }
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

/*
* Helpers used at view
*/
if( !function_exists('drizzle_itemTitle') ) {
    function drizzle_itemTitle() {
        $title = osc_item_title();
        foreach( osc_get_locales() as $locale ) {
            if( Session::newInstance()->_getForm('title') != "" ) {
                $title_ = Session::newInstance()->_getForm('title');
                if( @$title_[$locale['pk_c_code']] != "" ){
                    $title = $title_[$locale['pk_c_code']];
                }
            }
        }
        return $title;
    }
}
if( !function_exists('drizzle_itemDescription') ) {
    function drizzle_itemDescription() {
        $description = osc_item_description();
        foreach( osc_get_locales() as $locale ) {
            if( Session::newInstance()->_getForm('description') != "" ) {
                $description_ = Session::newInstance()->_getForm('description');
                if( @$description_[$locale['pk_c_code']] != "" ){
                    $description = $description_[$locale['pk_c_code']];
                }
            }
        }
        return $description;
    }
}

if( !function_exists('drizzle_locationShowAs') ){
    function drizzle_locationShowAs(){
        return osc_get_preference('defaultLocationShowAs','bootstrap');
    }
}

if( !function_exists('drizzle_searchNumber') ) {
    function drizzle_searchNumber() {
        $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
        $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
        if( $search_to > osc_search_total_items() ) {
            $search_to = osc_search_total_items();
        }

        return array(
            'from' => $search_from,
            'to'   => $search_to,
            'of'   => osc_search_total_items()
        );
    }
}
if( !function_exists('drizzle_defaultShowAs') ){
    function drizzle_defaultShowAs(){
        return getPreference('defaultShowAs@all','bootstrap');
    }
}
if( !function_exists('drizzle_showAs') ){
    function drizzle_showAs(){

        $p_sShowAs    = Params::getParam('sShowAs');
        $aValidShowAsValues = array('list', 'gallery');
        if (!in_array($p_sShowAs, $aValidShowAsValues)) {
            $p_sShowAs = drizzle_defaultShowAs();
        }

        return $p_sShowAs;
    }
}
if( !function_exists('drizzle_drawItem') ) {
    function drizzle_drawItem($class = false,$admin = false, $premium = false) {
        $filename = 'loop-single';
        if($premium){
            $filename .='-premium';
        }
        require WebThemes::newInstance()->getCurrentThemePath().$filename.'.php';
    }
}