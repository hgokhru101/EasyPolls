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
$name=$mobile_no=$address=$age=$zone=$gender=$prev_acc=$qualification=$income=$password=$username=$doc1=$doc2=$doc3="";
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
if(isset($_POST["income"])){
    $income = $_POST["income"];
}
if(isset($_POST["prev_acc"])){
    $prev_acc= $_POST["prev_acc"];
}

if(isset($_POST["qualification"])){
    $qualification = $_POST["qualification"];
}

if(isset($_POST["zone"])){
    $zone = $_POST["zone"];
}

if(isset($_POST["gender"])){
    $gender = $_POST["gender"];
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
if(isset($_POST["partyname"])){
    $partyname =$_POST["partyname"];
}
if(isset($_POST["username"])){
    $username =$_POST["username"];
}
if(isset($_POST["password"])){
    $password =$_POST["password"];
}
      $sql2 = "SELECT * FROM login WHERE uname = '$username'";
      $result = mysqli_query($conn,$sql2);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      $sql3 = "SELECT * FROM login WHERE upassword = '$password'";
      $result1 = mysqli_query($conn,$sql3);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $count1 = mysqli_num_rows($result1);

      $sql4 = "SELECT * FROM party WHERE party_name = '$partyname';";
      $result2 = mysqli_query($conn,$sql4);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $count2 = mysqli_num_rows($result2);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count >= 1) {
         // $_SESSION['login_user'] = $login_user;
         // echo "Sign in successful";
         //  header("location: home.html");
        $error = "Your Username is already taken";
         echo "
         <script>
         alert('Your Username is already taken');
         window.location.href='CR.html';
         </script>
         ";
      }
      else if($count1 >= 1) {
         // $_SESSION['login_user'] = $login_user;
         // echo "Sign in successful";
         //  header("location: home.html");
        $error = "Your Password is already taken";
         echo "
         <script>
         alert('Your Password is already taken');
         window.location.href='CR.html';
         </script>
         ";}
         else if($count2==0 && $partyname!=""){
            $error = "Your Party is not registered with us";
         echo "
         <script>
         alert('Your Party is not registered with us. Kindly, enter a registered party or register without a party and then update your profile again after your party has registered. We regret your inconvenience');
         window.location.href='CR.html';
         </script>
         ";
         }
         else{
$sql = "INSERT INTO candidate(name,mobile_no,address,age,income,prev_acc,qualification,zone,gender,doc1,doc2,doc3,uid,party_name) VALUES ('$name',$mobile_no,'$address',$age,$income,'$prev_acc','$qualification','$zone','$gender',$doc1,$doc2,$doc3,'$username','$partyname');";
$sql1="INSERT INTO login(uname,upassword) VALUES ('$username','$password')";
if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
    echo "Sign in successful!";
    header("location: admin.php");
} else {
	echo "Error: " . $conn->error;
}
}
}
?>