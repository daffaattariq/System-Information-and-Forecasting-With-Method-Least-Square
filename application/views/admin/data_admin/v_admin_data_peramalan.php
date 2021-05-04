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
           
            <h1 class="h3 mb-0 text-gray-800">DataTables Peramalan </h1>            
           
            <ol class="breadcrumb">            
                      
          </div>                
         
    
    </body>


          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                
                <div class="table-responsive p-3">
                <br>

                <form action="<?php echo base_url('admin/aksi_admin_peramalan/tampil_peramalan') ?>" method="post">
                
                <div class="form-group">
                      <label for="exampleFormControlSelect1">Select Varian</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="list_id_varian">
                        <?php
  
                          foreach($varian as $data_varian)
                          {
                        ?>

                          <option value ="<?php echo $data_varian['id_varian'] ?>"><?php echo $data_varian['jenis_varian'] ?></option>

                        <?php
                          }
                        ?>               
                      </select>
                    </div>  

                <br>
                <div class="form-group">
                      <label for="exampleFormControlSelect1">Choose Bulan</label>
                       <select class="form-control" id="exampleFormControlSelect1" name="list_bulan">  
                       
                       <?php
                          if(!empty($list_bulan))
                          {
                       ?>
                          <option selected="selected" value="<?php echo $list_bulan ?>"><?php echo $nama_bulan ?></option>                              
                       <?php    
                          }
                       ?>                               
                        
                        <?php 
                          foreach($bulan as $bulan => $value)
                          {
                              if($bulan != $nama_bulan) 
                              {
                        ?>
                                  <option value="<?php echo $value ?>"><?php echo $bulan ?></option>
                        <?php
                              }
                          }
                        ?>
                       </select>
                </div>  

                <div class="form-group">
                      <label for="exampleFormControlSelect1">Choose Tahun</label>
                       <select class="form-control" id="exampleFormControlSelect1" name="list_tahun">                        
                            <?php
                                if(!empty($list_tahun))
                                {
                            ?>
                                <option selected="selected" value="<?php echo $list_tahun ?>"><?php echo $list_tahun ?></option>                              
                            <?php    
                                }
                            ?>                                    
                           <option value="2018">2018</option>
                           <option value="2019">2019</option>
                           <option value="2020">2020</option>
                           <option value="2021">2021</option>
                       </select>
                </div>                
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>   
                <br>             
                </form>
                
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Number</th>                                                
                        <th>Month</th>                                                                                        
                        <th>Year</th> 
                        <th>Penjualan(y)</th> 
                        <th>x</th> 
                        <th>x2</th> 
                        <th>x4</th>                         
                        <th>x.y</th>                                           
                        <th>x2.y</th>       
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                        $number = 0;
                        $total_nilai_y = 0;
                        $total_nilai_x2 = 0;
                        $total_nilai_x4 = 0;
                        $total_nilai_xy = 0;
                        $total_nilai_x2y = 0;

                        $count_jumlah_data = count($nilai_x);
                        
                        foreach($data_peramalan as $data_peramalan)
                        {
                          $number++;                        
                      ?>
                        <tr>
                            <td><?php echo $number ?></td>                                                        
                            <td><?php echo $data_peramalan['month'] ?></td>                              
                            <td><?php echo $data_peramalan['year'] ?></td>  
                            <td><?php echo $data_peramalan['total'] ?></td> 

                            <?php
                              if($count_jumlah_data > 6)
                              {
                            ?>
                              <!-- nilai x -->
                              <td><?php echo $nilai_x[$number-1] ?></td>  
                              <!-- nilai x2 -->
                              <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1] ?></td> 
                              <!-- nilai x4 -->
                              <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1] ?></td> 
                              <!-- nilai x.y -->
                              <td><?php echo $nilai_x[$number-1]*$data_peramalan['total'] ?></td>  
                              <!-- nilai x2.y -->
                              <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1]*$data_peramalan['total'] ?></td> 
                            <?php
                              }
                            ?>
                        </tr>
                      <?php
                          if($count_jumlah_data > 6)
                          {
                            $total_nilai_y = $total_nilai_y + $data_peramalan['total'];
                            $total_nilai_x2 = $total_nilai_x2 + $nilai_x[$number-1]*$nilai_x[$number-1];
                            $total_nilai_x4 = $total_nilai_x4 + $nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1];
                            $total_nilai_xy = $total_nilai_xy + $nilai_x[$number-1]*$data_peramalan['total'];
                            $total_nilai_x2y = $total_nilai_x2y + $nilai_x[$number-1]*$nilai_x[$number-1]*$data_peramalan['total'];
                            $total_8 = $data_peramalan['total'];
                          }
                        }//tutup foreach

                        if($count_jumlah_data > 6)
                        {
                          $total_nilai_y = $total_nilai_y - $total_8;
                        }

                        if($count_jumlah_data > 6)
                        {
                      ?>
                      <tr>
                      <td>Total</td>
                      <td>-</td>
                      <td>-</td>
                      <td><?php echo $total_nilai_y ?></td>
                      <td>-</td>
                      <td><?php echo $total_nilai_x2 ?></td>
                      <td><?php echo $total_nilai_x4 ?></td>
                      <td><?php echo $total_nilai_xy ?></td>
                      <td><?php echo $total_nilai_x2y ?></td>
                      <td>-</td>
                    </tbody>
                  </table>
                  <br>
                  <br>
                  <?php
                        $a = (($total_nilai_x4*$total_nilai_y)-($total_nilai_x2*$total_nilai_x2y)) / (7*($total_nilai_x4)-7*($total_nilai_x2*$total_nilai_x2y));
                        $b = $total_nilai_xy/$total_nilai_x2;
                        $c = ((7*$total_nilai_x2y) - ($total_nilai_x2*$total_nilai_y)) / ((7*$total_nilai_x4) - ($total_nilai_x2*$total_nilai_x2));

                        $hasil =ceil($a+($b*4)+($c*4*4));
                  ?>
                  <h2>PERHITUNGAN</h2>
                  <br>
                  Nilai A = <?php echo $a?>
                  <br>
                  Nilai B = <?php echo $b?>
                  <br>
                  Nilai C = <?php echo $c?>
                  <br>

                  HASIL
                  <br>
                  HASIL PERAMALAN = <?php echo $hasil?>

                  <?php
                        }
                  ?>

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