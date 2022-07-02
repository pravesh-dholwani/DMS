<?php
session_start();
error_reporting(0);
include("conn.php");
$n=5;
$sqlbatch1="SELECT DISTINCT batch FROM timetable WHERE YEAR=1";
$resultbatch1=$con2->query($sqlbatch1);
$batchcount1=$resultbatch1->num_rows-1;
$sqlbatch2="SELECT DISTINCT batch FROM timetable WHERE YEAR=2";
$resultbatch2=$con2->query($sqlbatch2);
$batchcount2=$resultbatch2->num_rows-1;
$sql1="select * from timetable where day=? AND timeslot=? AND year=? and batch=?";
$stmt1=$con->prepare($sql1);
$stmt1->bind_param("ssis",$day,$timeslot,$year,$batch);
$sql2="select * from timetable where day=? AND timeslot=? AND year=?";
$stmt2=$con1->prepare($sql2);
$stmt2->bind_param("ssi",$day,$timeslot,$year);
$con2=new mysqli($db_host,$db_user,$db_pass,$db_name);
$enroll=$_SESSION['u_enroll'];
$sql3="select * from course_reg where enroll=$enroll";
$result=$con2->query($sql3);
$row=mysqli_fetch_array($result,MYSQLI_NUM);
if($batchcount1==3)
{
$batch1st=array('b1','b2','b3');
}
if($batchcount1==2)
{
$batch1st=array('b1','b2');
}
if($batchcount1==3)
{
$batch2nd=array('b1','b2','b3');
}
if($batchcount1==2)
{
$batch2nd=array('b1','b2');
}
$timeslots=array('t1','t2','t3','t4','t5','t6','t7');
$days=array("monday","tuesday","wednesday","thursday","friday");

