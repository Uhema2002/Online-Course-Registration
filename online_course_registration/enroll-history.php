<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {header('location:index.php');}   
else{ 
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
	  <h1>ENROLL HISTORY</h1>
		<table class="content-table">
			<thead>
				<tr>
					<th>S.no</th>
					<th>Course name</th>
					<th>Session</th>
					<th>Departmet</th>
					<th>Level</th>
					<th>Semester</th>
					<th>Enrollment date</th>
					<th>Action</th>
				</tr>
			</thead>
		<tbody>
<?php
$sql=mysqli_query($bd, "select courseenrolls.course as cid, course.courseName as courname,session.session as session,department.department as dept,level.level as level,courseenrolls.enrollDate as edate ,semester.semester as sem from courseenrolls join course on course.id=courseenrolls.course join session on session.id=courseenrolls.session join department on department.id=courseenrolls.department join level on level.id=courseenrolls.level  join semester on semester.id=courseenrolls.semester  where courseenrolls.studentRegno='".$_SESSION['login']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
    <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo htmlentities($row['courname']);?></td>
        <td><?php echo htmlentities($row['session']);?></td>
        <td><?php echo htmlentities($row['dept']);?></td>
        <td><?php echo htmlentities($row['level']);?></td>
		<td><?php echo htmlentities($row['sem']);?></td>
		<td><?php echo htmlentities($row['edate']);?></td>
		<td>
			<a href="print.php?id=<?php echo $row['cid']?>" target="_blank">
            	<button class="btn btn-primary"><i class="fa fa-print "></i> Print</button> 
			</a>
		</td>
    </tr>
<?php 
$cnt++;
} ?>
		</tbody>
    </table>
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
  padding: 0 0px;}
  


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
	.content-table {
  border-collapse: collapse;
  margin: 30px 0;
  font-size: 0.9em;
  min-width: 1300px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  margin-left: 7%;
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
	margin: 15px 0;
	margin-left: 40%;
	margin-top: 30px;
	color: #333;
	text-transform: uppercase;
	font-size: 2.0rem;
}
</style>