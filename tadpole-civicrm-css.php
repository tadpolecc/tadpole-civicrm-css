<?php

/*
Plugin Name: Tadpole CiviCRM CSS for WordPress
Plugin URI: https://tadpole.cc
Description: Clean up CiviCRM default CSS handling.  On Activation, via CiviCRM API deactivate built in civicrm.css.  Then properly register and load Tadpole's custom civicrm.css on the front end, in the admin register the default civicrm.css.
Version: 1.1
Author: Tadpole Collective
Author URI: https://tadpole.cc
License: AGPL
*/

define( 'TC_CIVICRM_CSS_DIR', dirname( __FILE__ ) );
define( 'TC_CIVICRM_CSS_URL', plugin_dir_url( __FILE__ ) );
define( 'TC_CIVICRM_CSS_PBASE', plugin_basename( __FILE__ ) );
define( 'TC_CIVICRM_CSS_BASE', str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );

add_action( 'admin_enqueue_scripts', 'tc_admin_register_tad_civicrm_styles' );

function tc_admin_register_tad_civicrm_styles() {
        wp_enqueue_style ('tad_admin_civicrm',  '/wp-content/plugins/civicrm/civicrm/css/civicrm.css' );
}


add_action( 'wp_print_styles', 'tc_register_tad_civicrm_styles', 110 );
function tc_register_tad_civicrm_styles() {
	wp_enqueue_style ('tad_civicrm', TC_CIVICRM_CSS_URL . 'css/civicrm.css' );
}

register_activation_hook( __FILE__, 'tc_civi_api');
function tc_civi_api() {

civicrm_wp_initialize();

civicrm_api3('Setting', 'create', array('disable_core_css' => 1,));
}

register_deactivation_hook( __FILE__, 'tc_civi_deactivate');
function tc_civi_deactivate() {

civicrm_wp_initialize();

civicrm_api3('Setting', 'create', array('disable_core_css' => 0,));
}