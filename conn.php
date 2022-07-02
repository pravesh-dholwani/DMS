<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="DMS";
$con=new mysqli($db_host,$db_user,$db_pass,$db_name);
$con1=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
$con2=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
$conn=new mysqli($db_host,$db_user,$db_pass,$db_name);
if(!$con)
{echo"no";
exit();
}
else
{
	

}
?>