<?php
// ? get users
$statement = $connect->prepare("SELECT * FROM users");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_OBJ);
// print_r($users);

// ? delete user
if (isset($_POST["deleteBtn"])) {
  $id = $_POST['id'];
  $statement = $connect->prepare("DELETE FROM users WHERE id=$id");
  $statement->execute();
  echo "<script>location.href='index.php?page=users'</script>";
}
?>
<div class="container-fluid">
  <div class="card shadow mb-4 ">
    <div class="card-header py-3 d-flex justify-content-between align-items-center ">
      <h5 class="m-0 font-weight-bold text-primary">User List</h5>
      <a href="index.php?page=user-create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Add New
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Role</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php
            foreach ($users as $index => $user) :
            ?>
              <tr>
                <td><?php echo $index + 1 ?></td>
                <td><?php echo $user->name ?></td>
                <td><?php echo $user->role ?></td>
                <td><?php echo $user->email ?></td>
                <td>
                  <form method="post">
                    <a href="index.php?page=user-update&id=<?php echo $user->id ?>" class="btn btn-outline-info btn-sm" style="padding: 7px 6px 4px 8px;">
                      <i class="far fa-edit" style="font-size: 18px;"></i>
                    </a>
                    <input name="id" type="text" value="<?php echo $user->id ?>" hidden>
                    <button name="deleteBtn" type="submit" class="btn btn-outline-danger btn-sm" style="padding: 7px 9px 4px 9px;" onclick="return confirm('Are you sure to delete - <?php echo $user->name; ?> ')">
                      <i class="far fa-trash-alt" style="font-size: 18px;"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>