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
		var secq=document.forms[0].scq.value;
		var seca=document.forms[0].sca.value;
		var newpwd=document.forms[0].newpwd.value;

		if(usr=="" || !un.test(usr)){
			alert("Please enter a valid username");
			pass=false;
			document.forms[0].uid.focus;
		}
		else if(seca==""){
			alert("Security Answer field can not be left blank");
			pass=false;
			document.forms[0].seca.focus;
		}
		else if(newpwd==""){
			alert("New password field can not be left blank");
			pass=false;
			document.forms[0].newpwd.focus;
		}
		if(pass==true){
			return true;
		}
	}</script>
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
    <label  style =" font-style:normal;font-family:Verdana;font-size:14px;">Username:</label><br /><input style =" font-style:normal;font-family:Verdana;font-size:12px;" class="tx mar" type="text" placeholder = "Enter Username" name="uid" size=20  maxlength=40/><span class="avail"></span>
    <!--<label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Password:</label><br /><input  style =" font-style:normal;font-family:Verdana;font-size:12px;" class="tx mar" placeholder= "Enter Password " type="password" name="pwd" size=25 text-align = "center"  maxlength=40/>
	<input style =" font-style:bold;" type="submit" name="submit" value="Sign In" class="sub-button"/>
	<br/>
	</form>
	<span style="margin:40px 0 1.2% 20%;"><a href='forgotpassword.php'>Forgot password</a></span><br/>
	<span style="margin:15px 0 0 8%;">New to IntraMail? <a href="register.php">Create an account now</a></span>
	</div>
  </div>
  </div>
 comment starts here
<div id="footer"><span class="fn1">&copy; Intranet Email System 2018</span><span class="fn2">powered by:IIIT Allahabad</span>
</div>-->
    <label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Select Security Question:</label><br>
    

	<select name = "scq" class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:12px;" maxlength=40;>
  	<option value="1" >First pet's Name ?</option>
  	<option value="2" >Favourite Sports Club ?</option>
  	<option value="3">Favourite player ?</option>
	</select>
	<br>
    <label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">Answer:</label>
    <input class="tx mar" style =" font-style:normal;font-family:Verdana;font-size:12px;" type="password" name="sca" placeholder = "Enter Answer" size="20" maxlength=40/>
    <label class = "mar"  style =" font-style:normal;font-family:Verdana;font-size:14px;">New password:</label>
    <input class="tx mar" style =" font-style:normal;font-family:Verdana;font-size:12px;" type="password" name="newpwd" placeholder = "Enter Password" size="20" maxlength=40/>

	<input type="submit" name="submit" value="Update password" class="sub-button"/>
	<br/>
	</form>
	<span style="margin:20px 0 0 15%;">Already a user? <a href="index.php">Sign In</a></span>

	<span style="margin:15px 0 0 8%;">New to IntraMail? <a href="register.php">Create an account now</a></span>
	</div>
  </div>
  </div>
</div>

<?php
	if(isset($_POST['submit'])){
		$user=$_POST['uid'];
		$secques=$_POST['scq'];
		$secans=$_POST['sca'];
		$newpass=md5($_POST['newpwd']);
		//$pass=md5($_POST['pwd']);
		$link=mysql_connect("localhost","root","");
			if(!$link)
				echo("could not connect to database");
			$db="ies";
			if(!mysql_select_db($db,$link))
				echo("could not select the database");
		$resultset=mysql_query("select username from users where username='$user' and security_question = '$secques' and sq_answer = '$secans' ;");
		if(mysql_num_rows($resultset)==1){
		/*	session_start();
			$sid=session_id();
			setcookie("ies",$sid,time()+24*60*60);
			setcookie("usr", $user,time()+24*60*60);
			mysql_close($link);
			header("location:inbox.php");
			UPDATE users set password = '$newpass' where username='$user'

		*/

			$success=mysql_query("UPDATE users set password = '$newpass' where username='$user'	;");
			if($success)
				echo "<script>alert(\"password changed successfully \");</script>";

				
		}
		else{
			echo "<script>alert(\"you are not authorised to view this page\");</script>";
		}
	}
?>
</body>
</html>
