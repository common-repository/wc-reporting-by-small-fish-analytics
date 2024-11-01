<?php
if ( !defined( "ABSPATH" ) ) { 
    exit; 
}

class SFA_WooCommerce_Daily_Orders_Report extends SFA_WooCommerce_Report_Base {
	
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
			$this->results[$i] = 0;
		}
		
		foreach ($query->posts as $order) {
			$difference = time() - strtotime($order->post_date);
			$this->results[floor($difference/(60*60*24)) - 1] += 1;
		}
	}
	
	public function generate_report_data() {
		$json = "[";
		for($i = 30; $i > 0; $i--) {
			$json = $json . "[\"" . $i . "\", \"" . $this->results[31 - $i] . "\"],";
		}
		$json = rtrim($json, ",");
		$json = $json . "]";
		
		return $json;
	}
	
	public function get_report_title() {
		return "Daily Order Count";
	}
	
	protected function get_first_value() {
		return $this->results[30];
	}
	
	protected function get_last_value() {
		return $this->results[1];
	}
	
	public function get_current_value() {
		$result = $this->results[1];
		
		if ($result > 1) {
			return $result . ' Orders';
		}
		else {
			return $result . ' Order';
		}
	}
}