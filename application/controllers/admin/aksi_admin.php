<?php

class Aksi_Admin extends CI_Controller
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
        //chart
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
        $ar_id_varian = array();
        $data_chart = array();

        
        //sementara
        $bulan = date("m");
        $tahun = date("Y");
        $tahun = 2020; //inputan sementara
        $bulan = 12; //inputan sementara

        $tgl_awal = $tahun . "00";

        if($bulan<10)
        {
            $tgl_akhir = $tahun . "0" . $bulan ;
        }
        else
        {
            $tgl_akhir = $tahun .  $bulan ;                
        }

        //ambil nilai id varian
        $where = array(
            'varian.id_wilayah_distributor' => $id_wilayah_distributor,
            'is_deleted' => 0
        );

        // $list_id_varian = 1;
        $list_id_varian = $this->model_data->ambil_data_varian($where);
        
        $i=0;
        foreach($list_id_varian as $varian)
        {
             $ar_id_varian[$i] = $list_id_varian[$i]['id_varian'];            
             //echo $ar_id_varian[$i];             
             $data_chart[$i] = $this->model_data->ambil_data_chart_penjualan($tgl_awal ,$tgl_akhir , $id_wilayah_distributor , $ar_id_varian[$i]);
            
            
             $i++;
        }

        $data['data_chart'] = json_encode($data_chart);
        echo "<br><br>";
        // var_dump($data['data_chart']);die();
        
    	$this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/v_admin_dashboard' , $data);
        
    }
}