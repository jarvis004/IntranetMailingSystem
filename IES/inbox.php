<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your Mailbox</title>
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
	if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$page=isset($_GET['page'])?$_GET['page']:0;
		if($page<0)
			$page=0;
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$prev=$page-1;
		$next=$page+1;
		echo "<div class=\"nav_links\"><a href=inbox.php?page=".$prev." style=\"float:left;\">previous</a>";
		print "<span>Showing:  ".(($page+1)*10-9)." to ".(($page+1)*10)."</span>";
		echo "<a href=inbox.php?page=".$next." style=\"float:right;\">next</a></div>";
		$leave=$page*10;
	
		$query1="select msg_id from  mailstats where username='$user' and type='rcvd' order by serial DESC limit ".$leave.",10";
		$result1=mysql_query($query1);
		$i=0;
		if(mysql_num_rows($result1)){
			echo "<form id=\"del_form\" action=\"del_mails.php\" method=\"post\">";
			while($rowset1=mysql_fetch_array($result1)){
				$id=$rowset1['msg_id'];
				$result2=mysql_query("select subject from mails where msg_id='$id';");
				$rwst2=mysql_fetch_array($result2);
				echo "<table border=\"0\" id=\"mail_list\">";
				echo "<tr>";
				echo "<td class=\"index\">".($leave + ++$i)."</td>";
				echo "<td class=\"subjects\" id=".$id."><input type=\"checkbox\" name=\"del_msgs[]\" value=".$id."><a class=\"msglink\" href=\"showmail.php?id=".$id."\">".$rwst2['subject']."</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<div id=\"button_holder\"><input type=\"submit\" value=\"delete mails\"/></div>";
			echo "</form>";
		}
		else
			echo "no more mails to show!";
			mysql_close($link);
	}
	else
		echo "sorry, Your session has expired. Please log in again to see the content of this page.";
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
