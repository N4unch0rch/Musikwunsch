<?php

$mysqlserverip       = "localhost";
$mysqlserveruser     = "XXX";
$mysqlserverpassword = "XXX";
$mysqlserverdatabase = "db";

function connect()
{
    $con = mysql_connect($GLOBALS['mysqlserverip'], $GLOBALS['mysqlserveruser'], $GLOBALS['mysqlserverpassword']) or die(mysql_error());
    mysql_select_db($GLOBALS['mysqlserverdatabase'], $con) or die(mysql_error());
	mysql_set_charset('utf8mb4');
}


function insert($titel,$interpret,$name,$agent,$ip){
	$sql="INSERT IGNORE INTO wuensche(Titel,Interpret,Name,Agent,Ip,Likes,Dislikes) VALUES('".mysql_real_escape_string($titel)."' , '".mysql_real_escape_string($interpret)."' , '".mysql_real_escape_string($name)."' , '".mysql_real_escape_string($agent)."','".mysql_real_escape_string($ip)."',0,0)  ";
	mysql_query($sql) or die(mysql_error());
}


function listwishes($list){
	if($list=='likes'){$sql="SELECT * FROM wuensche ORDER BY Likes DESC ";}
	else {$sql="SELECT * FROM wuensche ";}
	$result = mysql_query($sql);
	$i = 1;
    while ($zeile = mysql_fetch_object($result)) {
      echo "
    <tr class='"; if($zeile->Likes>$zeile->Dislikes){echo "info";}elseif($zeile->Dislikes>$zeile->Likes){echo "danger";}elseif($zeile->Likes=0 && $zeile->Dislikes=0){ echo "";}
      echo "'><td>" . $zeile->Id . "</td>
      <td>".$zeile->Titel."</td>
      <td>".$zeile->Interpret."</td>
      
	  <td>Likes: ".$zeile->Likes."  Dislikes:".$zeile->Dislikes."</td>
	  <td><a href='?like=".$zeile->Id."' style='text-decoration:none' class='btn-sm btn-success'><span class='glyphicon glyphicon-thumbs-up'></span> Like</a><br><br><a href='?dislike=".$zeile->Id."' style='text-decoration:none' class='btn-sm btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Dislike</a></td>
    </tr>
	  ";
	  $i++;
    }
	
}


function like($id){
	if(!isset($_COOKIE[$id])){
	$sql="UPDATE wuensche SET Likes = Likes + 1 WHERE Id='".mysql_real_escape_string($id)."' ";
	mysql_query($sql) or die(mysql_error());
	setcookie($id, "Like");
	}elseif(isset($_COOKIE[$id]) && $_COOKIE[$id] == 'Dislike'){
	$sql="UPDATE wuensche SET Likes = Likes + 1, Dislikes = Dislikes - 1 WHERE Id='".mysql_real_escape_string($id)."' ";
	mysql_query($sql) or die(mysql_error());
	setcookie($id, "Like");	
	}else {
		header('Location: index.php');
	}
}

function dislike($id){
	if(!isset($_COOKIE[$id])){
	$sql="UPDATE wuensche SET Dislikes = Dislikes + 1 WHERE Id='".mysql_real_escape_string($id)."' ";
	mysql_query($sql) or die(mysql_error());
	setcookie($id, "Dislike");
	}elseif(isset($_COOKIE[$id]) && $_COOKIE[$id] == 'Like'){
	$sql="UPDATE wuensche SET Likes = Likes - 1, Dislikes = Dislikes + 1 WHERE Id='".mysql_real_escape_string($id)."' ";
	mysql_query($sql) or die(mysql_error());
	setcookie($id, "Dislike");	
	}else {
		header('Location: index.php');
	}
}


connect();
?>