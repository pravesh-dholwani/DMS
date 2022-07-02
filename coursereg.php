<?php
session_start();
include("conn.php");
$enroll=$_SESSION['u_enroll'];
error_reporting(0);
$sql2="select * from course_reg where enroll='$enroll'";
$result2=$con->query($sql2);
$row2=$result2->fetch_assoc();
$sql="select * from courses";
$result=$con->query($sql);
?>
<html>
<head>
<script>
			function callalert()
			{
				alert('already registered courses');
			}
</script>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style type="text/css">
body{
background-color:#657383;

background-size: cover;
color:white;
font-size: 22px;
font-family:sns-serif;
}
.aa{
width: 600px;
padding:40px;
position: absolute;
top: 70%;
left: 50%;
transform: translate(-50%,-50%);
background:#e1e8fo;
font-family:sns-serif;
font-size: 22px;

}
.aa h1,.aa h3{
color: white;
font-weight: 500;
}
.aainput[type="text"],.aa input[type="password"],.aa input[type="date"],.aa input[type="email"],.aa input[type="Number"]
{
border:0;
background: rgba(0,0,0,0.4);
margin: 10px auto;
border: 3px solid #3498db;
padding: 8px 10px;
width: 250px;
outline: none;
color:white;
transition: 0.25s;
}
.aainput[type="radio"]
{
border:0;
background: rgba(0,0,0,0.4);
margin: 7px auto;
border: 3px solid #3498db;
padding: 5px 7px;
width: 50px;
outline: none;
color:white;
transition: 0.25s;
}
.aa input[type="text"]:focus,.aa input[type="password"]:focus,.aa input[type="date"]:focus,.aa input[type="email"]:focus,.aa input[type="Number"]:focus
{
width: 200px;
border-color: #2ecc71;
}
.aainput[type=radio]:focus
{
width: 240px;
border-color: #2ecc71;
}
.aainput[type="submit"],button
{
border:0;
background: none;
display: inline;
margin: 20px auto;
text-align: center;
border: 2px solid #2ecc71;
padding: 12px 20px;
outline: none;
color: white;
border-radius: 25px;
transition: 0.25s;
cursor: pointer;
}
.aainput[type="submit"]:hover,button:hover
{
background: #2ecc71;
}
</style>
</head>

<body>
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<center>
     

<?php
if($row2['course1']!="")
{
	echo<<<PRAVESH
			<script>
			callalert();
			</script>
PRAVESH;
}
else
{
?><h1><b>Courses allotment :-</b></h1>
<h2>ONLY 7 COURSES WILL BE RECORDED FILL CAREFULLY</h2>
<form method="post">

<?php
for($i=0;$i<$result->num_rows;$i++)
{
	mysqli_data_seek($result,$i);
	$row=$result->fetch_assoc();
	?>
	<input type ="checkbox" name="courses[]" value="<?php echo $row['course_id'];?>"><?php echo $row['course_name'];?>
	<br>
<?php } ?>
<input type="submit" value="SUBMIT" name="sub">

</form>

<?php
}
if(isset($_POST['sub']))
{
	$enroll=$_SESSION['u_enroll'];
	$course=array('course1','course2','course3','course4','course5','course6','course7');
	$courses=$_POST['courses'];
	for($i=0;$i<6;$i++)
	{
		if($courses[$i]=="")
		{
				break;
		}
		else
		{
			
		$course1=$course[$i];
		echo $course1;
		echo $courses[$i];
		$sql="update course_reg set $course1='$courses[$i]' where enroll='$enroll'";
		$con->query($sql);
		
		}
	}
}
?>
</body>
</html>
