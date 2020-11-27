<?php
include_once 'includes/header.php';
include_once 'includes/dbcon.php';

if(isset($_POST["viewimage"]))
{
    $image=mysqli_real_escape_string($con,$_POST["image"]);
}
?>
<section>
        <img src="<?php print($image)?>" alt="Couldn't load Image" style="position:fixed; left:30%; right:30%; top:100px; width:40%; height:80%;">
</section>


<?php
    include_once 'includes/footer.php';
?>