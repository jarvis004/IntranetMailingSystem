<?php
	if (isset($_POST['msgid'])&&isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$id=$_POST['msgid'];
		$result=mysql_query("select msg from mails where msg_id='$id'");
		$row=mysql_fetch_array($result);
		$data=$row['msg'];
		echo $data;
	}
	if(strstr($_SERVER['HTTP_REFERER'],"register")){
			$link=mysql_connect("localhost","root","");
			if(!$link)
				echo("could not connect to database");
			$db="ies";
			if(!mysql_select_db($db,$link))
				echo("could not select the database");
			$checkfor=$_POST['checkfor'];
			$result=mysql_query("select username from users where username='$checkfor';");
			if(!strlen($checkfor))
				$data="<span style=\"color:red\">username can not be left blank</span>";
			else if(mysql_num_rows($result)){
				$data="<span style=\"color:red\">this username is <b>not available</b>, please try another</span>";
			}
			else{
				$data="<span style=\"color:Green\"><b>username available</b></span>";
			}
			echo $data;
		}
?>