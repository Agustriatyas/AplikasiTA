<?php 
	class M_laporan extends CI_Model{
		/**
		 * Fungsi untuk menampilkan laporan pendaftaran
		 */
		function lap_pendaftaran(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				B.nama_lengkap AS nama_pemohon,
				C.open_file AS status_perm, C.d_entry AS d_entry
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				LEFT JOIN tb_tracking AS C ON C.id_perm = A.id_perm
				");
    	return $query->result(); 
		}

		/**
		 * Fungsi untuk menampilkan laporan penerimaan
		 */
		function lap_penerimaan(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.no_identitas AS no_identitas,
				B.nama_lengkap AS nama_pemohon,
				C.nilai_retribusi AS nilai_ret,
				C.status AS status
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				LEFT JOIN tb_retribusi AS C ON C.id_perm = A.id_perm
				");
    	return $query->result(); 
		}

		function lap_pendaftaran2(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				B.nama_lengkap AS nama_pemohon,
				C.open_file AS status_perm, C.d_entry AS d_entry
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				LEFT JOIN tb_tracking AS C ON C.id_perm = A.id_perm
				ORDER BY tgl_permohonan DESC
				");
    	return $query->result(); 
		}

		function lap_penerimaan2(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.no_identitas AS no_identitas,
				B.nama_lengkap AS nama_pemohon,
				C.nilai_retribusi AS nilai_ret,
				C.status AS status
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				LEFT JOIN tb_retribusi AS C ON C.id_perm = A.id_perm
				ORDER BY tgl_permohonan DESC
				");
    	return $query->result(); 
		}
	}
 ?>