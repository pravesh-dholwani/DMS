<?php
include("conn.php");
error_reporting(0;)
$sql="SELECT * FROM `announcements` ORDER BY `announcements`.`a_id` DESC";
$result=$con->query($sql);
$colors=array('red','green','grey','pink','aqua','beige');
?>
<html>
<head>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style>
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
color: black;
border-radius: 25px;
transition: 0.25s;
cursor: pointer;
}
input[type="submit"]:hover,button:hover
{
background: #2ecc71;
}
table{
	font-size:20px;
}
td
{
	text-align:center;
}
</style>
<body>
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<Center>
<table cellspacing="20px" >
<tr>
<th>ANNOUNCEMENT SUBJECT</th>
<th>ANNOUNCEMENT BRIEF</th>
</tr>
<?php
if($result->num_rows>0)
{
	$i=0;
	while($row=$result->fetch_assoc())
	{
		if($i==count($colors)-1)
		{
			$i=0;
		}
		?><tr bgcolor="<?php echo $colors[$i];?>" ><?php
		if($row['mov_stat']==1)
		{
			echo "<td width='20%' height='20%'><b>".$row['a_sub']."</b></td>";
			echo "<td width='28%' height='20%'><b>".$row['a_msg']."</b></td>";
		}
		else
		{
			echo "<td width='20%' height='20%'>".$row['a_sub']."</td>";
			echo "<td width='28%' height='20%'>".$row['a_msg']."</td>";
		}
		$i++;
		echo "</tr>";
	}
}
?>
</table>
</body>
</html>