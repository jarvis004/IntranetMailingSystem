<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	if (isset($_COOKIE['ies'])){
		print "oh! i know you!!\r\n here's the secret content<br/>";
		echo $_COOKIE['ies'];
	}
	else
		echo "sorry who are you again!";
?>
<form name="logout" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><br />
<input type="submit" name="submit" value="log out" />
</form>
<a href="new2.php"> go directly</a>
<?php
	if(isset($_POST['submit'])&&isset($_COOKIE['ies'])){
		$sid=$_COOKIE['ies'];
		echo $sid;
		setcookie("ies",$sid, 1);
	}
?>
</body>
</html>
