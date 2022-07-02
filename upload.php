<?php
session_start();
error_reporting(0);
$from=$_SESSION['teacher_name'];
include("conn.php");
?>
<html>
<head>
<title>
Upload the Notes
</title>
<style>
body{
background-color:#657383;
background-size: cover;
color:white;
font-family: sns-serif;
font-size: 28px;
letter-spacing: 3px;

}
select,input[type=text]{
margin: 10px 15px;
border: 3px black;
padding: 14px 10px;
width: 230px;
color: black;

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
</style>
</head>
<?php
if(isset($_SESSION['admin_id']))
{	?>
	<button onclick="location.href='admin.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<?php } ?>
<?php
if(isset($_SESSION['teacher_id']))
{ ?>
	<button onclick="location.href='teacher.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<?php } ?>
<body>
<center>
<form method="POST" enctype="multipart/form-data">
<br>
<br><br>
 Upload File:
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
<br>
<input type="file" name="userfile" />
<br>
<br>
<br>
<input type="submit" name="upload" value="UPLOAD" />

</form>
</center>
<?php

if(isset($_POST['upload']))
{
$sql="select * from notification_msg";
$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
$conn1=new mysqli($db_host,$db_user,$db_pass,$db_name);
$conn2=new mysqli($db_host,$db_user,$db_pass,$db_name);
$sql1="insert into notify(NID,to_send,From1)values(?,?,?)";
$sql2="insert into notification_msg(message) values(?)";
$stmt1=$conn1->prepare($sql1);
$stmt2=$conn2->prepare($sql2);
$stmt1->bind_param("iss",$nid,$to,$from);
$stmt2->bind_param("s",$msg);
if($_FILES['userfile']['name']!="")
{
$fname="Documents/".$_POST['course_name']."/".$_FILES['userfile']['name'];
move_uploaded_file($_FILES['userfile']['tmp_name'],$fname);
echo  "The Uploaded File=".$_FILES['userfile']['name'];
	$from=$_SESSION['teacher_name'];
	$msg=$_FILES['userfile']['name']." is uploaded by ".$from;
	
	$to="all";
	$stmt2->execute();
	$result=$conn->query($sql);
	mysqli_data_seek($result,($result->num_rows)-1);
	$row=mysqli_fetch_row($result);
	$nid=$row[0];
	
	if($to=="all")
	{
		$result=$conn->query("select enroll from students");
		while($row=$result->fetch_assoc())
		{
			$to=$row['enroll'];
			$stmt1->execute();
		}
	}
}
}
?>

</body>
</html>
