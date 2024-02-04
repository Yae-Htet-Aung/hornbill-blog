<?php
$nameErr = "";
$roleErr = "";
$emailErr = "";
$passwordErr = "";

if (isset($_POST["submitBtn"])) {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  // echo '<pre>';
  // var_dump($_POST);
  // echo '</pre>';
  if ($name === '') {
    $nameErr = 'Name field must be filled!';
  } else if ($role === '') {
    $nameErr = 'Role field must be filled!';
  } else if ($email === '') {
    $emailErr = 'Email field must be filled!';
  } else if ($email === '') {
    $password = 'Password field must be filled!';
  } else {
    $password = md5($password);
    $statement = $connect->prepare("INSERT INTO users (name, role, email, password) VALUE ('$name', '$role', '$email', '$password')");
    $statement->execute();
    if ($statement) {
      // var_dump($statement);
      echo "<script>location.href='index.php?page=users'</script>";
    }
  }
}
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold text-primary">User Creation Form</h5>
      <a href="index.php?page=users" class="btn btn-primary btn-sm">
        <i class="far fa-hand-point-left"></i> Back </a>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-2">
          <label for="name">Name <span class="text-danger">*</span></label>
          <input name="name" type="text" class="form-control">
          <span class="text-danger"><?php echo $nameErr ?></span>
        </div>

        <div class="mb-2">
          <label for="role">Role <span class="text-danger">*</span></label>
          <select name="role" id="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
          <span class="text-danger"><?php echo $roleErr ?></span>
        </div>

        <div class="mb-2">
          <label for="email">Email <span class="text-danger">*</span></label>
          <input name="email" type="text" class="form-control">
          <span class="text-danger"><?php echo $emailErr ?></span>
        </div>

        <div class="mb-2">
          <label for="password">Password <span class="text-danger">*</span></label>
          <input name="password" type="password" class="form-control">
          <span class="text-danger"><?php echo $passwordErr ?></span>
        </div>

        <button type="submit" class="btn btn-primary" name="submitBtn">Submit</button>
      </form>
    </div>
  </div>
</div>