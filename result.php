<?php session_start();
require("config.php"); 

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
	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="poll.css">
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
    <?php 
    $sql = "SELECT DISTINCT zone FROM candidate ORDER BY zone;";
    $result =mysqli_query($conn,$sql);
    $resultCheck=mysqli_num_rows($result);
    ?>
    <form name="frmdropdown" method="post" >
    <center>
    <h1 style="color:white">Select Zone</h1>
    <div class="form-control" style="width:200px;">
    <select class="form-control" name="zone">
         <?php 
         while($row = mysqli_fetch_array($result)) 
             echo "<option value=" . $row['zone'] . ">" . $row['zone'] . "</option>";
         ?>
     </select>
      </div>
        
<br>
<br>
      <input name="submit" type="submit" class="Regbtn" value="submit" >
    
</center>
</form> 
<script>
    var x, i, j, selElmnt, a, b, c;
/* Look for any elements with the class "form-control": */
x = document.getElementsByClassName("form-control");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
</script>

      <?php 
  if(isset($_POST['submit']))
  {
         $des=$_POST["zone"];
         ?>
    <h2 style="color:white">View Results</h2>
    <table width="100%" border="3" style="border-collapse:collapse; color:white;">
        <thead>
            <tr>
                <th><strong>Candidate-Name</strong></th>
                <th><strong>Candidate-Id</strong></th>
                <th><strong>NUMBER OF VOTES</strong></th>
            </tr>
        </thead>
    <tbody>
        
    <?php 
        $sel_query="SELECT candidate.name,poll.cid,candidate.zone, count(*) as votes FROM poll,candidate WHERE (candidate.cid=poll.cid OR poll.cid=0) AND candidate.zone='$des' GROUP BY poll.cid;";
        $result = mysqli_query($conn,$sel_query);
        while($row = mysqli_fetch_assoc($result)) {?>
            <tr><td align="center"><?php echo $row["name"]; ?></td>
                <td align="center"><?php echo $row["cid"]; ?></td>
                <td align="center"><?php echo $row["votes"]; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
    <div class="form">
    <h2 style="color:white">TOP 3 WINNERS!</h2>
    <table width="100%" border="3" style="border-collapse:collapse; color:white;">
        <thead>
            <tr>
                <th><strong>Candidate-Name</strong></th>
                <th><strong>Candidate-Id</strong></th>
                <th><strong>NUMBER OF VOTES</strong></th>
            </tr>
        </thead>
    <tbody>
    <?php
    $winquery="SELECT candidate.name,poll.cid,candidate.zone, count(*) as votes FROM poll,candidate WHERE candidate.cid=poll.cid AND candidate.zone='$des' GROUP BY poll.cid ORDER BY votes desc limit 3; ";
    $result = mysqli_query($conn,$winquery);
        while($row = mysqli_fetch_assoc($result)) {?>
            <tr><td align="center"><?php echo $row["name"]; ?></td>
                <td align="center"><?php echo $row["cid"]; ?></td>
                <td align="center"><?php echo $row["votes"]; ?></td>
            </tr>
        <?php }} ?>
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