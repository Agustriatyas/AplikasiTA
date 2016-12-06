<?php 
	class M_bo extends CI_Model{
		/**
		 * Fungsi ini digunakan untuk ambil data permohonan untuk di tampilkan di view back office
		 */
		function get_data_entry(){
			$query = $this->db->query("SELECT
					A.id_perm AS id_perm,
					A.no_pendaftaran AS no_pendaftaran,
					A.tgl_permohonan AS tgl_permohonan,
					A.jenis_permohonan AS jenis_permohonan,
					B.nama_lengkap AS nama_pemohon,
					C.nama_perusahaan AS nama_perusahaan 
					FROM tb_permohonan AS A

					INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					INNER JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					WHERE c_kasubid = 1 ORDER BY id_perm ASC");
    	return $query->result();  
		}

		/**
		 * Fungsi ini digunakan untuk ambil data permohonan untuk di tampilkan di view Pembuatan Izin
		 */
		function get_data_pembuatan_izin(){
			$query = $this->db->query("SELECT
					A.id_perm AS id_perm,
					A.no_pendaftaran AS no_pendaftaran,
					A.tgl_permohonan AS tgl_permohonan,
					A.jenis_permohonan AS jenis_permohonan,
					B.nama_lengkap AS nama_pemohon,
					C.nama_perusahaan AS nama_perusahaan 
					FROM tb_permohonan AS A

					INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					INNER JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					WHERE c_kabid = 1 ORDER BY id_perm ASC");
    	return $query->result();  
		}

		/**
		 * Fungsi ini digunakan untuk menyimpan data perizinan di table tb_dataperizinan
		 */
		function save($data_izin){
			$this->db->insert('tb_dataperizinan', $data_izin);			
		}

		function save_iddata($id_dataizin, $id_perm){
			$query = $this->db->query("UPDATE tb_permohonan SET id_dataizin = $id_dataizin WHERE id_perm = $id_perm");
		}

		function save_tracking($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Penjadwalan Tinjauan' WHERE id_perm = $id_perm");
		}
		/**
		 * Fungsi ini digunakan untuk mengambil data perizinan berdasarkan id_perm yang diberikan
		 */
		function get_perid($id_perm){
			$this->db->select('*')->from('tb_dataperizinan')->where('id_perm', $id_perm);
			$query = $this->db->get();
			return $query->first_row();
		}
		/**
		 * Fungsi ini digunakan untuk mengubah data perizinan di table tb_dataperizinan
		 */
		function edit_data($id_perm, $data){
			$this->db->where('id_perm', $id_perm);
			$this->db->update('tb_dataperizinan', $data);
			//$query = $this->db->query("UPDATE tb_dataperizinan SET open_file = 'Pendataan di Back Office selesai' WHERE id_perm = $id_perm");
		}

		function get_data_entry_tinjauan(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.nama_lengkap AS nama_pemohon,
				C.nama_perusahaan AS nama_perusahaan 
				FROM tb_permohonan AS A

				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				INNER JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
				WHERE c_kasubid = 1 AND id_tinjauan != 0 ORDER BY id_perm ASC");
    		return $query->result();  
		}
		/**
		 * Fungsi ini digunakan untuk menyimpan data perizinan hasil tinjauan di table tb_dataperizinan
		 */
		function save_data_tinjauan($id_data, $data_izin){
			$this->db->where('id_data', $id_data);
			$this->db->update('tb_dataperizinan', $data_izin);
			//$this->db->insert('tb_dataperizinan', $data_izin);			
		}
		function save_tracking_data_tinjauan($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Proses Perhitungan Retribusi' WHERE id_perm = $id_perm");
		}

		/**
		 * Fungsi ini digunakan untuk ambil data permohonan untuk di tampilkan di view perhitungan retribusi
		 */
		function get_data_retribusi(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.nama_lengkap AS nama_pemohon,
				C.nama_perusahaan AS nama_perusahaan 
				FROM tb_permohonan AS A

				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				INNER JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
				WHERE c_kasubid = 1 AND id_tinjauan != 0 ORDER BY id_perm ASC");
			return $query->result();  
		}

		/**
		 * Fungsi digunakan untuk ambil data detail bap untuk di tampilkan di view detail bap
		 */
		function get_detail_bap($id_perm = NULL){
			$query = $this->db->query("SELECT A.id_perm, A.no_pendaftaran,
					B.nama_lengkap, B.alamat, B.id_prop, B.id_kab, B.id_kec, B.id_kel,
					C.nama_perusahaan,
					D.thn_lahir, D.luas_tanah, D.status_tanah, D.pemilik_tanah, D.gsb, D.gsp, D.no_hak_milik, D.pekerjaan, D.kewarganegaraan, D.fungsi_bangunan, D.jenis_bangunan, D.gss, D.gsr, D.luas_bangunan_tutupan,
					D.thn_lahir_v, D.luas_tanah_v, D.status_tanah_v, D.pemilik_tanah_v, D.gsb_v, D.gsp_v, D.no_hak_milik_v, D.pekerjaan_v, D.kewarganegaraan_v, D.fungsi_bangunan_v, D.jenis_bangunan_v, D.gss_v, D.gsr_v, D.luas_bangunan_tutupan_v,
					E.tgl_tinjauan, E.no_surat_bap,
					F.nama_prop AS prop_pem, G.nama_kab AS kab_pem, H.nama_kec AS kec_pem, I.nama_kel AS kel_pem,
					K.nama_prop AS prop_lokasi, L.nama_kab AS kab_lokasi, M.nama_kec AS kec_lokasi, N.nama_kel AS kel_lokasi


					FROM tb_permohonan AS A
					LEFT JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					LEFT JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					LEFT JOIN tb_dataperizinan AS D ON D.id_perm = A.id_perm
					LEFT JOIN tb_peninjauan AS E ON E.id_peninjauan = A.id_tinjauan
					LEFT JOIN tb_lokasi AS J ON J.id_lokasi = A.id_lokasi
					LEFT JOIN wilayah_provinsi AS F ON F.id_prop = B.id_prop
					LEFT JOIN wilayah_kabupaten AS G ON G.id_kab = B.id_kab
					LEFT JOIN wilayah_kecamatan AS H ON H.id_kec = B.id_kec
					LEFT JOIN wilayah_desa AS I ON I.id_kel = B.id_kel
					LEFT JOIN wilayah_provinsi AS K ON K.id_prop = J.id_prop
					LEFT JOIN wilayah_kabupaten AS L ON L.id_kab = J.id_kab
					LEFT JOIN wilayah_kecamatan AS M ON M.id_kec = J.id_kec
					LEFT JOIN wilayah_desa AS N ON N.id_kel = J.id_kel

					WHERE A.id_perm = '$id_perm' ");
			return $query->result();  
		}

		/**
		 * Fungsi untuk update catatan bap di tb_permohonan berdasarkan id
		 */
		function update_permohonan($id_perm, $catatan){
			$query = $this->db->query("UPDATE tb_permohonan SET catatan = '$catatan' WHERE id_perm = $id_perm");
		}
		function save_tracking_pembuatan_bap($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Penetapan Izin Kabid' WHERE id_perm = $id_perm");
		}

	}
 ?>