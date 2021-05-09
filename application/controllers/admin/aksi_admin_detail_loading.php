<?php

class Aksi_Admin_Detail_Loading extends CI_Controller
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
    	redirect('admin/aksi_admin_detail_loading/tampil_detail_loading');
    }

    function tampil_detail_loading()
    {
        $id_loading = $this->input->get('id_loading'); 
         
        if($id_loading == null)
        {
            $id_loading = $this->session->userdata('kirim_id_loading');
        }        

        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');                  
        
        //where detail_loading
        $where = array(
            'detail_loading.id_loading' => $id_loading,
            'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
            'loading_barang.is_deleted' => 0,
            'detail_loading.is_deleted' => 0,
        );

        $where_data_loading = array(
            'id_loading' => $id_loading,
            'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
            'loading_barang.is_deleted' => 0
        );

        $where_varian = array(
            'id_wilayah_distributor' => $id_wilayah_distributor,
            'is_deleted' => 0
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where);   
        $ambil_data['varian'] = $this->model_data->ambil_data_where('varian',$where_varian);    
        $ambil_data['data_loading'] =  $this->model_data->ambil_data_loading_barang($where_data_loading);

        
            $ambil_data['tgl_loading'] = $ambil_data['data_loading'][0]['tgl_loading'];
            $ambil_data['id_loading'] = $id_loading;
            $ambil_data['nama_sales'] = $ambil_data['data_loading'][0]['nama_sales'];
        
        
        
        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_data_detail_loading' , $ambil_data);
    }

    function tambah_detail_loading()
    {
        $id_loading     = $this->input->post('id_loading');   
        $customer       = $this->input->post('customer');
        $id_varian      = $this->input->post('list_id_varian');
        $jml_pesanan    = $this->input->post('jml_pesanan');
        

        //untuk mecari harga sesuai id
        $where_varian = array(
            'id_varian' => $id_varian
        );

        $cek_data_varian = $this->model_data->cek($where_varian,'varian');
        // print_r($cek_data_varian['harga_varian'] );die();
        $harga_varian = $cek_data_varian['harga_varian'];
        
        $total = $jml_pesanan * $harga_varian;
        

        $data_insert = array(            
            'customer'     => $customer,
            'jumlah_pesanan' => $jml_pesanan,
            'id_varian'     => $id_varian,
            'id_loading' => $id_loading,
            'total' => $total
        );

        $this->model_data->insert($data_insert,'detail_loading');

        if(isset($_SESSION['kirim_id_loading']))
        {
            unset($_SESSION['kirim_id_loading']);
            $this->session->set_userdata('kirim_id_loading', $id_loading);
        }
        else
        {
            $this->session->set_userdata('kirim_id_loading', $id_loading);
        }
        redirect('admin/aksi_admin_detail_loading' );


    }

    function tampil_edit_detail_loading()
    {
        $id_detail_loading = $this->input->get('id_detail_loading');   

        $where = array(
            'id_detail_loading' => $id_detail_loading
        );

        $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where);
        $ambil_data['varian'] = $this->model_data->ambil_data_result('varian');   

        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_edit_detail_loading' , $ambil_data);
    }

    function do_edit_detail_loading()
    {
        $id_loading     = $this->input->post('id_loading');   
        $id_detail_loading = $this->input->get('id_detail_loading');        
        $id_varian = $this->input->post('list_id_varian');
        $jumlah_pesanan = $this->input->post('jumlah_pesanan');
        $customer = $this->input->post('customer');
        
        
        $where = array(
            'id_detail_loading' => $id_detail_loading
        );

        //untuk mecari harga sesuai id
        $where_varian = array(
            'id_varian' => $id_varian
        );

        $cek_data_varian = $this->model_data->cek($where_varian,'varian');
        // print_r($cek_data_varian['harga_varian'] );die();
        $harga_varian = $cek_data_varian['harga_varian'];
        
        $total = $jumlah_pesanan * $harga_varian;

        $data = array(            
            'id_varian' => $id_varian,
            'customer' => $customer,
            'jumlah_pesanan' => $jumlah_pesanan,
            'total' => $total
        );
        $this->model_data->edit_data($where,$data,'detail_loading');

        
        if(isset($_SESSION['kirim_id_loading']))
        {
            unset($_SESSION['kirim_id_loading']);
            $this->session->set_userdata('kirim_id_loading', $id_loading);
        }
        else
        {
            $this->session->set_userdata('kirim_id_loading', $id_loading);
        }

        
        redirect('admin/aksi_admin_detail_loading' );
    }


}

?>