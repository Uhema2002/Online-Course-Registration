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
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="myprofile">
  <nav>
    <a href="enroll.php">Enroll for course</a>
    <a href="enroll-history.php">Enroll_history</a>
    <a href="my-profile.php">My profile</a>
    <a href="change-password.php">Change password</a>
    <a href="logout.php">Logout</a>
    <div class="animation start-home"></div>
  </nav>
  
  <div class="wrapper">
    <div class="title">
      REGISTRATION FORM
    </div>
    <font color="green" align="center">
      <?php if (isset($_SESSION['msg'])) { echo htmlentities($_SESSION['msg']);}?>
    </font>
                            <?php $sql=mysqli_query($bd, "select * from students where StudentRegno='".$_SESSION['login']."'");
                            $cnt=1;
                            while($row=mysqli_fetch_array($sql)){
                             ?>
    <form name="dept" method="post" enctype="multipart/form-data">
        <div class="form">
          <div class="inputfield">
          <label for="studentname">Student Name  </label>
          <input type="text" class="input" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>" required />
        </div>  
        <div class="inputfield">
          <label for="studentregno">Student Reg No   </label>
          <input type="text" class="input" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']);?>"  placeholder="Student Reg no" readonly />
        </div>  
        <div class="inputfield">
          <label  for="student-pin">Student Pin</label>
          <input type="text" class="input" id="Pincode" name="Pincode" readonly value="<?php echo htmlentities($row['pincode']);?>" required />
        </div>   
        <div class="inputfield">
          <label>Gender</label>
          <select name="gender"  class="custom_select" required>
              <?php 
                if ($row['Gender'] == 'Male') {

                    echo "<option selected>Male</option>";
                    echo "<option>Female</option>";

                } else {
                    echo "<option selected>Female</option>";
                    echo "<option>Male</option>";
                }
              ?>
          </select>
        </div> 
        <div class="inputfield">
          <label>Email Address</label>
          <input type="email" class="input" id="email" name="email"  value="<?php echo htmlentities($row['email']);?>" required />
        </div> 
        <div class="inputfield">
          <label>Phone Number</label>
          <input type="number" class="input" id="phone_no" name="phone_no"  value="<?php echo htmlentities($row['phone_no']);?>" required />
        </div> 
        <div class="inputfield">
          <label>CGPA</label>
          <input type="file" class="input" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" required />
        </div> 
        <div class="inputfield">
          <label>Address</label>
          <input type="text" class="input" id="address" name="address"  value="<?php echo htmlentities($row['address']);?>" required />
        </div> 
        <div class="inputfield">
          <label>Postal Code</label>
          <input type="number" class="input" id="postal_code" name="postal_code"  value="<?php echo htmlentities($row['postal_code']);?>" required />
        </div> 
        <div class="inputfield">
          <label>Student photo</label>
          <input type="file" class="input" id="photo" name="photo"  value="<?php echo htmlentities($row['studentPhoto']);?>" required />
        </div>
<?php } ?>
        <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" >
            <span class="checkmark"></span>
          </label>
          <p>Check the details once more</p>
        </div> 
<?php } ?>       
        <div class="inputfield">
          <input type="submit" value="Update" class="btn" name="submit">
        </div>
    </form>  

  </div>
    
  
  <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>




<style>

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'poppins', sans-serif;
}
body{
  background: white;
  padding: 0 0px;
  
}
.wrapper{
  max-width: 500px;
  width: 100%;
  background: rgb(255, 255, 255);
  margin: 20px auto;
  
  padding: 30px;
}

.wrapper .title{
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #000;
  text-transform: uppercase;
  text-align: center;
}

.wrapper .form{
  width: 100%;
}

.wrapper .form .inputfield{
  margin-bottom: 15px;
  display: flex;
  align-items: center;
}

.wrapper .form .inputfield label{
   width: 200px;
   color: #757575;
   margin-right: 10px;
  font-size: 14px;
}

.wrapper .form .inputfield .input,
.wrapper .form .inputfield .textarea{
  width: 100%;
  outline: none;
  border: 1px solid #d5dbd9;
  font-size: 15px;
  padding: 8px 10px;
  border-radius: 3px;
  transition: all 0.3s ease;
}

#studentregno, #Pincode
{
  width: 100%;
  outline: none;
  border: 1px solid #d5dbd9;
  font-size: 15px;
  padding: 8px 10px;
  border-radius: 3px;
  transition: all 0.3s ease;
  background-color:#d9d7d2;
}

.wrapper .form .inputfield .textarea{
  width: 100%;
  height: 125px;
  resize: none;
}

.wrapper .form .inputfield .custom_select{
  position: relative;
  width: 100%;
  height: 37px;
}

.wrapper .form .inputfield .custom_select:before{
  content: "";
  position: absolute;
  top: 12px;
  right: 10px;
  border: 8px solid;
  border-color: #d5dbd9 transparent transparent transparent;
  pointer-events: none;
}

.wrapper .form .inputfield .custom_select select{
  -webkit-appearance: none;
  -moz-appearance:   none;
  appearance:        none;
  outline: none;
  width: 100%;
  height: 100%;
  border: 0px;
  padding: 8px 10px;
  font-size: 15px;
  border: 1px solid #d5dbd9;
  border-radius: 3px;
}


.wrapper .form .inputfield .input:focus,
.wrapper .form .inputfield .textarea:focus,
.wrapper .form .inputfield .custom_select select:focus{
  border: 1px solid #32b28f;
}

.wrapper .form .inputfield p{
   font-size: 14px;
   color: #757575;
}
.wrapper .form .inputfield .check{
  width: 15px;
  height: 15px;
  position: relative;
  display: block;
  cursor: pointer;
}
.wrapper .form .inputfield .check input[type="checkbox"]{
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.wrapper .form .inputfield .check .checkmark{
  width: 15px;
  height: 15px;
  border: 1px solid #32be8f;
  display: block;
  position: relative;
}
.wrapper .form .inputfield .check .checkmark:before{
  content: "";
  position: absolute;
  top: 1px;
  left: 2px;
  width: 5px;
  height: 2px;
  border: 2px solid;
  border-color: transparent transparent #fff #fff;
  transform: rotate(-45deg);
  display: none;
}
.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark{
  background: #32be8f;
}

.wrapper .form .inputfield .check input[type="checkbox"]:checked ~ .checkmark:before{
  display: block;
}

.wrapper .form .inputfield .btn{
  width: 100%;
   padding: 8px 10px;
  font-size: 15px; 
  border: 0px;
  background:  #32be8f;
  color: #fff;
  cursor: pointer;
  border-radius: 3px;
  outline: none;
}

.wrapper .form .inputfield .btn:hover{
  background: darkgreen;
}

.wrapper .form .inputfield:last-child{
  margin-bottom: 0;
}

@media (max-width:420px) {
  .wrapper .form .inputfield{
    flex-direction: column;
    align-items: flex-start;
  }
  .wrapper .form .inputfield label{
    margin-bottom: 5px;
  }
  .wrapper .form .inputfield.terms{
    flex-direction: row;
  }
}
body {
      font-family: 'Open Sans', sans-serif;
      
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

</style>