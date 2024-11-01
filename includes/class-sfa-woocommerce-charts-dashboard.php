<?php
if ( !defined( 'ABSPATH' ) ) { 
    exit; 
}

class SFA_WooCommerce_Charts_Dashboard {
	
	public function generate_dashboard() {	
	
		$revenue_report = new SFA_WooCommerce_Daily_Revenue_Report();
		$sales_report = new SFA_WooCommerce_Daily_Orders_Report();
		$customer_report = new SFA_WooCommerce_Daily_Active_Customers_Report();
		$average_cart_report = new SFA_WooCommerce_Daily_Daily_Average_Cart_Amount_Report();
		$daily_refunds_report = new SFA_WooCommerce_Daily_Refunds_Report();
		$daily_coupons_report = new SFA_WooCommerce_Daily_Coupons_Report();
		$ticker = new SFA_WooCommerce_Ticker();
?>
		
		<div id="sfa_wrapper">
			<div id="sfa_charts">
				<?php include('sfa-woocommerce-charts.php'); ?>
				<?php include('sfa-woocommerce-notices.php'); ?>
			</div>
			<div id="sfa_notices">
				<div class="sfa_ticker_heading">Latest Activity</div>
				<?php echo($ticker->generate_ticker_output()); ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<?php
	}
	
}

?>