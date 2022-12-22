<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || (isset($_SESSION['id']) && $_SESSION['id'] != 1)) {
    header("location: ../auth/login.php");
}

include '../../config/db_connection.php';
include '../../partials/use_head_tag.php';

if (isset($_GET['id'])) {
    try {
        $sql = $con->query("DELETE FROM subjects WHERE id = '" . $_GET['id'] . "'");
        if (!mysqli_error($con)) {
            header("location: subjects.php");
        }
    } catch (Exception $e) {
?>
        <script>
            alert("This subject cannot be deleted");
        </script>
<?php
        // die("<h4 class='text-danger card-title mx-2 my-4'>This subject cannot be deleted</h4>
        // <a href='./subjects.php' class='mx-2'>return home</a>");
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
                                    <h4>List of subjects</h4>
                                    <a href="./add_subjects.php" class="btn btn-outline-primary btn-sm">Add subject</a>
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
                                                    Name
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = $con->query("SELECT * FROM subjects");
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
                                                            <?= $row['subject_name'] ?>
                                                        </td>
                                                        <td>
                                                            <span><a href="./subjects.php?id=<?php echo $row['id']; ?>" class="text-danger">delete</a></span>
                                                            &nbsp;
                                                            <span><a href="./update_subject.php?id=<?php echo $row['id']; ?>">edit</a></span>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-danger card-title">No subject Available ...</td>
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