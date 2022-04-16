<?php
session_start();
include('includes/config.php');
if
	(strlen($_SESSION['login'])==0)
    {header('location:index.php');}
else
{
	date_default_timezone_set('Asia/Kolkata');
	$currentTime = date( 'd-m-Y h:i:s A', time () );
}
	if(isset($_POST['submit']))
	{
		$sql=mysqli_query($bd, "SELECT password FROM  students where password='".md5($_POST['cpass'])."' && studentRegno='".$_SESSION['login']."'");
		$num=mysqli_fetch_array($sql);
		if($num>0)
			{
			$con=mysqli_query($bd, "update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where studentRegno='".$_SESSION['login']."'");
			$_SESSION['msg']="Password Changed Successfully !!";
			}
	  	else
	  	{$_SESSION['msg']="Current Password not match !!";}
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<title>Admin | Student Password</title>
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
</head>

<script type="text/javascript">
	function valid()
	{
	if(document.chngpwd.cpass.value=="")
	{
	alert("Current Password Filed is Empty !!");
	document.chngpwd.cpass.focus();
	return false;
	}
	else if(document.chngpwd.newpass.value=="")
	{
	alert("New Password Filed is Empty !!");
	document.chngpwd.newpass.focus();
	return false;
	}
	else if(document.chngpwd.cnfpass.value=="")
	{
	alert("Confirm Password Filed is Empty !!");
	document.chngpwd.cnfpass.focus();
	return false;
	}
	else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
	{
	alert("Password and Confirm Password Field do not match  !!");
	document.chngpwd.cnfpass.focus();
	return false;
	}
	return true;
	}
</script>
<body>
	<nav>
		<a href="enroll.php">Enroll for course</a>
		<a href="enroll-history.php">Enroll_history</a>
		<a href="my-profile.php">My profile</a>
		<a href="change-password.php">Change password</a>
		<a href="logout.php">Logout</a>
		<div class="animation start-home"></div>
	</nav>
	
	<div class="container">
		<div class="login-content">
			<img src="assets/img/avatar.svg">
			<h2 class="title">STUDENT CHANGE PASSWORD</h2>
				<form name="chngpwd" method="post" onSubmit="return valid();">
                	<font color="green" class="msg" align="center">
						<?php if (isset($_SESSION['msg'])) { echo htmlentities($_SESSION['msg']);}?>
					</font>
					<div class="input-div one"></br>
						<div class="div">
							<h5>Current password</h5>
							<input type="password" class="input" id="exampleInputPassword1" name="cpass" placeholder="" />
							<i class="toggle-password fa fa-fw fa-eye-slash"></i> 	  
						</div>
					</div>
					<div class="input-div pass"></br>
						<div class="div">
							<h5>New password</h5>
							<input type="password" class="input" id="exampleInputPassword2" name="newpass" placeholder="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
							<i class="toggle-password fa fa-fw fa-eye-slash"></i> 
						</div>
					</div>
					<div class="input-div pass"></br>
						<div class="div">
							<h5>Confirm password</h5>
							<input type="password" class="input" id="exampleInputPassword3" name="cnfpass" placeholder="" />
							<i class="toggle-password fa fa-fw fa-eye-slash"></i> 
						</div>
					</div>
            		<input type="submit" name="submit" class="btn" value="update">
            	</form>
        </div>
    </div>
	<script src="assets/js/jquery-1.11.1.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
	<script>
		var myInput = document.getElementById("newpass");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		myInput.onkeyup = function() {
			// Validate lowercase letters
			var lowerCaseLetters = /[a-z]/g;
			if(myInput.value.match(lowerCaseLetters)) {  
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}
			
			// Validate capital letters
			var upperCaseLetters = /[A-Z]/g;
			if(myInput.value.match(upperCaseLetters)) {  
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			// Validate numbers
			var numbers = /[0-9]/g;
			if(myInput.value.match(numbers)) {  
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}
			
			// Validate length
			if(myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
			}
	</script>
	<script>
		$(".toggle-password").click(function() 
		    {
				$(this).toggleClass("fa-eye fa-eye-slash");
				input = $(this).parent().find("input");
					if (input.attr("type") == "password") 
						{input.attr("type", "text");}
					else {input.attr("type", "password");}	
			});	 
	</script>
</body>
</html>


<style>
	*{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

.container{
    width: 100%;
    height: 100%;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.login-content{
	display: flex;
	justify-content: flex-start;
	align-items: center;
	text-align: center;
	width: 100%;
	margin-left: 30%;
	margin-top: -10%;
}

form{
	width: 500px;
	margin-top: 35%;
	margin-left: -70%;
}

.login-content img{
    height: 100px;
    margin-top: -30%;
    margin-left: 17%;
}

.login-content h2{
	margin: 15px 0;
	color: #333;
	text-transform: uppercase;
	font-size: 2.0rem;
	margin-top: -28%;
	margin-left: 30px;
}

.login-content .input-div{
	position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
    margin-top: 0%;
}

.login-content .input-div.one{
	margin-top: 0;
}

.i{
	color: #d9d9d9;
	display: flex;
	justify-content: center;
	align-items: center;
}

.i i{
	transition: .3s;
}

.input-div > div{
    position: relative;
	height: 45px;
}

.input-div > div > h5{
	position: absolute;
	left: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #999;
	font-size: 18px;
	transition: .3s;
}

.input-div:before, .input-div:after{
	content: '';
	position: absolute;
	bottom: -2px;
	width: 0%;
	height: 2px;
	background-color: #38d39f;
	transition: .4s;
}

.input-div:before{
	right: 50%;
}

.input-div:after{
	left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
	width: 50%;
}

.input-div.focus > div > h5{
	top: -5px;
	font-size: 15px;
}

.input-div.focus > .i > i{
	color: #38d39f;
}

.input-div > div > input{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}

.input-div.pass{
	margin-bottom: 20px;
}

a{
	display: block;
	text-align: right;
	text-decoration: none;
	color: #999;
	font-size: 0.9rem;
	transition: .3s;
}

a:hover{
	color: #38d39f;
}

.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	font-family: 'Poppins', sans-serif;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
}
.btn:hover{
	background-position: right;
}

.msg{
	margin-left: -30%;
	margin-top: -40%;
}

@media screen and (max-width: 1050px){
	.container{
		grid-gap: 5rem;
	}
}

@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}

	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}

	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 900px){
	.container{
		grid-template-columns: 1fr;
	}

	.img{
		display: none;
	}

	.wave{
		display: none;
	}

	.login-content{
		justify-content: center;
	}
}

		------------ menu ----------

		 
		body {
			font-family: 'Open Sans', sans-serif;
			background: #fff;
		}
		nav{
			position: relative;
			margin: 0px ;
			width: 100%;
			height: 70px;
			background: #34495e;
			
			font-size: 0;
			box-shadow: 0 2px 3px 0 rgba(0,0,0,.1);
		}
		nav a{
			margin-left: 10%;
			margin-top: 10px;
			font-size: 15px;
			text-transform: uppercase;
			color: white;
			text-decoration: none;
			line-height: 50px;
			position: relative;
			z-index: 1;
			display: inline-block;
			text-align: left;
		}
		
.toggle-password {
    float: right;
    cursor: pointer;
    margin-right: 10px;
    margin-top: 22px;
	
}		
		
		
		
		
</style>
