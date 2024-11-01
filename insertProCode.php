<?php

function ajax_lead_generation_insertProCode() {
	if (isset($_POST['pro'])) {
		$pro = $_POST['pro'];

		$Lead_Generation_Option = "LeadGenOpt";
		$options = get_option($Lead_Generation_Option );
		if (!is_array($options)) {
			$options = array();
		}
		if($pro=="test1234") {
			$options['pro'] = true;
			echo("true");
		}else {
			$options['pro'] = false;
			echo("false");
		}
		update_option($Lead_Generation_Option , $options);

	}
}
?>