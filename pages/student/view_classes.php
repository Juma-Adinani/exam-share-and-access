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
    header("location: ./");
}

$_SESSION['school_id'] = mysqli_real_escape_string($con, $_GET['id']);
$school = mysqli_fetch_object($con->query("SELECT school_name as name FROM schools WHERE id = '" . $_SESSION['school_id'] . "'"))->name

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
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0 font-weight-bold lead">
                                    <?= $school ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                <?php
                                $sql = $con->query("SELECT * FROM classes");
                                while ($fetch_class = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <div class="col-md-2 col-lg-1">
                                        <a href="./view_exams.php?id=<?= $fetch_class['id'] ?>"> <u><?= $fetch_class['class_name']; ?></u>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
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