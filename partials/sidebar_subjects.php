<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/examsharing/pages/auth/login.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
            <hr />
        </li>
        <?php
        $sql0 = $con->query("SELECT user_id FROM teachers WHERE school_id = '$school' AND class_id = '$class'");
        if (mysqli_num_rows($sql0) > 0) {

            $user_id = mysqli_fetch_assoc($sql0)['user_id'];

            $sql = $con->query("SELECT * FROM exams WHERE uploaded_by = '$user_id'");

            if (mysqli_num_rows($sql) > 0) {
        ?>
                <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/student/view_exams.php?id=<?= $class; ?>`)">
                    <a class="nav-link">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">All subjects</span>
                    </a>
                </li>
                <?php
                $sql = $con->query("SELECT * FROM subjects");
                if (mysqli_num_rows($sql) > 0) {
                    while ($subject = mysqli_fetch_object($sql)) {
                ?>
                        <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/student/view_exams.php?id=<?= $class; ?>&&subj_id=<?= $subject->id; ?>`)">
                            <a class="nav-link">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title"><?= $subject->subject_name; ?></span>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
        <?php
            }
        }
        ?>
    </ul>
</nav>
<script type="text/javascript">
    function navigate(url) {
        window.location.href = url;
    }
</script>
<style>
    .nav-item {
        cursor: pointer;
    }
</style>