<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Compose Mail</title>
<script type="text/javascript" language="javascript">
/*	function validate(){
		var pass=true;
		var un=/^(([A-Z]*[a-z]+)+[0-9]*)+(,\s*(([A-Z]*[a-z]+)+[0-9]*)+)*$/;
		var send_to=document.forms[0].send_to.value;
		var subject=document.forms[0].subject.value;
		var content=document.forms[0].content.value;
		if(send_to=="" || !un.test(send_to)){
			alert("Please enter a valid username");
			pass=false;
			document.forms[0].send_to.focus;
		}
		else if(subject==""){
			alert("subject field can not be left blank");
			pass=false;
			document.forms[0].subject.focus;
		}
		else if(content==""){
			alert("content field can not be left blank");
			pass=false;
			document.forms[0].content.focus;
		}
		if(pass==true){
			document.forms[0].submit();
		}
	}*/
</script>
<script src="scripts/jquery.js"></script>
<script src="scripts/js01.js"></script>
<style>
	.msglink{
		text-decoration:none;
		color:#333399;
		font-weight:bold;
		font-family:verdana;
		font-size:12px;
	}
</style>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header"><span class="title">IES</span><span class="account_links"><a href=logout.php>logout</a></span>
</div>
<div id="main">
<div id="left_col">
<ul>
<li><a href="compose.php">Compose Mail</a></li>
<li><a href="inbox.php">Inbox</a></li>
<li><a href="drafts.php">Drafts</a></li>
<li><a href="sent.php">Sent Mails</a></li>
<li><a href="trash.php">Mails in Trash</a></li>
</ul>

</div>

<div id="right_col">
<img src="images/vr.png" style="width:1px; float:left;" height="550px"/>
<div id="content">
<?php
	$to="";
	$subject="";
	$content="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$link=mysqli_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($link,"ies"))
			echo("could not select the database");
		$resultset=mysqli_query($link,"select for_users, subject, msg from mails where msg_id='$id';");
		$row=mysqli_fetch_array($resultset);
		$to=$row['for_users'];
		$subject=$row['subject'];
		$content=$row['msg'];
	}
	echo "<form name=\"compose_mail\" method=\"post\" action=".$_SERVER['PHP_SELF'].">";
		echo "to:<input type=\"text\" name=\"send_to\" size=\"40\" value=\"$to\"/><br />";
		echo "subject:<input type=\"text\" name=\"subject\" size=\"40\" value=\"$subject\" /><br />";
		echo "mail content:<textarea name=\"content\" rows=\"20\" cols=\"50\">";
			echo $content;
		echo "</textarea><br/>";
		echo "<input type=\"submit\" name=\"save\" value=\"save\" />";
		echo "<input type=\"submit\" name=\"send\" value=\"send mail\"/>";
	echo "</form>";


	if(isset($_POST['save'])){
		$link=mysqlii_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($db,$link))
			echo("could not select the database");
		$ts=mktime();
		$msgid="msg".$ts.mt_rand(0,9999);
		$from_user=$_COOKIE['usr'];
		$to=$_POST['send_to'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		$delimit=",";
		$indi=strtok($to, $delimit);
		while(is_string($indi)){
			$users[]=$indi;
			$indi=strtok($delimit);
		}
		
		//inserting the mail properties i.e. subject, id and content into the mails table
		$success1=mysqli_query("insert into mails(msg_id, subject, msg, for_users) values('$msgid','$subject','$content','$to');");
		//inserting data for the user who composed the mail
		$success2=mysqli_query("insert into mailstats(username, msg_id, type) values('$from_user', '$msgid', 'svd');");
		if($success1&&$success2)
			echo "draft saved successfully";
		mysqli_close($link);
	}
	else if(isset($_POST['send'])){
		$link=mysqli_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($link,"ies"))
			echo("could not select the database");
		$ts=mktime();
		$msgid="msg".$ts.mt_rand(0,9999);
		$from_user=$_COOKIE['usr'];
		$to=$_POST['send_to'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];
		//seperating each user in the user string
		$delimit=",";
		$indi=strtok($to, $delimit);
		while(is_string($indi)){
			$users[]=$indi;
			$indi=strtok($delimit);
		}
		
		//inserting the mail properties i.e. subject, id and content into the mails table
		$success1=mysqli_query($link,"insert into mails(msg_id, subject, msg, for_users) values('$msgid','$subject','$content','');");
		//inserting data for the user who composed the mail
		$success2=mysqli_query($link,"insert into mailstats(username, msg_id, type) values('$from_user', '$msgid', 'snt');");
		//inserting data for every user that is specified by user in 'to' field
		foreach($users as $user){
			$success3=mysqli_query($link,"insert into mailstats(username, msg_id, type) values('$user', '$msgid', 'rcvd');");
			if(!$success3){
				echo "operation failed, please check the mail you composed";
				break;
			}
		}
		if($success1&&$success2)
			echo "mail send successfully";
		mysqli_close($link);
	}
?>
</div>
</div>
</div>
<div id="footer"><span class="fn1">&copy; Intranet Email System 2012</span><span class="fn2">powered by:skyroute.org</span>
</div>
<!--extra division used in the page-->
<div id="mail_content">
</div>
</body>
</html>
