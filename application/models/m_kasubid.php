<?php 
	class M_kasubid extends CI_Model{
		/**
		 * Fungsi ini digunakan untuk ambil data permohonan untuk di tampilkan di view kasubid
		 */
		function get_app_kasubid(){
			$query = $this->db->query("SELECT
					A.id_perm AS id_perm,
					A.no_pendaftaran AS no_pendaftaran,
					A.tgl_permohonan AS tgl_permohonan,
					A.jenis_permohonan AS jenis_permohonan,
					B.no_identitas AS no_identitas,
					B.nama_lengkap AS nama_pemohon
					FROM tb_permohonan AS A
					INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					WHERE c_kasubid = 0 ORDER BY id_perm DESC");
        	return $query->result();  
		}
		/**
		 * Fungsi ini digunakan untuk mengubah c_kasubid di tb_permohonan menjadi 1 sebagai tanda bahwa 
		 * permohonan telah di approve oleh kasubid
		 */
		function approve_kasubid($id_perm = NULL){
			$query = $this->db->query("UPDATE tb_permohonan SET c_kasubid = 1 WHERE id_perm = $id_perm ");
			$query2 = $this->db->query("UPDATE tb_tracking SET open_file = 'Entry Data di Back Office' WHERE id_perm = $id_perm");
		}
		/**
		 * Fungsi ini digunakan untuk menghapus data permohonan oleh Kasubid (sama dengan hapus di FO)
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
	}
 ?>