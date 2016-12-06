<?php 
	class M_fo extends CI_Model{
		/**
		 * Fungsi ini digunakan untuk mengambil data jenis permohonan dari table tb_jenis_permohonan
		 * untuk ditampilkan di dropdown input data permohonan
		 */
		function get_jenis_permohonan(){
        	$query = $this->db->query("SELECT * FROM tb_jenis_permohonan");
        	return $query->result();  
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data propinsi dari table wilayah_provinsi
		 * untuk ditampilkan di dropdown Propinsi input data permohonan
		 */
		function get_propinsi(){
        	$query = $this->db->query("SELECT * FROM wilayah_provinsi ORDER BY nama_prop ASC");
        	return $query->result();  
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data syarat dari table tb_syarat untuk ditampilkan di view
		 * persyaratan input data permohonan berdasarkan jenis_permohonan (ID) yang diberikan
		 */
		function get_syarat($id){			
        	$sql = "SELECT DISTINCT * FROM tb_syarat WHERE stat='$id'";
        	$query = $this->db->query($sql);
        	return $query->result();
    	}

		/**
		 * Fungsi ini digunakan untuk insert data ke table tb_pemohon, tb_perusahaan, tb_lokasi
		 */
		function save($pemohon,$perusahaan,$lokasi){
			$this->db->insert('tb_pemohon', $pemohon);
			$this->db->insert('tb_perusahaan', $perusahaan);
			$this->db->insert('tb_lokasi', $lokasi);
		}

		/**
		 * Fungsi ini digunakan untuk insert data ke table tb_permohonan
		 */
		function save_permohonan($permohonan){
			$this->db->insert('tb_permohonan', $permohonan);
		}

		/**
		 * Fungsi ini digunakan untuk insert data ke table tb_tracking
		 */
		function save_tracking($tracking){
			$this->db->insert('tb_tracking', $tracking);
		}

		//DATA PERMOHONAN

		/**
		 * Fungsi ini digunakan untuk ambil data permohonan untuk di tampilkan di tabel view
		 */
		function get_data_permohonan(){
			$query = $this->db->query("SELECT
					A.id_perm AS id_perm,
					A.no_pendaftaran AS no_pendaftaran,
					A.tgl_permohonan AS tgl_permohonan,
					A.jenis_permohonan AS jenis_permohonan,
					B.no_identitas AS no_identitas,
					B.nama_lengkap AS nama_pemohon
					FROM tb_permohonan AS A
					INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					WHERE c_kasubid = 0 ORDER BY id_perm ASC");
        	return $query->result();  
		}

		/**
		 * Fungsi ini digunakan untuk menghapus data permohonan
		 */
		function del($id){
			$query = $this->db->query("SELECT A.id_perm, B.id_pemohon, C.id_perusahaan, D.id_lokasi, E.id_perm AS idperm_in_syarat, F.id_perm AS idperm_in_tracking 
					FROM tb_permohonan AS A 
					LEFT JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					LEFT JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					LEFT JOIN tb_lokasi AS D ON D.id_lokasi = A.id_lokasi
					LEFT JOIN tb_syarat AS E ON E.id_perm = A.id_perm
					LEFT JOIN tb_tracking AS F ON F.id_perm = A.id_perm
					WHERE A.id_perm = '$id' ");
			foreach ($query->result() as $row){
	   			$row->id_perm;
	   			$row->id_pemohon;
	   			$row->id_perusahaan;
	   			$row->id_lokasi;
			}
			$id_perm = $row->id_perm;
			$id_pemohon = $row->id_pemohon;
			$id_perusahaan = $row->id_perusahaan;
			$id_lokasi = $row->id_lokasi;

        	$this->db->where('id_perm', $id_perm);
			$this->db->delete('tb_permohonan');

        	$this->db->where('id_pemohon', $id_pemohon);
			$this->db->delete('tb_pemohon');

        	$this->db->where('id_perusahaan', $id_perusahaan);
			$this->db->delete('tb_perusahaan');

        	$this->db->where('id_lokasi', $id_lokasi);
			$this->db->delete('tb_lokasi');

        	$this->db->where('id_perm', $id_perm);
			$this->db->delete('tb_syarat');

        	$this->db->where('id_perm', $id_perm);
			$this->db->delete('tb_tracking');
		}

		function get_perid($id){
			// // $this->db->select('*')->from('tb_permohonan')->where('id_perm', $id);
			// $this->db->select('*');
			// $this->db->from('blogs');
			// $this->db->join('comments', 'comments.id = blogs.id');

			$this->db->select('*');
			$this->db->from('tb_permohonan');
			$this->db->join('tb_pemohon', 'tb_pemohon.id_pemohon = tb_permohonan.id_pemohon');
			$this->db->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_permohonan.id_perusahaan');
			$this->db->where('tb_permohonan.id_perm', $id);

			$query = $this->db->get();
			return $query->first_row();
		}

		function get_jenis_izin($id){
			$this->db->select('jenis_permohonan');
			$this->db->from('tb_permohonan');
			$this->db->where('id_perm', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		
	}

 ?>