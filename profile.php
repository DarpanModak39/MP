<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';

$id=$_SESSION["id"];
$type=$_SESSION["type"];

$sql="SELECT *FROM $type WHERE id ='$id'";
$result=mysqli_query($con,$sql);
$use =mysqli_fetch_assoc($result);
 
?>
<link rel="stylesheet" href="css/profile.css" type="text/css">
<div>
    <ul class="copt">
        <li>Name :<?php print($use["name"]);?></li><br>
        <li>Address :<?php print($use["address"]);?></li><br>
        <li>Mobile Number :<?php print($use["mnumber"]);?></li><br>
        <li>Username :<?php print($use["username"]);?></li><br>
        <li><a href="changepwd.php">Change Password</a><li>
    </ul>
</div>

<?php
    include_once 'includes/footer.php';
?>