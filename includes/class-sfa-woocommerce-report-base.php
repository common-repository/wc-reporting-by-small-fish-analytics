<?php
	
abstract class SFA_WooCommerce_Report_Base {
	
	protected $results = array();
	
	abstract public function get_report_title();
	abstract public function get_current_value();
	abstract protected function get_first_value();
	abstract protected function get_last_value();
	
	public function get_difference() {
		$first = $this->get_first_value();
		$last = $this->get_last_value();
		
		if ($first == 0 && $last != 0) {
			return "NaN";
		}
		else if ($first == 0 && $last == 0) {
			return "0%";
		}
		else if ($first < $last) {
			$difference = ($last - $first) / $first * 100;
			return "+ " . round($difference, 2) . '%';
		}
		else {
			$difference = ($last - $first) / $first * 100;
			return "- " . abs(round($difference, 2)) . '%';
		}
	}
	
	public function difference_class() {
		if (substr($this->get_difference(), 0, 1) == "+") {
			return "increase";
		} 
		else {
			return "descrease";
		}
	}
}
	
?>