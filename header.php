<div class="header-section">
  <a class="toggle-btn"><i class="fa fa-bars"></i></a>
  <div class="menu-right">
    <ul class="notification-menu">
      <li>
        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <?php echo $_SESSION['username']; ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>