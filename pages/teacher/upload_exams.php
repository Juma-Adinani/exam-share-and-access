<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['id']) || (isset($_SESSION['id']) && $_SESSION['role'] != 'teacher')) {
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
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Upload exam</h4>
                                    <?php
                                    if (isset($_FILES['exam']) && isset($_FILES['scheme'])) {
                                        $path_exam = "../../assets/images/exams/";
                                        $path_scheme = "../../assets/images/schemes/";
                                        $exam_file = basename($_FILES['exam']['name']);
                                        $scheme_file = basename($_FILES['scheme']['name']);
                                        $filepath_exam = $path_exam . $exam_file;
                                        $filepath_scheme = $path_scheme . $scheme_file;
                                        $filetype_exam = pathinfo($filepath_exam, PATHINFO_EXTENSION);
                                        $filetype_scheme = pathinfo($filepath_scheme, PATHINFO_EXTENSION);
                                        $name = mysqli_real_escape_string($con, $_POST['description']);
                                        $subject = mysqli_real_escape_string($con, $_POST['subject']);

                                        if (isset($_POST['upload'])) {
                                            $format = array('pdf');
                                            if (in_array($filetype_exam, $format) && in_array($filetype_scheme, $format)) {
                                                $exam_tempname = $_FILES['exam']['tmp_name'];
                                                $scheme_tempname = $_FILES['scheme']['tmp_name'];
                                                //inserting data into a database
                                                if (move_uploaded_file($exam_tempname, $filepath_exam) && move_uploaded_file($scheme_tempname, $filepath_scheme)) {
                                                    $sql = "INSERT INTO exams (exam_name, exam_doc, marking_scheme, subject_id, uploaded_by)
                                                     VALUES ('$name','$exam_file','$scheme_file', '$subject','" . $_SESSION['id'] . "')";
                                                    $result = mysqli_query($con, $sql);
                                                    if (!mysqli_error($con)) {
                                                        echo "<div class='card-title text-success'>Exam Uploaded Successfully!</div>";
                                                    } else {
                                                        echo "<div class='alert alert-danger'><strong class='card-title'>Failed to Upload a File!</strong></div>";
                                                    }
                                                } else {
                                                    echo "<div class='alert alert-danger'><strong class='card-title'>Error Occured on uploading!</strong></div>";
                                                }
                                            } else {
                                                echo "<div class='text-danger card-title'>Only pdf files are allowed, Try again!</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-warning'><strong class='card-title'>Select a file to upload!</strong></div>";
                                        }
                                    }
                                    ?> <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleTextarea1">Description</label>
                                            <textarea class="form-control" required id="exampleTextarea1" rows="4" name="description"></textarea>
                                        </div>
                                        <label for="subject">Subject</label>
                                        <div class="form-group row d-flex justify-content-center align-items-center">
                                            <select required id="subject" class="js-example-basic-single col-md-11 col-sm-11 col-lg-11" name="subject">
                                                <option value="">choose a subject...</option>
                                                <?php

                                                $sql = $con->query("SELECT * FROM subjects");

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <option value="<?= $row['id'] ?>"><?= $row['subject_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exam">Exam upload</label>
                                            <input type="file" id="exam" name="exam" class="file-upload-default" required />
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload exam" />
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">
                                                        Choose doc
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="scheme">Marking scheme (optional)</label>
                                            <input type="file" id="scheme" name="scheme" class="file-upload-default" required />
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload marking scheme" />
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">
                                                        Choose doc
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" name="upload" class="btn btn-primary mr-2">
                                            Upload
                                        </button>
                                    </form>
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