<?php

class Aksi_Admin_Peramalan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username'))
        {
            redirect('login');
        }
    }
    function index()
    {        
    	redirect('admin/aksi_admin_peramalan/tampil_peramalan');
    }

    function tampil_peramalan()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
        {

            $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
            $list_bulan      = $this->input->post('list_bulan');
            $list_tahun      = $this->input->post('list_tahun');
            $list_id_varian = $this->input->post('list_id_varian');
                    
            $where = array(            
                'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0
            );

            $where_varian = array(
                'id_wilayah_distributor' => $id_wilayah_distributor,
                'is_deleted' => 0
            );
                
            $ambil_data['varian'] = $this->model_data->ambil_data_where('varian',$where_varian);   
            // $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
                        ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;
            
            if(!empty($list_bulan))
            {
                //untuk mencari nilai di array bulan
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        


            //data peramalan
            
            if(!empty($list_bulan))
            {
                $tgl_input = $list_tahun . "-" . $list_bulan . "-"  . "1";
                if($list_bulan<=10)
                {
                    $tgl_calculated = $list_tahun . "0" . ($list_bulan-1) ;
                }
                else
                {
                    $tgl_calculated = $list_tahun .  ($list_bulan-1) ;                
                }
                            
            }    
            else
            {
                $tgl_input = "2030-7-1";
                $tgl_calculated = "203007";
                $list_id_varian = 1;
            }

            $ambil_data['list_id_varian'] = $list_id_varian;

            

            // echo $tgl_input;
            $ambil_data['data_peramalan'] = $this->model_data->ambil_data_peramalan($tgl_input , $list_id_varian , $tgl_calculated , $id_wilayah_distributor);
            $hitung_data_peramalan = count($ambil_data['data_peramalan']);
            $n = 9;
            
            if($hitung_data_peramalan == $n)
            {
                $ambil_data['nilai_x'] = [-4,-3,-2,-1,0,1,2,3,4];
            }
            else
            {
                $ambil_data['nilai_x'] = [1,1];
            }

             //FORECASTTTTTTTTT             
             if($list_bulan<10)
                {
                    $tgl_calculated_frc = $list_tahun . "0" . $list_bulan ;
                }
                else
                {
                    $tgl_calculated_frc = $list_tahun .  $list_bulan ;                
                }
             $ambil_data['tgl_calculated_frc'] = $tgl_calculated_frc;
            
             $where = array(            
                'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0,
                'detail_loading.id_varian' => $list_id_varian
            );

             $ambil_data['nilai_actual'] = $this->model_data->ambil_data_penjualan_varian($where); 
             
             //FORECASTTTTTTTTT


            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');              
            // print_r($ambil_data['nilai_x'])   ;
            $this->load->view('admin/data_admin/v_admin_data_peramalan' , $ambil_data);
        }

        //PUSATT

        else
        {

            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');


            $list_bulan      = $this->input->post('list_bulan');
            $list_tahun      = $this->input->post('list_tahun');
            $list_id_varian = $this->input->post('list_id_varian');
             

                $where = array(            
                    'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );

                $where_varian = array(
                    'id_wilayah_distributor' => $id_wilayah_distributor,
                    'is_deleted' => 0
                );


            $ambil_data['varian'] = $this->model_data->ambil_data_where('varian',$where_varian);   
            // $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
                        ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;
            
            if(!empty($list_bulan))
            {
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        


            //data peramalan
            
            if(!empty($list_bulan))
            {
                $tgl_input = $list_tahun . "-" . $list_bulan . "-"  . "1";
                if($list_bulan<=10)
                {
                    $tgl_calculated = $list_tahun . "0" . ($list_bulan-1) ;
                }
                else
                {
                    $tgl_calculated = $list_tahun .  ($list_bulan-1) ;                
                }
                            
            }    
            else
            {
                $tgl_input = "2030-7-1";
                $tgl_calculated = "203007";
                $list_id_varian = 1;
            }

            $ambil_data['list_id_varian'] = $list_id_varian;

            

            // echo $tgl_input;
            $ambil_data['data_peramalan'] = $this->model_data->ambil_data_peramalan($tgl_input , $list_id_varian , $tgl_calculated , $id_wilayah_distributor);
            $hitung_data_peramalan = count($ambil_data['data_peramalan']);
            
            if($hitung_data_peramalan == 7)
            {
                $ambil_data['nilai_x'] = [-3,-2,-1,0,1,2,3];
            }
            else
            {
                $ambil_data['nilai_x'] = [1,1];
            }

           
            
            $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('admin/v_admin_top_navbar');              
            $this->load->view('admin/data_admin/v_admin_data_peramalan' , $ambil_data);


        }
        
    }

    function eksekusi()
    {
          //SEND TO FORECATS TABLE
          $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');

          $list_id_varian = $this->input->get('list_id_varian');
          $actual = $this->input->post('actual');
          $mape = $this->input->post('mape');          
          $tgl_calculated_input = $this->input->post('tgl_calculated_input');
          $hasil = $this->input->post('hasil');
  

          $data_insert = array(            
              'tgl_calculated'     => $tgl_calculated_input,
              'nilai_prediksi' => $hasil,
              'nilai_actual' => $actual,
              'nilai_mape' => $mape,
              'id_varian' => $list_id_varian,
              'id_wilayah_distributor' => $id_wilayah_distributor
          );
  
          
          $this->model_data->insert($data_insert,'data_chart');

          redirect('admin/aksi_admin_peramalan/tampil_peramalan');
          
          //SEND UP
    }

    // GENERATE PERAMALAN

    function generate_peramalan()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
        
         //ambil nilai id varian
         $where = array(
            'varian.id_wilayah_distributor' => $id_wilayah_distributor,
            'is_deleted' => 0
        );
        $list_id_varian = $this->model_data->ambil_data_varian($where);
        $jumlah_list_id_varian = count($list_id_varian);

        for($i=0; $i<$jumlah_list_id_varian; $i++)
        {
            $id_varian = $list_id_varian[$i]['id_varian']; 
            echo $id_varian;

            for($bln=10;$bln <13; $bln++)
            {
                $tahun = 2018;
                $bulan = $bln;
                if($bulan <= 10)
                {
                    $tgl_calculated = $tahun . "0" . ($bulan-1);
                    $tgl_input = $tahun . "-" . $bulan . "-"  . "1";
                }
                else
                {
                    $tgl_calculated = $tahun .  ($bulan-1);
                    $tgl_input = $tahun . "-" . $bulan . "-"  . "1";
                }

                $data_peramalan[$i] = $this->model_data->ambil_data_peramalan($tgl_input , $id_varian , $tgl_calculated , $id_wilayah_distributor);
            }
        }

        var_dump($data_peramalan );
        

    }

    //AKSI PERAMALAN FIX
    function aksi_peramalan()
    {
        
       $bulan = date("m");
       $tahun = date("Y");
       $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
       $list_id_varian = $this->input->post('list_id_varian');
       $n = 9; // JUMLAH DATA YANG DIBUTUHKAN ASLINYA 9
       

       //variable bulan depan
    //    $tgl_calculated = $tahun . "0" . ($bulan-1);
    //    $tgl_input = $tahun . "-" . $bulan . "-"  . "1";

    //SEMENTARA
        $tahun = 2020;
        $bulan = 12;
        if($bulan <= 10)
        {
            $tgl_calculated = $tahun . "0" . ($bulan-1);
            $tgl_input = $tahun . "-" . $bulan . "-"  . "1";
        }
        else
        {
            $tgl_calculated = $tahun .  ($bulan-1);
            $tgl_input = $tahun . "-" . $bulan . "-"  . "1";
        }
        
       
       $where_varian = array(
        'id_wilayah_distributor' => $id_wilayah_distributor,
        'is_deleted' => 0
        );
       $ambil_data['varian'] = $this->model_data->ambil_data_where('varian',$where_varian);           
       
       //memberikan nilai 1 jika list id kosong
       if(empty($list_id_varian))
       {
           $list_id_varian = 1;
       }
       $ambil_data['list_id_varian'] = $list_id_varian;
       //mengambil data peramalan
      $ambil_data['data_peramalan'] = $this->model_data->ambil_data_peramalan($tgl_input , $list_id_varian , $tgl_calculated , $id_wilayah_distributor);

      $total_data = count($ambil_data['data_peramalan']);

       //melakukan perhitungan forecast
       $ambil_data['nilai_x'] = [-4,-3,-2,-1,0,1,2,3,4];
       $total_nilai_y = 0;
       $total_nilai_x2 = 0;
       $total_nilai_x4 = 0;
       $total_nilai_xy = 0;
       $total_nilai_x2y = 0;
       

       if($total_data == $n)
       {
            for($i=0; $i<$n; $i++)
            {
                $total = $ambil_data['data_peramalan'][$i]['total'];
                $total_nilai_y = $total_nilai_y + $total;
                $total_nilai_x2 = $total_nilai_x2 + $ambil_data['nilai_x'][$i]*$ambil_data['nilai_x'][$i];
                $total_nilai_x4 = $total_nilai_x4 + $ambil_data['nilai_x'] [$i]*$ambil_data['nilai_x'] [$i]*$ambil_data['nilai_x'] [$i]*$ambil_data['nilai_x'][$i];
                $total_nilai_xy = $total_nilai_xy + $ambil_data['nilai_x'] [$i]*$total;
                $total_nilai_x2y = $total_nilai_x2y + $ambil_data['nilai_x'] [$i]*$ambil_data['nilai_x'] [$i]*$total;
                // echo $ambil_data['data_peramalan'][$i]['month'];
            }
            
            $ambil_data['total_nilai_y'] = $total_nilai_y;
            $ambil_data['total_nilai_x2'] = $total_nilai_x2;
            $ambil_data['total_nilai_x4'] = $total_nilai_x4;
            $ambil_data['total_nilai_xy'] = $total_nilai_xy;
            $ambil_data['total_nilai_x2y'] = $total_nilai_x2y;

            $x_indeks = 5; //(KARENA JUMLAH N 9)
                  
            $a = (($total_nilai_x4*$total_nilai_y)-($total_nilai_x2*$total_nilai_x2y)) / ($n*($total_nilai_x4)-($total_nilai_x2*$total_nilai_x2));
            $b = $total_nilai_xy/$total_nilai_x2;
            $c = (($n*$total_nilai_x2y) - ($total_nilai_x2*$total_nilai_y)) / (($n*$total_nilai_x4) - ($total_nilai_x2*$total_nilai_x2));

            $hasil =ceil($a+($b*$x_indeks)+($c*$x_indeks*$x_indeks));
            if($hasil < 0)
            {
              $hasil = $hasil * -1;
            }  
            
            $ambil_data['x_indeks'] = $x_indeks;
            $ambil_data['nilai_a'] = $a;
            $ambil_data['nilai_b'] = $b;
            $ambil_data['nilai_c'] = $c;
            $ambil_data['hasil'] = $hasil;

            //Melakukan perhitungan MAPE
            $where = array(            
                'MONTH(loading_barang.tgl_loading)' => $bulan,
                'YEAR(loading_barang.tgl_loading)' => $tahun,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0,
                'detail_loading.id_varian' => $list_id_varian
            );

            $ambil_data['nilai_actual'] = $this->model_data->ambil_data_penjualan_varian($where);
            // var_dump($ambil_data['nilai_actual'][0]['total']) ;die();

            $actual = $ambil_data['nilai_actual'][0]['total'];
            $ambil_data['actual'] = $actual;

            $abs_mape = $actual - $hasil;
            if($abs_mape < 1)
            {
                $abs_mape = $abs_mape*-1;
            }
            $ambil_data['abs_mape'] = $abs_mape;

            $abs_mape_bagi = $abs_mape/$actual;                                         
            $nilai_mape = round($abs_mape_bagi/$n * 100 ,1);

            $ambil_data['abs_mape_bagi'] = $abs_mape_bagi;
            $ambil_data['nilai_mape'] = $nilai_mape;

            

       }

        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');              
        $this->load->view('admin/data_admin/v_admin_data_prediksi' , $ambil_data);       

           

    }

}

?>