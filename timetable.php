<?php
session_start();
error_reporting(0);
include("conn.php");
$sql1="select * from courses";
$result1=$con->query($sql1);
$courses1=$_SESSION['course1'];
//$courses1=array("cm409e","cm408e","c++","c","se");
$courses2=$_SESSION['course2'];
//$courses2=array("os","ad_cm408e","python","sad","r");
$practs1=$_SESSION['practs1'];
//$practs1=array('cm408e','c','cm409e','sql');
$practs2=$_SESSION['practs2'];
//$practs2=array('ad_cm408e','python','r');
$max_lecture_course=$_SESSION['coursecount'];
//$max_lecture_course=array('os'=>3,"cm409e"=>3,"cm408e"=>3,"c++"=>3,"c"=>3,"se"=>3,"ad_cm408e"=>3,"python"=>3,"sad"=>3,"r"=>3);
$max_practs=$_SESSION['practscount'];
//$max_practs=array('sql'=>2,'cm408e'=>4,'c'=>2,'cm409e'=>4,'ad_cm408e'=>2,'python'=>4,'r'=>4);
for($i=0;$i<$result1->num_rows;$i++)
{
	mysqli_data_seek($result1,$i);
	$row1=$result1->fetch_assoc();
	$teach_courses[$row1['course_id']]=$_SESSION[$row1['course_id']];
}
for($i=0;$i<$result1->num_rows;$i++)
{
	mysqli_data_seek($result1,$i);
	$row1=$result1->fetch_assoc();
	$teach_prac[$row1['course_id']]=$_SESSION[$row1['course_id']];
}
//$teach_prac=array('sql'=>'teach10','cm408e'=>'teach1','c'=>'teach2','cm409e'=>'teach6','ad_cm408e'=>'teach5','python'=>'teach3','r'=>'teach7');
//$teach_courses=array('os'=>"teach2","cm409e"=>"teach4","cm408e"=>"teach1","c++"=>"teach5","c"=>"teach5","se"=>"teach6","ad_cm408e"=>"teach3","python"=>"teach6","sad"=>"teach5","r"=>"teach3");

