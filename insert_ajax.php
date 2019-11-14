 <?php
include("config.php");
session_start();

		$des=$_SESSION['des'];

      $sql = "SELECT vid FROM voter WHERE uid='{$_SESSION['login_user']}'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $sql_que="INSERT INTO poll(cid,vid) values (".$des.",".$row['vid'].");";
      mysqli_query($conn,$sql_que) or die(mysqli_error($conn)); 
      unset($_SESSION['des']);
       ?>