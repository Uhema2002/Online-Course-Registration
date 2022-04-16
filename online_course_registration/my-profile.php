<?php
session_start();
include('includes/config.php');
if
    (strlen($_SESSION['login'])==0)
    {header('location:index.php');}   
else{
    if(isset($_POST['submit']))
      {
        $studentname=$_POST['studentname'];
        $photo=$_FILES["photo"]["name"];
        $cgpa=$_FILES["cgpa"]["name"];
        $email=$_POST['email'];
        $phone=$_POST['phone_no'];
        $address=$_POST['address'];
        $postal=$_POST['postal_code'];
        $gender=$_POST['gender'];
          move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
          move_uploaded_file($_FILES["cgpa"]["tmp_name"],"cgpa/".$_FILES["cgpa"]["name"]);
        $ret=mysqli_query($bd, "update students set studentName='$studentname',Gender='$gender',email='$email',phone_no='$phone',cgpa='$cgpa',address='$address',postal_code='$postal',studentPhoto='$photo'  where StudentRegno='".$_SESSION['login']."'");
        if($ret)
            {$_SESSION['msg']="Student Record updated Successfully !!";}
        else
            {$_SESSION['msg']="Error : Student Record not update";}
      }
?>

<!DOCTYPE html>
<html>
<head>
	<title>my project</title>
	<link rel="stylesheet" type="text/css" href="assets/css/.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<nav>
		<a href="enroll.php">Enroll for course</a>
		<a href="enroll-history.php">Enroll_history</a>
		<a href="my-profile.php">My profile</a>
		<a href="change-password.php">Change password</a>
		<a href="logout.php">Logout</a>
		<div class="animation start-home"></div>
    </nav>

			<?php $sql=mysqli_query($bd, "select * from students where StudentRegno='".$_SESSION['login']."'");
			$cnt=1;
			while($row=mysqli_fetch_array($sql)){
			?>
<form name="dept" method="post" enctype="multipart/form-data">
	<div class="wrapper">
		<div class="left">
			<?php if($row['studentPhoto']==""){ ?>
			<img src="studentphoto/noimage.png" width="100" ><?php } else {?>
			<img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="100" >
			<?php } ?>
			<h4   id="studentname" name="studentname"><?php echo htmlentities($row['studentName']);?></h4>
		</div>
		<div class="right">
			<div class="info">
				<h3>My Profile</h3>
				<div class="info_data">
					<div class="data">
						<h4>Register Number</h4>
						<p id="studentregno" name="studentregno"><?php echo htmlentities($row['StudentRegno']);?></p>
					</div>
					<div class="data">
					   <h4>Student Pin</h4>
						<p id="Pincode" name="Pincode"><?php echo htmlentities($row['pincode']);?></p>
				    </div>
				</div>
				<div class="info_data">
					<div class="data">
						<h4>Email</h4>
						<p id="email" name="email"><?php echo htmlentities($row['email']);?></p>
					</div>
					<div class="data">
					   <h4>Gender</h4>
					   <p id="gender" name="gender"><?php echo htmlentities($row['Gender']);?></p>
				    </div>
				</div>
				<div class="info_data">
					<div class="data">
						<h4>Phone Number</h4>
						<p id="phone_no" name="phone_no"><?php echo htmlentities($row['phone_no']);?></p>
					</div>
					<div class="data">
					   <h4>CGPA</h4>
					   <p id="cgpa" name="cgpa">
					   		<?php if($row['cgpa']==""){ ?>
							<p><span style="color:red"> No file here</span></p><?php } else {?>
							<a href="javascript:void(0);" onclick="javascipt:window.open('cgpa/<?php echo htmlentities($row['cgpa']);?>','width=100%,height=100%','_self');return false;" class="popup">View</a>  
							<?php } ?>
					   </p>
				    </div>
				</div>
				<div class="info_data">
					<div class="data">
					   <h4>Address</h4>
					   <p id="address" name="address"><?php echo htmlentities($row['address']);?></p>
				    </div>
					<div class="data">
						<h4>Postal Code</h4>
						<p id="postal_code" name="postal_code"><?php echo htmlentities($row['postal_code']);?></p>
					</div>
				</div>
			</div>
<?php } ?>			
			<span style="color: black;"><p>Click here to <a href="edit-profile.php">Edit</a></p></span>
		</div>
<?php } ?>
	</div>	
</form>    
   
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>


<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		list-style: none;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
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

a:hover{
	     color: #38d39f;
        }

.wrapper{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 1000px;
  display: flex;
  box-shadow: 0 1px 20px 0 rgba(69,90,100,.08);
}

.wrapper .left{
  width: 35%;
  background: linear-gradient(to right,#34495e,#34495e);
  padding: 30px 25px;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  text-align: center;
  color: #fff;
}

.wrapper .left img{
  border-radius: 5px;
  margin-bottom: 10px;
  width:70%;
}

.wrapper .left h4{
  margin-bottom: 10px;
}

.wrapper .left p{
  font-size: 12px;
}

.wrapper .right{
  width: 65%;
  background: #fff;
  padding: 30px 25px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}

.wrapper .right .info,
.wrapper .right .projects{
  margin-bottom: 25px;
}

.wrapper .right .info h3,
.wrapper .right .projects h3{
    margin-bottom: 15px;
    padding-bottom: 5px;
    border-bottom: 1px solid #e0e0e0;
    color: #353c4e;
  text-transform: uppercase;
  letter-spacing: 5px;
}

.wrapper .right .info_data,
.wrapper .right .projects_data{
  display: flex;
  justify-content: space-between;
}

.wrapper .right .info_data .data,
.wrapper .right .projects_data .data{
  width: 45%;
}

.wrapper .right .info_data .data h4,
.wrapper .right .projects_data .data h4{
    color: #353c4e;
    margin-bottom: 5px;
}

.wrapper .right .info_data .data p,
.wrapper .right .projects_data .data p{
  font-size: 13px;
  margin-bottom: 10px;
  color: #919aa3;
}

.wrapper .social_media ul{
  display: flex;
}

.wrapper .social_media ul li{
  width: 45px;
  height: 45px;
  background: linear-gradient(to right,#01a9ac,#01dbdf);
  margin-right: 10px;
  border-radius: 5px;
  text-align: center;
  line-height: 45px;
}

.wrapper .social_media ul li a{
  color :#fff;
  display: block;
  font-size: 18px;
}
</style>
