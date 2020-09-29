<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/default.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">WELCOME STUDENT</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>
      <li><a href="assignments.php"><i class="fa fa-barcode"></i> <span>Upload Assignment</span></a></li>
      <li><a href="send_review.php"><i class="fa fa-reply"></i> <span>Send Review</span></a></li>
      <li><a href="users_delete.php" onclick="return confirm('Are you sure you wish to delete this account?')"><i class="fa fa-users"></i> <span>DELETE ACCOUNT</span></a></li>
   
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>