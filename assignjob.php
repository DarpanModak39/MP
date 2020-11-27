<?php

include_once 'includes/header.php';
include_once 'includes/dbcon.php';

if(isset($_POST["submit"]))
{
    
    $queryid=mysqli_real_escape_string($con,$_POST["queryid"]);
    $workerid=mysqli_real_escape_string($con,$_POST["workerid"]);
    
    $sql="SELECT id,workerid FROM query WHERE id=$queryid";
    $result=mysqli_query($con,$sql);
    $use=mysqli_fetch_assoc($result);
    if($use)
    {
        if($use['workerid']===NULL)
        {
            $sql="SELECT * FROM worker WHERE id=$workerid";
            $result=mysqli_query($con,$sql);
            $use=mysqli_fetch_assoc($result);
            if($use)
            {
                $sql="UPDATE query SET workerid='$workerid', status='Job assign to worker' WHERE $queryid=id ";
                $result=mysqli_query($con,$sql);
                if($result){ $_SESSION["message"]="You have assign query $queryid to  worker $workerid";}
                else{$_SESSION["message"]="Server error please try after some time";}
            }
            else
            {
                $_SESSION["message"]="Please enter valid WorkerId";
            }
        }
        else
        {
            $_SESSION["message"]="Query is assigned to another worker";
        }
    }
    else
    {
        $_SESSION["message"]="Please enter valid QueryId";
    }

}
?>
<link rel="stylesheet" href="css/signuplogin.css" type="text/css">
<section class="cbody">
    <h2>Assign Job to Worker</h2>
    <form action="assignjob.php" method="post">
    <div class="inf"><?= $_SESSION['message'] ?></div>
        <input type="text" name="queryid" placeholder="Query ID" required>
        <input type="text" name="workerid" placeholder="Worker ID" required >
        <input type="submit" name="submit" value="Assign Job">
    </form>
</section>

<?php
    include_once 'includes/footer.php';
?>