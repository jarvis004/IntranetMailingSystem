<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	/*if(isset($_POST['delete'])){
		foreach($_POST['del_msgs'] as $id){
			echo $id;
			$ids[]=$id;
		}
	}*/
	if (isset($_POST['delete'])&&isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		if(isset($_POST['delete'])){
			foreach($_POST['del_msgs'] as $id){
				echo $id;
				$ids[]=$id;
			}
		}
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		 //checking where did the request come from, if it includes inbox: type=rcvd are deleted, if it includes sent:type=snt are deleted
		if(strstr($_SERVER['HTTP_REFERER'],"inbox")){     
			$type="rcvd";
		}
		else if(strstr($_SERVER['HTTP_REFERER'],"sent")){
			$type="snt";
		} 
		else if(strstr($_SERVER['HTTP_REFERER'],"drafts")){
			$type="svd";
		} 
		foreach($ids as $id){
			$success=mysql_query("update mailstats set type='del' where msg_id='$id' and type='$type';");
			if(!$success){
				echo "operation failed, please check the mail you selected";
				break;
			}
		}
		mysql_close($link);
		header("location:".$_SERVER['HTTP_REFERER']);
	}
?>
</body>
</html>
