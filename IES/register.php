<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New User Sign Up</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script src="scripts/jquery.js"></script>
<script src="scripts/js01.js"></script>
<script type="text/javascript" language="javascript">
	function validate(){
		var pass=true;
		var un=/^(([A-Z]*[a-z]+)+[0-9]*)+$/;
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
			document.forms[0].submit();
		}
	}
</script>
</head>

<body>
<div id="container">
  <div id="header"><span class="title">IES</span></div>
  <div id="main">
    <div id="left_col"><img src="images/mailbox.jpg" alt="IES" style="width:90%; height:90%; margin:5% auto auto 5%;"/>
	</div>
   	<div id="right_col">
   		<img src="images/vr.png" style="width:1px; float:left;" height="550px"/>
		<div id="form_holder">
		<form autocomplete="off" name="reg_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<label>Username:</label><br /><input class="tx" type="text" name="uid" size=20 maxlength=40/><br /><span class="avail"></span>
			<label style="">Password:</label><br /><input class="tx" type="password" name="pwd" size=20 maxlength=40/>
			<input type="button" name="register" value="sign up" onclick="validate()" class="sub-button"/>
			<span style="margin:20px 0 0 15%;">already a user? <a href="index.php">Sign In</a></span>
		</form>
		</div>
	</div>
</div>
<div id="footer" ><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:</span></div>
</div>
<?php
	if(count($_POST)>0){
		$link=mysqli_connect("localhost","root","","ies");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysqli_select_db($link,"ies"))
			echo("could not select the database");
		$user=$_POST['uid'];
		$pass=md5($_POST['pwd']);
		echo $user."<br/>".$pass;
		$success=mysqli_query($link,"insert into users(username, password) values('$user','$pass');");
		if($success)
			echo "registration successful";
	}
?>
</body>
</html>
