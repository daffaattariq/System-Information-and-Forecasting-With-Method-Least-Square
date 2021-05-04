<?php

class Aksi_Admin_Peramalan extends CI_Controller
{
    function index()
    {        
    	redirect('admin/aksi_admin_peramalan/tampil_peramalan');
    }

    function tampil_peramalan()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
        $list_bulan      = $this->input->post('list_bulan');
        $list_tahun      = $this->input->post('list_tahun');
                
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
            $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
        }        


        //data peramalan
        $list_id_varian = $this->input->post('list_id_varian');
        $list_bulan      = $this->input->post('list_bulan');
        $list_tahun      = $this->input->post('list_tahun');

        if(!empty($list_bulan))
        {
            $tgl_input = $list_tahun . "-" . $list_bulan . "-"  . "1";
        }    
        else
        {
            $tgl_input = "2030-7-1";
            $list_id_varian = 1;
        }

        

        // echo $tgl_input;
        $ambil_data['data_peramalan'] = $this->model_data->ambil_data_peramalan($tgl_input , $list_id_varian);
        $hitung_data_peramalan = count($ambil_data['data_peramalan']);
        
        if($hitung_data_peramalan == 8)
        {
            $ambil_data['nilai_x'] = [-3,-2,-1,0,1,2,3,0];
        }
        else if($hitung_data_peramalan == 7)
        {
            $ambil_data['nilai_x'] = [-3,-2,-1,0,1,2,3];
        }
        else
        {
            $ambil_data['nilai_x'] = [1,1];
        }

        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');                 
        $this->load->view('admin/data_admin/v_admin_data_peramalan' , $ambil_data);
        
    }

    function tambah_peramalan()
    {
        $list_id_varian = $this->input->post('list_id_varian');
        $list_bulan      = $this->input->post('list_bulan');
        $list_tahun      = $this->input->post('list_tahun');

        $tgl_input = "1-" . $list_bulan . "-"  . $list_tahun;
        // echo $tgl_input;
        $ambil_data['data_peramalan'] = $this->model_data->ambil_data_peramalan($tgl_input);  
        // $hitung_data_peramalan = count($ambil_data['data_peramalan']);

        

        $this->load->view('admin/data_admin/v_admin_data_peramalan' , $ambil_data);
       
    }

}

?>