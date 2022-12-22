<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'teacher') {
    header("location: ../auth/login.php");
}
include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

$sql = $con->query("SELECT user_id FROM teachers");
if (mysqli_num_rows($sql) > 0) {
    while ($userId = mysqli_fetch_assoc($sql)) {
        if (in_array($_SESSION['id'], $userId)) {
            header("location: ./dashboard.php");
        }
    }
}

if (isset($_POST['save'])) {
    $school = mysqli_real_escape_string($con, $_POST['school']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $id = $_SESSION['id'];

    $sql = $con->query("INSERT INTO teachers (user_id, school_id, class_id) VALUES ('$id','$school', '$class')");

    if (!mysqli_error($con)) {
        header("location: ./dashboard.php");
    } else {
        die("There is arror => " . mysqli_error($con));
    }
}

?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../assets/images/logo.svg" alt="logo" />
                            </div>
                            <form class="pt-3" action="" method="POST">
                                <h4 class="card-title">School</h4>
                                <div class="form-group row">
                                    <select required class="js-example-basic-single col-md-12 col-sm-12 col-lg-12" name="school">
                                        <option value="">choose a school...</option>
                                        <?php

                                        $sql = $con->query("SELECT * FROM schools");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['school_name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <h4 class="card-title">Class</h4>
                                <div class="form-group row">
                                    <select required class="js-example-basic-single col-md-12 col-sm-12 col-lg-12" name="class">
                                        <option value="">choose a class...</option>
                                        <?php

                                        $sql = $con->query("SELECT * FROM classes");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['class_name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                                    <button name="save" class="btn btn-primary btn-sm font-weight-medium auth-form-btn">SAVE</button>
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