<?php
session_start();
if(!isset($_SESSION['admin_id']))
{
	header:("location:admin.php");
}
include("conn.php");
error_reporting(0);
?>
<html>
<head>
<script>
	function callalert()
	{
		alert("COURSE already exists");
	}
	function callsuccess()
	{
		alert("Course added successfully");
	}
</script>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style type="text/css">
body{
background-color :#657383;

background-size: cover;
color:white;
}
.aa{
width: 600px;
padding: 40px;
position: absolute;
top: 60%;
left: 50%;
transform: translate(-50%,-50%);
background: #e1e8fo;
font-family: sns-serif;
font-size: 22px;
}
.aa h1,.aa h3{
color: white;
font-weight: 500;
}
.aa input[type="text"],.aa input[type="password"],.aa input[type="date"],.aa input[type="email"],.aa input[type="Number"]
{
border:0;
background: rgba(0,0,0,0.4);
margin: 10px auto;
text-align: center;
border: 3px solid #3498db;
padding: 5px 7px;
width: 130px;
outline: none;
color: white;
transition: 0.25s;
}
.aa input[type="radio"]
{
border:0;
background: none;
margin: 7px auto;
border: 3px solid #3498db;
padding: 7px 12px;
width: 50px;
outline: none;
color: rgb(0,0,0);
transition: 0.25s;
}
.aa input[type="text"]:focus,.aa input[type="password"]:focus,.aa input[type="date"]:focus,.aa input[type="email"]:focus,.aa input[type="Number"]:focus
{
width: 200px;
border-color: #2ecc71;
}
.aa input[type=radio]:focus
{
width: 240px;
border-color: #2ecc71;
}
input[type="submit"],button
{
border:0;
background: none;
display:inline;
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
input[type="submit"]:hover,button:hover
{
background: #2ecc71;
}
</style>
</head>
<button onclick="location.href='admin.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<body>
<center>
<div class="aa">
<h1>ADD COURSE</h1>
<form method="POST">
Course Name:<br><input type="text" name="coursename" placeholder="Enter course Name"><br>
Course Code:<br><input type="text" name="coursecode" placeholder="Enter course code"><br>
Lecture Count:<br><input type="text" name="lectcount" placeholder="0 if no lectures"><br>
Practical Count :<br><input type="text" name="praccount" placeholder="0 if no practicals"><br>
<input type="submit" value="ADD COURSE" name='sub'>
</form>
</div>
<?php
if(isset($_POST['sub']))
{
	$course_name=$_POST["coursename"];
	$course_code=$_POST["coursecode"];
	$lectcount=$_POST["lectcount"];
	$praccount=$_POST["praccount"];
	$sql="select * from courses where course_id='$course_code'";
	$result=$con->query($sql);
	if($result->num_rows>0)
	{
		echo<<<PRAVESH
			<script>
			callalert();
			</script>
PRAVESH;
	}
	else
	{
		$sql="insert into courses values('$course_code','$course_name','$praccount','$lectcount')";
		$result=$con->query($sql);
		mkdir("Documents/".$course_code);
		echo<<<PRAVESH
			<script>
			callsuccess();
			</script>
PRAVESH;

	}
}
?>
</body>
</html>