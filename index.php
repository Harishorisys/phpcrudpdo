<?php
require "connection.php";
$msg = "";

if(isset($_POST['submit'])){
    $studentid = $_POST['studentid'];
    $studentname = $_POST['studentname'];
    $studentemail = $_POST['studentemail'];

   $sql = "SELECT * FROM detail where studentid = :studentid limit 1";// the query is to make the id is already registered or not..
    $stmt = $conn->prepare($sql);
    $stmt->execute([':studentid'=>$studentid]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
        echo "<script type='text/javascript'>alert('the given id is already registered !!')</script>";
    }else{
        // the query is to make the email is already registered or not..
        $sql1 = "SELECT * FROM detail  where studentemail = :studentemail limit 1";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([':studentemail'=> $studentemail]);
        $user1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        if($user1){
            echo "<script type='text/javascript'>alert('the given email is already registered!!')</script>";
        }else{
            // the query is to make the data to insert in the database......
            $insert = "INSERT INTO detail(studentid,studentname,studentemail) VALUES(:studentid,:studentname,:studentemail)";
            $stmt2 = $conn->prepare($insert);
            if($stmt2->execute([':studentid' => $studentid,':studentname' => $studentname,':studentemail' => $studentemail])){
                $msg =  "Inserted Successfully";
            }
        }
    } 
     
}
?>

<?php
require "header.php";
?>

<div class="container w-25 mt-5">
<form action="" method="post">
    <div>
        <h3><?php echo "$msg";?></h3>
    </div>
    <div><h3>DATA ENTRY</h3></div>
    <div>
    <input type="text" name="studentid" class="form-control mb-3" placeholder="Id">
    </div>
    <div>
    <input type="text" name="studentname" class="form-control mb-3" placeholder="Name">
    </div>
    <div>
    <input type="text" name="studentemail" class="form-control mb-3" placeholder="Email">
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-danger text-dark mt-3 me-3 ">INSERT</button>
    <a href="view.php" type="viewbtn" name="submit" class="btn btn-primary text-dark mt-3">VIEW DETAILS</a>
    </div>
</form>
</div>


<?php
require "footer.php";
?>
