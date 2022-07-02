<?php
include("conn.php");
error_reporting(0);
?>
<html>
<head>
<script>
function callsuccess()
{
	alert("teacher added successfully");
}
</script>
<style type="text/css">
body{
background-image: url(bg-reg1.jpg);
background-size: cover;
color:white;
}
.aa{
width: 750px;
padding: 40px;
position: absolute;
top: 45%;
left: 50%;
transform: translate(-50%,-50%);
background: #e1e8fo;
font-family:sns-serif;
font-size: 22px;

}
.aa h1,.aa h3{
color: white;
font-weight: 500;
}
.aa input[type="text"],.aa input[type="password"],.aa input[type="date"],.aa input[type="email"],.aa input[type="Number"],select
{
border:0;
background: rgba(0,0,0,0.4);
margin: 10px auto;
text-align: center;
border: 3px solid #3498db;
padding: 7px 15px;
width: 220px;
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
width: 60px;
outline: none;
color: white;
transition: 0.25s;
}
.aa input[type="text"]:focus,.aa input[type="password"]:focus,.aa input[type="date"]:focus,.aa input[type="email"]:focus,.aa input[type="Number"]:focus
{
width: 250px;
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
</head>
<body>
<div class="aa">
<h1>Teacher Registration Form</h1>
<br>
<form action="" method="POST">
<table>
<tr>
<td>Name:<br><input type="text" name="name" placeholder="Enter first Name"\></td>
<td>Surname:<br><input type="text" name="lname" placeholder="Enter Last Name"></td></tr>
<tr><td>Email_Id:<br><input type="email" name="eid" placeholder="Enter Email"></td><td>Mobile no.:<br><input type="number" name="mnum" placeholder="Enter Mobile No."></td></tr>
<tr><td>DOB:<br><input type="date" name="Dob"></td>
</tr>
<tr><td><h4>Department:</h4><select name="dept">
<option>cm</option>
<option>it</option>
<option>ce</option>
<option>etx</option>
</select></td></tr>
<tr><td><h3><b>Gender:</u></h3>Male<input type="radio" name="gen" value="Male">Female<input type="radio" name="gen" value="Female">Other<input type="radio" name="gen" value="other">
</td></tr>
<tr><td> </td></tr>
<tr>
<td>User_Id:<br><input type="text" name="uid" placeholder="Enter User_Id "></td>
<td>Password:<br><input type="password" name="pass" placeholder="Password"></td></tr>
</table><br>
<input type="submit" name="submit" value="submit">
</form>
</div>
<?php
if(isset($_POST['submit']))
{
$name= $_POST['name'];
$lname = $_POST['lname'];
$email= $_POST['eid'];
$mobile=$_POST['mnum'];
$dobs= $_POST['Dob'];
$dept= $_POST['dept'];
$gen= $_POST['gen'];
$uid= $_POST['uid'];
$pwd= $_POST['pass'];
$query = "insert into teachers values ('$name','$lname','$email','$mobile','$dobs','$dept','$gen','$uid','$pwd')";
$data= mysqli_query($conn, $query);
echo<<<PRAVESH
<script>
callsuccess();
</script>
PRAVESH;
}
?>
</body>
</html>
