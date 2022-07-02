<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include("conn.php");
if(!isset($_SESSION['teacher_id']))
{
	header('location:login2.php');
	session_destroy();
}
$teach_id=$_SESSION['teacher_id'];
$result=$con->query("select teacher_name from teachers where teacher_id='$teach_id'");
$row=$result->fetch_assoc();
$_SESSION['teacher_name']=$row['teacher_name'];
?>
<html>
  <head>
    <title>TEACHER</title>
    <link rel="stylesheet" href="style.css">
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
    <li><a href="viewnotes.php" ><i class="fas fa-eye"></i>VIEW UPLOADED NOTES</a></li>   
    <li><a href="upload.php"><i class="fas fa-book-reader"></i>UPLOAD NOTES</a></li>
	<li><a href="showtta.php"><i class="fas fa-calendar-check"></i>SHOW TIMETABLE</a></li>
    <li><a href="Att_dance.php"><i class="fas fa-calendar-week"></i>TAKE ATTENDANCE</a></li>
    <li><a href="send_ann.php"><i class="far fa-envelope"></i>ANNOUNCE</a></li>
    <li><a href="get_attendance_teacher.php"><i class="far fa-address-card"></i>ATTENDANCE REPORT</a></li>
	<li><a href="logoutteach.php"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>
  </ul>
  </div>
  <section></section>
  </body>
  </html>