<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';

if(isset($_POST["submit"]))
{
    $id=$_SESSION["id"];
    $type=$_SESSION["type"];
    $opwd=md5($_POST["opwd"]);
    $pwd=md5($_POST["pwd"]);
    $pwdRepeat=md5($_POST["pwdrepeat"]);
    
    $sql="SELECT *FROM $type WHERE id ='$id'";
    $result=mysqli_query($con,$sql);
    $use =mysqli_fetch_assoc($result);
    
    if($use["password"]===$opwd)
    {
        if($pwd===$pwdRepeat)
        {
            $sql="UPDATE $type SET password='$pwd' WHERE id='$id'";
            $result=mysqli_query($con,$sql);
            if($result){ $_SESSION["message"]="Password Changed!";}
            else{$_SESSION["message"]="Server error please try after some time";}
        }
        else
        {
            $_SESSION["message"]="Password do not match";
        }
    }
    else
    {
        $_SESSION["message"]="Wrong old password";
       
    }
}

 
?>
<link rel="stylesheet" href="css/signuplogin.css" type="text/css">
<section class="cbody">
    <h2>Change Password</h2>
    <form action="changepwd.php" method="post">
    <div class="inf"><?= $_SESSION['message'] ?></div>
        <input type="password" name="opwd" placeholder=" Old Password" required>
        <input type="password" name="pwd" placeholder="New Password" required>
        <input type="password" name="pwdrepeat" placeholder="Repeat New Password" required>
        <input type="submit" name="submit" value="Change Password">
    </form>
</section>
    
<?php
    include_once 'includes/footer.php';
?>