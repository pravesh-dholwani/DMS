<?php
session_start();
error_reporting(0);
include('conn.php');
$u_enroll=$_SESSION['u_enroll'];
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="dms";
$conn1=new mysqli($db_host,$db_user,$db_pass,$db_name);
$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
$sql="SELECT * FROM `notify` WHERE to_send = '$u_enroll' ORDER BY `notify`.`NID` DESC";
$sql2="select * from notification_msg where NID=?";
$stmt=$conn->prepare($sql2);
$stmt->bind_param("i",$nid);
$result1=$conn1->query($sql);
$colors=array('red','green','grey','pink','aqua','beige');
?>
<html>
<script>
function callno()
{
	alert("you have no notifications");
}
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style>
table
{
	font-size:20px;
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
<body>
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<br>
<br>
<center>
<form method="post">
<table cellspacing="10px" >
<tr>
<th>NOTIFICATIONs</th>
<th>DELETE</th>
</tr>
<?php
if($result1->num_rows>0)
{  $i=0;
	while($row1=$result1->fetch_assoc())
	{	 if($i==count($colors)-1)
		{
			$i=0;
		}
		?><tr  bgcolor="<?php echo $colors[$i];?>">
		<?php
		$nid=$row1['NID'];
		$stmt->execute();
		$result2=$stmt->get_result();
		if($result2->num_rows>0)
		{
			$row2=$result2->fetch_assoc();
			echo "<td>".$row2['message']."</td>";
			echo "<td><input type='checkbox' name='notify[]' value='".$nid."'></td>";
		}
		$i++;
	}
}
else
	{
		echo<<<PRAVESH
		<script>
		callno();
		</script>
PRAVESH;
	}

?>
</tr>
</table>
<input type="submit" name="sub" value="DELETE NOTIFICATIONS">
</form>
<?php
if(isset($_POST['sub']))
{
	$u_enroll=$_SESSION['u_enroll'];
	$selectn=$_POST['notify'];
	for($i=0;$i<count($selectn);$i++)
	{
		
	$query="delete from notify where to_send='$u_enroll' AND NID='$selectn[$i]'";
	$con->query($query);
	}
	header('location:get_notification.php');
}?>
</body>
</html>