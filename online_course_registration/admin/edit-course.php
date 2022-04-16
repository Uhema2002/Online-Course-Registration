<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$id=intval($_GET['id']);
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
$coursecode=$_POST['coursecode'];
$coursename=$_POST['coursename'];
$courseunit=$_POST['courseunit'];
$seatlimit=$_POST['seatlimit'];
$ret=mysqli_query($bd, "update course set courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit',updationDate='$currentTime' where id='$id'");
if($ret)
{
$_SESSION['msg']="Course Updated Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Course not Updated";
}
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
      COURSE
    </div>
    <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
    <div class="form">
      <form name="dept" method="post">
<?php
$sql=mysqli_query($bd, "select * from course where id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<span style="color: red"><p><b>Last Updated at</b> :<?php echo htmlentities($row['updationDate']);?></p></span>
       <div class="inputfield">
        <label for="coursename">Course Name  </label>
    <input type="text" class="input" id="coursename" name="coursename"  value="<?php echo htmlentities($row['courseName']);?>" required />
       </div>  
      <div class="inputfield">
       <label for="coursecode">Course Code  </label>
    <input type="text" class="input" id="coursecode" name="coursecode" value="<?php echo htmlentities($row['courseCode']);?>" required />
       </div>  
       <div class="inputfield">
      <label for="courseunit">Course unit  </label>
    <input type="number" class="input" id="courseunit" name="courseunit"  value="<?php echo htmlentities($row['courseUnit']);?>" required />
     </div>   
      
      
      <div class="inputfield">
        <label for="seatlimit">Seat limit  </label>
    <input type="number" class="input" id="seatlimit" name="seatlimit"  value="<?php echo htmlentities($row['noofSeats']);?>" required />
       </div> 
      <?php } ?>
      <div class="inputfield">
      <input type="submit" name="submit" value="Update" class="btn">
      </div>
      </form>
      
    </div>
  </div>
    
   
  <script type="text/javascript" src="assets/js/main.js"></script>
  
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
    .content-table {
  border-collapse: collapse;
  margin: 0px 0;
  font-size: 0.9em;
  min-width: 1000px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  margin-left: -60%;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.content-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 12px 15px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}
h1{
  margin: 5px 0;
  margin-left: 24%;
  margin-top: 10%;
  color: #333;
  text-transform: uppercase;
  font-size: 2.0rem;
}
</style>