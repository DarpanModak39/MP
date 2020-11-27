<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';


if(isset($_POST["submit"]))
{
    $type=mysqli_real_escape_string($con,$_POST["type"]);
    $username=mysqli_real_escape_string($con,$_POST["uname"]);
    $pwd=md5($_POST["pwd"]);

    
    $sql="SELECT *FROM $type WHERE username ='$username'";
    $result=mysqli_query($con,$sql);
    $use =mysqli_fetch_assoc($result);

    if($use)
    {
        if($use["password"] ===$pwd )
        {
            $_SESSION["id"]=$use["id"];
            $_SESSION["type"]=$type;
            header("location:$type.php");
        }
        else
        {
            $_SESSION["message"]="Wrong Password";
        }
    }
    else
    {
        $_SESSION["message"]="Username does not exists";
    }

}
 
?>
<link rel="stylesheet" href="css/signuplogin.css" type="text/css">
<section class="cbody">
    <h2>Log In</h2>
    <form action="login.php" method="post">
    <div class="inf"><?= $_SESSION['message'] ?></div>
        <label for="type">Log In as : </label>
        <input type="radio" name="type" value="admin" required>Admin
        <input type="radio" name="type" value="citizen" required>Citizen
        <input type="radio" name="type" value="worker" required>Worker
        <input type="text" name="uname" placeholder="Username" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <input type="submit" name="submit" value="Log In">
    </form>
</section>

<?php
    include_once 'includes/footer.php';
?>