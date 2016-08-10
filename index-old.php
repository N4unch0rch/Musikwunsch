<?php 
include_once('sessionhelpers.inc.php');
if($_GET['wunsch']){
	$titel = $_GET['titel'];
	$interpret = $_GET['interpret'];
	$name = $_GET['name'];
	$agent = 'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'];
	$ip = $_SERVER['REMOTE_ADDR'];
	insert($titel,$interpret,$name,$agent,$ip);
}


?>
<html>
<form>
Titel:<input type="text" name="titel" id="titel">
Interpret:<input type="text" name="interpret" id="interpret">
Name:<input type="text" name="name" id="name">
<input type="hidden" value="wunsch" id="wunsch" name="wunsch">
<input type="submit">
</form>
</html>