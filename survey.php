<?
require_once "includes/define_root.php";

require_once INCLUDE_ROOT . "config/config.php";

require_once INCLUDE_ROOT . 'Model/Study.php'; # Study , nothing is echoed yet
require_once INCLUDE_ROOT . 'Model/Survey.php'; # Survey class, nothing is echoed yet

$survey = new Survey($vpncode,$study,@$run,array('timestarted'=>@$timestarted));

if($survey->progress===1) 
{
	$goto = "study_done.php?study_id={$study->id}";
	if(isset($run))
		$goto .= "&run_id=".$run->id;
	redirect_to($goto);
}
// Öffne Datenbank, mache ordentlichen Header, binde Stylesheets, Scripts ein
// Settings einlesen
require_once INCLUDE_ROOT . 'includes/settings.php';
require_once INCLUDE_ROOT . 'includes/variables.php';	
require_once INCLUDE_ROOT . 'view_header.php';

?>
<div class="row-fluid">
    <div id="span12">
        <? echo "<h1>$title</h1>";
        echo $description;
        ?>
    </div>
</div>
<div class="row-fluid">
	<div class="span12">

<?php

if(isset($_POST['vpncode'])) 
{
	$survey->post($_POST);
}

echo $survey->render();

?>
		</div> <!-- end of span10 div -->
	</div> <!-- end of row-fluid div -->
	<div class="row-fluid">
		<div class="span12">
			Bei Problemen wenden Sie sich bitte an <strong><a href="mailto:<?=EMAIL?>"><?=EMAIL?></a>.</strong>
		</div>
	</div>
</div>

<?php

require_once INCLUDE_ROOT . 'view_footer.php';