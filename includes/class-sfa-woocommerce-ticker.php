<?php
if ( !defined( "ABSPATH" ) ) { 
    exit; 
}

class SFA_WooCommerce_Ticker {
	
	private $results = array();
	
	function __construct() {
		/* completed, refunded, coupons */
		$args = array(
			"post_type" => "shop_order",
			"post_status" => array(
				"wc-completed",
				"wc-refunded"
			), 
			"posts_per_page" => 30,
			"orderby" => "post_date",
			"date_query" => array(
				"column" => "post_date",
				"before" => "yesterday",
				"inclusive" => true
			) 
		);
		
		$query = new WP_Query($args);
		
		foreach ($query->posts as $order) {
			$results = array_push($this->results, $order);
		}
	}
	
	public function generate_ticker_output() {
			
			$text = '<table id="sfa_ticker">';
			
				foreach ($this->results as $result) {
					$amount = get_post_meta($result->ID, '_order_total');
					$order_date = new DateTime($result->post_date);
				
					$row_description = '';
				
					if ($result->post_status == 'wc-refunded') {
						$row_description .= '<span class="sfa_order_refund">Refund #';
					}
					else {
						$row_description .= '<span class="sfa_order_complete">Order #';
					}
				
					$row_description .= $result->ID . '</span> for $';
				
					$row_description .= $amount[0] . ' completed on ';
					
					$row_description .= $order_date->format('Y/m/d');
				
					$text .= '<tr class="sfa_ticker_row"><td><a href="' . get_edit_post_link($result->ID) . '">' . $row_description . '</a></td></tr>';
			}
		$text .= '</table>';
		
		return($text);
	}
}