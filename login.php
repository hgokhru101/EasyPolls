<?php
   require("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $login_user = mysqli_real_escape_string($conn,$_POST['uname']);
      $Password = mysqli_real_escape_string($conn,$_POST['upassword']); 
      
      $sql = "SELECT * FROM login WHERE uname = '$login_user' and upassword = '$Password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      $sql1 = "SELECT * FROM voter WHERE uid = '$login_user'";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $count1 = mysqli_num_rows($result1);

      $sql2 = "SELECT * FROM candidate WHERE uid = '$login_user'";
      $result2 = mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $count2 = mysqli_num_rows($result2);

      $sql3 = "SELECT * FROM ec WHERE uname = '$login_user'";
      $result3 = mysqli_query($conn,$sql3);
      $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
      $count3 = mysqli_num_rows($result3);
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) {
         $_SESSION['login_user'] = $login_user;
         echo "Sign in successful";
         if($count1==1)
          header("location: voter.php");
         else if($count2==1)
          header("location: candidate.php");
         else if($count3==1)
          header("location: admin.php");

      }
      else {
         $error = "Your Login Name or Password is invalid";
         echo "
         <script>
         alert('Your Login Name or Password is invalid');
         window.location.href='login.html';
         </script>
         ";
      }
   }
?>