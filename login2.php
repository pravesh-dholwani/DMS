<?php
include("conn.php");
session_start();
error_reporting(0);
$_SESSION['login_set']=0;
?>
<html>
<head>
<style type="text/css">
body{
background-image: url(abc.jpg);
background-size: cover;
}
.aa{
width: 300px;
padding: 40px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
background: rgba(0,0,0,0.7);
text-align: center;
}
.aa h1{
color: white;
font-weight: 500;
}
.aa input[type="text"],.aa input[type="password"]
{
border:0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 4px solid #3498db;
padding: 14px 10px;
width: 200px;
outline: none;
color: white;
border-radius: 25px;
transition: 0.25s;
}
.aa input[type="text"]:focus,.aa input[type="password"]:focus
{
width: 280px;
border-color: #2ecc71;
}
.aa input[type="submit"]
{
border:0;
background: rgba(0,0,0,0.4);
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #2ecc71;
padding: 14px 40px;
outline: none;
color: white;
border-radius: 25px;
transition: 0.25s;
cursor: pointer;
}
.aa input[type="submit"]:hover
{
background: #2ecc71;
}
.button{
border:0;
background: skyblue;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #2ecc71;
padding: 14px 40px;
outline: none;
color: black;
border-radius: 25px;
transition: 0.25s;
cursor: pointer;
}
</style>
</head>
<body>
<div class="aa">
<h1>LOGIN</h1>
<form action="" method="POST">
<input type="text" name="uid" placeholder="Enter userid"/>
<input type="password" name="password" placeholder="password"/>
<input type="submit" name="submit" value="LOGIN"/>
<a href="teacherreg2.php" class="button">REGISTRATION</a>
</form>
</div>
<?php
if(isset($_POST['submit']))
{
$userid=$_POST['uid'];
$pwd=$_POST['password'];
$qwery="select * from teachers where teacher_id='$userid' AND password='$pwd'";
$data= mysqli_query($conn,$qwery);
$total= mysqli_num_rows($data);
if($total==1)
{
	$_SESSION['login_set']=1;
$_SESSION['teacher_id']=$_POST['uid'];
header('location:teacher.php');

}
else
{
echo"login failed";
}
}
?>
</body>
</html>
