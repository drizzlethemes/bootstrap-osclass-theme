<?php
require_once('vendor/autoload.php');

use App\helpers\bodyClass;

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