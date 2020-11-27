<?php

include_once 'includes/header.php';
include_once 'includes/dbcon.php';

if(isset($_POST["submit"]))
{
    $type=mysqli_real_escape_string($con,$_POST["type"]);
    $name=mysqli_real_escape_string($con,$_POST["name"]);
    $address=mysqli_real_escape_string($con,$_POST["address"]);
    $number=mysqli_real_escape_string($con,$_POST["mnumber"]);
    $username=mysqli_real_escape_string($con,$_POST["uname"]);
    $pwd=md5($_POST["pwd"]);
    $pwdRepeat=md5($_POST["pwdrepeat"]);

    
    $sql="SELECT *FROM $type WHERE username ='$username' OR mnumber='$number' ";
    $result=mysqli_query($con,$sql);
    $use =mysqli_fetch_assoc($result);


    if($use)
    {
        if($use["username"] ===$username)
        {
            $_SESSION["message"]="Username already exits";
            
        }
        elseif($use["mnumber"] ===$number)
        {
            $_SESSION["message"]="Mobile Number has linked to another account";
        }
    
    }
    elseif($pwd !==$pwdRepeat)
    {
        $_SESSION["message"]="Password do not match";
    }
    else
    {
        $sql="INSERT INTO $type (name,address,mnumber,username,password) VALUES ('$name','$address','$number','$username','$pwd') ";
        $result=mysqli_query($con,$sql);
        if($result){ $_SESSION["message"]="You have Sign Up!";}
        else{$_SESSION["message"]="Server error please try after some time";}
    }

}
?>
<link rel="stylesheet" href="css/signuplogin.css" type="text/css">
<section class="cbody">
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
    <div class="inf"><?= $_SESSION['message'] ?></div>
        <label for="type">Sign Up as : </label>
        <input type="radio" name="type" value="admin" required>Admin
        <input type="radio" name="type" value="citizen" required>Citizen
        <input type="radio" name="type" value="worker" required>Worker
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="address" placeholder="Address" required >
        <input type="text" name="mnumber" placeholder="Mobile Number" pattern="[7-9]{1}[0-9]{9}" required>
        <input type="text" name="uname" placeholder="Username" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <input type="password" name="pwdrepeat" placeholder="Repeat Password" required>
        <input type="submit" name="submit" value="Sign Up">
    </form>
</section>

<?php
    include_once 'includes/footer.php';
?>