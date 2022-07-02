
<?php
session_start();
include("conn.php");
error_reporting(0);
?>
<html>
<head>
<style type="text/css">
body{
background-image:url(bg-reg1.jpg);
background-size: cover;
color:white;
}
.aa{
width: 600px;
padding: 40px;
position: absolute;
top: 70%;
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
.aa input[type="submit"]
{
border:0;
background: none;
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

</style>
<script>
	function callalert()
	{
		alert("student already exists");
	}
	function callsuccess()
	{
		alert("Registration done Now you can login using your user_id and password");
	}
</script>
</head>
<body>
<center>
<?php
if($_GET['step']==1)
{?>
<div class="aa">
<h1>Student Registration Form</h1>
<h2>Your Personal details</h2>
<form action="str1.php?step=2" method="POST">
Name:<br><input type="text" name="fname" placeholder="Enter first Name"\>
<br>
Surname:<br><input type="text" name="lname" placeholder="Enter Last Name">
<br>
DOB:<br><input type="date" name="dob"><br>
Mobile no.:<br><input type="number" name="mnum" placeholder="Enter Mobile No."><br>
Email_Id:<br><input type="email" name="eid" placeholder="Enter Email"><br>
Gender:<input type="radio" name="gender" value="Male">Male
<input type="radio" name="radios" value="Female">
Female
<input type="radio" name="radios" value="other">
Other
<br>
<input type="submit" name="step1sub" VALUE="NEXT">
</form>
</div>
<?php
}
if($_GET['step']==2)
{
if(isset($_POST['step1sub']))
{
$_SESSION['name']= $_POST['fname'];
$_SESSION['lname']= $_POST['lname'];
$_SESSION['dob'] = $_POST['dob'];
$_SESSION['email']=$_POST['eid'];
$_SESSION['mobile']= $_POST['mnum'];
$_SESSION['gen']= $_POST['gender'];
//$query = "insert into login(name,surname,date of birth,email,gender) values ('$name','$lname','$dob','$email','$mobile','$gen')";
//$data= mysqli_query($conn, $query);
//if($data)
//echo"done insertion successfullll";
?>
<div class="aa">
<h1>Student Registration Form</h1>
<h2>Your Parent details</h2>
<form action="str1.php?step=3" method="POST">

Mother Name:<br><input type="text" name="mothername" placeholder="Enter Mother Name"\><br>
Father Name:<br><input type="text" name="fathername" placeholder="Enter father Name">
<br>
Parent No:<br><input type="Number" name="parentno" placeholder="Enter Your Parent No."><br>
Parent Email_Id:<br><input type="email" name="pemailid" placeholder="Enter Email"><br>
Address:<br><textarea name="address" cols="30" rows="10"></textarea><br>
<input type="submit" name="step2sub" VALUE="NEXT">
</form>
</div>
<?php
}
}
if($_GET['step']==3)
{
	if(isset($_POST['step2sub']))
	{
		$_SESSION['mothername']=$_POST['mothername'];
		$_SESSION['fathername']=$_POST['fathername'];
		$_SESSION['parentno']=$_POST['parentno'];
		$_SESSION['pemailid']=$_POST['pemailid'];
		$_SESSION['address']=$_POST['address'];
	
	?>
	<div class="aa">
<h1>Student Registration Form</h1>
<h2>CREDENTIALS</h2>
<form action="str1.php?step=4" method="POST">
Enrollnment NO.:<br><input type="Number" name="roll" placeholder="Enter Enrollnment No."><br>
<br>
<br>
User_Id:<br><input type="text" name="user" placeholder="Enter User_Id "><br>
Password:<br><input type="password" name="pass" placeholder="Password"><br>
<input type="submit" name="step3sub" value="Submit">
</form>
</div>
<?php
	}
}
if($_GET['step']==4)
{
	if(isset($_POST['step3sub']))
	{
		$_SESSION['enroll']=$_POST['roll'];
		$_SESSION['uid']=$_POST['user'];
		$_SESSION['password']=$_POST['pass'];
		$enroll=$_SESSION['enroll'];
		$uid=$_SESSION['uid'];
		$password=$_SESSION['password'];
		$name=$_SESSION['name'];
		$lname=$_SESSION['lname'];
		$dob=$_SESSION['dob'];
		$email=$_SESSION['email'];
		$mobile=$_SESSION['mobile'];
		$gen=$_SESSION['gen'];
		$mothername=$_SESSION['mothername'];
		$fathername=$_SESSION['fathername'];
		$address=$_SESSION['address'];
		$pemailid=$_SESSION['pemailid'];
		$parentno=$_SESSION['parentno'];
		$sql="select * from login where enrollment=$enroll";
		$result=$con->query($sql);
		if($result->num_rows>0)
		{
			echo<<<PRAVESH
			<script>
			callalert();
			</script>
PRAVESH;
session_destroy();
		}
		else
		{
			$sql="INSERT INTO login VALUES ('$name','$lname','$dob','$email','$mobile','$gen','$enroll','$uid','$password','$mothername','$fathername','$address','$pemailid','$parentno')";
			$result=$con->query($sql);
			$sql1="insert into course_reg(enroll) values($enroll)";
			$con->query($sql1);
			echo<<<PRAVESH
			<script>
			callsuccess();
			</script>
PRAVESH;
session_destroy();
		}
	}
}
?>
</body>
</html>
