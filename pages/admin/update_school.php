<!DOCTYPE html>
<html lang="en">
<?php

// $file = '../../assets/images/exams/01.pdf';
// header("Content-type: application/pdf");
// header("Content-Length: " . filesize($file));
// readfile($file);

session_start();
if (!isset($_SESSION['id']) || (isset($_SESSION['id']) && $_SESSION['role'] != 'admin')) {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

if (!isset($_GET['id'])) {
    header("location: ./schools.php");
}

$sql = $con->query("SELECT * FROM schools WHERE id = '" . $_GET['id'] . "'");

$row = mysqli_fetch_object($sql);

if (isset($_POST['save'])) {

    $index = mysqli_real_escape_string($con, $_POST['index']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $now = date("Y-m-d H:i:s");

    $sql = $con->query("UPDATE schools SET school_index = '$index', school_name = '$name', created_at = '$row->created_at', updated_at = '$now' WHERE id = '" . $_GET['id'] . "'");

    if (!mysqli_error($con)) {
        header("location:./schools.php");
    } else {
        die('<h4 class="text-danger">Failed to update, Try again!</h4>');
    }
}

?>

<body>
    <div class="container-scroller">
        <?php
        include '../../partials/navbar.php'
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php include '../../partials/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit school</h4>
                                    <form class="forms-sample" action="update_school.php?id=<?= $row->id; ?>" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Index number</label>
                                            <input type="text" name="index" class="form-control" id="exampleInputEmail1" required placeholder="Index no" value="<?= $row->school_index; ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">School name</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="name" required placeholder="Name" value="<?= $row->school_name; ?>" />
                                        </div>
                                        <div class="w-100 d-flex justify-content-end">
                                            <button type="submit" name="save" class="btn btn-primary mr-2">
                                                Save
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include '../../partials/footer.php' ?>
            </div>
        </div>
    </div>
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
    <?php include '../../partials/use_scripts.php'; ?>
</body>

</html>