$batchcount1=$_SESSION['batch1count'];
$batchcount2=$_SESSION['batch2count'];
if($_SESSION['batch1count']==2)
{
	$batch1c=array();
	for($i=0;$i<2;$i++)
	{
		for($j=0;$j<count($practs1);$j++)
		{
		$batch1c[$i][$practs1[$j]]=0;
		}
	}
}
if($_SESSION['batch1count']==3)
{
	$batch1c=array();
	for($i=0;$i<3;$i++)
	{
		for($j=0;$j<count($practs1);$j++)
		{
		$batch1c[$i][$practs1[$j]]=0;
		}
	}
}
if($_SESSION['batch2count']==2)
{
	$batch2c=array();
	for($i=0;$i<2;$i++)
	{
		for($j=0;$j<count($practs1);$j++)
		{
		$batch1c[$i][$practs2[$j]]=0;
		}
	}
}
if($_SESSION['batch2count']==3)
{
	$batch1c=array();
	for($i=0;$i<3;$i++)
	{
		for($j=0;$j<count($practs1);$j++)
		{
		$batch1c[$i][$practs2[$j]]=0;
		}
	}
}
//$batch1c=array(array('sql'=>0,'cm408e'=>0,'c'=>0,'cm409e'=>0),array('sql'=>0,'cm408e'=>0,'c'=>0,'cm409e'=>0),array('sql'=>0,'cm408e'=>0,'c'=>0,'cm409e'=>0));
//$batch2c=array(array('ad_cm408e'=>0,'python'=>0,'r'=>0),array('ad_cm408e'=>0,'python'=>0,'r'=>0),array('ad_cm408e'=>0,'python'=>0,'r'=>0));
$result1=$con->query($sql1);
for($i=0;$i<count($courses1);$i++)
{
	$coursecounts[$courses1[$i]]=0;
}
for($i=0;$i<count($courses2);$i++)
{
	$coursecounts[$courses2[$i]]=0;
}
//$coursecounts=array('os'=>0,"cm409e"=>0,"cm408e"=>0,"c++"=>0,"c"=>0,"se"=>0,"ad_cm408e"=>0,"python"=>0,"sad"=>0,"r"=>0);
if($_SESSION['batch1count']==2)
{
	$batch1st=array('b1','b2');
}
if($_SESSION['batch1count']==3)
{
	$batch1st=array('b1','b2','b3');
}
if($_SESSION['batch2count']==2)
{
	$batch2nd=array('b1','b2');
}
if($_SESSION['batch2count']==3)
{
	$batch2nd=array('b1','b2','b3');
}
//$batch2nd=array('b1','b2','b3');
$timeslots=array('t1','t2','t3','t4','t5','t6','t7');
$n=5;
for($i=0;$i<$n;$i++)
{
	$att_prac=array();
	$att_course=array();
	$att_teacht1=array();
	$att_teacht5=array();
	$att_teacht15=array();
	$att_teacht3=array();
	for($j=1;$j<=2;$j++)
	{
		for($k=0;$k<count($timeslots);$k++)
		{
			if($j==1)
			{
				if($i==0 OR $i==2 OR $i==4)
				{
				if($timeslots[$k]=='t1')
				{
					$e=0;
					while($e<$batchcount1)
					{	
						$f=0;$flag=0;
						while(($f<count($practs1)) AND ($flag!=1))
						{
							if(($batch1c[$e][$practs1[$f]]==$max_practs[$practs1[$f]]) OR (in_array($practs1[$f],$att_prac)) OR (in_array($teach_prac[$practs1[$f]],$att_teacht1)))
							{
								$flag=0;
							}
							else
							{
								$batch1c[$e][$practs1[$f]]+=2;
								array_push($att_prac,$practs1[$f]);
								array_push($att_teacht1,$teach_prac[$practs1[$f]]);
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$practs1[$f];
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$teach_prac[$practs1[$f]];
								$flag=1;
							}
							$f++;
						}
						if($flag==0)
						{
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']='nil';
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']='nil';
						}
						$e++;
					}
				}
				elseif($timeslots[$k]=='t2')
				{
					$e=0;
					while($e<$batchcount1)
					{
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['prac_id'];
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['teach_id'];
						$e++;
					}
				}
				else
				{
					$f=0;$flag=0;
					while(($f<count($courses1)) AND ($flag!=1))
					{
						if(($coursecounts[$courses1[$f]]==$max_lecture_course[$courses1[$f]]) OR in_array($courses1[$f],$att_course))
						{
							$flag=0;
						}
						else
						{
							array_push($att_course,$courses1[$f]);
							$coursecounts[$courses1[$f]]++;
							$finaltt1[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses1[$f]];
							$finaltt1[$i][$timeslots[$k]]['course_id']=$courses1[$f];
							$flag=1;
						}
						$f++;
					}
					if($flag==0)
					{
						$finaltt1[$i][$timeslots[$k]]['teach_id']='nil';
						$finaltt1[$i][$timeslots[$k]]['course_id']='nil';
					}
				}
				
			}
			if($i==1 OR $i==3)
			{
				if($timeslots[$k]=='t1')
				{
					$e=0;
					while($e<$batchcount1)
					{	
						$f=0;$flag=0;
						while(($f<count($practs1)) AND ($flag!=1))
						{
							if(($batch1c[$e][$practs1[$f]]==$max_practs[$practs1[$f]]) OR (in_array($practs1[$f],$att_prac)) OR (in_array($teach_prac[$practs1[$f]],$att_teacht1)))
							{
								$flag=0;
							}
							else
							{
								$batch1c[$e][$practs1[$f]]+=2;
								array_push($att_prac,$practs1[$f]);
								array_push($att_teacht1,$teach_prac[$practs1[$f]]);
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$practs1[$f];
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$teach_prac[$practs1[$f]];
								$flag=1;
							}
							$f++;
						}
						if($flag==0)
						{
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']='nil';
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']='nil';
						}
						$e++;
					}
				}
				elseif($timeslots[$k]=='t2')
				{
					$e=0;
					while($e<$batchcount1)
					{
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['prac_id'];
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['teach_id'];
						$e++;
					}
				}
				elseif($timeslots[$k]=='t5')
				{
					$att_prac=array();
					$e=0;
					while($e<$batchcount1)
					{	
						$f=0;$flag=0;
						while(($f<count($practs1)) AND ($flag!=1))
						{
							if(($batch1c[$e][$practs1[$f]]==$max_practs[$practs1[$f]]) OR (in_array($practs1[$f],$att_prac)) OR (in_array($teach_prac[$practs1[$f]],$att_teacht5)))
							{
								$flag=0;
							}
							else
							{
								$batch1c[$e][$practs1[$f]]+=2;
								array_push($att_prac,$practs1[$f]);
								array_push($att_teacht5,$teach_prac[$practs1[$f]]);
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$practs1[$f];
								$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$teach_prac[$practs1[$f]];
								$flag=1;
							}
							$f++;
						}
						if($flag==0)
						{
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']='nil';
							$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']='nil';
						}
						$e++;
					}
					
				}
				elseif($timeslots[$k]=='t6')
				{
					$e=0;
					while($e<$batchcount1)
					{
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['prac_id'];
						$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']=$finaltt1[$i][$timeslots[$k-1]][$batch1st[$e]]['teach_id'];
						$e++;
					}
				}
				else
				{
					$f=count($courses1)-1;$flag=0;
					while(($f>=0) AND ($flag!=1))
					{
						if(($coursecounts[$courses1[$f]]==$max_lecture_course[$courses1[$f]]) OR in_array($courses1[$f],$att_course))
						{
							$flag=0;
						}
						else
						{
							array_push($att_course,$courses1[$f]);
							$coursecounts[$courses1[$f]]++;
							$finaltt1[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses1[$f]];
							$finaltt1[$i][$timeslots[$k]]['course_id']=$courses1[$f];
							$flag=1;
						}
						$f--;
					}
					if($flag==0)
					{
						$finaltt1[$i][$timeslots[$k]]['teach_id']='nil';
						$finaltt1[$i][$timeslots[$k]]['course_id']='nil';
					}
				}
			}
			}
			if($j==2)
			{
				if($i==1 OR $i==3)
				{
				if($timeslots[$k]=='t3')
				{
					
					$e=0;
					while($e<$batchcount2)
					{
						$f=count($practs2)-1;$flag=0;
						while(($f>=0) AND ($flag!=1))
						{
							if(($batch2c[$e][$practs2[$f]]==$max_practs[$practs2[$f]]) OR (in_array($practs2[$f],$att_prac)) OR (in_array($teach_prac[$practs2[$f]],$att_teacht3)) OR (($finaltt1[$i][$timeslots[$k]]['teach_id']==$teach_prac[$practs2[$f]]) OR ($finaltt1[$i][$timeslots[$k+1]]['teach_id']==$teach_prac[$practs2[$f]])))
							{
								$flag=0;
							}
							else
							{
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$practs2[$f];
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$teach_prac[$practs2[$f]];
								$batch2c[$e][$practs2[$f]]+=2;
								array_push($att_prac,$practs2[$f]);
								$flag=1;
							}
							$f--;
						}
						if($flag==0)
						{
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']='nil';
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']='nil';
						}
						$e++;
					}
				}
				if($timeslots[$k]=='t4')
				{
					$e=0;
					while($e<$batchcount2)
					{
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['prac_id'];
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['teach_id'];
						$e++;
					}
				}
				if(($timeslots[$k]=='t1') OR ($timeslots[$k]=='t2') OR ($timeslots[$k]=='t5') OR ($timeslots[$k]=='t6') OR ($timeslots[$k]=='t7') )
				{
					$f=count($courses2)-1;$flag=0;
					while(($f>=0) AND ($flag!=1))
					{
						if(($coursecounts[$courses2[$f]]!=$max_lecture_course[$courses2[$f]]) AND (!in_array($courses2[$f],$att_course)))
						{
							if(($timeslots[$k]=='t1') OR ($timeslots[$k]=='t2'))
							{
								if(in_array($teach_courses[$courses2[$f]],$att_teacht1))
								{
									$flag=0;
								}
								else
								{
									$finaltt2[$i][$timeslots[$k]]['course_id']=$courses2[$f];
									$finaltt2[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses2[$f]];
									$flag=1;
								}
							}
							elseif(($timeslots[$k]=='t5') OR ($timeslots[$k]=='t6'))
							{
								if(in_array($teach_courses[$courses2[$f]],$att_teacht5))
								{
									$flag=0;
								}
								else
								{
									$finaltt2[$i][$timeslots[$k]]['course_id']=$courses2[$f];
									$finaltt2[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses2[$f]];
									$flag=1;
								}
							}
							else
							{
								if($finaltt1[$i][$timeslots[$k]]['teach_id']==$teach_courses[$courses2[$f]])
								{
									$flag=0;
								}
								else
								{
									$finaltt2[$i][$timeslots[$k]]['course_id']=$courses2[$f];
									$finaltt2[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses2[$f]];
									$flag=1;
								}
							}
						}
						$f--;
					}
					if($flag==0)
					{
						$finaltt2[$i][$timeslots[$k]]['course_id']='nil';
						$finaltt2[$i][$timeslots[$k]]['teach_id']='nil';
					}
					if($flag==1)
					{
						array_push($att_course,$finaltt2[$i][$timeslots[$k]]['course_id']);
						$coursecounts[$finaltt2[$i][$timeslots[$k]]['course_id']]++;
					}
				}
				}
				if($i==0 OR $i==2 OR $i==4)
				{
					if($timeslots[$k]=='t3')
				{
					
					$e=0;
					while($e<$batchcount2)
					{
						$f=0;$flag=0;
						while(($f<count($practs2)) AND ($flag!=1))
						{
							if(($batch2c[$e][$practs2[$f]]==$max_practs[$practs2[$f]]) OR (in_array($practs2[$f],$att_prac)) OR (in_array($teach_prac[$practs2[$f]],$att_teacht3)) OR (($finaltt1[$i][$timeslots[$k]]['teach_id']==$teach_prac[$practs2[$f]]) OR ($finaltt1[$i][$timeslots[$k+1]]['teach_id']==$teach_prac[$practs2[$f]])))
							{
								$flag=0;
							}
							else
							{
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$practs2[$f];
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$teach_prac[$practs2[$f]];
								$batch2c[$e][$practs2[$f]]+=2;
								array_push($att_prac,$practs2[$f]);
								array_push($att_teacht3,$teach_prac[$practs2[$f]]);
								
								$flag=1;
							}
							$f++;
						}
						if($flag==0)
						{
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']='nil';
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']='nil';
						}
						$e++;
					}
				}
				if($timeslots[$k]=='t4')
				{
					$e=0;
					while($e<$batchcount2)
					{
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['prac_id'];
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['teach_id'];
						$e++;
					}
				}
				if(($timeslots[$k]=='t1') OR ($timeslots[$k]=='t2') OR ($timeslots[$k]=='t7') )
				{
					$f=0;$flag=0;
					while(($f<count($courses2)) AND ($flag!=1))
					{
						if(($coursecounts[$courses2[$f]]!=$max_lecture_course[$courses2[$f]]) AND (!in_array($courses2[$f],$att_course)))
						{
							if(($timeslots[$k]=='t1') OR ($timeslots[$k]=='t2'))
							{
								if(in_array($teach_courses[$courses2[$f]],$att_teacht1))
								{
									$flag=0;
								}
								else
								{
									$finaltt2[$i][$timeslots[$k]]['course_id']=$courses2[$f];
									$finaltt2[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses2[$f]];
									$flag=1;
								}
							}
							else
							{
								if($finaltt1[$i][$timeslots[$k]]['teach_id']==$teach_courses[$courses2[$f]])
								{
									$flag=0;
								}
								else
								{
									$finaltt2[$i][$timeslots[$k]]['course_id']=$courses2[$f];
									$finaltt2[$i][$timeslots[$k]]['teach_id']=$teach_courses[$courses2[$f]];
									$flag=1;
								}
							}
						}
						$f++;
					}
					if($flag==0)
					{
						$finaltt2[$i][$timeslots[$k]]['course_id']='nil';
						$finaltt2[$i][$timeslots[$k]]['teach_id']='nil';
					}
					if($flag==1)
					{
						array_push($att_course,$finaltt2[$i][$timeslots[$k]]['course_id']);
						$coursecounts[$finaltt2[$i][$timeslots[$k]]['course_id']]++;
					}
				}
				if($timeslots[$k]=='t5')
				{
					$att_prac=array();
					$e=0;
					while($e<$batchcount2)
					{	
						$f=0;$flag=0;
						while(($f<count($practs2)) AND ($flag!=1))
						{
							if(($batch2c[$e][$practs2[$f]]==$max_practs[$practs2[$f]]) OR (in_array($practs2[$f],$att_prac)) OR (in_array($teach_prac[$practs2[$f]],$att_teacht15)) OR (($finaltt1[$i][$timeslots[$k]]['teach_id']==$teach_prac[$practs2[$f]]) OR ($finaltt1[$i][$timeslots[$k+1]]['teach_id']==$teach_prac[$practs2[$f]])))
							{
								$flag=0;
							}
							else
							{
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$practs2[$f];
								$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$teach_prac[$practs2[$f]];
								$batch2c[$e][$practs2[$f]]+=2;
								array_push($att_prac,$practs2[$f]);
								array_push($att_teacht15,$teach_prac[$practs2[$f]]);
								$flag=1;
							}
							$f++;
						}
						if($flag==0)
						{
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']='nil';
							$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']='nil';
						}
						$e++;
					}
				}
				if($timeslots[$k]=='t6')
				{
					$e=0;
					while($e<$batchcount2)
					{
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['prac_id'];
						$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']=$finaltt2[$i][$timeslots[$k-1]][$batch2nd[$e]]['teach_id'];
						$e++;
					}
				}
				}
			}
		}
	}
}
$days=array("monday","tuesday","wednesday","thursday","friday");
echo "<br>";
$sql="insert into timetable(year,day,timeslot,batch,prac_id,teach_id) values(?,?,?,?,?,?)";
$stmt1=$con->prepare($sql);
$stmt1->bind_param("isssss",$year,$day,$timeslot,$batch,$prac_id,$teach_id);
$sql1="insert into timetable(year,day,timeslot,course_id,teach_id) values(?,?,?,?,?)";
$stmt2=$con1->prepare($sql1);
$stmt2->bind_param("issss",$year,$day,$timeslot,$course_id,$teach_id);
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
padding: 12px 20px;
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
	
	background-color:none;
}

