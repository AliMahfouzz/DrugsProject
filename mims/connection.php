<?php   
$servername= "localhost";
$db_name= "mims";
$username = "root";
$password = "";


$con = mysqli_connect($servername, $username, $password, $db_name);

if(!$con){
    echo "Not connected";
}          

?>  