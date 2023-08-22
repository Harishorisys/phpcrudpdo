<?php 
require "connection.php";

$id = $_GET['id'];  //  the query is to make all the given data to the update page.
$sql = "SELECT * from detail where id=:id ";
$stmt = $conn->prepare($sql);
$stmt->execute([':id'=>$id]);
$stud = $stmt->fetch(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){
    $studentid = $_POST['studentid'];
    $studentname = $_POST['studentname'];
    $studentemail = $_POST['studentemail'];
    // comment for already existed id.......... 
    $sql1 = "SELECT * from detail where studentid = :studentid and id != :currentid limit 1";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([':studentid'=>$studentid,':currentid'=>$id]);
    $user = $stmt1->fetch(PDO::FETCH_ASSOC);

    if($user){
        echo "<script type='text/javascript'>alert('the given id is already exists')</script>";
    }else{
            // comment for already existed email.......... 
        $sql2 = "SELECT * from detail where studentemail = :studentemail and id != :currentid limit 1";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute(['studentemail'=>$studentemail,':currentid'=>$id]);
        $user1 = $stmt2->fetch(PDO::FETCH_ASSOC);

        if($user1){
            echo "<script type='text/javascript'>alert('the given email is already exists')</script>";
        }else{
            // updating a old data to the view page.....
            $update = "UPDATE detail SET studentid = :studentid , studentname = :studentname , studentemail = :studentemail where id = :id";
            $stmt3 = $conn->prepare($update);
            
            if($stmt3->execute([':id'=>$id,':studentid'=>$studentid,':studentname'=>$studentname,':studentemail'=>$studentemail])){
                echo "<script type='text/javascript'>alert('SUCCESSFULLY UPDATED')</script>";
                header("location:view.php");
            }

        }
    }
}


?>
<?php require "header.php";?>

<div class="container w-25 mt-5">
<form action="" method="post">
    
    <div><h3>DATA UPDATE</h3></div>
    <div>
    <input type="text" name="studentid" class="form-control mb-3" value="<?=$stud->studentid?>" >
    </div>
    <div>
    <input type="text" name="studentname" class="form-control mb-3"  value="<?=$stud->studentname?>" >
    </div>
    <div>
    <input type="text" name="studentemail" class="form-control mb-3"  value="<?=$stud->studentemail?>" >
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-success text-dark mt-3 me-3 ">UPDATE</button>
    </div>
    <div><a href="view.php" class="btn btn-primary text-dark mt-3 ">BACK</a></div>

</form>
</div>


<?php require "footer.php";?>