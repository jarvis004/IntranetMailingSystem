<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if (isset($_COOKIE['ies'])){
		$user=$_COOKIE['usr'];
		$msgid=$_GET['id'];
		$link=mysqli_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($link,"ies"))
			echo("could not select the database");
		$result=mysqli_query($link,"select subject, msg from mails where msg_id='$msgid'");
		$row=mysqli_fetch_array($result);
		echo "<table border=1>";
		echo "<tr>";
		echo "<td><h2>".$row['subject']."</h2></td>";
		echo "<td>".$row['msg']."</td>";
		echo "</tr></table>";
		mysqli_close($link);
	}
	else
		echo "sorry, Your session has expired. Please log in again to see the content of this page.";
?>
</body>
</html>
