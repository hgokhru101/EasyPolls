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
$password=$name=$post=$uname="";
if(isset($_POST["name"])){
    $name = $_POST["name"];
}
if(isset($_POST["post"])){
    $post =$_POST["post"];
}
if(isset($_POST["uname"])){
    $uname = $_POST["uname"];
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
$sql2 = "SELECT * FROM login WHERE uname = '$uname'";
      $result = mysqli_query($conn,$sql2);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count >= 1) {
         // $_SESSION['login_user'] = $login_user;
         // echo "Sign in successful";
         //  header("location: home.html");
        $error = "Username is already taken";
         echo "
         <script>
         alert('Username is already taken');
         window.location.href='EC.html';
         </script>
         ";
      }
      else{
$sql = "INSERT INTO ec(name,post,uname) VALUES ('$name','$post','$uname');";
$sql1="INSERT INTO login(uname,upassword) VALUES ('$name','$password')";
if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
    echo "Sign in successful!";
    header('location:admin.php');
} else {
	echo "Error: " . $conn->error;
}
}
}
?>