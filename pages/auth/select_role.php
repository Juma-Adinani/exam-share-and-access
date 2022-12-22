<!DOCTYPE html>
<html lang="en">

<?php
include '../../partials/use_head_tag.php';
include '../../config/db_connection.php';
session_start();
?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h2 class="card-title text-primary text-center">E<sup>share</sup></h2>
                            </div>
                            <h3>Register as..</h3>
                            <form action="" method="POST" class="pt-3 row">
                                <?php
                                if (isset($_POST['select'])) {
                                    if (empty($_POST['role'])) {
                                        echo "<div class='col-md-12'><h6 class='text-danger mb-4'>Please!, select an option..</h6></div>";
                                    } else {
                                        $_SESSION['role'] = mysqli_real_escape_string($con, $_POST['role']);
                                        header("Refresh:0, url=./register.php");
                                    }
                                }

                                $sql = "SELECT * FROM roles WHERE id != 1";
                                $query = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label" for=<?php echo $row['id']; ?>>
                                                    <input type="radio" class="form-check-input" name="role" id=<?php echo $row['id']; ?> value=<?php echo $row['id']; ?> />
                                                    <?php echo $row['name']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" name="select" class="btn btn-primary">Proceed</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="./login.php" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../../partials/use_scripts.php';
    ?>
</body>

</html>