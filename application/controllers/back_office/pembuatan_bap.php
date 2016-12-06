<?php 
	class Pembuatan_bap extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_bo');			
    	}
    	/**
		 * Fungsi ini digunakan untuk menmpilkan data permohonan yang telah di approve oleh kasubid
		 * dan sudah dapat di olah di back office.
		 */
		function index(){
			$entry_data = $this->m_bo->get_data_entry();
			$this->load->view('back_office/v_pembuatan_bap',array('entry_data'=>$entry_data));
		}
		/**
		 * Fungsi ini digunakan untuk menampilkan detail Berita Acara pemeriksaan (BAP) dari data sebelum tinjauan
		 * dan data setelah tinjauan berdasarkan id_perm
		*/

		function detail_bap($id_perm = NULL){
			$id_perm = $id_perm;
			$detail_bap = $this->m_bo->get_detail_bap($id_perm);
			$this->load->view('back_office/v_form_detil_bap', array('id_perm'=>$id_perm,'detail_bap'=>$detail_bap));
		}

		/**
		 * Fungsi untuk cetak BAP
		 */
		function cetak_bap($id_perm = NULL){
			$this->load->library('PHPWord');
  			$document = $this->phpword->loadTemplate('application/docs/temp/BAP.docx');

			$query = $this->db->query("SELECT A.id_perm,  A.peruntukan, A.id_pemohon, A.id_lokasi, A.id_tinjauan,
					B.pemilik_tanah_v, B.thn_lahir_v, B.pekerjaan_v, B.kewarganegaraan_v, B.luas_bangunan_tutupan_v, B.no_hak_milik_v, B.gsb_v, B.gsp_v, B.gss_v, B.jenis_bangunan_v,
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
		   			$pemilik_tanah_v = $row->pemilik_tanah_v;
		   			$thn_lahir_v = $row->thn_lahir_v;
		   			$pekerjaan_v = $row->pekerjaan_v;
		   			$kewarganegaraan_v = $row->kewarganegaraan_v;
		   			$luas_bangunan_tutupan_v = $row->luas_bangunan_tutupan_v;
		   			$no_hak_milik_v = $row->no_hak_milik_v;
		   			$gsb_v = $row->gsb_v;
		   			$gsp_v = $row->gsp_v;
		   			$gss_v = $row->gss_v;
		   			$jenis_bangunan_v = $row->jenis_bangunan_v;
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

				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$date = $row->tgl_tinjauan;
				$tahun = substr($date, 0, 4);
				$bulan = substr($date, 5, 2);
				$tgl = substr($date, 8, 2);
				$tgl_tinjauan_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;

				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$date = $tgl_sekarang;
				$tahun = substr($date, 0, 4);
				$bulan = substr($date, 5, 2);
				$tgl = substr($date, 8, 2);
				$tgl_sekarang_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;

				$document->setValue('tgl_tinjauan',$tgl_tinjauan_format);
				$document->setValue('tim_pemeriksa',$tim_pemeriksa);
				$document->setValue('nama_pemohon',$nama_lengkap);
				$thn_sekarang = date('Y');
				$umur = $thn_sekarang-$thn_lahir_v;
				$document->setValue('umur',$umur);
				$document->setValue('pekerjaan',$pekerjaan_v);
				$document->setValue('alamat_pemohon',$alamat_pemohon);
				$document->setValue('kewarganegaraan',$kewarganegaraan_v);
				$document->setValue('kel_lokasi',$kel_lokasi);
				$document->setValue('kec_lokasi',$kec_lokasi);
				$document->setValue('kab_lokasi',$kab_lokasi);
				$document->setValue('prop_lokasi',$prop_lokasi);
				$document->setValue('peruntukan',$peruntukan);
				$document->setValue('luas_bangunan_tutupan',$luas_bangunan_tutupan_v);
				$document->setValue('pemilik_tanah_v',$pemilik_tanah_v);
				$document->setValue('no_hak_milik',$no_hak_milik_v);
				$document->setValue('gsp',$gsp_v);
				$document->setValue('gsb',$gsb_v);
				$document->setValue('gss',$gss_v);
				$document->setValue('jenis_bangunan',$jenis_bangunan_v);
				$document->setValue('tanggal_cetak',$tgl_sekarang_format);

				$filename = 'BAP.docx';
				$document->save($filename);
				header('Content-Description: File Transfer');
				header('Content-type: application/force-download');
				header('Content-Disposition: attachment; filename='.basename($filename));
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($filename));
				readfile($filename);
		}

		/**
		 *  Fungsi save catatan bap ke tabel permohonan
		 */
		function save_bap(){
			$id_perm = $this->input->post('id_perm');
			$catatan = $this->input->post('catatan');

			// Update tb_permohonan
			$this->m_bo->update_permohonan($id_perm,$catatan);
			$this->m_bo->update_isbap($id_perm);
			$this->m_bo->save_tracking_pembuatan_bap($id_perm);
			redirect('back_office/pembuatan_bap');
		}
	}
 ?>