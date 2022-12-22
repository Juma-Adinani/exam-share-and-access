<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || (isset($_SESSION['id']) && $_SESSION['id'] != 1)) {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';
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
                                    <h4 class="card-title">Register school</h4>
                                    <?php
                                    if (isset($_POST['save'])) {
                                        $index = mysqli_real_escape_string($con, $_POST['index']);
                                        $name = mysqli_real_escape_string($con, $_POST['name']);

                                        try {
                                            $sql = $con->query("INSERT INTO schools (school_index, school_name) VALUES ('$index', '$name')");

                                            if (!mysqli_error($con)) {
                                                echo '<h4 class="text-success">School saved successfully!</h4>';
                                            } else {
                                                echo '<h4 class="text-danger">Failed to save, Try again!</h4>';
                                            }
                                        } catch (Exception $e) {
                                            echo '<h5 class="card-title text-danger">This school has already added!</h5>';
                                        }
                                    }
                                    ?>
                                    <form class="forms-sample" action="" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Index number</label>
                                            <input type="text" name="index" class="form-control" id="exampleInputEmail1" required placeholder="Index no (e.g S3278)" />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">School name</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="name" required placeholder="Name" />
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