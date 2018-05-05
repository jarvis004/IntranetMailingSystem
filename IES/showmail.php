<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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

<body background="images/whats.png" >
	<div id="header"  style = "background-color: #4169e1; height:50px;"><span class="title" style = "color:white;font-size:20px; padding-bottom: 10px; padding-top: 5px; font-family:arial;">IntraMail</span><span class="account_links"><a href="logout.php" style = " color: white;">logout</a></span>
		<?php 
		if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$msgid=$_GET['id'];
		$us="Welcome";
		echo "<span class=\"account_link\" style = \" color:white; \">  ".$user."</span>";
		}
	?>
</div>
<div id="main">
<div id="left_col" style ="font-family: sans-serif;height:610px;width:250px; background-color: #f5f5f5">
<ul>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href= "compose.php" style = "color: black;">   &emsp; Compose Mail</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="inbox.php" style = "color: black;">  &emsp;  Inbox</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="drafts.php" style = "color: black;">  &emsp;  Drafts</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="sent.php" style = "color: black;"> &emsp; Sent Mails</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="trash.php" style = "color: black;"> &emsp;    Mails in Trash</a></li>
</ul>

</div>

<div id="right_col" >
<img src="images/vr.png" style="width:1px; float:left;" height="600px"/>

<div id="container" font-family = "Arial" style="
		height:50%;
		width:50%;
        color: black;
        padding: 2em;
        position: absolute;
        top: 50%;
        left: 60%;
        margin-right: -40%;
        transform: translate(-50%, -50%);
        ">
	<span class = "subject" style = "font-weight: bold;text-align: left;margin:10px 0% 0% -40%;"></span>
	<span class = "msg" style = "font-weight:italic; text-align: left;"></span>
	

<?php
	if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$msgid=$_GET['id'];
		$us="Welcome";
		//echo "<span class=\"account_link\">".$us."  ".$user."</span>";
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$result=mysql_query("select subject, msg,Attachment from mails where msg_id='$msgid'");
		$row=mysql_fetch_array($result);
		//echo "<table border=1>";
		echo "<tr>";
		echo "<span class = \"subject\">".$row['subject']."</span><br><br>";
		//echo "<td><h3>".$row['subject']."</h3></td><br>";
		echo "<img src='images/vr1.png' alt='photo of me' style = ' width:95%; height:2px;' /><br><br>";
		echo "<span class = \"msg\">".$row['msg']."</span><br>";
		//echo "<td>".$row['msg']."</td>";
		if($row['Attachment']){
		//echo "<img src = '../uploads/".$row['Attachment']."'></img>";
		echo "<a target = '_blank' href = '../uploads/".$row['Attachment']."'> download </a>";}

		// Checking if the string contains parent directory
		
		echo "</tr></table>";
		mysql_close($link);
	}
	else
		echo "sorry, Your session has expired. Please log in again to see the content of this page.";
?>
</div>
</div>
<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>
</body>
</html>
