<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url();?>assets/admin/img/logo/logosisi.png" rel="icon">
  <title>Administrator</title>
  <link href="<?php echo base_url();?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/css/ruang-admin.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
           
            <h1 class="h3 mb-0 text-gray-800">DataTables Penjualan  </h1>            
           
            <ol class="breadcrumb">            
                      
          </div>
          
          
          <br>
          <?php
            if($this->session->userdata('id_wilayah_distributor') != 5)
            {
          ?>
            <a href = "<?php echo base_url('admin/aksi_admin_penjualan') ?>"><button type="button" class="btn btn-secondary">Harian</button></a>
            <a href = "<?php echo base_url('admin/aksi_admin_penjualan/tampil_bulanan_penjualan') ?>"><button type="button" class="btn btn-secondary">Bulanan</button></a>
          <?php
            } 
            else
            {
          ?>
            <a href = "<?php echo base_url('admin/aksi_admin_penjualan')?>?id_wilayah_distributor=<?php echo $id_wilayah_distributor ?>"><button type="button" class="btn btn-secondary">Harian</button></a>
            <a href = "<?php echo base_url('admin/aksi_admin_penjualan/tampil_bulanan_penjualan')?>?id_wilayah_distributor=<?php echo $id_wilayah_distributor?>"><button type="button" class="btn btn-secondary">Bulanan</button></a>
          <?php    
            }
          ?>

         
    
    </body>

  <script src="<?php echo base_url();?>assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="<?php echo base_url();?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>



</body>

</html>