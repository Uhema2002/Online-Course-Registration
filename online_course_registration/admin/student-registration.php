<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    { 
      header('location:index.php');
    }
    else{
          if(isset($_POST['submit']))
          {
            $studentname=$_POST['studentname'];
            // $sql=$_POST['sql'];
            $password=md5($_POST['password']);
            $pincode = rand(100000,999999);
            $studingyear=$_POST['studingyear'];
            $year = date("Y");
            // $cnt = 100;
            // $cnt++;
            $str=mysqli_query($bd, "SELECT COUNT(StudentRegno) as students_count FROM `students` where studingyear = ".$studingyear);
            $row=mysqli_fetch_array($str);
            $last_id = $row['students_count'];
                              $cnt = "10". ($last_id + 1);
                              // $cnt++; 
                              $sql=$year.$studingyear.$cnt;
                          
                            //   if($studingyear == '01')
                            // {
                            //   $cnt = 100;
                            //   $cnt++; 
                            //   $sql=$year.$studingyear.$cnt;
                            // }

                            // else if($studingyear == '02')
                            // {
                            //   $cnt = 100;
                            //   $cnt++;  
                            //   $sql=$year.$studingyear.$cnt;
                            // }
                            
                            // else if($studingyear == '03')
                            // {
                            //   $cnt = 100;
                            //   $cnt++;  
                            //   $sql=$year.$studingyear.$cnt;
                            // }
                            
                            // else if ($studingyear == '04')
                            // {
                            //   $cnt = 100;
                            //   $cnt++;  
                            //   $sql=$year.$studingyear.$cnt;
                            // }
            $ret=mysqli_query($bd, "insert into students(studentName,StudentRegno,password,pincode,studingyear) values('$studentname','$sql','$password','$pincode','$studingyear')");
              if($ret)
                {$_SESSION['msg']="Student Registered Successfully !!";}
              else 
                {$_SESSION['msg']="Error : Student  not Register";}
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
    <a href="session.php">SESSION</a>
    <a href="semester.php">SEMESTER</a>
    <a href="department.php">DEPARTMENT</a>
    <a href="level.php">LEVEL</a>
    <a href="course.php">COURSE</a>
    <a href="student-registration.php">REGISTRATION</a>
    <a href="manage-students.php">MANAGE STUDENTS</a>
    <a href="enroll-history.php">ENROLL HISTORY</a>
    <a href="user-log.php">STUDENT LOGS</a>
    <a href="logout.php">LOGOUT</a>
    <div class="animation start-home"></div>
    </nav>

  
    <div class="wrapper">
    <div class="title">
      STUDENT REGISTRATION
    </div>
    <font color="green" align="center"><?php if (isset($_SESSION['msg'])) { echo htmlentities($_SESSION['msg']);}?></font>
    <div class="form">
       <form name="dept" method="post">
       <div class="inputfield">
        <label for="studentname">Student Name  </label>
    <input type="text" class="input" id="studentname" name="studentname" placeholder="Student Name" required />
       </div>  
       <!-- <div class="inputfield">
          <label for="studentregno">Student Reg num   </label>
          <input type="text" class="input" id="studentregno" name="studentregno" onBlur="userAvailability()" placeholder="Enter Registor number" required />
          <span id="user-availability-status1" style="font-size:12px;">
        </div> -->
        <div class="inputfield">
          <label for="">Studing year   </label>
          <select name="studingyear"  class="custom_select" required>
            <option value="01">First year</option>
            <option value="02">Second year</option>
            <option value="03">Third year</option>
            <option value="04">Fourth year</option>
          </select>
          <span id="user-availability-status1" style="font-size:12px;">
        </div>  
       <div class="inputfield">
      <label for="password">Password  </label>
      <input type="password" class="input" id="password" name="password" placeholder="Enter password" required />
     </div>   
      
      <div class="inputfield">
      <input type="submit" name="submit" id="submit" value="submit" class="btn">
      </div>
      </form>
    </div>
  </div>
    
   
  <script type="text/javascript" src="assets/js/main.js">
    
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>



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
  background: #fff;
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
      margin-left: 2%;
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