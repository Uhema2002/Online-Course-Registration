<?php
session_start();
include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0)
      {header('location:index.php');}
    else{
          if(isset($_POST['submit']))
            {
                $level=$_POST['level'];
                $ret=mysqli_query($bd, "insert into level(level) values('$level')");
                if($ret)
                {$_SESSION['msg']="Level Created Successfully !!";}
                else
                {$_SESSION['msg']="Error : Level not created";}
            }
                if(isset($_GET['del']))
                {
                    mysqli_query($bd, "delete from level where id = '".$_GET['id']."'");
                    $_SESSION['delmsg']="Level deleted !!";
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
        <form name="level" method="post">
            <h2 class="title">Create level</h2></br>
            <font color="green" align="center">
                <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
            </font>
                <div class="input-div one"></br>
                    <div class="div">
                        <h5>Create level</h5>
                        <input type="number" class="input" id="level" name="level"  required />
                    </div>
                </div>
                    <input type="submit" name="submit" class="btn" value="Create">
        </form>
    </div>
            <h1>manage level</h1>
            <font color="red" align="center">
                <?php if (isset($_SESSION['delmsg'])) { echo htmlentities($_SESSION['delmsg']);}?>
            </font>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>level</th>
                            <th>Creation date</th>
                            <th>Action  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql=mysqli_query($bd, "select * from level");
                        $cnt=1;
                        while($row=mysqli_fetch_array($sql))
                        {
                        ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo htmlentities($row['level']);?></td>
                                <td><?php echo htmlentities($row['creationDate']);?></td>
                                <td>
                                    <a href="level.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                    <button class="abcd">&nbsp;Delete&nbsp;</button>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                        $cnt++;
                        } ?>
                    </tbody>
                </table>
                
        </form>
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

.abcd{
     margin-right: 70%;
     font-size: 1.0rem;
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
    margin-left: 24%;
    margin-top: 10%;
    color: #333;
    text-transform: uppercase;
    font-size: 2.0rem;
}
        
.wrapper{
  max-width: 500px;
  width: 100%;
  background: #fff;
  margin: 20px auto;
  
  padding: 30px;
  height: 100%;
}   
        
        
</style>
