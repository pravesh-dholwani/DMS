<?php
session_start();
error_reporting(0);
include("conn.php");
if(!isset($_SESSION['admin_id']))
{
	session_destroy();
	header("location:admin_login.php");
}
?>
<html>
<head>
<script>
		function callsuccess()
		{
			alert("course deleted successfully");
		}
		</script>
		 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style>
select,input[type=text]{
margin: 10px 15px;
border: 3px black;
padding: 14px 10px;
width: 230px;
color: black;
}
a
{
	color:white;
	text-decoration:none;
}
input[type="submit"],button
{
border:0;
background: none;
display: inline;
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
body{
background-color:#657383;
background-size: cover;
color:white;
font-family: sns-serif;
font-size: 28px;
letter-spacing: 3px;

}
</style>
</head>
<body>
<button onclick="location.href='admin.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<center>
<form method="POST">
<br>
<br>
<br>
<select name="course_name">
<?php
$sql="select course_id from courses";
$result=$con->query($sql);
while($row=$result->fetch_assoc())
{
?>
<option value="<?php echo $row['course_id'];?>"><?php echo $row['course_id'];?></option>
<?php } ?>
</select>
<br>
<input type="submit" name="sub" value="DELETE COURSE">
</form>
<?php
if(isset($_POST['sub']))
{
	$course_id=$_POST['course_name'];
	echo $course_id;
	$sql1="delete from courses where course_id='$course_id'";
	if($con->query($sql1)==true)
	{
		echo<<<PRAVESH
		<script>
		callsuccess();
		</script>
PRAVESH;

	}
}?>
</body>
</html>
