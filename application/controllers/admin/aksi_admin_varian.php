<?php

class Aksi_Admin_Varian extends CI_Controller
{
    function index()
    {        
    	$this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/v_admin_dashboard');
        
    }

    function tampil_input_stock() //useless
    {
        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/v_admin_dashboard');
    }

    function tampil_data_stock()
    {

        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'varian.id_wilayah_distributor' => $id_wilayah_distributor,
            'is_deleted' => 0
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_varian($where);
        $ambil_data['produk'] = $this->model_data->ambil_data_result('produk');

        if(!empty($ambil_data['data'][0]['id_wilayah_distributor']))
        {
            // $ambil_data['id_wilayah_distributor'] = $ambil_data['data'][0]['id_wilayah_distributor'];
            $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];
        }
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_data_stock' , $ambil_data);
    }

    function tambah_varian()
    {
        $jenis_varian   = $this->input->post('jenis_varian');
        $stock_varian   = $this->input->post('stock_varian');
        $harga_varian   = $this->input->post('harga_varian');
        $id_produk      = $this->input->post('list_id_produk');
        $id_wilayah_distributor        = $this->session->userdata('id_wilayah_distributor');

        $data_insert = array(
            'jenis_varian'  => $jenis_varian,
            'stock_varian'  => $stock_varian,
            'harga_varian'  => $harga_varian,
            'id_produk'     => $id_produk,
            'id_wilayah_distributor' => $id_wilayah_distributor
        );

        
        $this->model_data->insert($data_insert,'varian');

        //AKSI LOG VARIAN
        $id_varian_log = $this->db->insert_id(); //untuk mendapatkan nilai id terbaru
        $data_insert_log = array(            
            'id_varian'  => $id_varian_log,            
            'aksi'     => "tambah"            
        );

        $this->model_data->insert($data_insert_log,'log_varian');

        redirect('admin/aksi_admin_varian/tampil_data_stock' );
    }

    function hapus_varian()
    {
        $id_varian = $this->input->get('id_varian');        
        
        $where = array(
            'id_varian' => $id_varian
        );

        $data = array(
            'is_deleted' => 1
        );
        
        $this->model_data->edit_data($where,$data,'varian');

        //AKSI LOG VARIAN

        $data_insert_log = array(            
            'id_varian'  => $id_varian,            
            'aksi'     => "hapus"            
        );

        $this->model_data->insert($data_insert_log,'log_varian');

        redirect('admin/aksi_admin_varian/tampil_data_stock' );
    }

    function tampil_edit_stock()
    {
        $id_varian = $this->input->get('id_varian');

        $where = array(
            'id_varian' => $id_varian
        );

        $ambil_data['data'] = $this->model_data->ambil_data_varian($where);
        $ambil_data['produk'] = $this->model_data->ambil_data_result('produk');
        $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];

        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_edit_stock' , $ambil_data);
    }

    function do_edit_stock()
    {
        $id_varian = $this->input->get('id_varian');
        $jenis_varian = $this->input->post('jenis_varian');
        $stock_varian = $this->input->post('stock_varian');
        $harga_varian   = $this->input->post('harga_varian');
        $id_produk = $this->input->post('list_id_produk');
        
        
        $where = array(
            'id_varian' => $id_varian
        );

        $data = array(
            'jenis_varian' => $jenis_varian,
            'stock_varian' => $stock_varian,
            'harga_varian'  => $harga_varian,
            'id_produk' => $id_produk
        );
        $this->model_data->edit_data($where,$data,'varian');
        
        redirect('admin/aksi_admin_varian/tampil_data_stock' );
    }

    //FUNCTION LOG
    function tampil_data_stock_log()
    {

        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'varian.id_wilayah_distributor' => $id_wilayah_distributor            
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_log_varian($where);
        $ambil_data['produk'] = $this->model_data->ambil_data_result('produk');

        if(!empty($ambil_data['data'][0]['id_wilayah_distributor']))
        {
            // $ambil_data['id_wilayah_distributor'] = $ambil_data['data'][0]['id_wilayah_distributor'];
            $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];
        }
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/data_log_admin/v_log_admin_data_stock' , $ambil_data);
    }

    //FUNCTION RECENT DELETED
    function tampil_recent_delete_data_stock_log()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'varian.id_wilayah_distributor' => $id_wilayah_distributor   ,
            'varian.is_deleted' => 1  ,
            'log_varian.aksi'  => 'hapus'
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_recent_delete_varian($where);
        $ambil_data['produk'] = $this->model_data->ambil_data_result('produk');

        if(!empty($ambil_data['data'][0]['id_wilayah_distributor']))
        {
            // $ambil_data['id_wilayah_distributor'] = $ambil_data['data'][0]['id_wilayah_distributor'];
            $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];
        }
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/data_log_admin/v_recent_delete_admin_data_stock' , $ambil_data);
    }

    function do_pulihkan_stock()
    {
        $id_varian = $this->input->get('id_varian');        
        
        $where = array(
            'id_varian' => $id_varian
        );

        $data = array(
            'is_deleted' => 0
        );
        
        $this->model_data->edit_data($where,$data,'varian');

        //AKSI LOG VARIAN

        $data_insert_log = array(            
            'id_varian'  => $id_varian,            
            'aksi'     => "pulihkan"            
        );

        $this->model_data->insert($data_insert_log,'log_varian');

        redirect('admin/aksi_admin_varian/tampil_data_stock' );
    }

    function do_hapus_stock()
    {
        $id_varian = $this->input->get('id_varian'); 

        $where = array(
            'id_varian' => $id_varian
        );

        $this->model_data->delete_data($where,'varian');
      

        //AKSI LOG VARIAN

        $data_insert_log = array(            
            'id_varian'  => $id_varian,            
            'aksi'     => "Hapus Permanent"            
        );

        $this->model_data->insert($data_insert_log,'log_varian');

        redirect('admin/aksi_admin_varian/tampil_data_stock' );
    }
}

?>