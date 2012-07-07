<?php
 

$serproxyPort = 5331;
$fp = fsockopen('192.168.123.35', $serproxyPort); 

if(isset($_GET['color'])){

	$color = $_GET['color'];
	$mycommand = $color; 
	fputs($fp, '('.$mycommand.')');
}

if(isset($_GET['def'])){
	
	$def = $_GET['def'];
	fputs($fp, '(def)');

}
if(isset($_GET['showmode'])){
	$showmode = $_GET['showmode'];
	fputs($fp, '(sm'.$showmode.')');

}
?>