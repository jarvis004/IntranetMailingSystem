<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="javascript">
	function validate(){
		var pass=true;
	//	var un=/^(([A-Z]*[a-z]+)+[0-9]*)+$/;
		var un =/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
		var usr=document.forms[0].uid.value;
		var pwd=document.forms[0].pwd.value;
		if(usr=="" || !un.test(usr)){
			alert("Please enter a valid username");
			pass=false;
			document.forms[0].uid.focus;
		}
		else if(pwd==""){
			alert("password field can not be left blank");
			pass=false;
			document.forms[0].pwd.focus;
		}
		if(pass==true){
			return true;
		}
	}
</script>
</head>
<body >
<div id="container">
  <div id="header"><span class="title">IES</span></div>
  <div id="main">
    <div id="left_col"><img src="images/mailbox.jpg" alt="IES" style="width:90%; height:90%; margin:5% auto auto 5%;"/></div>
  
  <div id="right_col">
   <img src="images/vr.png" style="width:1px; float:left;" height="550px"/>
   <div id="form_holder">
   <form name="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate()">
    <label>Username:</label>
    <input class="tx" type="text" name="uid" size="20" maxlength=40/>
    <br/>
    <label>Password:</label>
    <input class="tx" type="password" name="pwd" size="20" maxlength=40/>
    <br/>
	<input type="submit" name="submit" value="sign in" class="sub-button"/>
	<br/>
	</form>
	<span style="margin:40px 0 1.2% 20%;"><a href=#>Forgot password</a></span><br/>
	<span style="margin:15px 0 0 8%;">New to IES? <a href="register.php">Create an account now</a></span>
	</div>
  </div>
  </div>
  <div id="footer" ><span class="fn1">&copy; Intranet Email System 2012</span><span class="fn2">powered by:skyroute.org</span></div>
</div>
<?php
	if(isset($_POST['submit'])){
		$user=$_POST['uid'];
		$pass=md5($_POST['pwd']);
		$link=mysql_connect("localhost","root","");
			if(!$link)
				echo("could not connect to database");
			$db="ies";
			if(!mysql_select_db($db,$link))
				echo("could not select the database");
		$resultset=mysql_query("select username from users where username='$user' and password='$pass';");
		if(mysql_num_rows($resultset)==1){
			session_start();
			$sid=session_id();
			setcookie("ies",$sid,time()+24*60*60);
			setcookie("usr", $user,time()+24*60*60);
			mysql_close($link);
			header("location:inbox.php");
		}
		else{
			echo "<script>alert(\"you are not authorised to view this page\");</script>";
		}
	}
?>
</body>
</html>
