<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../images/child.png" class="img-circle" alt="User Image">
        <br>
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">WELCOME LECTURE</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="courses2.php"><i class="fa fa-university"></i> <span>Courses</span></a></li>
      <li><a href="students.php"><i class="fa fa-users"></i> <span>Students</span></a></li>
      <li><a href="modules.php"><i class="fa fa-book"></i> <span>Modules</span></a></li>
      <li><a href="assignments.php"><i class="fa fa-bookmark"></i> <span>Assignments</span></a></li>
      <li><a href="view_reviews.php"><i class="fa fa-sticky-note"></i> <span>View Reviews</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>