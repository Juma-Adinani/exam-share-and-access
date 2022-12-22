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
    header("location: ./view_classes.php?id=" . $_SESSION['school_id']);
}

$_SESSION['class_id'] = mysqli_real_escape_string($con, $_GET['id']);

$school = $_SESSION['school_id'];
$class = $_SESSION['class_id'];

$sql2 = $con->query("SELECT class_name as name FROM classes WHERE id = '$class'");
$row2 = mysqli_fetch_assoc($sql2)['name'];

$sql3 = $con->query("SELECT school_name as name FROM schools WHERE id = '$school'");
$row3 = mysqli_fetch_assoc($sql3)['name'];

function getSubject()
{
    include '../../config/db_connection.php';
    if (isset($_GET['subj_id'])) {
        $sql = $con->query("SELECT subject_name as subject FROM subjects WHERE id = '" . $_GET['subj_id'] . "'");
        $subject = mysqli_fetch_assoc($sql)['subject'];
        return $subject;
    } else {
        return 'All';
    }
}

?>

<body>
    <div class="container-scroller">
        <?php
        include '../../partials/navbar.php'
        ?>
        <div class="container-fluid page-body-wrapper">
            <?php include '../../partials/sidebar_subjects.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold"><?= $row2; ?>&nbsp;exams <sup class="font-weight-light" style="font-size: 14px;">(<?= getSubject() ?>)</sup></h3><?= $row3 ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row m-4">
                                <?php
                                $sql = $con->query("SELECT user_id FROM teachers WHERE school_id = '$school' AND class_id = '$class'");

                                if (mysqli_num_rows($sql) > 0) {
                                    $user_id = mysqli_fetch_assoc($sql)['user_id'];
                                    if (isset($_GET['subj_id'])) {
                                        $sql = $con->query("SELECT * FROM exams WHERE uploaded_by = '$user_id' AND subject_id = '" . $_GET['subj_id'] . "'");
                                        if (mysqli_num_rows($sql) <= 0) {
                                            echo '<p class="text-danger lead">No exam available for this subject</p>';
                                        }
                                    } else {
                                        $sql = $con->query("SELECT * FROM exams WHERE uploaded_by = '$user_id'");
                                        if (mysqli_num_rows($sql) <= 0) {
                                            echo '<p class="text-danger lead">Exams are not yet uploaded</p>';
                                        }
                                    }
                                } else {
                                    echo '<p class="text-danger lead">Exams are not yet uploaded</p>';
                                }
                                while ($exams = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <a class="col-md-4 my-3" href="./exam_details.php?id=<?= $exams['id']; ?>&&exam=<?= $exams['exam_doc']; ?>">
                                        <div class="card">
                                            <div class="card-body">
                                                <iframe style="min-height: 10vh;" src="../../assets/images/exams/<?= $exams['exam_doc']; ?>" frameborder="0" height=100 width="100%"></iframe>
                                            </div>
                                            <div class="card-title mx-3 p">
                                                <?= $exams['exam_name']; ?>
                                            </div>
                                        </div>
                                    </a>
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

        .exam {
            width: 100%;
        }

        .p {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 500px;
        }
    </style>
    <?php include '../../partials/use_scripts.php'; ?>
</body>

</html>