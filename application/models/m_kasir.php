<?php 
	class M_kasir extends CI_Model{

		function get_data_pembayaran(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.no_identitas AS no_identitas,
				B.nama_lengkap AS nama_pemohon
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				WHERE c_kabid = 1 AND id_dataizin !=0 ORDER BY id_perm ASC");
    	return $query->result(); 
		}

		/**
		 * Fungsi untuk menampilkan data pembayaran di kasir
		 */
		function get_data_bayar($id_perm = NULL){
			$query = $this->db->query("SELECT A.id_perm, A.no_pendaftaran,
					B.nama_lengkap,
					C.nilai_retribusi,
					C.status
					FROM tb_permohonan AS A
					LEFT JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					LEFT JOIN tb_retribusi AS C ON C.id_perm = A.id_perm

					WHERE A.id_perm = '$id_perm' ");
			return $query->result();  
		}

		/**
		 * Fungsi untuk mengubah status pembayaran retribusi
		 */
		function update_retribusi($id_perm, $status_bayar){
			$query = $this->db->query("UPDATE tb_retribusi SET status = '$status_bayar' WHERE id_perm = $id_perm"); 
		}
		function save_tracking($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Izin Selesai' WHERE id_perm = $id_perm");
		}
	}
 ?>