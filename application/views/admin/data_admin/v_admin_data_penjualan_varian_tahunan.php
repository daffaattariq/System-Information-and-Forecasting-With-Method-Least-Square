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
  <!-- <link href="<?php echo base_url();?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
</head>


          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                
                <div class="table-responsive p-3">
                <br>

                <form action=
                "<?php 
                if($this->session->userdata('id_wilayah_distributor') != 5)
                {
                echo base_url('admin/aksi_admin_penjualan/tampil_penjualan_varian_tahunan')
                 ?>
                 <?php
                }
                else
                {
                  echo base_url('admin/aksi_admin_penjualan/tampil_penjualan_varian_tahunan')?>?id_wilayah_distributor=<?php echo $id_wilayah_distributor
                  ?>
                  <?php
                }
                  ?>"
                 method="post">
                
                <br>
                

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
                
                  <table class="table align-items-center table-flush table-hover" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Number</th>                                                
                        <th>Nama Produk</th>                                                                                        
                        <th>Jenis Varian</th> 
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
                            <td><?php echo $data_detail_loading['nama_produk'] ?></td>  
                            <td><?php echo $data_detail_loading['jenis_varian'] ?></td>                                                        
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
          
          <div class="row">
					<div class="col-12">
						<div class="card card-chart">
							<div class="card-header">
								<div class="row">
									<div class="col-sm-6 text-left">
										<h2 class="card-title">Grafik</h2>
									</div>
								</div>
							</div>
							<div class="card-body">
							
								<hr style="background-color:black;">
								<canvas id="myChartAktualVSPrediksi" width="400" height="200"></canvas>
								<script>
									var ctx = document.getElementById('myChartAktualVSPrediksi').getContext('2d');
									var myChart = new Chart(ctx, {
										type: 'line',
										data: {
											labels: [<?php
														$jmlp = count($hp)+1;
														$in = 1;
														foreach ($data_aktual as $d) {
															echo "'ke - ".$in."' ,";
															$in++;
														}
													?>],
											datasets: [{
												label: 'Data Aktual',
												data: [<?php
														foreach ($data_aktual as $da) {
															echo round($da['total'], 2).', ';
														}
													?>],
												backgroundColor: [
													'rgba(0,0,0,1)'
												],
												borderColor: [
													'rgba(0,0,0 1)'
												],
												tension: 0.4,
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												y: {
													beginAtZero: false
												}
											}
										}
									});
								</script>
								
							</div>
						</div>
					</div>
				</div>

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
  <!-- <script src="<?php echo base_url();?>assets/admin/vendor/js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/js/datatables/dataTables.bootstrap4.min.js"></script> -->
                          <!-- UNTUK EXCEL DAN PDF -->
<!-- data tables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <!-- chart -->
    <script src="<?php echo base_url() ?>assets/admin/js/chartjs.min.js"></script>
  <!-- Page level custom scripts -->
  <script type="text/javascript"> 
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            title: 'Penjualan Varian Tahunan'
          },
          {
            extend: 'pdfHtml5',
            title: 'Penjualan Varian Tahunan'
          }
        ]
    } )
    } );                        
  </script>

</body>

</html>