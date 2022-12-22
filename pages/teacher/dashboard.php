<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'teacher') {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

$sql = $con->query("SELECT count(*) as count FROM exams WHERE uploaded_by = '" . $_SESSION['id'] . "'");
$exam_count = mysqli_fetch_assoc($sql)['count'];

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
                    <?php
                    include '../../partials/welcome_note.php';
                    ?>
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <a href="./exams.php" class="text-white">
                                            <div class="card-body">
                                                <p class="mb-4 h2">Exams</p>
                                                <p class="fs-30 mb-2"><?= $exam_count; ?></p>
                                            </div>
                                        </a>
                                    </div>
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