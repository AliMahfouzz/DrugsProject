<?php   
$servername= "localhost";
$db_name= "mims";
$username = "root";
$password = "1A2b3c4d!";


$con = mysqli_connect($servername, $username, $password, $db_name);

if(!$con){
    echo "Not connected";
}          

?>  