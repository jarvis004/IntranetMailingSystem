<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$link=mysql_connect('localhost:3308','root', 'pass');
	mysql_select_db('test1', $link);
	$page=1;
	$leave=3*$page;
	$query="select vals from test order by serial desc limit ".$leave.", 3";
	$result=mysql_query($query);
	print("<table>");
	while($row=mysql_fetch_array($result)){
		print "<tr>";
		print "<td>".$row[0]."</td>";
		print "</tr>";
	}
	print "</table>";
	mysql_close($link);
?>
</body>
</html>
