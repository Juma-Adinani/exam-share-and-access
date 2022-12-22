<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="http://localhost/examsharing/pages/auth/login.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php
    if ($_SESSION['role'] == 'teacher') {
    ?>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/teacher/exams.php`)">
        <a class="nav-link">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Exams</span>
        </a>
      </li>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/teacher/upload_exams.php`)">
        <a class="nav-link">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Upload exam</span>
        </a>
      </li>
    <?php
    }
    if ($_SESSION['role'] == 'admin') {
    ?>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/admin/users.php`)">
        <a class="nav-link">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/admin/schools.php`)">
        <a class="nav-link">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Schools</span>
        </a>
      </li>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/admin/add_schools.php`)">
        <a class="nav-link">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Add School</span>
        </a>
      </li>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/admin/subjects.php`)">
        <a class="nav-link">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Subjects</span>
        </a>
      </li>
      <li class="nav-item" onclick="navigate(`http://localhost/examsharing/pages/admin/add_subjects.php`)">
        <a class="nav-link">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Add Subject</span>
        </a>
      </li>
    <?php
    }
    ?>
    <!-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Charts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="icon-grid-2 menu-icon"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User Pages</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
        <i class="icon-trash menu-icon"></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Error pages</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/documentation/documentation.html">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li> -->
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