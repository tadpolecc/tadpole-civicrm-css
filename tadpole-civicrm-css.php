<?php

/*
Plugin Name: Tadpole CiviCRM css
Plugin URI: https://tadpole.cc
Description: Disable defaut CiviCRM on front end only, inject custom css for CiviCRM.
Version: 1.0
Author: Tadpole Collective
Author URI: https://tadpole.cc
License: AGPL
*/

define( 'TC_CIVICRM_CSS_DIR', dirname( __FILE__ ) );
define( 'TC_CIVICRM_CSS_URL', plugin_dir_url( __FILE__ ) );
define( 'TC_CIVICRM_CSS_PBASE', plugin_basename( __FILE__ ) );
define( 'TC_CIVICRM_CSS_BASE', str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );


//* Set CiviCRM CSS file
add_action( 'wp_print_styles', 'tc_deregister_default_civicrm_styles', 100 );
function tc_deregister_default_civicrm_styles() {
// CRM-11823 - If Civi bootstrapped, then run
	global $civicrm_root;
	if ( empty($civicrm_root)) {
		return;
	}
	wp_deregister_style( 'civicrm/css/civicrm.css' );
	$file = CRM_Core_Resources::singleton()->getUrl('civicrm', 'css/civicrm.css', TRUE);
	CRM_Core_Region::instance('html-header')->update($file, array('disabled' => 'TRUE'));
}

add_action( 'wp_print_styles', 'tc_register_tad_civicrm_styles', 110 );
function tc_register_tad_civicrm_styles() {
	wp_enqueue_style ('tad_civicrm', TC_CIVICRM_CSS_URL . 'css/civicrm.css' );
}