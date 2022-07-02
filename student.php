<!DOCTYPE html>
<?php
 session_start();
 error_reporting(0);
 if(!isset($_SESSION['user_id']))
{
	header('location:login1.php');
	session_destroy();
}
include("conn.php");
$user_id=$_SESSION['user_id'];
$sql="select * from login where uid='$user_id'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$user_enroll=$row['enrollment'];
$sql1="select * from notify where to_send='$user_enroll'";
$result1=$con->query($sql1);
$_SESSION['u_enroll']=$user_enroll;
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>STUDENT</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
    <header>WELCOME</header>
 <ul>
    <li><a href="coursereg.php"><i class="fas fa-receipt"></i>REGISTER COURSES</a></li>   
    <li><a href="viewnotes.php"><i class="fas fa-eye"></i>VIEW NOTES</a></li>
    <li><a href="get_announce.php"><i class="fas fa-comments"></i>ANNOUNCEMENTS</a></li>
    <li><a href="showTT.php"><i class="fas fa-calendar-check"></i>VIEW TIMETABLE</a></li>
    <li><a href="get_notification.php"><i class="far fa-envelope"></i>NOTIFICATIONS <?php echo $result1->num_rows; ?></a></li>
    <li><a href="get_attendance_student.php"><i class="far fa-address-card"></i>ATTENDANCE REPORT</a></li>
	<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>
  </ul>
  </div>
  <section><marquee><h1><?php 
  $sql2="SELECT * FROM `announcements` where mov_stat=1";
  $result2=$con->query($sql2);
  if($result2->num_rows>0){echo "CHECK ANNOUNCEMENTS FOR LATEST ANNOUNCEMENTS";}?></h1></marquee> </section>
  </body>
  </html>