</style>
</head>
<body>
<?php if(isset($_SESSION['admin_id']))
{ ?>
	<button onclick="location.href='admin.php'"><i class="fas fa-hand-point-left"></i> BACK TO HOME</button>
<?php } ?>
<?
if(isset($_GET['back']))
{
	header("location:admin.php");
}?>
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
	for($j=1;$j<=2;$j++)
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
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$batch=$batch1st[$e];
						$prac_id=$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id'];
						$teach_id=$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id'];
						$stmt1->execute();
						echo $batch1st[$e]."-"; echo $finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']."-"; echo $finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']; echo "<br>";
						$e++;
					}
					?> </td> <?php
					}
					else
					{
						?> <td> <?php
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$course_id=$finaltt1[$i][$timeslots[$k]]['course_id'];
						$teach_id=$finaltt1[$i][$timeslots[$k]]['teach_id'];
						$stmt2->execute();
						echo $finaltt1[$i][$timeslots[$k]]['course_id']."-"; echo $finaltt1[$i][$timeslots[$k]]['teach_id'];
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
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$batch=$batch1st[$e];
						$prac_id=$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id'];
						$teach_id=$finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id'];
						$stmt1->execute();
						echo $batch1st[$e]."-"; echo $finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['prac_id']."-"; echo $finaltt1[$i][$timeslots[$k]][$batch1st[$e]]['teach_id']; echo '<br>';
						$e++;
					}
					?></td><?php
					}
					else
					{
						?><td><?php
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$course_id=$finaltt1[$i][$timeslots[$k]]['course_id'];
						$teach_id=$finaltt1[$i][$timeslots[$k]]['teach_id'];
						$stmt2->execute();
						echo $finaltt1[$i][$timeslots[$k]]['course_id']."-"; echo $finaltt1[$i][$timeslots[$k]]['teach_id'];
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
	for($j=1;$j<=2;$j++)
	{
		for($k=0;$k<count($timeslots);$k++)
		{
			if($j==2)
			{
				if($i==0 OR $i==2 OR $i==4)
				{
				if($timeslots[$k]=='t3' OR $timeslots[$k]=='t4' OR $timeslots[$k]=='t5' OR $timeslots[$k]=='t6')
					{
						?> <td> <?php
						$e=0;
					while($e<$batchcount1)
					{
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$batch=$batch2nd[$e];
						$prac_id=$finaltt2[$i][$timeslots[$k]][$batch1st[$e]]['prac_id'];
						$teach_id=$finaltt2[$i][$timeslots[$k]][$batch1st[$e]]['teach_id'];
						$stmt1->execute();
						echo $batch2nd[$e]."-"; echo $finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']."-"; echo $finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']; echo "<br>";
						$e++;
					}
					?> </td> <?php
					}
					else
					{
						?> <td> <?php
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$course_id=$finaltt2[$i][$timeslots[$k]]['course_id'];
						$teach_id=$finaltt2[$i][$timeslots[$k]]['teach_id'];
						$stmt2->execute();
						echo $finaltt2[$i][$timeslots[$k]]['course_id']."-"; echo $finaltt2[$i][$timeslots[$k]]['teach_id'];
						?> </td> <?php
					}
				}
				if($i==1 OR $i==3)
				{
					if($timeslots[$k]=='t3' OR $timeslots[$k]=='t4')
					{
						?><td><?php
						$e=0;
					while($e<$batchcount1)
					{
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$batch=$batch2nd[$e];
						$prac_id=$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id'];
						$teach_id=$finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id'];
						$stmt1->execute();
						echo $batch2nd[$e]."-"; echo $finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['prac_id']."-"; echo $finaltt2[$i][$timeslots[$k]][$batch2nd[$e]]['teach_id']; echo '<br>';
						$e++;
					}
					?></td><?php
					}
					else
					{
						?><td><?php
						$year=$j;
						$day=$days[$i];
						$timeslot=$timeslots[$k];
						$course_id=$finaltt2[$i][$timeslots[$k]]['course_id'];
						$teach_id=$finaltt2[$i][$timeslots[$k]]['teach_id'];
						$stmt2->execute();
						echo $finaltt2[$i][$timeslots[$k]]['course_id']."-"; echo $finaltt2[$i][$timeslots[$k]]['teach_id'];
						?></td><?php
					}
				}
				}
			}
		}
	}
?>
</table>
</body>
</html>