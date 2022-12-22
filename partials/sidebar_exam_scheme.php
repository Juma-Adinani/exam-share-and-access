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
        if (isset($_GET['id']) && !empty($_GET['exam'])) {
        ?>
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Exam</span>
                </a>
            </li>
            <li class="nav-item" onclick="navigate(`./marking_scheme.php?id=<?= $exam_id; ?>`)">
                <a class="nav-link">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">View marking scheme</span>
                </a>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Marking scheme</span>
                </a>
            </li>
            <li class="nav-item" onclick="navigate(`./exam_details.php?id=<?= $exam_id; ?>&&exam=<?= $exam; ?>`)">
                <a class="nav-link">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">View it's exam</span>
                </a>
            </li>
        <?php
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

    .active {
        cursor: text
    }
</style>