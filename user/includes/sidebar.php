 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="company/blushlogo.png" alt="Beauty salon" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Blush Spa & Aesthetic</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php
      $eid=$_SESSION['sid'];
      $sql="SELECT * from tblusers   where id=:eid ";                                    
      $query = $dbh -> prepare($sql);
      $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);

      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $row)
        {    
          ?>
          <div class="image">
            <img class="img-circle"
            src="staff_images/<?php echo htmlentities($row->userimage);?>" width="90px" height="90px" class="user-image"
            alt="User profile picture">
          </div>
          <div class="info">
            <a href="profile.php" class="d-block"><?php echo ($row->name); ?> <?php echo ($row->lastname); ?></a>
          </div>
          <?php 
        }
      } ?>

    </div>

    <?php 
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI,PHP_URL_PATH);
    $components =explode('/',$path);
    $page = $components[2];
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="dashboard.php" class="<?php if($page == "dashboard.php"){echo "nav-link active";}else{echo "nav-link active";}?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>






        <li class="nav-item has-treeview">
          <a href="dashboard2.php" class="<?php if($page == "dashboard2.php"){echo "nav-link active";}else{echo "nav-link";}?>">
            <i class="fa fa-desktop"></i>
            <p>
              Monitor
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-cut"></i>
            <p>
              Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_service.php" class="<?php if($page == "add_service.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage_service.php" class="<?php if($page == "manage_service.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Services</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Beauticians
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add_beautician.php" class="<?php if($page == "add_beautician.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Beautician</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manage_beauticians.php" class="<?php if($page == "manage_beautician.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Beauticians</p>
              </a>
            </li>
          </ul>
        </li>








        





       <!-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Manage Customers
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           <li class="nav-item">
            <a href="add_customer.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Add Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer_list.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Customer list
              </p>
            </a>
          </li>
        </ul>
      </li>-->



       <li class="nav-item has-treeview">
          <a href="#" class="<?php if($page == "#.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
            <i class="nav-icon fas fa-user-edit"></i>
            <p>
              Client
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           <li class="nav-item">
            <a href="add_customer.php" class="<?php if($page == "add_customer.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Add Client
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer_list.php" class="<?php if($page == "customer_list.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="nav-icon far fa-image"></i>
              <p>
                Client list
              </p>
            </a>
          </li>
        </ul>
      </li> 
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon 	fas fa-calendar-alt"></i>
          <p>
            Appointments
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="all_appointments.php" class="<?php if($page == "all_appointments.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>All Appointments</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="new_appointment.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>New Appointments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="accepted_appointment.php" class="<?php if($page == "accepted_appointment.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Accepted Appointments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="rejected_appointment.php" class="<?php if($page == "rejected_appointment.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Rejected Appointments</p>
            </a>
          </li>


        </ul>
      </li>




      <li class="nav-item has-treeview">
        <a href="billing.php" class="nav-link">
        <i class="nav-icon fas fa-file-invoice-dollar"style='font-size:18px;color:white'></i>  
          <p>
            Billing
            <i class="fas fa-angle-left right"></i>
          </p>
        </a> 
      </li>









      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
          <p>
            Invoice
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="allinvoice.php" class="<?php if($page == "allinvoice.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>All Invoice</p>
              </a>
            </li>
          <!-- <li class="nav-item">
            <a href="invoices.php" class="<?php if($page == "invoices.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Invoice from walkin client</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="invoicesfromonline.php" class="<?php if($page == "invoicesfromonline.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Invoice from online client</p>
            </a>
          </li> -->
        </ul>
      </li>


      <!-- <li class="nav-item has-treeview">
        <a target="_blank" href="report/report.php" class="<?php if($page == "report.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
          <i class="nav-icon far fa-money-bill-alt"></i>
          <p>
            Sales Report
          </p>
        </a>
      </li>  -->
 
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon 	fas fa-search"></i>
          <p>
            Search
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
      <li class="nav-item has-treeview">
        <a href="search_appointment.php" class="<?php if($page == "search_appointment.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
          <i class="far fa-circle nav-icon"></i>
          <p>
            Search Appointments
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="search_invoice.php" class="<?php if($page == "search_invoice.php"){echo "nav-link active";}else{echo "nav-link";} ?>">
          <i class="far fa-circle nav-icon"></i>
          <p>
            Search Invoice
          </p>
        </a>
        </ul>
      </li>
     
      <li class="nav-header">USER MANAGEMENT</li>
      <!-- User Menu -->
      <li class="nav-item">
        <a href="userregister.php" class="nav-link ">
         <i class="far fa-user nav-icon"></i>
         <p>
          Register User
        </p>
      </a>
    </li><!-- /.user menu -->
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
