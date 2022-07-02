<?php
session_start();
include("conn.php");
error_reporting(0);
$sql="insert into announcements(a_sub,a_msg,mov_stat) values(?,?,?)";
$stmt1=$con1->prepare($sql);
$stmt1->bind_param("sss",$ann_sub,$ann_msg,$ann_status);
?>
<html>
<head>
<script>
function callsuccess()
{
	alert("announcement sent successfully");
}
</script>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
<body>
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
<center>
<form method="get">
<table>
<tr>
<th>ANNOUNCEMENT Subject:</th>
<td><textarea name="ann_sub" rows="3" cols="50" wrap="hard"></textarea></td>
</tr>
<tr>
<th>ANNOUNCEMENT Detail:</th>
<td><textarea name="ann_msg" rows="8" cols="50" wrap="soft"></textarea></td>
</tr>
<tr>
<th>ANNOUNCEMENT Alert:</th>
<td><input type="radio" name="ismove" value="1">YES<input type="radio" name="ismove" value="1">NO</td>
</tr>
</table>
<input type="submit" name="send" value="SEND">
</form>
</body>
</html>
<?php

if(isset($_GET['send']))
{
	$ann_sub=$_GET['ann_sub'];
	$ann_msg=$_GET['ann_msg'];
	$ann_status=$_GET['ismove'];
	$stat=$stmt1->execute();
	if($stat==1)
	{
		?>
		<script>
		 callsuccess();
		</script>
		<?php
	}
}
?>