<!DOCTYPE html>
<html lang="en">

<head>
  <title>Form Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/bintang_sidoraya.jpg">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/magnific-popup.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/aos.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.timepicker.css">


  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/flaticon.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/icomoon.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

  <style>
    html,
        body {
            height: 100%;
        }
        body {
            
  
            
            background-image: linear-gradient(-225deg, rgb(255, 255, 255) 50%, rgb(16,12,44) 50%);
        }
    </style>
</head>

<body>
  <div class="comment-form-wrap pt-5">
  <div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <div id="">
      <section class="ftco-section ">
        <div class="container">
          <center>
            <div class=".col-md-6 .offset-md-3">
              <div class="col-md-5 order-md-last pr-md-5">
          <?php if ($this->session->flashdata('error')) {?>
                  <div class="alert alert-danger" role="alert">
                  <?php echo $this->session->flashdata('error');?>
                </div>
              <?php }?>
                <form method ="post" action="<?php echo base_url('login/cek_login');?>" class=" p-3 p-md-5 bg-light">
                    <img src="<?php echo base_url();?>assets/images/bintang_sidoraya.jpg" />     
                  <div class="form-group">
                    <input type="text" class="form-control"  name="username" placeholder="Username" required="">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                  </div>         
                <div class="form-group">
                  <button href="<?php echo base_url('login/ceklogin');?>" type="submit"  name="login" class="btn btn-secondary btn-lg btn-block">Login</button> </div>
          </center>
        </div>
      </form>
    </div>
  </div>
  </div>
  </section>
  

  </div><!-- END COLORLIB-MAIN -->
  </div><!-- END COLORLIB-PAGE -->



  <script src="<?php echo base_url();?>assets/cjs/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/aos.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.animateNumber.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/jquery.timepicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
  </script>
  <script src="<?php echo base_url();?>assets/cjs/google-map.js"></script>
  <script src="<?php echo base_url();?>assets/cjs/main.js"></script>

</body>

</html>