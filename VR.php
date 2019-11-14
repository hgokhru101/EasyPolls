<?php
if(isset($_POST['submit']))
{
    require("config.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else{
    echo "Succesful";
}
$name=$mobile_no=$address=$age=$zone=$gender=$email=$password=$doc1=$doc2=$doc3="";
$vid=rand(100000,999999);
if(isset($_POST["name"])){
    $name = $_POST["name"];
}
if(isset($_POST["mobile_no"])){
    $mobile_no = (int)$_POST["mobile_no"];
}
 print('$mobile_no');
if(isset($_POST["address"])){
    $address = $_POST["address"];
}
if(isset($_POST["age"])){
    $age= $_POST["age"];
}
if(isset($_POST["zone"])){
    $zone = $_POST["zone"];
}

if(isset($_POST["gender"])){
    $gender= $_POST["gender"];
}

if(isset($_POST["email"])){
    $email = $_POST["email"];
}

if(isset($_POST["password"])){
    $password = $_POST["password"];
}

if(isset($_POST["doc1"])){
    $doc1 = $_POST["doc1"];
}

if(isset($_POST["doc2"])){
    $doc2 = $_POST["doc2"];
}

if(isset($_POST["doc3"])){
    $doc3 = $_POST["doc3"];
}
$sql2 = "SELECT * FROM login WHERE uname = '$email'";
      $result = mysqli_query($conn,$sql2);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);
      $sql3 = "SELECT * FROM login WHERE upassword = '$password'";
      $result1 = mysqli_query($conn,$sql3);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

      $count1 = mysqli_num_rows($result1);
      
      if($count >= 1) {
        $error = "Your Email is already taken";
         echo "
         <script>
         alert('Your Email is already taken');
         window.location.href='VR.html';
         </script>
         ";
      }
      else if($count1 >= 1) {
        $error = "Your Password is already taken";
         echo "
         <script>
         alert('Your Password is already taken');
         window.location.href='VR.html';
         </script>
         ";
      }else {
         $sql = "INSERT INTO voter(name,mobile_no,address,age,zone,gender,uid,doc1,doc2,doc3) VALUES ('$name',$mobile_no,'$address','$age','$zone','$gender','$email',$doc1,$doc2,$doc3);";
         $sql1="INSERT INTO login(uname,upassword) values ('$email','$password');";
         if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
            echo "Sign in successful!";
            header('location:admin.php');
         } else {
            echo "Error: " . $conn->error;
         }
      }
}
?>