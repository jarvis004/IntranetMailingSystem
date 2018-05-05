<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
<style type="text/css">
*{
padding:auto;
margin:auto;

}
.header img {
  float: left;
  width: 35px;
  height: 35px;
  background: #555;
}

.header h3 {
  position: relative;
  top: 7px;
  left: 10px;
  font-family:Arial;
}
.mar {
	margin-left:14%;
	margin-top:3%;
	margin-bottom:3%;
}
</style>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="javascript">
	function validate(){
		var pass=true;
	//	var un=/^(([A-Z]*[a-z]+)+[0-9]*)+$/;
	//	var un =/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
		var un =/^([a-zA-Z0-9_\-\.]+)$/;
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
<body background = "images/effil.jpg">
<div id="container" font-family = "Arial" style="background: #FFFFF2;
		height:55%;
		width:21%;
        color: black;
        padding: 2em;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)"> 
        <div class="header">
  		<img src="images/logo1.gif" alt="logo" />
  		<h3> <font color="#808080">IntraMail</font></h3>
		</div>    
    <div id="form_holder">
    <form name="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate()">
    <label  style =" font-style:normal;font-family:Verdana;font-size:14px;">Username:</label><br /><input style =" font-style:normal;font-family:Verdana;font-size:12px;" class="tx mar" type="text" placeholder = "Enter Username" name="uid" size=25  maxlength=40/><br /><span class="avail"></span>
    <label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Password:</label><br /><input  style =" font-style:normal;font-family:Verdana;font-size:12px;" class="tx mar" placeholder= "Enter Password " type="password" name="pwd" size=25 text-align = "center"  maxlength=40/>
	<input style =" font-style:bold;" type="submit" name="submit" value="Sign In" class="sub-button"/>
	<br/>
	</form>
	<span style="margin:40px 0 1.2% 20%;"><a href='forgotpassword.php'>Forgot password</a></span><br/>
	<span style="margin:15px 0 0 8%;">New to IntraMail? <a href="register.php">Create an account now</a></span>
	</div>
  </div>
  </div>
<!--<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>-->
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
