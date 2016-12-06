<?php 
	class Retribusi extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_bo');			
    	}
    	/**
		 * Fungsi ini digunakan untuk menampilkan data permohonan untuk perhitungan retribusi
		 */
		function index(){
			$data_retribusi = $this->m_bo->get_data_retribusi();
			$this->load->view('back_office/v_data_retribusi',array('data_retribusi'=>$data_retribusi));
		}
    	/**
		 * Fungsi ini digunakan untuk menampilkan view create retribusi
		 */
		function create($id_perm = NULL){
			$id_perm = $id_perm;
			$this->load->view('back_office/v_entry_retribusi',array('id_perm'=>$id_perm));
		}

		/**
		 * Fungsi untuk mencetak SKR IMB
		 */
		function cetak_skr($id_perm = NULL){
			//echo "cek";
			$this->load->library('PHPWord');
  			$document = $this->phpword->loadTemplate('application/docs/temp/SKR.docx');

			$query = $this->db->query("SELECT A.id_perm, A.jenis_permohonan, A.tgl_permohonan, 
				A.peruntukan, A.no_pendaftaran, B.nama_lengkap, B.jenis_identitas, B.no_identitas, C.nama_perusahaan, 
				D.id_lokasi, E.nama_prop AS prop_izin, F.nama_kab AS kab_izin, G.nama_kec AS kec_izin, 
				H.nama_kel AS kel_izin, D.alamat_lengkap AS alamat_izin, B.alamat AS alamat_pem, 
				I.nama_prop AS prop_pem, J.nama_kab AS kab_pem, K.nama_kec AS kec_pem, L.nama_kel AS kel_pem, M.nilai_retribusi
					
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
					LEFT JOIN tb_retribusi AS M ON M.id_perm = A.id_perm

					WHERE A.id_perm = '$id_perm' ");
				foreach ($query->result() as $row){
		   			$tipe_izin = $row->jenis_permohonan;
		   			$tgl_daftar = $row->tgl_permohonan;
		   			$peruntukan = $row->peruntukan;
		   			$nama_pemohon = $row->nama_lengkap;
		   			$jenis_identitas = $row->jenis_identitas;
		   			$no_identitas = $row->no_identitas;
		   			$nama_perusahaan = $row->nama_perusahaan;
		   			$prop_i = $row->prop_izin;
		   			$kab_i = $row->kab_izin;
		   			$kec_i = $row->kec_izin;
		   			$kel_i = $row->kel_izin;
		   			$almt_i = $row->alamat_izin;
		   			$almt_p = $row->alamat_pem;
		   			$prop_p = $row->prop_pem;
		   			$kab_p = $row->kab_pem;
		   			$kec_p = $row->kec_pem;
		   			$kel_p = $row->kel_pem;
		   			$no_pendaftaran = $row->no_pendaftaran;
		   			$nilai_retribusi = $row->nilai_retribusi;
				}

				$lokasi_izin = $almt_i." Kel. ".$kel_i." Kec.".$kec_i." ".$kab_i." Prop. ".$prop_i;
				$alamat_pemohon = $almt_p." Kel. ".$kel_p." Kec.".$kec_p." ".$kab_p." Prop. ".$prop_p;

			  $tgl = date('d');
			  $bulan = date('m');
			  $tahun = date('Y');

			  if($bulan == 1){
			  	$masa = 'Januari';
			  }else if($bulan == 2){
			  	$masa = 'Februari';
			  }else if($bulan == 3){
			  	$masa = 'Maret';
			  }else if($bulan == 4){
			  	$masa = 'April';
			  }else if($bulan == 5){
			  	$masa = 'Mei';
			  }else if($bulan == 6){
			  	$masa = 'Juni';
			  }else if($bulan == 7){
			  	$masa = 'Juli';
			  }else if($bulan == 8){
			  	$masa = 'Agustus';
			  }else if($bulan == 9){
			  	$masa = 'September';
			  }else if($bulan == 10){
			  	$masa = 'Oktober';
			  }else if($bulan == 11){
			  	$masa = 'November';
			  }else{
			  	$masa = 'Desember';
			  }

			  $document->setValue('masa', $masa);
			  $document->setValue('tahun', $tahun);
			  $document->setValue('pemohon',$nama_pemohon);
			  $document->setValue('a_pemohon',$alamat_pemohon);
			  $document->setValue('tglcetak', $tgl." ".$masa." ".$tahun);
			  $nilai = number_format($nilai_retribusi);
			  $document->setValue('nilai_retribusi', $nilai);


				$filename = 'SKR.docx';
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