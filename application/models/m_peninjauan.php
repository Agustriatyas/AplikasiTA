<?php 
	class M_peninjauan extends CI_Model{
		function get_data_tinjauan(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.no_identitas AS no_identitas,
				B.nama_lengkap AS nama_pemohon,
				C.isdisable
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				LEFT JOIN tb_peninjauan AS C ON C.id_peninjauan = A.id_tinjauan
				WHERE c_kasubid = 1 AND id_dataizin !=0 ORDER BY id_perm ASC");
    	return $query->result(); 
		}

		function save($data_survey){
			$this->db->insert('tb_peninjauan', $data_survey);			
		}

		function update_isdisable($id_tinjauan){
			$this->db->query("UPDATE tb_peninjauan SET isdisable = 1 WHERE id_peninjauan = $id_tinjauan");
		}

		function save_idtinjauan($id_tinjauan, $id_perm){
			$query = $this->db->query("UPDATE tb_permohonan SET id_tinjauan = $id_tinjauan WHERE id_perm = $id_perm");
		}

		function save_tracking($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Proses Peninjauan' WHERE id_perm = $id_perm");
		}
	}
 ?>