<?php
	if (isset($_POST['msgid'])&&isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$link=mysqli_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($link,"ies"))
			echo("could not select the database");
		$id=$_POST['msgid'];
		$result=mysqli_query($link,"select msg from mails where msg_id='$id'");
		$row=mysqli_fetch_array($result);
		$data=$row['msg'];
		echo $data;
	}
	if(strstr($_SERVER['HTTP_REFERER'],"register")){
			$link=mysqli_connect("localhost","root","","");
			if(!$link)
				echo("could not connect to database");
			$db="ies";
			if(!mysqli_select_db($link,"ies"))
				echo("could not select the database");
			$checkfor=$_POST['checkfor'];
			$result=mysqli_query($link,"select username from users where username='$checkfor';");
			if(!strlen($checkfor))
				$data="<span style=\"color:red\">username can not be left blank</span>";
			else if(mysqli_num_rows($result)){
				$data="<span style=\"color:red\">this username is <b>not available</b>, please try another</span>";
			}
			else{
				$data="<span style=\"color:Green\"><b>username available</b></span>";
			}
			echo $data;
		}
?>