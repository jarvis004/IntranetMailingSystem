<?php
	$link=mysql_connect("localhost:3308","root","pass");
	if(!$link)
		echo("could not connect to database");
	$db="test1";
	if(mysql_select_db($db,$link))
		echo("database selected");
	//$result1 = mysql_query( "SELECT * FROM test_table" );
	print "<table border=\"1\">";
	while($row=mysql_fetch_array($result1)){
		print "<tr>";
		print "<td>".$row['sn']."</td>";
		print "<td>".$row['textvalue']."</td>";
		print "</tr>";
	}
	print "</table>";
	$num=3;
	$text="hi again";
//	mysql_query("insert into test_table values('$num','$text')");
	mysql_close($link);
	$ts=mktime();
	print date("m/d/y g.i:s<br>", $ts);
	$msg="msg".mt_rand(0, 9999).mktime();
	print $msg;
?>