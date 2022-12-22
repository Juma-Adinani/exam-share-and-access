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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4>System users</h4>
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
                                                    Fullname
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Role
                                                </th>
                                                <th>
                                                    Registered at
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = $con->query("SELECT concat(firstname,' ',' ',lastname) as name, name as role, registered_at, email FROM users, roles WHERE users.role_id = roles.id ORDER BY registered_at ASC");
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
                                                            <?= $row['name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['email'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['role'] ?>
                                                        </td>
                                                        <td><?= $row['registered_at'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-danger">No Available users ...</td>
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