<?php 
	class M_kabid extends CI_Model{

		function get_data_tinjauan(){
			$query = $this->db->query("SELECT
				A.id_perm AS id_perm,
				A.no_pendaftaran AS no_pendaftaran,
				A.tgl_permohonan AS tgl_permohonan,
				A.jenis_permohonan AS jenis_permohonan,
				B.no_identitas AS no_identitas,
				B.nama_lengkap AS nama_pemohon
				FROM tb_permohonan AS A
				INNER JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
				WHERE c_kasubid = 1 AND id_dataizin !=0 ORDER BY id_perm ASC");
    	return $query->result(); 
		}

		/** 
		 * Fungsi ambil data penetapan
		 */
		function get_data_penetapan($id_perm = NULL){
			$query = $this->db->query("SELECT A.id_perm, A.no_pendaftaran,
					B.nama_lengkap, B.alamat, B.id_prop, B.id_kab, B.id_kec, B.id_kel,
					C.nama_perusahaan,
					D.thn_lahir, D.luas_tanah, D.status_tanah, D.pemilik_tanah, D.gsb, D.gsp, D.no_hak_milik, D.pekerjaan, D.kewarganegaraan, D.fungsi_bangunan, D.jenis_bangunan, D.gss, D.gsr, D.luas_bangunan_tutupan,
					D.thn_lahir_v, D.luas_tanah_v, D.status_tanah_v, D.pemilik_tanah_v, D.gsb_v, D.gsp_v, D.no_hak_milik_v, D.pekerjaan_v, D.kewarganegaraan_v, D.fungsi_bangunan_v, D.jenis_bangunan_v, D.gss_v, D.gsr_v, D.luas_bangunan_tutupan_v,
					E.tgl_tinjauan, E.no_surat_bap,
					F.nama_prop AS prop_pem, G.nama_kab AS kab_pem, H.nama_kec AS kec_pem, I.nama_kel AS kel_pem,
					K.nama_prop AS prop_lokasi, L.nama_kab AS kab_lokasi, M.nama_kec AS kec_lokasi, N.nama_kel AS kel_lokasi
					,A.status_izin, O.nilai_retribusi

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
					LEFT JOIN tb_retribusi AS O ON O.id_perm = A.id_perm

					WHERE A.id_perm = '$id_perm' ");
			return $query->result();  
		}

		/**
		 * Fungsi untuk update status izin di tb_permohonan berdasarkan id
		 */
		function update_permohonan($id_perm, $status_izin){
			$query = $this->db->query("UPDATE tb_permohonan SET status_izin = '$status_izin', c_kabid = 1 WHERE id_perm = $id_perm");
		}
		function save_tracking($id_perm){
			$query = $this->db->query("UPDATE tb_tracking SET open_file = 'Pembuatan Izin' WHERE id_perm = $id_perm");
		}
	}
 ?>