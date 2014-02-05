<?php
/*
Plugin Name: Category List Icon
Plugin URI: http://kentothemes.com
Description: Add Category list icon for each diffrent post category.
Version: 1.0
Author: KentoThemes
Author URI: http://kentothemes.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


wp_enqueue_script('jquery');
define('CLI_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
wp_enqueue_style('kento-fancy-cat-style', CLI_PLUGIN_PATH.'css/style.css');



add_filter('wp_list_categories', 'add_slug_css_list_categories');
function add_slug_css_list_categories($list) {

$cats = get_categories();
	foreach($cats as $cat) {
		
	$cat_icon = CLI_PLUGIN_PATH."cat-images/".$cat->slug.'.png';
	$cli_icon_size = get_option( 'cli_icon_size' );
	
	if (cli_is_exist_image($cat_icon)=="true")
		{
			$find = 'cat-item-' . $cat->term_id . '">';
			$replace = 'category-' . $cat->slug . '"><img width="'.$cli_icon_size.'px" height="'.$cli_icon_size.'px" src="'.$cat_icon.'" />';
			$list = str_replace( $find, $replace, $list );
		}
	else
		{
			$find = 'cat-item-' . $cat->term_id . '">';
			$replace = 'category-' . $cat->slug . '">';
			$list = str_replace( $find, $replace, $list );
		}
		

		
	}

return $list;
}





function cli_is_exist_image($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}



/////////////////////////////
add_action('admin_init', 'cli_init' );
add_action('admin_menu', 'cli_menu');

 function cli_init(){
	register_setting( 'cli_plugin_options', 'cli_icon_size');
			
    }
function cli_settings(){
	include('category-list-icon-admin.php');	
}

function cli_menu() {
	add_menu_page(__('Category List Icon','cli'), __('CLI Settings','cli'), 'manage_options', 'cli_settings', 'cli_settings');
}







 ?>