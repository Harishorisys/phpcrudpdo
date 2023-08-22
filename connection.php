<?php 
// connnection page
$dsn = "mysql:host=localhost;dbname=student" ;
$dbuser = "root";
$dbpassword = "";

try{
    $conn = new PDO($dsn,$dbuser,$dbpassword);
    // echo "connecion successful";
}catch(PDOException $e){
    echo $e->getmessage();
}


?>