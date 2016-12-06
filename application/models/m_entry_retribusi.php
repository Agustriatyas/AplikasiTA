<?php 
	class M_entry_retribusi extends CI_Model{
		
		function get_data_entry(){
			$query = $this->db->query("SELECT id_ret,id_perm,nilai_retribusi,status FROM tb_retribusi");
    		return $query->result();  
		}

		//Begin list detail data retribusi
		function get_detail_perm($id_perm = NULL){
			$query = $this->db->query("SELECT 
											a.id_perm
											,no_pendaftaran
											,tgl_permohonan
											,nama_lengkap
											,jenis_permohonan
											,peruntukan
											,alamat
											,nama_kel
											,nama_kec
											,nama_kab
											,nama_prop
										FROM 
										tb_permohonan a
										INNER JOIN tb_pemohon b ON a.id_pemohon = b.id_pemohon
										LEFT JOIN wilayah_desa d ON b.id_kel = d.id_kel
										LEFT JOIN wilayah_kecamatan e ON b.id_kec = e.id_kec
										LEFT JOIN wilayah_kabupaten f ON b.id_kab = f.id_kab
										LEFT JOIN wilayah_provinsi g ON b.id_prop = g.id_prop
										WHERE 1=1
											AND a.id_perm = '$id_perm'
										");
    		return $query->result(); 
		}
		// End retribusi 

		function save($data_retribusi,$txtTotal){
			// var_dump($data_retribusi);
			foreach ($data_retribusi as $row){
			// var_dump($row["id_perm"]);
			$id_perm = $row['id_perm'];
			$luas = $row['luas'];
			$harga_satuan = $row['harga_satuan'];
			$jenis_bangunan = $row['jenis_bangunan'];
			$jumlah = $row['jumlah'];
			$query = $this->db->query("INSERT INTO 
											TB_DETAILRETRIBUSI
											(
												ID_PERM
												,LUAS
												,HARGA_SATUAN
												,JENIS_BANGUNAN
												,JUMLAH
											)
											VALUES
											(
												$id_perm
												,'$luas'
												,'$harga_satuan'
												,'$jenis_bangunan'
												,'$jumlah'
											)");
			}
			$query = $this->db->query("INSERT INTO 
											TB_RETRIBUSI
											(
												ID_PERM
												,NILAI_RETRIBUSI
												,STATUS
											)
											VALUES
											(
												$id_perm
												,'$txtTotal'
												,'Belum Bayar'
											)");
			
		}

		//cetak SKR
		function cetak_SKR(){
			$query = $this->db->query("SELECT * FROM tb_detailretribusi WHERE id_perm = '$id_perm' ");
    	return $query->result(); 
		}
	}
 ?>