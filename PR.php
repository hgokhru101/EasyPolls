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
$partyname=$party_abbrev=$party_head="";
if(isset($_POST["party_name"])){
    $partyname = $_POST["party_name"];
}
if(isset($_POST["party_abbrev"])){
    $party_abbrev =$_POST["party_abbrev"];
}
if(isset($_POST["party_head"])){
    $party_head = $_POST["party_head"];
}
$sql2 = "SELECT * FROM party WHERE party_name = '$party_name'";
      $result = mysqli_query($conn,$sql2);
      $count = mysqli_num_rows($result);

      $sql3 = "SELECT * FROM  WHERE party_abbrev = '$party_abbrev'";
      $result1 = mysqli_query($conn,$sql3);
      $count1 = mysqli_num_rows($result1);
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count >= 1) {
         // $_SESSION['login_user'] = $login_user;
         // echo "Sign in successful";
         //  header("location: home.html");
        $error = "Your Party Name is already taken";
         echo "
         <script>
         alert('Your Party Name is already taken');
         window.location.href='PR.html';
         </script>
         ";
      }
      else if($count1 >= 1) {
         // $_SESSION['login_user'] = $login_user;
         // echo "Sign in successful";
         //  header("location: home.html");
        $error = "Your Party abbrevaition is already taken";
         echo "
         <script>
         alert('Your Party abbrevaition is already taken');
         window.location.href='PR.html';
         </script>
         ";
      }
      else{
$sql = "INSERT INTO party(party_name,party_abbrev,party_head) VALUES ('$partyname','$party_abbrev','$party_head');";
$sql1="INSERT INTO login(uname) VALUES ('$partyname');";
if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
    header('location:admin.php');
    echo "Sign in successful!";
} else {
	echo "Error: " . $conn->error;
}
}
}
?>