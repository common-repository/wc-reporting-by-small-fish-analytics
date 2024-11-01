<?php
if ( !defined( 'ABSPATH' ) ) { 
    exit; 
}

class SFA_WooCommerce_Daily_Active_Customers_Report extends SFA_WooCommerce_Report_Base {
	
	function __construct() {
		$args = array(
			"post_type" => "shop_order",
			"post_status" => "wc-completed", 
			"posts_per_page" => -1,
			"date_query" => array(
				"column" => "post_date",
				"after" => "midnight 31 days ago",
				"before" => "yesterday",
				"inclusive" => "true"
				) 
		);
		
		$query = new WP_Query($args);

		for($i = 1; $i <= 30; $i++) {
			$this->results[$i] = array(
				'customers' => array(),
				'count' => 0
			);
		}
		
		foreach ($query->posts as $order) {
			$difference = time() - strtotime($order->post_date);
			$bucket = $this->results[floor($difference/(60*60*24)) - 1];
			
			$post_meta = get_post_meta($order->ID, '_customer_user');
			$customer = $post_meta[0];
			
			if($bucket != null) {
				if(!in_array($customer, $bucket['customers'])) {
					array_push($bucket['customers'], $customer);
					$bucket['count'] += 1;
					$this->results[floor($difference/(60*60*24)) - 1] = $bucket;
				}
			}
		}
	}
	
	public function generate_report_data() {
		$json = "[";
		for($i = 30; $i > 0; $i--) {
			$bucket = $this->results[31 - $i];
			$json = $json . "[\"" . $i . "\", \"" . $bucket['count'] . "\"],";
		}
		
		$json = rtrim($json, ",");
		$json = $json . "]";
		
		return $json;
	}
	
	protected function get_first_value() {
		$bucket = $this->results[30];
		return $bucket['count'];
	}
	
	protected function get_last_value() {
		$bucket = $this->results[1];
		return $bucket['count'];
	}
	
	public function get_report_title() {
		return "Daily Customer Count";
	}
	
	public function get_current_value() {
		$bucket = $this->results[1];
		
		if ($bucket['count'] > 1) {
			return $bucket['count']. ' Customers';
		}
		else {
			return $bucket['count']. ' Customer';
		}
		
	}
}