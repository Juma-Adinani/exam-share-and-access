<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'student') {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

if (!isset($_GET['id'])) {
    header("location: ./view_exams.php?id=" . $_SESSION['class_id']);
}

$exam_id = mysqli_real_escape_string($con, $_GET['id']);
$sql = $con->query("SELECT marking_scheme FROM exams WHERE id = '$exam_id'");
$exam = mysqli_fetch_object($sql)->marking_scheme;

?>

<body>
    <div class="container-scroller">
        <?php
        include '../../partials/navbar.php'
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php include '../../partials/sidebar_exam_scheme.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-12 grid-margin transparent">
                                    <iframe style="min-height: 50vh;" src="../../assets/images/exams/<?= $exam; ?>" frameborder="0" height=600 width="100%"></iframe>
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