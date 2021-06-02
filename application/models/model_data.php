<?php

class Model_Data extends CI_Model
{
		function insert($data,$table)
		{
			return $this->db->insert($table,$data);
		}
		function cek($where,$table)
		{
			$query = $this->db->get_where($table,$where);
			return $query->row_array();
        }
        function ambil_user($where,$table)
		{
			$query = $this->db->get_where($table,$where);
			return $query->row_array();
		}
		function ambil_data_varian ($where)
		{
			$this->db->select('*');
			$this->db->from('varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=varian.id_wilayah_distributor');
			$this->db->where($where);
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			// print_r($this->db->last_query()); 
			return $data;
		}
		
		function ambil_data_loading_barang ($where)
		{
			$this->db->select('*');
			$this->db->from('loading_barang');
			$this->db->join('sales','sales.id_sales=loading_barang.id_sales');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=loading_barang.id_wilayah_distributor');
			$this->db->where($where);
			$this->db->order_by('tgl_loading','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			// print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_detail_loading ($where)
		{
			$this->db->select('*');
			$this->db->from('loading_barang');
			$this->db->join('sales','sales.id_sales=loading_barang.id_sales');		
			$this->db->join('detail_loading','detail_loading.id_loading=loading_barang.id_loading');
			$this->db->join('varian','varian.id_varian=detail_loading.id_varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');	
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=loading_barang.id_wilayah_distributor');
			$this->db->where($where);
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_penjualan_varian ($where)
		{
			$this->db->select('detail_loading.id_detail_loading , nama_wilayah , produk.nama_produk, varian.jenis_varian , sum(detail_loading.jumlah_pesanan) as total');
			$this->db->from('loading_barang');			
			$this->db->join('detail_loading','detail_loading.id_loading=loading_barang.id_loading');
			$this->db->join('varian','varian.id_varian=detail_loading.id_varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');	
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=loading_barang.id_wilayah_distributor');
			$this->db->where($where);
			$this->db->group_by('detail_loading.id_varian');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			// print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_sales ($where)
		{
			$this->db->select('*');
			$this->db->from('sales');				
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=sales.id_wilayah_distributor');
			$this->db->where($where);
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_produk($where_produk)
		{
			$query = $this->db->get_where('produk',$where_produk);			
			return $query->result_array();
		}
		function ambil_data_where($table,$where_produk)
		{
			$query = $this->db->get_where($table,$where_produk);			
			return $query->result_array();
		}
		function delete_varian($where,$table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}
		function ambil_data_result($table)
		{
			$query = $this->db->get($table);
			return $query->result_array();
		}
		function edit_data($where,$data,$table)
		{		
			$this->db->where($where);
			$this->db->update($table,$data);
			
		}
		function delete_data($where,$table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}

		//PERAMALAN
		function ambil_data_peramalan($tgl_input , $list_id_varian, $tgl_calculated , $id_wilayah_distributor)
		{
			

			$sql = "SELECT `detail_loading`.`id_detail_loading`, `produk`.`nama_produk`, 
			`varian`.`jenis_varian`, sum(detail_loading.jumlah_pesanan) as total , 
			YEAR(loading_barang.tgl_loading) as year , MONTH(loading_barang.tgl_loading) as month 
			FROM `loading_barang` 
			JOIN `detail_loading` ON `detail_loading`.`id_loading`=`loading_barang`.`id_loading` 
			JOIN `varian` ON `varian`.`id_varian`=`detail_loading`.`id_varian` 
			JOIN `produk` ON `produk`.`id_produk`=`varian`.`id_produk` 
			JOIN `wilayah_distributor` ON `wilayah_distributor`.`id_wilayah_distributor`=`loading_barang`.`id_wilayah_distributor` 
			WHERE loading_barang.tgl_calculated 
			BETWEEN Date_format(DATE_ADD('$tgl_input', INTERVAL -9 MONTH),'%Y%m') AND '$tgl_calculated' 
			AND `loading_barang`.`id_wilayah_distributor` = $id_wilayah_distributor 
			AND `loading_barang`.`is_deleted` = 0 
			AND `varian`.`id_varian`= $list_id_varian 
			GROUP BY `detail_loading`.`id_varian` , YEAR(loading_barang.tgl_loading ) ,MONTH(loading_barang.tgl_loading)";
			$result = $this->db->query($sql);
			$data= $result->result_array();
			// print_r($this->db->last_query()); 
			return $data;
		}

		function ambil_data_chart_penjualan($tgl_awal ,$tgl_akhir , $id_wilayah_distributor , $list_id_varian)
		{

			$sql = "SELECT * FROM `data_chart` 
			WHERE tgl_calculated BETWEEN $tgl_awal and $tgl_akhir 
			and id_wilayah_distributor = $id_wilayah_distributor 
			and id_varian = $list_id_varian";

			$result = $this->db->query($sql);
			$data= $result->result_array();
			print_r($this->db->last_query()); 
			return $data;
		}

		// function ambil_data_peramalan($tgl_input , $list_id_varian)
		// {
			

		// 	$sql = "SELECT `detail_loading`.`id_detail_loading`, `produk`.`nama_produk`, `varian`.`jenis_varian`, sum(detail_loading.jumlah_pesanan) as total ,
		// 	YEAR(loading_barang.tgl_loading) as year , MONTH(loading_barang.tgl_loading) as month
		// 	FROM `loading_barang` 
		// 	JOIN `detail_loading` ON `detail_loading`.`id_loading`=`loading_barang`.`id_loading` 
		// 	JOIN `varian` ON `varian`.`id_varian`=`detail_loading`.`id_varian` 
		// 	JOIN `produk` ON `produk`.`id_produk`=`varian`.`id_produk` 
		// 	JOIN `wilayah_distributor` ON `wilayah_distributor`.`id_wilayah_distributor`=`loading_barang`.`id_wilayah_distributor` 
		// 	WHERE loading_barang.tgl_loading 
		// 	BETWEEN DATE_ADD('$tgl_input', INTERVAL -11 MONTH) AND '$tgl_input'
		// 	AND `loading_barang`.`id_wilayah_distributor` = '1' AND `loading_barang`.`is_deleted` = 0 
		// 	AND `varian`.`id_varian`= $list_id_varian
		// 	GROUP BY `detail_loading`.`id_varian` , YEAR(loading_barang.tgl_loading ) ,MONTH(loading_barang.tgl_loading)";
		// 	$result = $this->db->query($sql);
		// 	$data= $result->result_array();
		// 	print_r($this->db->last_query()); 
		// 	return $data;
		// }

		//AKSI LOG
		function ambil_data_log_varian ($where)
		{
			$this->db->select('*');
			$this->db->from('varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=varian.id_wilayah_distributor');
			$this->db->join('log_varian','log_varian.id_varian=varian.id_varian');		
			$this->db->where($where);
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_log_sales ($where)
		{
			$this->db->select('*');
			$this->db->from('sales');				
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=sales.id_wilayah_distributor');
			$this->db->join('log_sales','log_sales.id_sales=sales.id_sales');	
			$this->db->where($where);
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_log_varian_all ()
		{
			$this->db->select('*');
			$this->db->from('varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=varian.id_wilayah_distributor');
			$this->db->join('log_varian','log_varian.id_varian=varian.id_varian');		
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_log_sales_all ()
		{
			$this->db->select('*');
			$this->db->from('sales');				
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=sales.id_wilayah_distributor');
			$this->db->join('log_sales','log_sales.id_sales=sales.id_sales');	
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_log_loading ($where)
		{
			$this->db->select('*');			
			$this->db->from('loading_barang');
			$this->db->join('sales','sales.id_sales=loading_barang.id_sales');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=loading_barang.id_wilayah_distributor');			
			$this->db->join('log_loading','log_loading.id_loading=loading_barang.id_loading');		
			$this->db->where($where);
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}

		//AKSI RECENT DELETE

		function ambil_data_recent_delete_varian ($where)
		{
			$this->db->select('*');
			$this->db->from('varian');
			$this->db->join('produk','produk.id_produk=varian.id_produk');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=varian.id_wilayah_distributor');
			$this->db->join('log_varian','log_varian.id_varian=varian.id_varian');		
			$this->db->where($where);
			$this->db->group_by('varian.id_varian');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_recent_delete_sales ($where)
		{
			$this->db->select('*');
			$this->db->from('sales');				
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=sales.id_wilayah_distributor');
			$this->db->join('log_sales','log_sales.id_sales=sales.id_sales');	
			$this->db->where($where);
			$this->db->group_by('sales.id_sales');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		function ambil_data_recent_delete_loading ($where)
		{
			$this->db->select('*');
			$this->db->from('loading_barang');
			$this->db->join('sales','sales.id_sales=loading_barang.id_sales');		
			$this->db->join('wilayah_distributor','wilayah_distributor.id_wilayah_distributor=loading_barang.id_wilayah_distributor');			
			$this->db->join('log_loading','log_loading.id_loading=loading_barang.id_loading');		
			$this->db->where($where);			
			$this->db->group_by('loading_barang.id_loading');
			$this->db->order_by('tgl_aksi','desc');
			$query=$this->db->get();			
			$data= $query->result_array();
			// print_r($data);
			print_r($this->db->last_query()); 
			return $data;
		}
		// function ambil_data_where($where,$table)
		// {
		// 	$query = $this->db->get_where($table,$where);
		// 	return $query->result_array();
        // }
}

?>