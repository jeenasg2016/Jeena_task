<?php
require_once('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Progress Bar</title>

<link rel="stylesheet" href="css/style.css">
<script src="js/vanilla.js"></script>
<script src="js/scripts.js"></script>
</head>

<body>
<h3>Progress Bar</h3>
<?php
#Initializations
$barIdArray   = array();
$PROGRESS_BAR = '';
$BUTTONS      = '';
$obj          = array();

# Get the values of bars, buttons, limit from the remote link  http://pb-api.herokuapp.com/bars
$json  = file_get_contents('http://pb-api.herokuapp.com/bars?'.rand());
$obj   = json_decode($json, true);
$Limit = isset($obj['limit']) ? $obj['limit'] : '100';


#=======================================================================================
#							Generate Progress Bar	STARTS
#=======================================================================================
if (isset($obj['bars']))
{
foreach ($obj['bars'] as $id=>$default_value)
{
	if ($default_value < 0)
	{
	$default_value     = 0;
	$CurrentPercentage = 0;
	}
	else
	{
	$CurrentPercentage = round(($default_value / $Limit) * 100);
	}
	
	if ($CurrentPercentage > 100)
	{
	$percentage = $CurrentPercentage;
    $col1		= "#F00";
    $col2		= "#F00";
	}
	else
	{
    $percentage = $CurrentPercentage;
	$col1		= "#afd8e5";
    $col2		= "#FFF";
	}
	
	$Style = '
	<style type="text/css">
	.default_'.$id.'{
	background: -webkit-linear-gradient(90deg, '.$col1.' '.$percentage.'%, '.$col2.' '.$percentage.'%); /* Safari 5.1-6.0 */
	background: -o-linear-gradient(90deg, '.$col1.' '.$percentage.'%, '.$col2.' '.$percentage.'%); /* For Opera 11.6-12.0 */
	background: -moz-linear-gradient(90deg, '.$col1.' '.$percentage.'%, '.$col2.' '.$percentage.'%); /* For Firefox 3.6-15 */
	background: linear-gradient(90deg, '.$col1.' '.$percentage.'%, '.$col2.' '.$percentage.'%);/* Standard syntax */
	}
	</style>
	';
	echo $Style;
	$PROGRESS_BAR   .= '<div class="bar default_'.$id.'"  id="barId_'.$id.'"><div class="bar_text" id="barTextId_'.$id.'">'.$CurrentPercentage.'%</div></div>
						<input type="hidden" id="barValue_'.$id.'" value="'.$CurrentPercentage.'" />
					   ';

# Store bar id and name in an array as #progress1, #progress2 etc.
$barIdArray[$id] = '#progress'.($id+1);
}
}

echo $PROGRESS_BAR;
#=======================================================================================
#							Generate Progress Bar	ENDS
#=======================================================================================


#=======================================================================================
#							Generate Buttons	STARTS
#=======================================================================================
$BUTTONS = '
<input type="hidden" id="Limit" value="'.$Limit.'" />

<select id="selBar">
'.buildOptions($barIdArray, '').'
</select>
';

if (isset($obj['buttons']))
{
foreach ($obj['buttons'] as $id=>$default_value)
{
	$BUTTONS .= '<input type="button" id="btn_'.$id.'" value="'.$default_value.'" onclick="fnProgressChange(this.value)" />';
}
}

echo $BUTTONS;
#=======================================================================================
#							Generate Buttons	ENDS
#=======================================================================================

?>

</body>
</html>