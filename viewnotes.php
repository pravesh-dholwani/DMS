<?php
session_start();
error_reporting(0);
include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VIEW NOTES</title>
</head>

<body>
<?php
if(isset($_SESSION['user_id']))
{ ?>
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<?php } ?>
<?php
if(isset($_SESSION['teacher_id']))
{ ?>
<button onclick="location.href='teacher.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<?php } ?>
<center>
<?php
if(isset($_POST['viewnotes']))
{
	echo "<table>";
$dir="DOCUMENTS/".$_POST['course_name'];
if(is_dir($dir))
{
if ($dh=opendir($dir))
{
while(($f=readdir($dh))!==false)
{
	echo "<tr>"; 
if(($f!=".") AND ($f!=".."))
{
echo "<td>".$f."&nbsp&nbsp&nbsp&nbsp&nbsp"."</td>";
?>
<td><button><a href='DMS/<?php echo $f; ?>'>Download</a></button></td>
<?php
}
}
closedir($dh);
}
}
}
else
{
?>
<form method="post">
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
<input type="submit" name="viewnotes" value="VIEW NOTES">
</form>
<?php 
}?>
</body>
</html>