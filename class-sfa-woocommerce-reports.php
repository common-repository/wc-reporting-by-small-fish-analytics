<?php
/**
* Plugin Name: WooCommerce Reporting By Small Fish Analytics
* Description: Adds additional reporting charts to the WooCommerce reporting tab.
* Version: 1.2.0
* Author: canship
* Email: mike@smallfishanalytics.com
*/

if ( !defined( 'ABSPATH' ) ) { 
    exit; 
}

wp_register_script('flot', plugins_url('assets/jquery.flot.min.js', __FILE__), array('jquery'), '2.6.1');
wp_enqueue_script('flot');


/**
 * Check if WooCommerce is active
 **/
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	
	add_action('admin_enqueue_scripts', 'sfa_load_css');
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_sfa_woocommerce_reporting_admin_options');
	
	require_once('includes/class-sfa-woocommerce-report-base.php');
	require_once('includes/class-sfa-woocommerce-charts-dashboard.php');
	require_once('includes/class-sfa-woocommerce-daily-revenue-report.php');
	require_once('includes/class-sfa-woocommerce-daily-orders-report.php');
	require_once('includes/class-sfa-woocommerce-daily-active-customers-report.php');
	require_once('includes/class-sfa-woocommerce-daily-average-cart-amount-report.php');
	require_once('includes/class-sfa-woocommerce-daily-refunds-report.php');
	require_once('includes/class-sfa-woocommerce-daily-coupons-report.php');
	require_once('includes/class-sfa-woocommerce-ticker.php');
	
	add_action('admin_menu', 'my_plugin_menu');
}

function my_plugin_menu() {
	add_menu_page( 'WooCommerce Reporting By Small Fish Analytics', 'Small Fish Analytics', 'manage_options', 'sfa-woocommerce', 'render_dashboard' );
}

function render_dashboard() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	$report_tab = new SFA_WooCommerce_Charts_Dashboard();
	$report_tab->generate_dashboard();
}

function sfa_load_css() {
		wp_register_style('sfa-woocommerce-reports-style', plugin_dir_url(__FILE__) . '/assets/sfa-woocommerce-reports-style.css');
		wp_enqueue_style('sfa-woocommerce-reports-style');
}

function add_sfa_woocommerce_reporting_admin_options($links) {
	$custom_links = array(
		'<a href="/wp-admin/admin.php?page=sfa-woocommerce">View Reports</a>',
		'<a href="http://www.smallfishanalytics.com">Support</a>');
		
	return array_merge($custom_links, $links);
}

?>