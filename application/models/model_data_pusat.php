<?php

class Model_Data_Pusat extends CI_Model
{
    function ambil_data($table)
		{
			$query = $this->db->get($table);
			return $query->result_array();
		}

}

?>