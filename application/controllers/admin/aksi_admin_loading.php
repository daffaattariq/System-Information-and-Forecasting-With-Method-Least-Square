<?php

class Aksi_Admin_Loading extends CI_Controller
{
    function index()
    {        
    	redirect('admin/aksi_admin_loading/tampil_loading');
    }

    function tampil_loading()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
            'loading_barang.is_deleted' => 0
        );

        $where_sales = array(
            'sales.id_wilayah_distributor' => $id_wilayah_distributor,
            'sales.is_deleted' => 0
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_loading_barang($where);
        $ambil_data['sales'] = $this->model_data->ambil_data_sales($where_sales);

    
        // print($ambil_data['produk'][0]['id_produk']);die();        

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_data_loading' , $ambil_data);
        
    }

    function tambah_loading()
    {        
        $id_sales      = $this->input->post('list_id_sales');
        $id_wilayah_distributor        = $this->session->userdata('id_wilayah_distributor');
        $date = date("y-m-d");        

        $data_insert = array(            
            'id_sales'     => $id_sales,
            'tgl_loading' => $date,
            'id_wilayah_distributor' => $id_wilayah_distributor
        );

        
        $this->model_data->insert($data_insert,'loading_barang');

         //AKSI LOG LOADING
         $id_loading_log = $this->db->insert_id(); //untuk mendapatkan nilai id terbaru
         $data_insert_log = array(            
             'id_loading'  => $id_loading_log,             
             'aksi'     => "tambah"            
         );
 
         $this->model_data->insert($data_insert_log,'log_loading');

        redirect('admin/aksi_admin_loading' );
    }

    function hapus_loading()
    {
        $id_loading = $this->input->get('id_loading');        
        
        $where = array(
            'id_loading' => $id_loading
        );

        $data = array(
            'loading_barang.is_deleted' => 1
        );

        
        $this->model_data->edit_data($where,$data,'loading_barang');

         //AKSI LOG LOADING

         $data_insert_log = array(            
            'id_loading'  => $id_loading,            
            'aksi'     => "hapus"            
        );

        $this->model_data->insert($data_insert_log,'log_loading');

        redirect('admin/aksi_admin_loading' );
    }

    function tampil_edit_loading()
    {
        $id_loading = $this->input->get('id_loading');

        $where = array(
            'id_loading' => $id_loading
        );

        $ambil_data['data'] = $this->model_data->ambil_data_loading_barang($where);
        $ambil_data['sales'] = $this->model_data->ambil_data_result('sales');
        $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];

        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_edit_loading' , $ambil_data);
    }

    function do_edit_loading()
    {
        $id_loading = $this->input->get('id_loading');        
        $id_sales = $this->input->post('list_id_sales');
        
        
        $where = array(
            'id_loading' => $id_loading
        );

        $data = array(            
            'id_sales' => $id_sales
        );
        $this->model_data->edit_data($where,$data,'loading_barang');
        
        redirect('admin/aksi_admin_loading' );
    }

    //LOG LOADING
    function tampil_data_loading_log()
    {

        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor            
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_log_loading($where);
        

        if(!empty($ambil_data['data'][0]['id_wilayah_distributor']))
        {
            // $ambil_data['id_wilayah_distributor'] = $ambil_data['data'][0]['id_wilayah_distributor'];
            $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];
        }
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/data_log_admin/v_log_admin_data_loading' , $ambil_data);
    }

    //FUNCTION RECENT DELETED
    function tampil_recent_delete_data_loading_log()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor   ,
            'loading_barang.is_deleted' => 1  ,
            'log_loading.aksi'  => 'hapus'
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_recent_delete_loading($where);        

        if(!empty($ambil_data['data'][0]['id_wilayah_distributor']))
        {
            // $ambil_data['id_wilayah_distributor'] = $ambil_data['data'][0]['id_wilayah_distributor'];
            $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];
        }
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/data_log_admin/v_recent_delete_admin_data_loading' , $ambil_data);
    }

    //RESTORE DAN HAPUS
    function do_pulihkan_loading()
    {
        $id_loading = $this->input->get('id_loading');        
        
        $where = array(
            'id_loading' => $id_loading
        );

        $data = array(
            'is_deleted' => 0
        );
        
        $this->model_data->edit_data($where,$data,'loading_barang');

        //AKSI LOG VARIAN

        $data_insert_log = array(            
            'id_loading'  => $id_loading,
            'aksi'     => "pulihkan"            
        );

        $this->model_data->insert($data_insert_log,'log_loading');

        redirect('admin/aksi_admin_loading' );
    }
    function do_hapus_loading()
    {
        $id_loading = $this->input->get('id_loading'); 

        $where = array(
            'id_loading' => $id_loading
        );

        $this->model_data->delete_data($where,'loading_barang');

        
        //AKSI LOG LOADING

        $data_insert_log = array(            
            'id_loading'  => $id_loading,
            'aksi'     => "Hapus Permanent"            
        );

        $this->model_data->insert($data_insert_log,'log_loading');

        redirect('admin/aksi_admin_loading' );
    }


}
?>