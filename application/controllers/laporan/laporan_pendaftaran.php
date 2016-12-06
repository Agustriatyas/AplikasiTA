<?php 
	class Laporan_pendaftaran extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_laporan');			
    	}
		/**
		 * Fungsi ini digunakan untuk menmpilkan data laporan pendaftaran IMB di kantor BPPTPM ciamis
		 */
		function index(){
			$lap_pendaftaran = $this->m_laporan->lap_pendaftaran();
			$this->load->view('laporan/v_lap_pendaftaran',array('lap_pendaftaran'=>$lap_pendaftaran));
		}
		/**
		 * Fungsi ini digunakan untuk mencetak laporan pendaftaran
		 */
		
		function cetak_lap_pendaftaran(){
			$this->load->library('PHPWord');

			$data = $this->m_laporan->lap_pendaftaran2();
			$document = $this->phpword->loadTemplate('application/docs/temp/LaporanPendaftaran.docx');

				 $a = array();
				 $b = array();
				 $c = array();
				 $d = array();
			     $e = array();
				 $f = array();
				 $g = array();
				 
				 $index = 0;
				 foreach($data as $row){
						$a[$index] = ($index+1);
						$b[$index] = $row->id_perm;
						$c[$index] = $row->no_pendaftaran;
						$d[$index] = $row->tgl_permohonan;
						$e[$index] = $row->nama_pemohon;
						$f[$index] = $row->status_perm;
						$g[$index] = $row->d_entry;
					
						$index++;
				 }
				$data = array(
					'a' =>$a,
					'b' =>$b,
					'c' =>$c,
					'd' =>$d,
					'e' =>$e,
					'f' =>$f,
					'g' =>$g
				);

				$document->cloneRow('data', $data);
				$filename = 'LaporanPendaftaran.docx';
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