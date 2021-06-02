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

  <!-- chart -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Chart Tahun <?php echo date("Y") ?></h1>
          
          </div>

          

          <!-- CHART -->
          <?php
          // var_dump($data_chart);die();
              for($n=0; $n<6; $n++)
              {
                 $chart = $data_chart[$n];
                
          ?>

            <div id="myfirstchart<?php echo $n ?>" style="height: 250px;"></div>
            <script>
             Morris.Line({
              element: 'myfirstchart<?php echo $n ?>' ,              
              data: <?php echo $chart; ?>,                        
              xkey: 'id_chart',              
              ykeys: ['nilai_actual' , 'nilai_prediksi'],              
              labels: ['Actual' , 'Prediksi']

            // element: 'myfirstchart',
            // data: [
            //   { year: '2008', value: 20 },
            //   { year: '2009', value: 10 },
            //   { year: '2010', value: 5 },
            //   { year: '2011', value: 5 },
            //   { year: '2012', value: 20 }
            // ],
            // xkey: 'year',
            // ykeys: ['value'],
            // labels: ['Value']
            });
            </script>
            <?php
              }
            ?>

          </div>


            


  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
   

      <!-- modal edit -->
      <!-- modal delete -->
    </body>

  <script src="<?php echo base_url();?>assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/admin/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  

  <!-- Page level custom scripts -->
  <!-- <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script> -->

</body>

</html>