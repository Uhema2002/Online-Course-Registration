<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from students where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Student record deleted !!";
      }

     if(isset($_GET['pass']))
      {
        $password="12345";
        $newpass=md5($password);
              mysqli_query($bd, "update students set password='$newpass' where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Password Reset. New Password is 12345";
      } 
      if(isset($_GET['view']))
      {
        mysqli_query($bd, "select from students where StudentRegno = '".$_GET['id']."'");
                  
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
        
          <h1>MANAGE Students</h1>
          <font color="red" align="center"><?php if (isset($_SESSION['delmsg'])) { echo htmlentities($_SESSION['delmsg']);}?></font>
             <table class="content-table">
               <thead>
                 <tr>
                   <th>S.no</th>
                   <th>Registor number</th>
                   <th>Student name</th>
                   <th>Student Pin</th>
                   <th>Registration date</th>
                   <th>Action  </th>
                   <th>Reset password</th>
                   <th>Student details</th>
                   
                 </tr>
               </thead>
               <tbody>
                 <tbody>
<?php
$sql=mysqli_query($bd, "select * from students");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['pincode']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>              
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a></td>
<td><a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
</a>
                                            </td>
<td><a href="my-profile.php?id=<?php echo $row['StudentRegno']?>&view=select"  target="_blank"
  onclick="window.open('my-profile.php?id=<?php echo $row['StudentRegno']?>&view=select','width=100%,height=100%','_self'); return false;">
<button type="submit" name="submit" id="submit" class="btn btn-default">View Details</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                 
               </tbody>
             </table>
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
  min-width: 1200px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  margin-left: -80%;
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