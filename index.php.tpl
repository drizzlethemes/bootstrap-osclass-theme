<?php
/*
Theme Name: Bootstrap
Theme URI: http://www.drizzlethemes.com/
Description: <%- pkg.description %>
Version: <%- pkg.version %>
Author: <%- pkg.author %>
Author URI: http://www.drizzlethemes.com/
Widgets:  header, footer, sidebar
Theme update URI: bootstrap
*/

function bootstrap_theme_info() {
    return array(
    	'name'        => 'Bootstrap',
		'version'     => '<%- pkg.version %>',
		'description' => '<%- pkg.description %>',
		'author_name' => '<%- pkg.author %>',
		'author_url'  => 'https://www.drizzlethemes.com',
		'locations'   => array()
    );
} ?>