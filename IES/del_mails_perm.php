<?php
	$_POST['del_msgs'];
	foreach($_POST['del_msgs'] as $id){
		$ids[]=$id;
	}
	if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$_POST['del_msgs'];
		foreach($_POST['del_msgs'] as $id){
			echo $id;
			$ids[]=$id;
		}
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		 //checking where did the request come from, if it includes inbox: type=rcvd are deleted, if it includes sent:type=snt are deleted
		/*if(strstr($_SERVER['HTTP_REFERER'],"inbox")){     
			$type="rcvd";
		}
		else if(strstr($_SERVER['HTTP_REFERER'],"sent")){
			$type="snt";
		} 
		else if(strstr($_SERVER['HTTP_REFERER'],"drafts")){
			$type="svd";
		}*/
		foreach($ids as $id){
			$success1=mysql_query("delete from mailstats where msg_id='$id' and type='del'");
			if(!$success1){
				echo "operation failed, please check the mail you selected";
				break;
			}
		}
		mysql_close($link);
		header("location:trash.php");
	}
?>