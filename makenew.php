<?php
session_start();
error_reporting(0);
include("conn.php");
$sql1="select * from courses";
$sql2="select * from teachers";
$result1=$con->query($sql1);
$result2=$con1->query($sql2);
$sql="DELETE from TIMETABLE";
$con->query($sql);

?>
<html>
<style type="text/css">
body{
background-color :#657383;

background-size: cover;
color:white;
}
.aa select,input[type=text]{
margin: 10px 15px;
border: 3px black;
padding: 14px 10px;
width: 230px;
color: black;

}
.aa{
width: 600px;
padding: 40px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
background: #e1e8fo;
font-family: sns-serif;
font-size: 22px;
}
.aa h1,.aa h3{
color: white;
font-weight: 500;
}
.aa input[type="text"],.aa input[type="password"],.aa input[type="date"],.aa input[type="email"],.aa input[type="Number"]
{
border:0;
background: rgba(0,0,0,0.4);
margin: 10px auto;
text-align: center;
border: 3px solid #3498db;
padding: 5px 7px;
width: 130px;
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
width: 50px;
outline: none;
color: rgb(0,0,0);
transition: 0.25s;
}
.aa input[type="text"]:focus,.aa input[type="password"]:focus,.aa input[type="date"]:focus,.aa input[type="email"]:focus,.aa input[type="Number"]:focus
{
width: 200px;
border-color: #2ecc71;
}
.aa input[type=radio]:focus
{
width: 240px;
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
<body>
<?php 
if($_GET['step']==1)
{
	$_SESSION['practs2']=array();
	$_SESSION['practs1']=array();
	$_SESSION['course1']=array();
	$_SESSION['course2']=array();
	?>
	<div class="aa">
	<form method="post" action="makenew.php?step=2">
	<B>SELECT COURSES FOR 1ST Year:</b><br>
<?php
for($i=0;$i<$result1->num_rows;$i++)
{ $row1=$result1->fetch_assoc();
?>
<input type="checkbox" name="course1[]" value="<?php echo $row1['course_id']; ?>">	
<?php
echo $row1['course_id']." ".$row1['course_name']."<br>";
}
?>	

<B>SELECT COURSES FOR 2nd Year:</b><br>
<?php
$result1=$con->query($sql1);
for($i=0;$i<$result1->num_rows;$i++)
{ 
$row1=$result1->fetch_assoc();
?>
<input type="checkbox" name="course2[]" value="<?php echo $row1['course_id']; ?>">	
<?php
echo $row1['course_id']." ".$row1['course_name']."<br>";
}
?>	

<B>SELECT BATCH COUNT FOR 1st year</b><br>
<input type="radio" name="batch1count" value="2">2<input type="radio" name="batch1count" value="3">3<br>
<B>SELECT BATCH COUNT FOR 2nd year</b><br>
<input type="radio" name="batch2count" value="2">2<input type="radio" name="batch2count" value="3">3<br>
<input type="submit" name="step1sub" value="NEXT">
</form>
</div>
<?php
}
if($_GET['step']==2)
{
	$result1=$con->query($sql1);
		for($i=0;$i<$result1->num_rows;$i++)
		{
			mysqli_data_seek($result1,$i);
			$row1=$result1->fetch_assoc();
			$_SESSION[$row1['course_id']]="";
		}
	if(isset($_POST['step1sub']))
	{
		foreach($_POST['course1'] as $course1)
		{
			$result1=$con->query($sql1);
			while($row1=$result1->fetch_assoc())
			{
				if($row1['course_id']==$course1)
				{
					if($row1['coursecount']!=0)
					{
						$_SESSION['course1'][]=$course1;
						$_SESSION['coursecount'][$row1['course_id']]=$row1['coursecount'];
					}
				}
			}
			
		}
		foreach($_POST['course1'] as $course1)
		{
			$result1=$con->query($sql1);
			while($row1=$result1->fetch_assoc())
			{
				if($row1['course_id']==$course1)
				{
					if($row1['praccount']!=0)
					{
						$_SESSION['practs1'][]=$course1;
						$_SESSION['practscount'][$row1['course_id']]=$row1['praccount'];
					}
				}
			}
			
		}
		foreach($_POST['course2'] as $course2)
		{
			$result1=$con->query($sql1);
			while($row1=$result1->fetch_assoc())
			{
				if($row1['course_id']==$course2)
				{
					if($row1['coursecount']!=0)
					{
						$_SESSION['course2'][]=$course2;
						$_SESSION['coursecount'][$row1['course_id']]=$row1['coursecount'];
					}
				}
			}
			
		}
		foreach($_POST['course2'] as $course2)
		{
			
			$result1=$con->query($sql1);
			while($row1=$result1->fetch_assoc())
			{
				if($row1['course_id']==$course2)
				{
					if($row1['praccount']!=0)
					{
						$_SESSION['practs2'][]=$course2;
						$_SESSION['practscount'][$row1['course_id']]=$row1['praccount'];
					}
				}
			}	
			
			
		}
		//$_SESSION['course1']=$_POST['course1'];
		//$_SESSION['course2']=$_POST['course2'];
		$_SESSION['batch1count']=$_POST['batch1count'];
		$_SESSION['batch2count']=$_POST['batch2count'];
		?>
		<div class="aa">
		<form method="post" action="makenew.php?step=3">
		<B>SELECT TEACHERS FOR COURSES</b><br>
		<?php
		$result1=$con->query($sql1);
		for($i=0;$i<$result1->num_rows;$i++)
		{
			mysqli_data_seek($result1,$i);
			$row1=$result1->fetch_assoc();
			echo $row1['course_id'].":";
			?>
			<select name='<?php echo $row1['course_id']; ?>'>
			<?php
			$result2=$con1->query($sql2);
			for($j=0;$j<$result2->num_rows;$j++)
			{	
				$row2=$result2->fetch_assoc();
				?>
				<option value="<?php echo $row2['teacher_name']; ?> " > <?php echo $row2['teacher_name']; ?> </option>
				<?php
			}
			?>
			</select><br>
			<?php
			}
		}
		?>
			
		<input type="submit" name="step2sub" value="SUBMIT">
		</form>
		<div>
		<?php
	}
if($_GET['step']==3)
{
	if(isset($_POST['step2sub']))
	{
		$sql="select course_id from courses";
		$result3=$con->query($sql);
		echo $result3->num_rows;
		for($i=0;$i<$result3->num_rows;$i++)
		{
			
			$row1=$result3->fetch_assoc();
			$_SESSION[$row1['course_id']]=$_POST[$row1['course_id']];
		}
		?>
		<div class="aa">
		<form action="timetable.php">
		<input type="submit" value="CLICK HERE TO MAKE THE NEW TIME TABLE">
		</form>
		</div>
		<?php
	}
}
?>
</body>
</html>