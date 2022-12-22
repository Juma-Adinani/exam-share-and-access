<!DOCTYPE html>
<html lang="en">

<?php
include '../../config/db_connection.php';
session_start();

if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("location: ../admin/");
    }
    if ($_SESSION['role'] == 'teacher') {
        header("location: ../teacher/");
    }
    if ($_SESSION['role'] == 'student') {
        header("location: ../student/");
    }
}

include '../../partials/use_head_tag.php';
?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h2 class="card-title text-primary text-center">E<sup>share</sup></h2>
                            </div>
                            <h4>let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" action="" method="POST">
                                <?php
                                if (isset($_POST['login'])) {
                                    $email = mysqli_real_escape_string($con, $_POST['email']);
                                    $pass = mysqli_real_escape_string($con, $_POST['password']);
                                    $password = sha1($pass);

                                    $sql = $con->query("SELECT users.id, name, firstname, lastname, role_id FROM users, roles WHERE email = '$email' AND password = '$password' AND users.role_id = roles.id");

                                    if (!mysqli_error($con)) {
                                        $dataExist = mysqli_num_rows($sql);
                                        if ($dataExist == 1) {
                                            $row = mysqli_fetch_assoc($sql);
                                            $_SESSION['id'] = $row['id'];
                                            $_SESSION['role'] = $row['name'];
                                            $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
                                            if ($row['role_id'] == 1) {
                                                header("location: ../admin/");
                                            }

                                            if ($row['role_id'] == 2) {
                                                header("location: ../teacher/");
                                            }

                                            if ($row['role_id'] == 3) {
                                                header("location: ../student/");
                                            }
                                        } else {
                                            echo '<h5 class="text-danger card-title">Invalid credentials, try again!</h5>';
                                        }
                                    } else {
                                        echo 'There is an error => ' . mysqli_error($con);
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" required placeholder="Email" name="email" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" required placeholder="Password" name="password" />
                                </div>
                                <div class="mt-3">
                                    <button name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account?
                                    <a href="./select_role.php" class="text-primary">Create</a>
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