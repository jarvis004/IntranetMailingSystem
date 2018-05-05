<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New User Sign Up</title>
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
<script src="scripts/jquery.js"></script>
<script src="scripts/js01.js"></script>
<script type="text/javascript" language="javascript">
	function validate(){
		var pass=true;
	//	var un=/^(([A-Z]*[a-z]+)+[0-9]*)+$/;
		// checks for any email something@something.com
	//	var un =/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
		var un =/^([a-zA-Z0-9_\-\.]+)$/;
	/*	checks for something@imail.com
		var un =/^([a-zA-Z0-9_\-\.]+)@imail.com$/; */
		var usr=document.forms[0].uid.value;
		var pwd=document.forms[0].pwd.value;
		var scq=document.forms[0].scq.value;
		var sca=document.forms[0].sca.value;

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
		else if(scq==""){
			alert("Security Question field can not be left blank");
			pass=false;
			document.forms[0].sca.focus;
		}
		else if(sca==""){
			alert("Security Answer field can not be left blank");
			pass=false;
			document.forms[0].sca.focus;
		}
		if(pass==true){
			document.forms[0].submit();
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
		<form autocomplete="off" name="reg_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			<label style =" font-style:normal;font-family:Verdana;font-size:14px;">Username:</label><br /><input style =" font-style:normal;font-family:Verdana;font-size:11px;" class="tx mar" placeholder = "Enter Username" type="text" name="uid" size=20 maxlength=40/><span class="avail"></span>
			<label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Password:</label><br /><input style =" font-style:normal;font-family:Verdana;font-size:12px;" class="tx mar" type="password" placeholder = "Enter Password" name="pwd" size=20 maxlength=40/>
			<label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Security Question:</label><br />
           	
			<select name = "scq" class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:13px;">
  			<option value="1">First pet's Name ?</option>
  			<option value="2">Favourite Sports Club ?</option>
  			<option value="3">Favourite player ?</option>
			</select><br>
			
            <label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Answer:</label><br /><input class="tx mar"  style =" font-style:normal;font-family:Verdana;font-size:11px;" placeholder = "Enter Answer" type="password" name="sca" size=20 maxlength=40/>
			<input type="button" name="register" value="sign up" onclick="validate()" class="sub-button"/>
			<span style="margin:20px 0 0 15%;">already a user? <a href="index.php">Sign In</a></span>
		</form>
		</div>

	</div>
<!--<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>-->
<?php
	if(count($_POST)>0){
		$link=mysql_connect("localhost","root","");
		if(!$link)
			echo("could not connect to database");
		$db="ies";
		if(!mysql_select_db($db,$link))
			echo("could not select the database");
		$user=$_POST['uid'];
		$pass=md5($_POST['pwd']);
		$scques = $_POST['scq'];
		$scans=($_POST['sca']);
		echo $user."<br/>".$pass;
		$success=mysql_query("insert into users(username, password,security_question,sq_answer) values('$user','$pass','$scques','$scans');");
		if($success)
			echo "<script>alert(\"Registration Successful\");</script>";
	}
?>
</body>
</html>
