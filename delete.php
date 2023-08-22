<?php
require "connection.php";
    
?>

<?php
require "header.php";
    
?>
<?php
if(isset($_POST['delete'])){
    $del = $_POST['delete'];
    try{
    $delete = "DELETE from detail where id = :id";
    $stmt = $conn->prepare($delete);
    $del = $stmt->execute([':id'=>$del]);

    if($del){
        echo "<script type='text/javascript'>alert('SUCCESSFULLY DELETED')</script>";
        header("location:view.php");
        exit(0);
    }else{
        echo "unsuccessful";
    }
    }catch(PDOException $e){
    echo $e->getmessage();
    }
}
?>

<?php
require "footer.php";
    
?>



<!--  -->