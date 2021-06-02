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

        <form action="<?php echo base_url('admin/aksi_admin_peramalan/aksi_peramalan') ?>" method ="post">
          <div class="form-group">
                      <label for="exampleFormControlSelect1">Select Varian</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="list_id_varian">
                      <option  value ="<?php echo $list_id_varian ?>"><?php echo $list_id_varian?></option>                                                  
                        <?php
                          foreach($varian as $data_varian)
                          {
                            if($list_id_varian != $data_varian['id_varian']) 
                            {                                
                        ?>

                              <option  value ="<?php echo $data_varian['id_varian'] ?>"><?php echo $data_varian['jenis_varian'] ?></option>                          
                                                
                              <?php
                            }
                          }
                        ?>               
                      </select>
                      <br>
                      
                      <button type="submit" class="btn btn-primary">Submit</button>   
            </div>  
            </form>
                       
           
           
          </div>
          <h1 class="h3 mb-0 text-gray-800">DataTables PREDIKSI   </h1>

           <!-- TABLE NILAI A B C -->

           <!-- Row -->
           <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">                                                                                        
                  <table class="table align-items-center table-flush table-hover" id="">
                    <thead class="thead-light">
                    <tr>
                        <th>Bulan</th>                                                   
                        <th>Tahun</th>                   
                        <th>Hasil Forecast</th>                             
                      </tr>    
                        
                    </thead>
                   <!--  <tfoot>
                    <tr>
                        <th>Id Employee</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Division</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
                    <tbody>
                      
                        <tr>
                            <td><?php echo date("M") ?></td>                            
                            <td><?php echo date("Y")?></td>                              
                            <td><?php echo $hasil ?></td>  
                            
                        </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- TABLE PENJUALAN -->

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">   

                
                <?php if ($this->session->flashdata('error')) {?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $this->session->flashdata('error');?>
                
              <?php }?>
                           
                           
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
                   <!--  <tfoot>
                    <tr>
                        <th>Id Employee</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Division</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
                    <tbody>
                      <?php
                        $number = 0;

                        foreach($data_peramalan as $data_peramalan)
                        {
                          $number++;
                        
                      ?>
                        <tr>
                            <td><?php echo $number ?></td>                            
                            <td><?php echo $data_peramalan['month'] ?></td>                              
                            <td><?php echo $data_peramalan['year'] ?></td>  
                            <td><?php echo $data_peramalan['total'] ?></td>   

                            <td><?php echo $nilai_x[$number-1] ?></td>  
                              <!-- nilai x2 -->
                            <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1] ?></td> 
                              <!-- nilai x4 -->
                            <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1]*$nilai_x[$number-1] ?></td> 
                              <!-- nilai x.y -->
                            <td><?php echo $nilai_x[$number-1]*$data_peramalan['total'] ?></td>  
                              <!-- nilai x2.y -->
                            <td><?php echo $nilai_x[$number-1]*$nilai_x[$number-1]*$data_peramalan['total'] ?></td> 
                            
                        </tr>
                        
                      <?php
                        }
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
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

            <!-- TABLE NILAI A B C -->

           <!-- Row -->
           <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">                                                                                        
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                    <tr>
                        <th>Nilai A</th>                                                   
                        <th>Nilai B</th>                   
                        <th>Nilai C</th>                             
                        <th>Nilai X indeks</th> 
                      </tr>    
                        
                    </thead>
                   <!--  <tfoot>
                    <tr>
                        <th>Id Employee</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Division</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
                    <tbody>
                      
                        <tr>
                            <td><?php echo $nilai_a ?></td>                            
                            <td><?php echo $nilai_b?></td>                              
                            <td><?php echo $nilai_c ?></td>  
                            <td><?php echo $x_indeks ?></td>
                            
                        </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <h1 class="h3 mb-0 text-gray-800">Perhitungan MAPE   </h1>

           <!-- TABLE MAPE-->

           <!-- Row -->
           <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">                                                                                        
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                    <tr>
                        <th>Actual (at)</th>                                                   
                        <th>Forecast (ft)</th>                   
                        <th>|at-ft|</th>                             
                        <th>|at-ft|/at</th>   
                        <th>Hasil MAPE</th> 
                      </tr>    
                        
                    </thead>
                   <!--  <tfoot>
                    <tr>
                        <th>Id Employee</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Division</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                    </tfoot> -->
                    <tbody>
                      
                        <tr>
                            <td><?php echo $actual ?></td>                            
                            <td><?php echo $hasil?></td>                              
                            <td><?php echo $abs_mape ?></td>  
                            <td><?php echo $abs_mape_bagi ?></td>
                            <td><?php echo $nilai_mape ?>%</td>
                            
                        </tr>
                      
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
    <!-- modal tambah members -->
        <div class="modal fade" id="tambahmembers" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Add Sales</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <form action="<?php echo base_url('admin/aksi_admin_sales/tambah_sales') ?>" method="post">
                    
                    <div class="form-group">
                      <input type="text" class="form-control" id="nama_sales"
                        placeholder="nama sales"required="" name="nama_sales" >
                    </div>
                   
                   
                

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
            </div>
        </div>
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