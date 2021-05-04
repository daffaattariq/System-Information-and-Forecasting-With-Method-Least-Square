<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url();?>assets/admin/img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="<?php echo base_url();?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/admin')?>">
        <div class="sidebar-brand-icon">
          <img src="<?php echo base_url();?>assets/admin/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin/aksi_admin')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>

      
            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Stock</span>
              </a>
              <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  
                  <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_varian/tampil_data_stock') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Input Stock</a>
                  <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_varian/tampil_recent_delete_data_stock_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Delete Stock</a>
                  <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_varian/tampil_data_stock_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Log Stock</a>
                  
                </div>
              </div>
            </li>

            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Loading</span>
              </a>
              <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_loading') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Input Data Loading</a>
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_loading/tampil_recent_delete_data_loading_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Delete Loading</a>
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_loading/tampil_data_loading_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Log Loading</a>

                </div>
              </div>
            </li>

            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Sales</span>
              </a>
              <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_sales') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Input Data Sales</a>
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_sales/tampil_recent_delete_data_sales_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Delete Sales</a>
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_sales/tampil_data_sales_log') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" >Recently Log Sales</a>

                </div>
              </div>
            </li>     

            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Penjualan</span>
              </a>
              <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_penjualan') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" > Data Penjualan</a>                
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_penjualan/tampil_penjualan_varian') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" > Data Penjualan Varian</a>                

                </div>
              </div>
            </li>     

            <li class="nav-item active">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Peramalan</span>
              </a>
              <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  
                <a class="collapse-item" href="<?php echo base_url('admin/aksi_admin_peramalan') ?>?id_wilayah_distributor=<?php echo $this->session->userdata('id_wilayah_distributor') ?>" > Data Peramalan</a>                

                </div>
              </div>
            </li>     
            
     
      
 
     </ul>
    <!-- Sidebar -->

    <script src="<?php echo base_url();?>assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/ruang-admin.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/demo/chart-area-demo.js"></script>  
</body>