<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aksi_Pusat extends CI_Controller {

	public function index()
	{	
        $data_wilayah['wilayah'] = $this->model_data_pusat->ambil_data('wilayah_distributor');
                      

        $this->load->view('pusat/v_pusat_side_navbar'  , $data_wilayah);        
        $this->load->view('pusat/v_pusat_top_navbar');         
        $this->load->view('pusat/v_pusat_dashboard');	
        
	}

}
?>