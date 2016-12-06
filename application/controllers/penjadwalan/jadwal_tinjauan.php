<?php 
	class Jadwal_tinjauan extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_peninjauan');			
    	}
		/**
		 * Fungsi ini digunakan untuk menmpilkan data permohonan yang telah di approve oleh kasubid
		 * dan sudah dapat di olah di back office.
		 */
		function index(){
			$entry_tinjauan = $this->m_peninjauan->get_data_tinjauan();
			$this->load->view('penjadwalan/v_entry_peninjauan',array('entry_tinjauan'=>$entry_tinjauan));
		}

		function entry_tinjauan($id_perm = NULL){
			$id_perm = $id_perm;
			// tgl daftar
			$query = $this->db->query("SELECT tgl_permohonan from tb_permohonan WHERE id_perm = $id_perm");
				foreach ($query->result() as $row){
		   			$row->tgl_permohonan;
				}
			$tgl_daftar = $row->tgl_permohonan;
			$this->load->view('penjadwalan/entry_tinjauan', array('id_perm'=>$id_perm,'tgl_daftar'=>$tgl_daftar));
		}

		function insert_tinjauan(){
			if($_POST){
				$data_survey = array(
					'tgl_terima_berkas'=>$this->input->post('tgl_terima_berkas'),
					'tgl_tinjauan'=>$this->input->post('tgl_peninjauan'),
					'no_surat_bap'=>$this->input->post('no_surat_bap'),
					'tim_pemeriksa'=>$this->input->post('tim_pemeriksa'),
				);
				/**
				 * Simpan Data Peninjauan
				 */
				$this->m_peninjauan->save($data_survey);

				$query = $this->db->query("SELECT * from tb_peninjauan ORDER BY id_peninjauan DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_peninjauan;
				}
				$id_data = $row->id_peninjauan;

				$id_tinjauan = $id_data;
				$id_perm = $this->input->post('id_perm');
				// die($id_tinjauan);
				$this->m_peninjauan->save_idtinjauan($id_tinjauan,$id_perm);
				$this->m_peninjauan->update_isdisable($id_tinjauan);
				$this->m_peninjauan->save_tracking($id_perm);

				redirect('penjadwalan/jadwal_tinjauan');
			}else{
				// $data['action'] = base_url().'/index.php/back_office/entry_data/insert/';
				// $data['data_perizinan'] = '';
				// $this->load->view('back_office/v_form_entry', $data);
				redirect('penjadwalan/jadwal_tinjauan');
			}
		}

		/**
		 * Fungsi cetak SP
		 */
		function cetak_sp($id_perm = NULL){
			$this->load->library('PHPWord');
  			$document = $this->phpword->loadTemplate('application/docs/temp/SP.docx');

			$query = $this->db->query("SELECT A.id_perm, A.jenis_permohonan, A.tgl_permohonan, 
				A.peruntukan, A.no_pendaftaran, B.nama_lengkap, B.jenis_identitas, B.no_identitas, C.nama_perusahaan, 
				D.id_lokasi, E.nama_prop AS prop_izin, F.nama_kab AS kab_izin, G.nama_kec AS kec_izin, 
				H.nama_kel AS kel_izin, D.alamat_lengkap AS alamat_izin, B.alamat AS alamat_pem, 
				I.nama_prop AS prop_pem, J.nama_kab AS kab_pem, K.nama_kec AS kec_pem, L.nama_kel AS kel_pem
					
					FROM tb_permohonan AS A 
					LEFT JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					LEFT JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					LEFT JOIN tb_lokasi AS D ON D.id_lokasi = A.id_lokasi
					LEFT JOIN wilayah_provinsi AS E ON E.id_prop = D.id_prop
					LEFT JOIN wilayah_kabupaten AS F ON F.id_kab = D.id_kab
					LEFT JOIN wilayah_kecamatan AS G ON G.id_kec = D.id_kec
					LEFT JOIN wilayah_desa AS H ON H.id_kel = D.id_kel

					LEFT JOIN wilayah_provinsi AS I ON I.id_prop = B.id_prop
					LEFT JOIN wilayah_kabupaten AS J ON J.id_kab = B.id_kab
					LEFT JOIN wilayah_kecamatan AS K ON K.id_kec = B.id_kec
					LEFT JOIN wilayah_desa AS L ON L.id_kel = B.id_kel

					WHERE A.id_perm = '$id_perm' ");
				foreach ($query->result() as $row){
		   			$tgl_daftar = $row->tgl_permohonan;
		   			$nama_pemohon = $row->nama_lengkap;
		   			$prop_i = $row->prop_izin;
		   			$kab_i = $row->kab_izin;
		   			$kec_i = $row->kec_izin;
		   			$kel_i = $row->kel_izin;
		   			$almt_i = $row->alamat_izin;
				}
				$lokasi_izin = $almt_i." Kel. ".$kel_i." Kec.".$kec_i." ".$kab_i." Prop. ".$prop_i;

				$tgl_sekarang = date('Y-m-d');
				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$date = $tgl_sekarang;
				$tahun = substr($date, 0, 4);
				$bulan = substr($date, 5, 2);
				$tgl = substr($date, 8, 2);
				$tgl_sekarang_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;

				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$date = $tgl_daftar;
				$tahun = substr($date, 0, 4);
				$bulan = substr($date, 5, 2);
				$tgl = substr($date, 8, 2);
				$tgl_daftar_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;

				
				$document->setValue('nama_pemohon',$nama_pemohon);
				// $document->setValue('tgl_keluar',$tgl_sekarang);
				$document->setValue('tgl_keluar',$tgl_sekarang_format);
				$document->setValue('alamat_perusahaan',$lokasi_izin);
				// $document->setValue('tgl_daftar',$tgl_daftar);
				$document->setValue('tgl_daftar',$tgl_daftar_format);

			  //query 1
			  $query1 = $this->db->query("SELECT * FROM tb_permohonan WHERE id_perm = '$id_perm' ");
				foreach ($query1->result() as $row1){
		   			$id_tinjauan = $row1->id_tinjauan;
				}

			  //query 2
			  $query2 = $this->db->query("SELECT * FROM tb_peninjauan WHERE id_peninjauan = '$id_tinjauan' ");
				foreach ($query2->result() as $row2){
		   			$id_peninjauan = $row2->id_peninjauan;
		   			$tgl_terima_berkas = $row2->tgl_terima_berkas;
		   			$tgl_tinjauan =$row2->tgl_tinjauan;
		   			$no_surat_bap = $row2->no_surat_bap;
		   			$tim_pemeriksa = $row2->tim_pemeriksa;
				}

				$document->setValue('nomor_sp',$no_surat_bap);
				$document->setValue('tim_pemeriksa',$tim_pemeriksa);

				$filename = 'SP.docx';
				$document->save($filename);
				header('Content-Description: File Transfer');
				header('Content-type: application/force-download');
				header('Content-Disposition: attachment; filename='.basename($filename));
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($filename));
				readfile($filename);
		}

		/**
		 * Fungsi cetak BAP
		 */
		function cetak_bap($id_perm = NULL){
			$this->load->library('PHPWord');
  			$document = $this->phpword->loadTemplate('application/docs/temp/BAP_sebelum.docx');

			$query = $this->db->query("SELECT A.id_perm,  A.peruntukan, A.id_pemohon, A.id_lokasi, A.id_tinjauan,
					B.pemilik_tanah, B.thn_lahir, B.pekerjaan, B.kewarganegaraan, B.luas_bangunan_tutupan, B.no_hak_milik, B.gsb, B.gsp, B.gss, B.jenis_bangunan,
					C.nama_lengkap, C.alamat, C.id_prop, C.id_kab, C.id_kec, C.id_kel,
					D.id_prop, D.id_kab, D.id_kec, D.id_kel, D.alamat_lengkap,
					E.tgl_tinjauan, E.tim_pemeriksa,
					F.nama_prop AS prop_lokasi, G.nama_kab AS kab_lokasi, H.nama_kec AS kec_lokasi, I.nama_kel AS kel_lokasi,
					J.nama_prop AS prop_pem, K.nama_kab AS kab_pem, L.nama_kec AS kec_pem, M.nama_kel AS kel_pem

					FROM tb_permohonan AS A
					LEFT JOIN tb_dataperizinan AS B ON B.id_perm = A.id_perm
					LEFT JOIN tb_pemohon AS C ON C.id_pemohon = A.id_pemohon
					LEFT JOIN tb_lokasi AS D ON D.id_lokasi = A.id_lokasi
					LEFT JOIN tb_peninjauan AS E ON E.id_peninjauan = A.id_tinjauan
					LEFT JOIN wilayah_provinsi AS F ON F.id_prop = D.id_prop
					LEFT JOIN wilayah_kabupaten AS G ON G.id_kab = D.id_kab
					LEFT JOIN wilayah_kecamatan AS H ON H.id_kec = D.id_kec
					LEFT JOIN wilayah_desa AS I ON I.id_kel = D.id_kel
					LEFT JOIN wilayah_provinsi AS J ON J.id_prop = C.id_prop
					LEFT JOIN wilayah_kabupaten AS K ON K.id_kab = C.id_kab
					LEFT JOIN wilayah_kecamatan AS L ON L.id_kec = C.id_kec
					LEFT JOIN wilayah_desa AS M ON M.id_kel = C.id_kel

					WHERE A.id_perm = '$id_perm' ");
				foreach ($query->result() as $row){
		   			$peruntukan = $row->peruntukan;
		   			$pemilik_tanah = $row->pemilik_tanah;
		   			$thn_lahir = $row->thn_lahir;
		   			$pekerjaan = $row->pekerjaan;
		   			$kewarganegaraan = $row->kewarganegaraan;
		   			$luas_bangunan_tutupan = $row->luas_bangunan_tutupan;
		   			$no_hak_milik = $row->no_hak_milik;
		   			$gsb = $row->gsb;
		   			$gsp = $row->gsp;
		   			$gss = $row->gss;
		   			$jenis_bangunan = $row->jenis_bangunan;
		   			$nama_lengkap = $row->nama_lengkap;
		   			$alamat = $row->alamat;
		   			$alamat_lengkap = $row->alamat_lengkap;
		   			$tgl_tinjauan = $row->tgl_tinjauan;
		   			$tim_pemeriksa = $row->tim_pemeriksa;
		   			$prop_lokasi = $row->prop_lokasi;
		   			$kab_lokasi = $row->kab_lokasi;
		   			$kec_lokasi = $row->kec_lokasi;
		   			$kel_lokasi = $row->kel_lokasi;
		   			$prop_pem = $row->prop_pem;
		   			$kab_pem = $row->kab_pem;
		   			$kec_pem = $row->kec_pem;
		   			$kel_pem = $row->kel_pem;
				}
				$lokasi_izin = $alamat_lengkap." Kel. ".$kel_lokasi." Kec.".$kec_lokasi." ".$kab_lokasi." Prop. ".$prop_lokasi;
				$alamat_pemohon = $alamat." Kel. ".$kel_pem." Kec.".$kec_pem." ".$kab_pem." Prop. ".$prop_pem;

				$tgl_sekarang = date('Y-m-d');

				$document->setValue('tgl_tinjauan',$tgl_tinjauan);
				$document->setValue('tim_pemeriksa',$tim_pemeriksa);
				$document->setValue('nama_pemohon',$nama_lengkap);
				$thn_sekarang = date('Y');
				$umur = $thn_sekarang-$thn_lahir;
				$document->setValue('umur',$umur);
				$document->setValue('pekerjaan',$pekerjaan);
				$document->setValue('alamat_pemohon',$alamat_pemohon);
				$document->setValue('kewarganegaraan',$kewarganegaraan);
				$document->setValue('kel_lokasi',$kel_lokasi);
				$document->setValue('kec_lokasi',$kec_lokasi);
				$document->setValue('kab_lokasi',$kab_lokasi);
				$document->setValue('prop_lokasi',$prop_lokasi);
				$document->setValue('peruntukan',$peruntukan);
				$document->setValue('luas_bangunan_tutupan',$luas_bangunan_tutupan);
				$document->setValue('pemilik_tanah',$pemilik_tanah);
				$document->setValue('no_hak_milik',$no_hak_milik);
				$document->setValue('gsp',$gsp);
				$document->setValue('gsb',$gsb);
				$document->setValue('gss',$gss);
				$document->setValue('jenis_bangunan',$jenis_bangunan);
				$document->setValue('tanggal_cetak',$tgl_sekarang);

				$filename = 'BAP Sebelum Tinjauan.docx';
				$document->save($filename);
				header('Content-Description: File Transfer');
				header('Content-type: application/force-download');
				header('Content-Disposition: attachment; filename='.basename($filename));
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($filename));
				readfile($filename);
		}
	}
 ?>