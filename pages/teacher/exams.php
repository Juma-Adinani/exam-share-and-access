<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'teacher') {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

if (isset($_GET['id'])) {
    $sql = $con->query("DELETE FROM exams WHERE id = '" . $_GET['id'] . "'");
    if (!mysqli_error($con)) {
        header("location: exams.php");
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4>List of exams</h4>
                                    <a href="./upload_exams.php" class="btn btn-outline-primary btn-sm">Upload exam</a>
                                </div>
                                <hr>
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Exam description
                                                </th>
                                                <th>
                                                    Exam Document
                                                </th>
                                                <th>
                                                    Marking Scheme
                                                </th>
                                                <th>
                                                    Uploaded at
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = $con->query("SELECT * FROM exams WHERE uploaded_by = '" . $_SESSION['id'] . "'");
                                            $count = 0;
                                            if (mysqli_num_rows($sql) > 0) {
                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    $count++;
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?= $count ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['exam_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['exam_doc'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['marking_scheme'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['created_at'] ?>
                                                        </td>
                                                        <td>
                                                            <span><a href="./exams.php?id=<?php echo $row['id']; ?>" class="text-danger">delete</a></span>
                                                            &nbsp;
                                                            <!-- <span><a href="./update_exam.php?id=<?php echo $row['id']; ?>">edit</a></span> -->
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="text-danger">No exam that have been uploaded ...</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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