?>
<html>
<head>
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
table
{
	font-size:20px;
	border-width:1px;
	border-color:#666666;
	border-collapse:collapse;
}
table th
{
	border-width:1px;
	padding:8px;
	border-style:solid;
	border-color:#666666;
	background-color:aqua;
}
table td
{
	border-width:1px;
	padding:8px;
	border-style:solid;
	border-color:#666666;
	background-color:white;
}
</style>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<button onclick="location.href='student.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<center>
<h1>TIME TABLE FOR 1st Year:</h1><br>
<table cellspacing="20px">
<tr>
<th>DAY</th>
<th>t1 10-11</th>
<th>t2 11-12</th>
<th>t3 13-14</th>
<th>t4 14-15</th>
<th>t5 15-16</th>
<th>t6 16-17</th>
<th>t7 17-18</th>
</tr>
<?php
for($i=0;$i<$n;$i++)
{
	?> <tr> <?php
	?> <th> <?php echo $days[$i]; ?></th><?php
	for($j=1;$j<2;$j++)
	{	
		for($k=0;$k<count($timeslots);$k++)
		{
			if($j==1)
			{
				if($i==0 OR $i==2 OR $i==4)
				{
					if($timeslots[$k]=='t1' OR $timeslots[$k]=='t2')
					{ 
						?> <td> <?php
						$e=0;
					while($e<$batchcount1)
					{
						
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$batch=$batch1st[$e];
						$stmt1->execute();
						$result1=$stmt1->get_result();
						$row1=$result1->fetch_assoc();
						if(in_array($row1['prac_id'],$row))
						{
						echo $row1['batch']."-"; echo $row1['prac_id']."-"; echo $row1['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						$e++;
					}
					?> </td> <?php
					}
					else
					{
						?> <td> <?php
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$stmt2->execute();
						$result2=$stmt2->get_result();
						$result2->num_rows;
						$row2=$result2->fetch_assoc();
						
						if(in_array($row2['course_id'],$row))
						{
						 echo $row2['course_id']."-".$row2['teach_id']."<br>";
						}
						else
						{
							echo " ";
						}
						
						?> </td> <?php
					}
				}
				if($i==1 OR $i==3)
				{
					if($timeslots[$k]=='t1' OR $timeslots[$k]=='t2' OR $timeslots[$k]=='t5' OR $timeslots[$k]=='t6')
					{
						?><td><?php
						$e=0;
					while($e<$batchcount1)
					{
						
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$batch=$batch1st[$e];
						$stmt1->execute();
						$result1=$stmt1->get_result();
						$row1=$result1->fetch_assoc();
						if(in_array($row1['prac_id'],$row))
						{
						echo $row1['batch']."-"; echo $row1['prac_id']."-"; echo $row1['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						$e++;
					}
					?></td><?php
					}
					else
					{
						?><td><?php
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$stmt2->execute();
						$result2=$stmt2->get_result();
						$row2=$result2->fetch_assoc();
						if(in_array($row2['course_id'],$row))
						{
						 echo $row2['course_id']."-"; echo $row2['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						?></td><?php
					}
				}
				
				
			}
			
		}
	}
	?></tr><?php
}
?>
</table>
<br>
<h1>TIME TABLE FOR 2nd Year:</h1><br>
<table cellspacing="20px">
<tr>
<th>DAY</th>
<th>t1 10-11</th>
<th>t2 11-12</th>
<th>t3 13-14</th>
<th>t4 14-15</th>
<th>t5 15-16</th>
<th>t6 16-17</th>
<th>t7 17-18</th>
</tr>
<?php
for($i=0;$i<$n;$i++)
{
	?> <tr> <?php
	?> <th> <?php echo $days[$i]; ?></th><?php
	for($j=2;$j<=2;$j++)
	{	
		for($k=0;$k<count($timeslots);$k++)
		{
			if($j==2)
			{
				if($i==0 OR $i==2 OR $i==4)
				{if($timeslots[$k]=='t4' OR $timeslots[$k]=='t3' OR $timeslots[$k]=='t5' OR $timeslots[$k]=='t6')
					{ 
						?> <td> <?php
						$e=0;
					while($e<$batchcount2)
					{
						
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$batch=$batch2nd[$e];
						$stmt1->execute();
						$result1=$stmt1->get_result();
						$row1=$result1->fetch_assoc();
						
						if(in_array($row1['prac_id'],$row))
						{
						echo $row1['batch']."-"; echo $row1['prac_id']."-"; echo $row1['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						$e++;
					}
					?> </td> <?php
					}
					else
					{
						?> <td> <?php
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$stmt2->execute();
						$result2=$stmt2->get_result();
						$row2=$result2->fetch_assoc();
						if(in_array($row2['course_id'],$row))
						{
						 echo $row2['course_id']."-"; echo $row2['teach_id']; echo "<br>";
						}
						else
						{
							echo "";
						}
						
						?> </td> <?php
					}
				}
				if($i==1 OR $i==3)
				{
					if($timeslots[$k]=='t3' OR $timeslots[$k]=='t4')
					{
						?><td><?php
						$e=0;
					while($e<$batchcount2)
					{
						
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$batch=$batch2nd[$e];
						$stmt1->execute();
						$result1=$stmt1->get_result();
						$row1=$result1->fetch_assoc();
						if(in_array($row1['prac_id'],$row))
						{
						echo $row1['batch']."-"; echo $row1['prac_id']."-"; echo $row1['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						$e++;
					}
					?></td><?php
					}
					else
					{
						?><td><?php
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$year=$j;
						$stmt2->execute();
						$result2=$stmt2->get_result();
						$row2=$result2->fetch_assoc();
						if(in_array($row2['course_id'],$row))
						{
						 echo $row2['course_id']."-"; echo $row2['teach_id']; echo "<br>";
						}
						else
						{
							echo " ";
						}
						?></td><?php
					}
				}
				
				
			}
			
		}
	}
	?></tr><?php
}
?>
</table>
<?php
?>