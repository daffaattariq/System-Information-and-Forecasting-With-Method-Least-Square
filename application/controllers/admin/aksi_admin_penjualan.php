<?php

class Aksi_Admin_Penjualan extends CI_Controller
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
    	redirect('admin/aksi_admin_penjualan/tampil_penjualan');
    }

    function tampil_penjualan()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
        {
            echo "admin";
            $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
            $tgl = date("y-m-d");
                    
            $where = array(
                'loading_barang.tgl_loading' => $tgl,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0
            );
                
            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where);        

        
            // print($ambil_data['produk'][0]['id_produk']);die();        

            //tampil
            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar');
            $this->load->view('admin/data_admin/v_admin_data_penjualan_harian' , $ambil_data);
        }

        //PUSAT
        else
        {
            echo "pusat";
            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

            $tgl = date("y-m-d");
                    
            if($id_wilayah_distributor != 6)
            {
                $where = array(
                    'loading_barang.tgl_loading' => $tgl,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );
            }
            else
            {
                $where = array(
                    'loading_barang.tgl_loading' => $tgl,
                    'loading_barang.is_deleted' => 0
                );  
            }
                   
            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where);  
            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
            $ambil_data['title'] = "dsadsa";  
            
    
        
            // print($ambil_data['produk'][0]['id_produk']);die();        
    
            //tampil
            $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('pusat/v_pusat_top_navbar');       
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar' , $ambil_data);
            $this->load->view('admin/data_admin/v_admin_data_penjualan_harian' , $ambil_data);
        }
        
    }

    function aksi_harian_penjualan()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
        {
            $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
            $tgl_harian      = $this->input->post('tgl_harian');
                    
            $where = array(
                'tgl_loading' => $tgl_harian,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0
            );
                
            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where);  
            

                $ambil_data['tgl_pilih'] = $tgl_harian;        

            
        
            // print($ambil_data['produk'][0]['id_produk']);die();        

            //tampil
            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar');
            $this->load->view('admin/data_admin/v_admin_data_penjualan_harian' , $ambil_data);
        }
        
        //PUSAT

        else
        {
            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

            $tgl_harian      = $this->input->post('tgl_harian');
        

            if($id_wilayah_distributor != 6)
            {
                $where = array(
                    'tgl_loading' => $tgl_harian,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );
            }
            else
            {
                $where = array(
                    'tgl_loading' => $tgl_harian,
                    'loading_barang.is_deleted' => 0
                );  
            }
                
            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where); 
            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
            
            $ambil_data['tgl_pilih'] = $tgl_harian;        

            
        
            // print($ambil_data['produk'][0]['id_produk']);die();        

            //tampil
             $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('pusat/v_pusat_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar' , $ambil_data);
            $this->load->view('admin/data_admin/v_admin_data_penjualan_harian' , $ambil_data);
        }
    }

    function tampil_bulanan_penjualan()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
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
                
            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
                        ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;
            
            if(!empty($list_bulan))
            {
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        

            
            //tampil
            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar');
            $this->load->view('admin/data_admin/v_admin_data_penjualan_bulanan' , $ambil_data);
        }

        //PUSAT
        else
        {
            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

            $list_bulan      = $this->input->post('list_bulan');
            $list_tahun      = $this->input->post('list_tahun');
            
            if($id_wilayah_distributor != 6)
            {
                $where = array(            
                    'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );            
            }    
            else
            {
                $where = array(            
                    'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.is_deleted' => 0
                );   
            }

            $ambil_data['data'] = $this->model_data->ambil_data_detail_loading($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
                        ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;

            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
            
            
            if(!empty($list_bulan))
            {
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        

            
            //tampil
            $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('pusat/v_pusat_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_navbar' , $ambil_data);
            $this->load->view('admin/data_admin/v_admin_data_penjualan_bulanan' , $ambil_data);
        }
    }

    //PENJUALAN VARIAN
    function tampil_penjualan_varian()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
        {
            //PENJUALAN BULANAN
            $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');
            $list_bulan      = $this->input->post('list_bulan');
            $list_tahun      = $this->input->post('list_tahun');
                    
            $where = array(            
                'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0
            );
                
            $ambil_data['data'] = $this->model_data->ambil_data_penjualan_varian($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
            ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;
            
            if(!empty($list_bulan))
            {
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        

            //tampil
            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_navbar');
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_bulanan' , $ambil_data);
        }

        //PUSAT

        else
        {
            //PENJUALAN BULANAN
            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

            $list_bulan      = $this->input->post('list_bulan');
            $list_tahun      = $this->input->post('list_tahun');
            
            if($id_wilayah_distributor != 6)
            {
                $where = array(            
                    'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );
            }
            else
            {
                $where = array(            
                    'MONTH(loading_barang.tgl_loading)' => $list_bulan,
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.is_deleted' => 0
                );
            }   

            $ambil_data['data'] = $this->model_data->ambil_data_penjualan_varian($where); 
            $ambil_data['list_bulan'] = $list_bulan;
            $ambil_data['list_tahun'] = $list_tahun;
                
            $bulan=array("januari"=>"1","februari"=>"2","maret"=>"3","april"=>"4","mei"=>"5","juni"=>"6","juli"=>"7" 
            ,"agustus"=>"8","september"=>"9","oktober"=>"10","november"=>"11","desember"=>"12");
            $ambil_data['bulan'] = $bulan;

            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
            
            if(!empty($list_bulan))
            {
                $ambil_data['nama_bulan'] = array_search($list_bulan,$bulan,true);
            }        

            //tampil
            $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('pusat/v_pusat_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_navbar' , $ambil_data);
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_bulanan' , $ambil_data);
        }
        
    }

    function tampil_penjualan_varian_tahunan()
    {
        if($this->session->userdata('id_wilayah_distributor') != 5)
        {
            $id_wilayah_distributor = $this->session->userdata('id_wilayah_distributor');

            $list_tahun      = $this->input->post('list_tahun');
                    
            $where = array(            
                'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                'loading_barang.is_deleted' => 0
            );
                
            $ambil_data['data'] = $this->model_data->ambil_data_penjualan_varian($where); 
            $ambil_data['data_aktual'] = $this->model_data->ambil_data_penjualan_varian($where); 
            $ambil_data['list_tahun'] = $list_tahun;
                
            

            //tampil
            $this->load->view('admin/v_admin_side_navbar');        
            $this->load->view('admin/v_admin_top_navbar');         
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_navbar');
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_tahunan' , $ambil_data);
        }

        //PUSAT

        else
        {
            $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
            $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

            $list_tahun      = $this->input->post('list_tahun');
            
            if($id_wilayah_distributor != 6)
            {
                $where = array(            
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.id_wilayah_distributor' => $id_wilayah_distributor,
                    'loading_barang.is_deleted' => 0
                );
            }
            else
            {
                $where = array(            
                    'YEAR(loading_barang.tgl_loading)' => $list_tahun,
                    'loading_barang.is_deleted' => 0
                ); 
            }    
            $ambil_data['data'] = $this->model_data->ambil_data_penjualan_varian($where); 
            $ambil_data['list_tahun'] = $list_tahun;
            
            $ambil_data['id_wilayah_distributor'] = $id_wilayah_distributor;
            
            //tampil
            $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
            $this->load->view('pusat/v_pusat_top_navbar');       
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_navbar' , $ambil_data);
            $this->load->view('admin/data_admin/v_admin_data_penjualan_varian_tahunan' , $ambil_data);
        }
        
    }
    

}

?>