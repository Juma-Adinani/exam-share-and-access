<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'student') {
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
                    <?php
                    include '../../partials/welcome_note.php';
                    ?>
                    <div class="container">
                        <div class="container d-flex flex-column align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-center">
                                    <input type="text" class="form-control" id="input_search" onkeyup="searchSchool()" placeholder="Search for school..." />
                                </div>
                            </div>
                            <div class="my-2 col-md-6">
                                <hr />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 grid-margin transparent">
                                <div class="row" id="schools">
                                    <?php
                                    $sql = $con->query("SELECT * FROM schools");
                                    if (mysqli_num_rows($sql) > 0) {
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                    ?>
                                            <div class="col-md-4 mb-3">
                                                <a href="./view_classes.php?id=<?= $row['id']; ?>"> <u><?= $row['school_index'] . " " . $row['school_name'] ?></u>
                                                </a>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo '<div class="col-md-12 text-danger card-title">No schools available yet!</div>';
                                    } ?>
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
    <script>
        function searchSchool() {
            var input, filter, div_school, school, a, i, txtValue;
            input = document.getElementById("input_search");
            filter = input.value.toUpperCase();
            div_school = document.getElementById("schools");
            school = div_school.getElementsByTagName("div");
            for (i = 0; i < school.length; i++) {
                a = school[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    school[i].style.display = "";
                } else {
                    school[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>