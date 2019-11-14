<?php require("config.php");
$id=$_REQUEST['id'];
$query = "SELECT * from voter where uid='".$id."'"; 
$result = mysqli_query($conn, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Arvo|Caveat|Dancing+Script|Mansalva&display=swap" rel="stylesheet">
	<title>Admin page</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
                    
    <div class="logo-link">
        <img src="http://icons.iconarchive.com/icons/iconarchive/blue-election/512/Election-Vote-icon.png" alt="logo" border="0" height="70" width="65">
    </div>
    <div class="vertical_align" style=" color:white;font-size: 18px;"> 
        <h1 style="font-family: 'Merriweather', serif;">Easypolls</h1>
        <h4 style="font-family: 'Dancing Script', cursive;">Every vote counts</h4>
    </div>
	<br>
    <nav>
        <a class="menu" href="admin.php">Home</a>
        <div class="dropdown">
            <a class="menu">Registration</a>
            <div class="dropdown-content">
                <a class="menuitem" href="VR.html">VOTER</a>
                <a class="menuitem" href="CR.html">CANDIDATE</a>
                <a class="menuitem" href="PR.html">PARTY</a>
                <br>
                <a class="menuitem" href="EC.html">EC</a>
            </div>
        </div>
        <div class="dropdown">
            <a class="menu">Update/Delete</a>
            <div class="dropdown-content">
                <a class="menuitem" href="updatevoter.php">VOTER</a>
                <a class="menuitem" href="updatecandidate.php">CANDIDATE</a>
                <a class="menuitem" href="updateec.php">EC</a>
            </div>
        </div>
        <a class="menu" href="result.php">Results</a>
        <a class="menu" href="logout.php">Logout</a>
    </nav>
	<br>
	<br>
        <div class="form">
            <h1>Update Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$name =$_REQUEST['name'];
$age =$_REQUEST['age'];
$mobile_no =$_REQUEST['mobile_no'];
$zone =$_REQUEST['zone'];
$address =$_REQUEST['address'];
$gender=$_REQUEST['gender'];
$update="update voter set name='".$name."', age=".$age.", mobile_no=".$mobile_no.", zone='".$zone."', address='".$address."', gender='".$gender."' where uid='".$id."'";
mysqli_query($conn, $update) or die(mysqli_error($conn));
$status = "Record Updated Successfully. </br></br>
<a href='updatevoter.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['uid'];?>" />
<p><input type="text" name="name" placeholder="Enter Name" 
required value="<?php echo $row['name'];?>" /></p>
<p><input type="number" name="age" placeholder="Enter Age" 
required value="<?php echo $row['age'];?>" /></p>
<p><input type="number" name="mobile_no" placeholder="Enter Mobile no." 
required value="<?php echo $row['mobile_no'];?>" /></p>
<p><input type="text" name="zone" placeholder="Enter Zone" 
required value="<?php echo $row['zone'];?>" /></p>
<p><input type="text" name="address" placeholder="Enter Address" 
required value="<?php echo $row['address'];?>" /></p>
<p><input type="text" name="gender" placeholder="Enter Your Gender" 
required value="<?php echo $row['gender'];?>" /></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</div>
</div>
    <br>
    <br>    
    <script>
    let box = document.querySelectorAll(".box");
    function frontFunction() {
        box.forEach(x => x.addEventListener("click", function () {
            this.classList.add("active"); }));
    }
    function backFunction() {
        box.forEach(x => x.addEventListener("click", function () {
        this.classList.remove("active"); }));
    }
</script>
</body>
</html>