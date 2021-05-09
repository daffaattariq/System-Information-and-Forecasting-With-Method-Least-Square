<?php

class Aksi_Admin_Sales extends CI_Controller
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
    	redirect('admin/aksi_admin_sales/tampil_sales');
    }

    function tampil_sales()
    {
        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'sales.id_wilayah_distributor' => $id_wilayah_distributor,
            'sales.is_deleted' => 0
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_sales($where);        
        
        // print($ambil_data['produk'][0]['id_produk']);die();

        //tampil
        $this->load->view('admin/v_admin_side_navbar');        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_data_sales' , $ambil_data);
        
    }

    
    function tambah_sales()
    {        
        $this->form_validation->set_rules('nama_sales','is_unique[sales.nama_sales]');
        if($this->form_validation->run()==false)
        {
            $this->session->set_flashdata('error', 'nama sales sudah ada');
            redirect('admin/aksi_admin_sales/tampil_sales');
        }
        else{
            $nama_sales      = $this->input->post('nama_sales');
        $id_wilayah_distributor        = $this->session->userdata('id_wilayah_distributor');

        $data_insert = array(            
            'nama_sales'     => $nama_sales,
            'id_wilayah_distributor' => $id_wilayah_distributor
        );

        
        $this->model_data->insert($data_insert,'sales');

         //AKSI LOG SALES

         $id_sales_log = $this->db->insert_id(); //untuk mendapatkan nilai id terbaru
         $data_insert_log = array(            
             'id_sales'  => $id_sales_log,
             'aksi'     => "tambah"            
         );
 
         $this->model_data->insert($data_insert_log,'log_sales');
 
        redirect('admin/aksi_admin_sales' );
        }


        
    }

    function hapus_sales()
    {
        $id_sales = $this->input->get('id_sales');        
        
        $where = array(
            'id_sales' => $id_sales
        );

        $data = array(
            'sales.is_deleted' => 1
        );

        
        $this->model_data->edit_data($where,$data,'sales');

        //AKSI LOG SALES

        $data_insert_log = array(            
            'id_sales'  => $id_sales,
            'aksi'     => "hapus"            
        );

        $this->model_data->insert($data_insert_log,'log_sales');

        redirect('admin/aksi_admin_sales' );
    }

    function tampil_edit_sales()
    {
        $id_sales = $this->input->get('id_sales');

        $where = array(
            'id_sales' => $id_sales
        );

        $ambil_data['data'] = $this->model_data->ambil_data_sales($where);        
        $ambil_data['nama_wilayah'] = $ambil_data['data'][0]['nama_wilayah'];

        $this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/data_admin/v_admin_edit_sales' , $ambil_data);
    }

    function do_edit_sales()
    {
        $id_sales = $this->input->get('id_sales');                        
        $nama_sales = $this->input->post('nama_sales');   
        
        $where = array(
            'id_sales' => $id_sales
        );

        $data = array(            
            'nama_sales' => $nama_sales
        );

        
        $this->model_data->edit_data($where,$data,'sales');
        
        redirect('admin/aksi_admin_sales' );
    }

    //FUNCTION LOG
    function tampil_data_sales_log()
    {

        $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                
        $where = array(
            'sales.id_wilayah_distributor' => $id_wilayah_distributor            
        );
               
        $ambil_data['data'] = $this->model_data->ambil_data_log_sales($where);
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
        $this->load->view('admin/data_admin/data_log_admin/v_log_admin_data_sales' , $ambil_data);
    }

     //FUNCTION RECENT DELETED
     function tampil_recent_delete_data_sales_log()
     {
         $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
                 
         $where = array(
             'sales.id_wilayah_distributor' => $id_wilayah_distributor   ,
             'sales.is_deleted' => 1  ,
             'log_sales.aksi'  => 'hapus'
         );         
                
         $ambil_data['data'] = $this->model_data->ambil_data_recent_delete_sales($where);
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
         $this->load->view('admin/data_admin/data_log_admin/v_recent_delete_admin_data_sales' , $ambil_data);
     }

     //RESTORE DAN HAPUS
    function do_pulihkan_sales()
    {
        $id_sales = $this->input->get('id_sales');        
        
        $where = array(
            'id_sales' => $id_sales
        );

        $data = array(
            'is_deleted' => 0
        );
        
        $this->model_data->edit_data($where,$data,'sales');

        //AKSI LOG VARIAN

        $data_insert_log = array(            
            'id_sales'  => $id_sales,
            'aksi'     => "pulihkan"            
        );

        $this->model_data->insert($data_insert_log,'log_sales');

        redirect('admin/aksi_admin_sales' );
    }

    function do_hapus_sales()
    {
        $id_sales = $this->input->get('id_sales'); 

        $where = array(
            'id_sales' => $id_sales
        );

        $this->model_data->delete_data($where,'sales');

        
        //AKSI LOG SALES

        $data_insert_log = array(            
            'id_sales'  => $id_sales,
            'aksi'     => "Hapus Permanent"            
        );

        $this->model_data->insert($data_insert_log,'log_sales');

        redirect('admin/aksi_admin_sales' );
    }
 
}

?>
