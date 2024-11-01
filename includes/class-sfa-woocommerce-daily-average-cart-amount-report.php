<?php
if ( !defined( "ABSPATH" ) ) { 
    exit; 
}

class SFA_WooCommerce_Daily_Daily_Average_Cart_Amount_Report extends SFA_WooCommerce_Report_Base {
	
	function __construct() {
		$args = array(
			"post_type" => "shop_order",
			"post_status" => "wc-completed", 
			"posts_per_page" => -1,
			"date_query" => array(
				"column" => "post_date",
				"after" => "midnight 31 days ago",
				"before" => "yesterday",
				"inclusive" => true
				) 
		);
		
		$query = new WP_Query($args);

		for($i = 1; $i <= 30; $i++) {
			$this->results[$i] = array(
				'count' => 0,
				'total' => 0.00
			);
		}
		
		foreach ($query->posts as $order) {
			$order_total_bucket = get_post_meta($order->ID, '_order_total');
			$order_total = floatval($order_total_bucket[0]);
			
			$difference = time() - strtotime($order->post_date);
			$bucket = $results[floor($difference/(60*60*24)) - 1];
			
			$bucket_working_total = $bucket['count'] * $bucket['total'];
			
			$bucket['count'] += 1;
			$bucket['total'] = ($bucket_working_total + $order_total) / $bucket['count'];
			
			$this->results[floor($difference/(60*60*24)) - 1] = $bucket;
		}
	}
	
	public function generate_report_data() {
		$json = "[";
		for($i = 30; $i > 0; $i--) {
			$bucket = $this->results[31 - $i];
			$json = $json . "[\"" . $i . "\", \"" . round($bucket['total'], 2) . "\"],";
		}
		
		$json = rtrim($json, ",");
		$json = $json . "]";
		
		return $json;
	}
	
	protected function get_first_value() {
		$bucket = $this->results[30];
		return $bucket['total'];
	}
	
	protected function get_last_value() {
		$bucket = $this->results[1];
		return $bucket['total'];
	}
	
	public function get_report_title() {
		return "Daily Average Cart Total";
	}
	
	public function get_current_value() {
		$bucket = $this->results[30];
		return '$' . number_format($bucket['total'], 2);
	}
	
}