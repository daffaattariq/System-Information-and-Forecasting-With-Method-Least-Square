<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aksi_Pusat_Log_Varian extends CI_Controller {

	public function index()
	{	
        $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      
        $id_wilayah_distributor = $this->input->get('id_wilayah_distributor');

        //AMBIL DARI CODE AKSI ADMIN LOG VARIAN
                
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
        
        $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
        $this->load->view('pusat/v_pusat_top_navbar');               
        $this->load->view('pusat/data/log/v_log_pusat_data_varian' , $ambil_data);
    }

}

?>