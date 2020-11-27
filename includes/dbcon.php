<?php

$serverName="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="syst";

$con=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if(!$con)
{
    die("Connection Failed ".mysqli_connect_error());
}
