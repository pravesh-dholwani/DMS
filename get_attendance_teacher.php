<?php
session_start();
$from=$_SESSION['teacher_name'];
include("conn.php");
error_reporting(0);
$dates=array();
$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
$sql10="select * from courses";
$result10=$con->query($sql10);
$sql="select * from attendance where c_id=?";
$stmt4=$conn->prepare($sql);
$stmt4->bind_param("s",$course);
//$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
$sql2="Select * from attendance where date=? AND enroll=?";
$stmt=$conn->prepare($sql2);
$stmt->bind_param("si",$date1,$enroll1);
$sql3="select * from course_reg where course2=? OR course3=? OR course1=? OR course4=? OR course5=? OR course6=? OR course7=?";
$stmt3=$conn->prepare($sql3);
$stmt3->bind_param("sssssss",$course,$course,$course,$course,$course,$course,$course);
$pcount=0;
$tcount=0;
?>
<html>
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
.mystyle
{
	background-color:red;
}
.mystyle1
{
	background-color:green;
}
</style>
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
<input type="submit" name="goon" value="See Attendance">
<br>
</form>
<?php 
if(isset($_POST['goon']))
{	
	$course=$_POST['course_select'];
	$stmt3->execute();
	$result3=$stmt3->get_result();
	$count3=$result3->num_rows;
	 ?>
	 <form method="post">
<table  cellspacing="20px">
<tr>
<th>Roll no.</th>
<?php
$stmt4->execute();
$result=$stmt4->get_result();
$pr=$result->num_rows;
if(($result->num_rows)>0)
{	
	while($row=$result->fetch_assoc())
	{ if(!(in_array($row['date'],$dates)))
		{
			$dates[]=$row['date'];
			?>
			<th><?php echo $row['date']; ?></th>
		<?php 
		}
	}
	?>
	<th>Percent</th>
	<th>NOTIFY</th>
	</tr>
<?php	
}
?>
<?php
if(($result3->num_rows)>0)
{
	while($row3=$result3->fetch_assoc())
	{
		?>
		<tr>
		<td><?php echo $row3['enroll']; ?></td>
		<?php 
		for($i=0;$i<$count=count($dates);$i++)
		{
			$enroll1=$row3['enroll'];
			$date1=$dates[$i];
			$stmt->execute();
			$result4=$stmt->get_result();
			$result4->num_rows;
			
			if($row4=$result4->fetch_assoc())
			{
				if($row4['status']=='present'){$pcount+=1;}
				?>
				<td <?php if($row4['status']=='absent'){ echo "class='mystyle'";} else {echo "class='mystyle1'";} ?> > <?php echo $row4['status']; ?></td>
			<?php }
			
		}
		?>
		<td <?php if(($percent=(($pcount/$count)*100))<75){echo "class='mystyle'";}?>><?php echo $percent=(($pcount/$count)*100)."%" ;?></td>
		<td><input type="checkbox" name="students[]" value="<?php echo $row3['enroll']; ?>"></td>
		</tr>
	<?php $pcount=0; }
}
	?>
	
</table>
<input type="submit" name="sub" value="NOTIFY">
</form>
<?php 
}
if(isset($_POST['sub']))
{
$sql6="select * from notification_msg";
$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
$conn1=new mysqli($db_host,$db_user,$db_pass,$db_name);
$conn2=new mysqli($db_host,$db_user,$db_pass,$db_name);
$sql7="insert into notify(NID,to_send,From1) values(?,?,?)";
$sql8="insert into notification_msg(message) values(?)";
$stmt1=$conn1->prepare($sql7);
$stmt2=$conn2->prepare($sql8);
$stmt1->bind_param("iss",$nid,$to,$from);
$stmt2->bind_param("s",$msg);
	$students=$_POST['students'];
	$msg="your attendance is less.Please attend the classes regularly from".$from;
	$stmt2->execute();
	$result6=$conn->query($sql6);
	mysqli_data_seek($result6,($result6->num_rows)-1);
	$row=mysqli_fetch_row($result6);
	$nid=$row[0];
	$from=$_SESSION['teacher_name'];
	for($i=0;$i<count($students);$i++)
	{
		$to=$students[$i];
		$stmt1->execute();
		
	}
}
?>
</body>
</html>