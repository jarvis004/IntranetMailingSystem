<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your Saved Mails</title>
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

<body background="images/whats.png">
<div id="header"  style = "background-color: #4169e1; height:50px;"><span class="title" style = "color:white;font-size:20px; padding-bottom: 10px; padding-top: 5px; font-family:arial;">IntraMail</span><span class="account_links"><a href="logout.php" style = " color: white;">logout</a></span>
</div>
<div id="main">
<div id="left_col" style ="font-family: sans-serif;height:610px;width:250px; background-color: #f5f5f5">
<ul>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href= "compose.php"  style="color:black; ">   &emsp; Compose Mail</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="inbox.php" style="color:black; ">  &emsp;  Inbox</a></li>
<li style = "background-color:#9fd7fb; width: 230px; height:30px; padding-top: 5px; font-size: 18px;"><a href="drafts.php" style="color:#326ada; ">  &emsp;  Drafts</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="sent.php"  style="color:black; "> &emsp; Sent Mails</a></li>
<li style = "color:black; width: 230px; height:30px;  padding-top: 5px; font-size: 15px;"><a href="trash.php" style = "color: black;"> &emsp;    Mails in Trash</a></li>
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
		echo "<div class=\"nav_links\"><a href=drafts.php?page=".$prev." style=\"float:left;\">previous</a>";
		print "<span>Showing:  ".(($page+1)*10-9)." to ".(($page+1)*10)."</span>";
		echo "<a href=drafts.php?page=".$next." style=\"float:right;\">next</a></div>";
		$leave=$page*10;
	
		$query1="select msg_id from  mailstats where username='$user' and type='svd' order by serial DESC limit ".$leave.",10";
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
				echo "<td class=\"index\" style = \" background-color:#E0E0E0 ; color:black;  width: 20px; height:5%; \">".($leave + ++$i)."</td>";
				echo "<td class=\"subjects\" style = \" background-color:white; color:black; height:5%; \" id=".$id."><input type=\"checkbox\" name=\"del_msgs[]\" value=".$id."><a style =\" color:black; font-size: 15px; \" class=\"msglink\" href=\"showmail.php?id=".$id."\">".$rwst2['subject']."</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<div id=\"button_holder\"><input name=\"delete\" type=\"submit\" value=\"delete mails\"/></div>";
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
<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>
<!--extra division used in the page-->
<div id="mail_content">
</div>
</body>
</html>

<?php
/*if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$page=isset($_GET['page'])?$_GET['page']:0;
		if($page<0)
			$page=0;
		$link=mysql_connect("localhost:3308","root","pass");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$prev=$page-1;
		$next=$page+1;
		echo "<a href=inbox.php?page=".$prev.">previous</a>";
		echo "<a href=inbox.php?page=".$next.">next</a>";
		$leave=$page*10;
		print "page=".($page+1);
		$query1="select msg_id from  mailstats where username='$user' and type='svd' order by serial DESC limit ".$leave.",10";
		$result1=mysql_query($query1);
		$i=0;
		if(mysql_num_rows($result1)){
			echo "<form id=\"del_form\" action=\"del_mails.php\" method=\"post\">";
			while($rowset1=mysql_fetch_array($result1)){
				$id=$rowset1['msg_id'];
				$result2=mysql_query("select subject from mails where msg_id='$id';");
				$rwst2=mysql_fetch_array($result2);
				echo "<table border=\"1\">";
				echo "<tr>";
				echo "<td>".($leave + ++$i)."</td>";
				echo "<td ><input type=\"checkbox\" name=\"del_msgs[]\" value=".$id."><a class=\"msglink\" href=\"compose.php?id=".$id."\">".$rwst2['subject']."</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<input type=\"submit\" value=\"delete mails\"/>";
			echo "</form>";
		}
		else
			echo "no more mails to show!";
			mysql_close($link);
	}
	else
		echo "sorry, Your session has expired. Please log in again to see the content of this page.";
*/?>

