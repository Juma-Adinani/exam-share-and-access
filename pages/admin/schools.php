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
        $sql = $con->query("DELETE FROM schools WHERE id = '" . $_GET['id'] . "'");
        if (!mysqli_error($con)) {
            header("location: schools.php");
        }
    } catch (Exception $e) {
?>
        <script>
            alert("This school cannot be deleted");
        </script>
<?php
        // die("<h4 class='text-danger card-title mx-2 my-4'>This school cannot be deleted</h4>
        // <a href='./schools.php' class='mx-2'>return home</a>");
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
                                    <h4>List of schools</h4>
                                    <a href="./add_schools.php" class="btn btn-outline-primary btn-sm">Add school</a>
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
                                                    Index no.
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
                                            $sql = $con->query("SELECT * FROM schools");
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
                                                            <?= $row['school_index'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['school_name'] ?>
                                                        </td>
                                                        <td>
                                                            <span><a href="./schools.php?id=<?php echo $row['id']; ?>" class="text-danger">delete</a></span>
                                                            &nbsp;
                                                            <span><a href="./update_school.php?id=<?php echo $row['id']; ?>">edit</a></span>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-danger">No school registered yet ...</td>
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