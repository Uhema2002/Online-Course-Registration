<?php
session_start();
include('includes/config.php');
  if(strlen($_SESSION['alogin'])==0)
      {header('location:index.php');}   
  else{
        if(isset($_POST['submit']))
          {
            $department=$_POST['department'];
            $ret=mysqli_query($bd, "insert into department(department) values('$department')");
            if($ret)
              {$_SESSION['msg']="Department Created Successfully !!";}
            else
              {$_SESSION['msg']="Error : Department not created";}
          }
        if(isset($_GET['del']))
          {
            mysqli_query($bd, "delete from department where id = '".$_GET['id']."'");
            $_SESSION['delmsg']="Department deleted !!";
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
<body>
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
    <div class="login-content">
        <form name="dept" method="post">
            <h2 class="title">Create Department</h2></br>
            <font color="green" align="center">
            <?php if (isset($_SESSION['msg'])) { echo htmlentities($_SESSION['msg']);}?>
            </font> 
                <div class="input-div one"></br>
                    <div class="div">
                        <h5>Create Department</h5>
                        <input type="text" class="input" id="department" name="department"  required />
                    </div>
                </div>
                   <input type="submit" name="submit" class="btn" value="Create">
        </form>
    </div>
        <h1>manage department</h1>
        <font color="red" align="center">
          <?php if (isset($_SESSION['delmsg'])) { echo htmlentities($_SESSION['delmsg']);}?>
        </font>
            <table class="content-table">
                <thead>
                  <tr>
                    <th>S.no</th>
                    <th>Department</th>
                    <th>Creation date</th>
                    <th>Action  </th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $sql=mysqli_query($bd, "select * from department");
                    $cnt=1;
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                          <tr>
                              <td><?php echo $cnt;?></td>
                              <td><?php echo htmlentities($row['department']);?></td>
                              <td><?php echo htmlentities($row['creationDate']);?></td>
                              <td>
                                  <a href="department.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                  <button class="abcd">&nbsp;Delete&nbsp;</button>
                                  </a>
                              </td>
                          </tr>
                    <?php 
                    $cnt++;
                    } ?>
                </tbody>
            </table>
</div>
   
    
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
<?php } ?>


<style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: scroll;
}

.wave{
    position: fixed;
    bottom: 0;
    left: 0;
    height: 100%;
    z-index: -1;
}

.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.img{
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.login-content{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    text-align: center;
    width: 100%;
    margin-left: 5%;
    margin-top: -10%;
}

.img img{
    width: 500px;
}

form{
    width: 500px;
}

.login-content img{
    height: 100px;
}

.login-content h2{
    margin: 15px 0;
    color: #333;
    text-transform: uppercase;
    font-size: 2.0rem;
}

.login-content .input-div{
    position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
}

.abcd{
     margin-right: 70%;
     font-size: 1.0rem;
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
    margin-bottom: 4px;
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
    margin-left: 20%;
    margin-top: 10%;
    color: #333;
    text-transform: uppercase;
    font-size: 1.5rem;
}
        
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #fff;
  margin: 20px auto;
  
  padding: 30px;
  height: 100%;
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
        
        
</style>
