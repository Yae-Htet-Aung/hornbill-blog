<?php
$nameErr = "";
if (isset($_POST["submitBtn"])) {
  $name = $_POST['name'];
  if ($name === '') {
    $nameErr = 'Name field must be filled!';
  } else {
    $statement = $connect->prepare("INSERT INTO categories (name) VALUE ('$name')");
    $statement->execute();
    echo "<script>location.href='index.php?page=category'</script>";
  }
}
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold text-primary">Category Creation Form</h5>
      <a href="index.php" class="btn btn-primary btn-sm">
      <i class="far fa-hand-point-left"></i> Back </a>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-2">
          <label for="">Name <span class="text-danger">*</span></label>
          <input name="name" type="text" class="form-control">
          <span class="text-danger"><?php echo $nameErr ?></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submitBtn">Submit</button>
      </form>
    </div>
  </div>
</div>