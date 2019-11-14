<?php
require('config.php');
$id=$_REQUEST['id'];
$sql1 = "SELECT * FROM voter WHERE uid = '".$id."'";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $count1 = mysqli_num_rows($result1);

      $sql2 = "SELECT * FROM candidate WHERE uid = '".$id."'";
      $result2 = mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $count2 = mysqli_num_rows($result2);

      $sql3 = "SELECT * FROM ec WHERE uname = '".$id."'";
      $result3 = mysqli_query($conn,$sql3);
      $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
      $count3 = mysqli_num_rows($result3);
if($count1>=1)
{
$query = "DELETE FROM voter WHERE uid='".$id."'";
$query1 = "DELETE FROM login WHERE uname='".$id."'"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error($conn));
$result9 = mysqli_query($conn,$query1) or die ( mysqli_error($conn));
header("Location: updatevoter.php"); 
}
else if($count2>=1)
	{
$query = "DELETE FROM candidate WHERE uid='".$id."'";
$query1 = "DELETE FROM login WHERE uname='".$id."'"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error($conn));
$result9 = mysqli_query($conn,$query1) or die ( mysqli_error($conn));
header("Location: updatecandidate.php"); 
}
else if($count3>=1)
{
$query = "DELETE FROM ec WHERE uname='".$id."'";
$query1 = "DELETE FROM login WHERE uname='".$id."'"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error($conn));
$result9 = mysqli_query($conn,$query1) or die ( mysqli_error($conn));
header("Location: updateec.php"); 
}
?>