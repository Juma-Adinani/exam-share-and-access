<!DOCTYPE html>
<html lang="en">

<?php
include '../../partials/use_head_tag.php';
?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h2 class="card-title text-primary text-center">E<sup>share</sup></h2>
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few seconds</h6>
              <form class="pt-3" action="" method="POST">
                <?php
                session_start();

                include '../../config/db_connection.php';

                if (!isset($_SESSION['role'])) {
                  header("Location:login.php");
                }

                if (isset($_POST['register'])) {

                  $role_id = $_SESSION['role'];
                  $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
                  $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
                  $email = mysqli_real_escape_string($con, $_POST['email']);
                  $pass = mysqli_real_escape_string($con, $_POST['password']);
                  $password = sha1($pass);

                  $sql = "INSERT INTO users (firstname, lastname, email, role_id, password) VALUES ('$firstname', '$lastname', '$email', '$role_id', '$password')";
                  $query = mysqli_query($con, $sql);

                  if (!mysqli_error($con)) {
                    unset($_SESSION['role']);
                    header("Location:./login.php");
                  } else {
                    echo '<h6 class="text-danger">Failed to register, try again!</h6>';
                  }
                }

                ?>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="firstname" class="form-control form-control-lg" id="exampleInputUsername1" required placeholder="Firstname">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" name="lastname" class="form-control form-control-lg" id="exampleInputUsername1" required placeholder="Lastname">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" required placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" required placeholder="Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" required>
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include '../../partials/use_scripts.php';
  ?>
</body>

</html>