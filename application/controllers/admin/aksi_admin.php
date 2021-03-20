<?php

class Aksi_Admin extends CI_Controller
{
    function index()
    {        
    	$this->load->view('admin/v_admin_side_navbar' );        
        $this->load->view('admin/v_admin_top_navbar');         
        $this->load->view('admin/v_admin_dashboard');
        
    }
}