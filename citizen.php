<?php
    include_once 'includes/header.php';
    if($_SESSION['type']!=="citizen")
    {
        exit("You must login as citizen to view this page");
    }
?>

<link rel="stylesheet" href="css/opt.css" type="text/css">
<div>
    <ul class="copt">
        <li><a href="raisequery.php">Raise Query</a></li><br>
        <li><a href='trackquery.php'>Track Query</a></li><br>
        <li><a href='feedback.php'>Feedback</a></li>
    </ul>
</div>

<?
    include_once 'includes/footer.php';
?>