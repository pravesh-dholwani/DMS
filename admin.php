<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include('conn.php');
if(!isset($_SESSION['admin_id']))
{
	header('location:adminlogin.php');
	session_destroy();
}
$a_id=$_SESSION['admin_id'];
$sql="select * from admin where a_id='$a_id'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$_SESSION['teacher_name']=$row['a_name'];
?>
<html>
  <head>
    <title>ADMIN</title>
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
    <li><a href="addcourse.php" ><i class="far fa-plus-square"></i>ADD COURSE</a></li>
	<li><a href="removecourse.php" ><i class="fas fa-trash"></i>DELETE COURSE</a></li>
    <li><a href="upload.php"><i class="fas fa-book-reader"></i>UPLOAD NOTES</a></li>
    <li><a href="makenew.php?step=1"><i class="fas fa-calendar-week"></i>MAKE NEW TIMETABLE</a></li>
    <li><a href="showtta.php"><i class="fas fa-calendar-check"></i>SHOW TIMETABLE</a></li>
	<li><a href="send_ann.php"><i class="far fa-envelope"></i> MAKE ANNOUNCEMENT</a></li>
    <li><a href="get_attendance_teacher.php"><i class="far fa-address-card"></i>ATTENDANCE REPORT</a></li>
	<li><a href="logoutadmin.php"><i class="fas fa-sign-out-alt"></i>LOGOUT</a></li>
  </ul>
  </div>
  <section></section>
  </body>
  </html>
