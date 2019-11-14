<?php require("config.php");
session_start();

if($_SESSION['login_user']=="")
{
    echo"
    <script>
     alert('Your are not logged in. Kindly, please login');
     window.location.href='home.html';
     </script>";
} ?>

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
        <a class="menu"href="result.php" >Results</a>
        <a class="menu" href="logout.php" >Logout</a>
    </nav>
	<br>
	<br>
    <div class="form1">
    <h2>View Records</h2>
    <table width="100%" border="3" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>Candidate-Id</strong></th>
                <th><strong>Username</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Age</strong></th>
                <th><strong>Zone</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Mobile No.</strong></th>
                <th><strong>Gender</strong></th>
                <th><strong>Income</strong></th>
                <th><strong>Prevoius Accomplishments</strong></th>
                <th><strong>Qualifications</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>
    <tbody>
    <?php
        $sel_query="Select * from candidate ORDER BY name desc;";
        $result = mysqli_query($conn,$sel_query);
        while($row = mysqli_fetch_assoc($result)) { ?>
            <tr><td align="center"><?php echo $row["cid"]; ?></td>
                <td align="center"><?php echo $row["uid"]; ?></td>
                <td align="center"><?php echo $row["name"]; ?></td>
                <td align="center"><?php echo $row["age"]; ?></td>
                <td align="center"><?php echo $row["zone"]; ?></td>
                <td align="center"><?php echo $row["address"]; ?></td>
                <td align="center"><?php echo $row["mobile_no"]; ?></td>
                <td align="center"><?php echo $row["gender"]; ?></td>
                <td align="center"><?php echo $row["income"]; ?></td>
                <td align="center"><?php echo $row["prev_acc"]; ?></td>
                <td align="center"><?php echo $row["qualification"]; ?></td>
                <td align="center">
                    <a href="editcan.php?id=<?php echo $row["uid"]; ?>">Edit</a>
                </td>
                <td align="center">
                    <a href="delete.php?id=<?php echo $row["uid"]; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
    </tbody>
    </table>
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