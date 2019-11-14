<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Polling Page</title>
    <link rel="stylesheet" type="text/css" href="poll.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
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
    <br>
    <ul class="mid">
            <li class="mid"> <a class="mid" href="voter.php">My profile</a> </li>
            <li class="mid"> <a class="mid" href="logout.php">Log out</a></li>
        </ul>
	
    <?php
    require("config.php");
    session_start();
    if($_SESSION['login_user']=="")
{
    echo"
    <script>
     alert('Your are not logged in. Kindly, please login');
     window.location.href='home.html';
     </script>";
}
    $des1="";
    $sql1 = "SELECT poll.vid FROM poll,voter WHERE voter.uid='{$_SESSION['login_user']}' AND voter.vid=poll.vid;";
      $result1 = mysqli_query($conn,$sql1);
      $count1 = mysqli_num_rows($result1);
      if($count1>=1)
      {?>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
       <h2 style="text-align:center ;color:white;"> You Have Voted. Thank You For Voting. YOUR VOTE COUNTS </h2>
      <?php
    }
      else{
    $sql = "SELECT candidate.cid,candidate.name FROM candidate,voter where voter.zone=candidate.zone AND voter.uid='{$_SESSION['login_user']}';";
    $result =mysqli_query($conn,$sql);
    $resultCheck=mysqli_num_rows($result);
    ?>
    <form name="frmdropdown" method="post" >
    <center>  
    <br>
    <br>
    <br>
    <h1 style="color:white;">Select Candidate</h1>
    <div class="form-control" style="width:200px;">
     <select class="form-control" name="candidate">
         <option value="0">NOTA</option>
         <?php 
         while($row = mysqli_fetch_array($result)) 
             echo "<option value=" . $row['cid'] . ">" . $row['name'] . "</option>";
         ?>
     </select>
      </div>
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
<br>
<br>
<br>
      <input name="submit" type="submit" class="Regbtn" value="submit" >
</center>
<br>
<br>
</form> 
      <?php 
  if(isset($_POST['submit']))
  {
         $des=$_POST["candidate"]; 
         $_SESSION['des']=$des;
        if($des=="0")
          {
            $des1="NONE-OF-THE-ABOVE";
          }?>
          <table width="100%" border="3" style="border-collapse:collapse; color:white;">
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
            </tr>
        </thead>
    <tbody>
    <?php
        $sel_query="Select * from candidate where cid= ".$des.";";
        $result = mysqli_query($conn,$sel_query);
        while($row = mysqli_fetch_assoc($result)) { $des1=$row["name"];?>
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
            </tr>
            <?php } ?>
    </tbody>
    </table>              
<?php 
}?>
<p id="g"></p>
<br>
  <center>
  <?php 
  if(isset($_POST['submit']))
  {
    ?>
    <br>
    
    <button onclick="myFunction()">CONFIRM</button>
    <?php
  }
  ?>
  <center>
<script>
function myFunction() {
  var doc;
  var r = confirm("Are you sure you want to give your vote to "+"<?php echo "$des1";?>");
  if (r == true) {
    $.ajax({
      url:"insert_ajax.php",
      type:"POST",
      data:"",
    }).done();
       window.location.href='poll.php';
  } else {
    window.location.href='poll.php';
  }
}
</script>
  <?php }?>
  
</body>
</html>

