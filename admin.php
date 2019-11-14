<?php session_start();
require("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Arvo|Caveat|Dancing+Script|Mansalva&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Jomolhari&display=swap" rel="stylesheet">
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
    <?php
    if($_SESSION['login_user']=="")
    {
        echo"
        <script>
         alert('Your are not logged in. Kindly, please login');
         window.location.href='home.html';
         </script>";
    } 
    $query= "SELECT * FROM ec where uname= '{$_SESSION['login_user']}' ;";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        ?>
        <div class="form">
            <h2>---Details---</h2>
<!-- Displaying Data Read From Database -->
            <label>Username:</label> <?php echo $row['uname']; echo"<br />";?>
            <label>Admin-Id:</label> <?php echo $row['eid']; echo"<br />";?>
            <label>Name:</label> <?php echo $row['name']; echo"<br />";?>
            <label>Post:</label> <?php echo $row['post']; echo"<br />";?>
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