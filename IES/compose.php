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
	.form {
		    border: none;
    		border-bottom: 2px solid red;

	}
</style>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<body background="images/whats.png">
<div id="header"  style = "background-color: #4169e1; height:50px;"><span class="title" style = "color:white;font-size:20px; padding-bottom: 10px; padding-top: 5px; font-family:arial;">IntraMail</span><span class="account_links"><a href="logout.php" style = " color: white;">logout</a></span>
</div>
<div id="main">
<div id="left_col" style ="font-family: sans-serif;height:610px;width:250px; background-color: #f5f5f5">
<ul>
<li style = "background-color:#9fd7fb; width: 230px; height:30px; padding-top: 5px; font-size: 18px;"><a href= "compose.php" style="color:#326ada; ">   &emsp; Compose Mail</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="inbox.php" style="color:black; ">  &emsp;  Inbox</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="drafts.php" style = "color: black;">  &emsp;  Drafts</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="sent.php"  style="color:black; "> &emsp; Sent Mails</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="trash.php" style = "color: black;"> &emsp;    Mails in Trash</a></li>
</ul>


</div>

<div id="right_col">
<img src="images/vr.png" style="width:1px; float:left;" height="550px"/>
<div id="container" font-family = "Arial" style="
		height:50%;
		width:50%;
        color: black;
        padding: 2em;
        position: absolute;
        top: 50%;
        left: 60%;
        margin-right: -40%;
        transform: translate(-50%, -50%)">   
<?php
	$to="";
	$subject="";
	$content="";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$resultset=mysql_query("select for_users, subject, msg,Attachment from mails where msg_id='$id';");
		$row=mysql_fetch_array($resultset);
		$to=$row['for_users'];
		$subject=$row['subject'];
		$content=$row['msg'];
	}
	
	echo "<form name=\"compose_mail\" method=\"post\" action=".$_SERVER['PHP_SELF']." enctype=\"multipart/form-data\" >";
		echo "To:<input style = \" border:none; border: 1px solid black; margin-bottom: 5px; margin-left: 30px; padding-top: 5px; padding-bottom: 5px; \" type=\"text\" name=\"send_to\" size=\"80\" value=\"$to\"/><br/>";
		echo "Subject:<input style = \" border:none; border: 1px solid black; margin-bottom: 5px; padding-top: 5px; padding-bottom : 5px; \" type=\"text\" name=\"subject\" size=\"80\" value=\"$subject\" /><br />";
		echo "Mail Content:<br><textarea style = \" border:none; border: 1px solid black; margin-bottom: 5px; margin-left:55px; padding-top: 5px;  \" name=\"content\" rows=\"20\" cols=\"73\">";
			echo $content;
		echo "</textarea><br/>";
		echo "&nbsp &nbspAttach Files<input type=\"file\" name=\"attachment\">";
		echo "<input style = \" margin-left:60px; margin-right:5px; background-color: #33b5e5; color:white;\" type=\"submit\" name=\"save\" value=\"save\" />";
		echo "<input style = \" background-color: #33b5e5; color:white; \" type=\"submit\" name=\"send\" value=\"send mail\"/>";
	echo "</form>";


	if(isset($_POST['save'])){
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$ts=mktime();
		$msgid="msg".$ts.mt_rand(0,9999);
		$from_user=$_COOKIE['usr'];
		$to=$_POST['send_to'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];

		$file_get = $_FILES['attachment']['name'];
		$temp = $_FILES['attachment']['tmp_name'];

		//seperating each user in the user string
		$delimit=",";
		$indi=strtok($to, $delimit);
		while(is_string($indi)){
			$users[]=$indi;
			$indi=strtok($delimit);
		}
		if($file_get){
		$file_to_saved = "../uploads/".$file_get; 
		move_uploaded_file($temp, $file_to_saved);
		//echo $file_to_saved;
		}


		//Inserting the mail properties i.e. subject, id and content into the mails table
		if($subject){
		$success1=mysql_query("insert into mails(msg_id, subject, msg, for_users,Attachment) values('$msgid','$subject','$content','$to','$file_get');");
		}
		else{
			$success1=mysql_query("insert into mails(msg_id, subject, msg, for_users,Attachment) values('$msgid','No Subject','$content','$to','$file_get');");

		}
		//inserting data for the user who composed the mail
		$success2=mysql_query("insert into mailstats(username, msg_id, type) values('$from_user', '$msgid', 'svd');");
		if($success1&&$success2)
			echo "draft saved successfully";
		mysql_close($link);
	}
	else if(isset($_POST['send'])){
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$ts=mktime();
		$msgid="msg".$ts.mt_rand(0,9999);
		$from_user=$_COOKIE['usr'];
		$to=$_POST['send_to'];
		$subject=$_POST['subject'];
		$content=$_POST['content'];

		$file_get = $_FILES['attachment']['name'];
		$temp = $_FILES['attachment']['tmp_name'];

		//seperating each user in the user string
		$delimit=",";
		$indi=strtok($to, $delimit);
		while(is_string($indi)){
			$users[]=$indi;
			$indi=strtok($delimit);
		}
		if($file_get){
		$file_to_saved = "../uploads/".$file_get; 
		move_uploaded_file($temp, $file_to_saved);
		//echo $file_to_saved;
		}


		//inserting the mail properties i.e. subject, id and content into the mails table
		if($subject){
		$success1=mysql_query("insert into mails(msg_id, subject, msg, for_users,Attachment) values('$msgid','$subject','$content','$to','$file_get');");
		}
		else{
			$success1=mysql_query("insert into mails(msg_id, subject, msg, for_users,Attachment) values('$msgid','No Subject','$content','$to','$file_get');");

		}//inserting data for the user who composed the mail
		
		$success2=mysql_query("insert into mailstats(username, msg_id, type) values('$from_user', '$msgid', 'snt');");
		//inserting data for every user that is specified by user in 'to' field
		foreach($users as $user){
			$success3=mysql_query("insert into mailstats(username, msg_id, type) values('$user', '$msgid', 'rcvd');");
			if(!$success3){
				echo "operation failed, please check the mail you composed";
				break;
			}
		}
		if($success1&&$success2)
			echo "<script type='text/javascript'>alert('Mail sent successfully');</script>";//echo "mail send successfully";
		mysql_close($link);
	}
?>
</div>
</div>
</div>
<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>
<!--extra division used in the page-->
<!--<div id="mail_content">
</div> -->
</body>
</html>
