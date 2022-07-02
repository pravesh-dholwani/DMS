<?php
session_start();
error_reporting(0);
include("conn.php");
$sql10="select * from courses";
$result10=$con->query($sql10);
$user_enroll=$_SESSION['u_enroll'];
?>
<html>
<script>
function callalert()
{
	alert("no attendance found");
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
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<center>
<form method="post">
<label for="course_select">Choose a Course:</label>
<select name="course_select" id="course_select">
<?php
$ab=0;
$pre=0;
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
$sql="select * from attendance where enroll='$user_enroll' AND c_id='$course'";
$result=$con->query($sql);
$count=$result->num_rows;
?>


<?php
if(($result->num_rows)>0)
{?>
<h1>
<?php echo "Attendance for course $course";?>
</h1>
<table cellspacing="20px">
<tr>
<th>DATE</th>
<th>Status</th>
</tr>
<?php
	while($row=$result->fetch_assoc())
	{
		?>
		<tr>
		<th><?php echo $row['date']; ?></th>
		<td <?php if($row['status']=='absent'){ echo "class='mystyle'"; $ab++;} else {echo "class='mystyle1'"; $pre++;} ?> > <?php echo $row['status']; ?></td>
		</tr>
	<?php }
}
else
{
	echo<<<PRAVESH
	<script>callalert();</script>
PRAVESH;
}
?>
<p><?php echo "Total number of classes attended $pre"." Out of $result->num_rows";?></p>
</table>
<?php
} ?>
</body>
</html>