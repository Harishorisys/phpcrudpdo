<?php require "connection.php"; 

// the query is make the data to read in the view page for the user. 
$sql = "SELECT * from detail ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_OBJ);

?>
<?php require "header.php"; ?>

<div class="container w-50 mt-5">
    <h3>STUDENT DETAILS</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Student Email</th>
      <th colspan=4>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($user as $stud): ?>
    <tr>
        <td><?=$stud->studentid;?></td>
        <td><?=$stud->studentname;?></td>
        <td><?=$stud->studentemail;?></td>
        <td><a href="update.php?id=<?=$stud->id;?>" class="btn btn-success" >UPDATE</a></td>
        <form action="delete.php" method="POST">
         <td><button type="submit" class="btn btn-danger"  value="<?= $stud->id; ?>" name="delete" onclick = "return confirm('are u sure to delete this data??')">DELETE</button></td>
        </form>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div><a href="index.php" class="btn btn-primary text-dark">BACK</a></div>
</div>

<?php require "footer.php"; ?>

