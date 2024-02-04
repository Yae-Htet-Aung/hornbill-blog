<?php
// ? get current value
$id = $_REQUEST['id'];
$statement = $connect->prepare("SELECT * FROM users WHERE id=$id");
$statement->execute();
$user = $statement->fetchObject();

// ? update user
$nameErr = "";
$roleErr = "";
$emailErr = "";
$passwordErr = "";

if (isset($_POST["submitBtn"])) {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $newPassword = $_POST['newPassword'];

  if ($name === '') {
    $nameErr = 'Name field must be filled!';
  } else if ($role === '') {
    $nameErr = 'Role field must be filled!';
  } else if ($email === '') {
    $emailErr = 'Email field must be filled!';
  } else if ($email === '') {
    $password = 'Password field must be filled!';
  } else {
    if ($newPassword !== $password) {
      $password = md5($newPassword);
    }
    $statement = $connect->prepare("UPDATE users SET name='$name', email='$email', password= '$password', role='$role' WHERE id=$id");
    $statement->execute();
    if ($statement) {
      echo "<script>location.href='index.php?page=users'</script>";
    }
  }
}
?>
<style>
  .newPsswdLabel,
  .newPsswd {
    display: none;
  }

  .newPsswdLabel.active,
  .newPsswd.active {
    display: block;
  }
</style>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h5 class="m-0 font-weight-bold text-primary">User Update Form</h5>
      <a href="index.php?page=users" class="btn btn-primary btn-sm">
        <i class="far fa-hand-point-left"></i> Back </a>
    </div>
    <div class="card-body">
      <form method="post">
        <div class="mb-2">
          <label for="name">Name <span class="text-danger">*</span></label>
          <input value="<?php echo $user->name ?>" name="name" type="text" class="form-control">
          <span class="text-danger"><?php echo $nameErr ?></span>
        </div>

        <div class="mb-2">
          <label for="role">Role <span class="text-danger">*</span></label>
          <select name="role" id="role" class="form-control">
            <option value="admin" <?php if ($user->role == 'admin') : ?> selected <?php endif ?>>Admin</option>
            <option value="user" <?php if ($user->role == 'user') : ?> selected <?php endif ?>>User</option>
          </select>
          <span class="text-danger"><?php echo $roleErr ?></span>
        </div>

        <div class="mb-2">
          <label for="email">Email <span class="text-danger">*</span></label>
          <input value="<?php echo $user->email ?>" name="email" type="text" class="form-control">
          <span class="text-danger"><?php echo $emailErr ?></span>
        </div>

        <div class="mb-2">
          <?php if ($user->password) : ?>
            <div class="my-3">
              <button onclick="changePsswdBtn()" id="psswdBtn" type="button" class="btn btn-outline-info btn-sm ">Change Password</button>
              <div class="my-3">
                <label class="newPsswdLabel" id="newPsswdLabel" for="password">New Password <span class="text-danger">*</span></label>
                <input class="newPsswd form-control" id="newPsswd" name="newPassword" type="password" class="form-control">
              </div>
            </div>

          <?php else : ?>
            <label for="password">Password <span class="text-danger">*</span></label>
            <input value="<?php echo $user->password ?>" name="password" type="password" class="form-control">
            <span class="text-danger"><?php echo $passwordErr ?></span>
          <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary btn-sm" name="submitBtn">Submit</button>
      </form>
    </div>
  </div>
</div>

<script>
  const changePsswdBtn = () => {
    let btn = document.getElementById('psswdBtn')
    let label = document.getElementById('newPsswdLabel')
    let password = document.getElementById('newPsswd')

    if (btn.innerHTML == 'Change Password') {
      btn.innerHTML = 'Cancel'
    } else {
      btn.innerHTML = 'Change Password'
    }
    label.classList.toggle('active')
    password.classList.toggle('active')
  }
</script>