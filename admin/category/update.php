<?php
$id = $_GET['id'];
$statement = $connect->prepare("SELECT * FROM categories WHERE id=$id");
$statement->execute();
$result = $statement->fetchObject();
$nameErr = '';

if (isset($_POST["submitBtn"])) {
  $name = $_POST["name"];
  if ($_POST['name'] === '') {
    $nameErr = 'Name field is required!';
  } else {
    $statement = $connect->prepare("UPDATE categories SET name='$name' WHERE id=$id");
    $statement -> execute();
    echo "<script>location.href='index.php?page=category'</script>";
  }
}
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold text-primary">Category Update Form</h5>
      <a href="index.php" class="btn btn-primary btn-sm">
        << Back </a>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-2">
          <label for="">Name <span class="text-danger">*</span></label>
          <input name="name" value="<?php echo $result->name ?>" type="text" class="form-control">
          <span class="text-danger"><?php echo $nameErr ?></span>
        </div>
        <button type="submit" class="btn btn-primary" name="submitBtn">Save</button>
      </form>
    </div>
  </div>
</div>