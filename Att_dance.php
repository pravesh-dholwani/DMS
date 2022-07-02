<?php
session_start();
include("conn.php");
error_reporting(0);
if(!isset($_SESSION['teacher_id']))
{
	header('location:login2.php');
	session_destroy();
}
$sql10="select * from courses";
$result10=$con->query($sql10);
$sql1=" select * from course_reg where course1=? OR course2=? OR course3=? OR course4=? OR course5=? OR course6=? OR course7=? ";
$con1=new mysqli($db_host,$db_user,$db_pass,$db_name);
$stmt1=$con1->prepare($sql1);
$stmt1->bind_param("sssssss",$course,$course,$course,$course,$course,$course,$course);
$r=1;
$dates=date("yy-m-d");
?>
<html>
<link rel="stylesheet" href="att_dance_css.css" type="text/css">
</head>
<script>
function callalert()
{
	alert("attendance already taken");
}
function callsuccess()
{
	alert("attendance taken successfully");
}
function changeName(column_id,clicked_id)
{
	if(document.getElementById(clicked_id).name=="present[]")
	{
		document.getElementById(clicked_id).name="absent[]";
		document.getElementById(column_id).style.background= "red";
	}
	else
	{
		document.getElementById(clicked_id).name="present[]";
		document.getElementById(column_id).style.background= "green";
	}
}
</script>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
 </head>
 <body>
<button onclick="location.href='teacher.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<center>
<form method="post">
<label for="course_select">Choose a Course:</label>
<select name="course_select" id="course_select">
<?php
if($result10->num_rows>0)
{
	while($row10=$result10->fetch_assoc())
	{
		?>
		<option value="<?php echo $row10['course_id'];?>"><?php echo $row10['course_name'];?></option>

<?php
	}
}?>
</select>
<input type="submit" name="goon" value="Take Attendance">
<br>
<?php 

if(isset($_POST['goon']))
{	
	$course=$_POST['course_select'];
	$_SESSION['mycourse']=$course;
	$stmt1->execute();
	$result3=$stmt1->get_result();
	$count=$result3->num_rows;
	 ?>
<table  cellspacing="20">
<?php
for($i=0;$i<($count/4);$i++)
{	
?>
<tr>
<?php
for($j=0;$j<4;$j++)
{
	$row=$result3->fetch_assoc();
	?>
<td class="mystyle" id="<?php echo $r;?>"><input type="checkbox" id="<?php echo $row['enroll']; ?>" name="present[]" onclick="changeName(<?php echo $r;?>,this.id)" value="<?php echo $row['enroll'];$r++; ?>" /><label for="<?php echo $row['enroll']; ?>"><?php echo $row['enroll'] ?></label></td>
<?php } ?>
	</tr>
	<?php
}
?>
</table>
<input type="submit" name="mark">

<?php }
?>
</form>
<?php
$abs1=$_POST["absent"];
if(isset($_POST['mark']))
{	
	$course=$_SESSION['mycourse'];
	$sql7="select * from attendance where date='$dates' AND c_id='$course'";
	$result7=$con->query($sql7);
	$result2=$con->query("select * from course_reg where course1='$course' OR course2='$course' OR course3='$course' OR course4='$course' OR course5='$course' OR course6='$course' OR course7='$course'");
	$count=$result2->num_rows;
	if((($result2->num_rows)>0) AND (($result7->num_rows)==0))
	{	
	$conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
	$dates1=$dates;
	$sql="insert into attendance values(?,?,?,?)";
	$stmt=$conn->prepare($sql);
	
	$stmt->bind_param("isss",$enroll1,$c_id1,$status1,$dates1);
	$c_id1=$_SESSION['mycourse'];
	for($p=0;$p<$count;$p++)
	{
		$row1=$result2->fetch_assoc();
	if(in_array($row1['enroll'],$abs1))
	{
		$enroll1=$row1['enroll'];
		$status1='absent';
		$stmt->execute();
	}
	else
	{
		$enroll1=$row1['enroll'];
		$status1='present';
		$stmt->execute();
	}
	}
	echo<<<PRAVESH
<script>
callsuccess();
</script>
PRAVESH;
	}
else
	{	
echo<<<PRAVESH
<script>
callalert();
</script>
PRAVESH;
	}
}

?>
</body>
</html>