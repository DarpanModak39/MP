<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';
if($_SESSION['type']!=="admin")
{
    exit("You must login as admin to view this page");
}
if(isset($_POST["changestatus"]))
{
    $queryid=mysqli_real_escape_string($con,$_POST["queryid"]);
    $status=mysqli_real_escape_string($con,$_POST["status"]);
    $sql="UPDATE query SET status='$status' WHERE id='$queryid'";
    $result=mysqli_query($con,$sql);
    if($result){ $_SESSION["message"]="You have changed the status successfully";}
    else{$_SESSION["message"]="Server error please try after some time";}
}
if(isset($_POST["CloseQuery"]))
{
    $queryid=mysqli_real_escape_string($con,$_POST["queryid"]);
    $status="Work done succesfully & query closed";
    $sql="UPDATE query SET status='$status' WHERE id='$queryid'";
    $result=mysqli_query($con,$sql);
    if($result){ $_SESSION["message"]="You have closed the query";}
    else{$_SESSION["message"]="Server error please try after some time";}
}
$sql="SELECT * FROM query";
$result=mysqli_query($con,$sql);

?>
<link rel="stylesheet" href="css/trackquery.css" type="text/css">
<div>
<table>
    <tr>
    <td> Query ID </td>
    <td> Citizen ID </td>
    <td> Worker ID</td>
    <td> Query Image</td>
    <td> Description </td>
    <td> Location </td>
    <td> Job Image</td>
    <td> Status</td>
    </tr>
    <tr>
        <?php
            while($row=mysqli_fetch_row($result))
            {
                echo"
                    <tr>
                    <td> $row[0]</td>
                    <td> $row[1]</td>
                    <td> $row[2]</td>
                    <td>
                    <form action='image.php' method='post'> 
                        <input type='hidden' name='image' value='$row[3]'>
                        <input type='submit' value='View Image' name='viewimage'>
                    </form>
                    </td>
                    <td> $row[4]</td>
                    <td> $row[5]
                        <form action='location.php' method='post'> 
                            <input type='hidden' name='location' value='$row[5]'>
                            <input type='submit' value='View Location' name='submitlocation'>
                        </form>
                    </td>";
                    if($row[6]!=="")
                    {
                        echo"                    
                        <td>
                        <form action='image.php' method='post'> 
                            <input type='hidden' name='image' value='$row[6]'>
                            <input type='submit' value='View Image' name='viewimage'>
                        </form>
                        </td>";
                    }
                    else 
                    {
                        echo"<td>Job yet to be done </td>";
                    }

                    if($row[7]!=="Work done succesfully & query closed")
                    {
                        echo"    
                            <td>$row[7]
                            <form action='queryinfo.php' method='post'> 
                                <input type='text' name='status' placeholder='Status' required>   
                                <input type='hidden' name='queryid' value=$row[0]>
                                <input type='submit' value='Change Status' name='changestatus'>
                            </form>
                            <form action='queryinfo.php' method='post'>
                                <input type='hidden' name='queryid' value=$row[0]>
                                <input type='submit' name='CloseQuery' value='Close Query'>
                            </form>
                            </td></tr>";
                    }
                    else
                    {
                        echo"<td>$row[7]</td></tr>";    
                    }
                    
            }

        ?>
    </tr>
</div>



<?php
    include_once 'includes/footer.php';
?>