<?php
require_once '../../../define_root.php';
require_once INCLUDE_ROOT . "View/admin_header.php";
require_once INCLUDE_ROOT . "Model/Site.php";
require_once INCLUDE_ROOT . "Model/RunUnit.php";

if( env('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest' ):

	if(isset($_GET['run_unit_id'])):
		if(isset($_GET['special']))
			$special = $_GET['special'];
		else $special = false;
		
		$unit_info = $run->getUnitAdmin($_GET['run_unit_id'], $special);

		require_once INCLUDE_ROOT."Model/RunUnit.php";
		$unit_factory = new RunUnitFactory();
		$unit = $unit_factory->make($fdb,null,$unit_info);
		
		echo $unit->displayForRun();
		exit;
	endif;
endif;

bad_request_header();
$alert_msg = "<strong>Sorry, missing unit.</strong> ";
if(isset($unit)) $alert_msg .= implode($unit->errors);
alert($alert_msg, 'alert-danger');
echo $site->renderAlerts();