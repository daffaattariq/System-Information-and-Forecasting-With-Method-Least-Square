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


          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                
                <div class="table-responsive p-3">
                <br>

                <form action="<?php echo base_url('admin/aksi_admin_penjualan/aksi_harian_penjualan') ?>" method="post">
                <label>Pilih Tanggal</label>
                <br>
                <?php
                if(!empty($tgl_pilih))
                {                    
                ?>
                    <input type="date" name="tgl_harian" value="<?php echo $tgl_pilih ?>">
                <?php
                }
                else
                {
                ?>
                    <input type="date" name="tgl_harian" value="<?php echo date("Y-m-d") ?>" >
                <?php
                }
                ?>
              
                <button type="submit" class="btn btn-primary">Submit</button>                
                </form>
                
                  <table class="table align-items-center table-flush table-hover" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Number</th>                                                
                        <th>Tgl Loading</th>                                                                                        
                        <th>Sales</th> 
                        <th>Customer</th> 
                        <th>Varian</th> 
                        <th>Produk</th> 
                        <th>Jumlah Pesanan</th>                         
                        <th>Total</th>                                           
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                        $number = 0;

                        foreach($data as $data_detail_loading)
                        {
                          $number++;                        
                      ?>
                        <tr>
                            <td><?php echo $number ?></td>                                                        
                            <td><?php echo $data_detail_loading['tgl_loading'] ?></td>  
                            <td><?php echo $data_detail_loading['nama_sales'] ?></td>                                                        
                            <td><?php echo $data_detail_loading['customer'] ?></td>
                            <td><?php echo $data_detail_loading['jenis_varian'] ?></td>
                            <td><?php echo $data_detail_loading['nama_produk'] ?></td>                            
                            <td align="center"><?php echo $data_detail_loading['jumlah_pesanan'] ?></td>
                            <td><?php echo $data_detail_loading['total'] ?></td>    
                           
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
        <!---Container Fluid-->
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
    
    </body>

  <script src="<?php echo base_url();?>assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="<?php echo base_url();?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>