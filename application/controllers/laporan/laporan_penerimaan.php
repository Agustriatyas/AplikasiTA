<?php 
	class Laporan_penerimaan extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_laporan');			
    	}
		/**
		 * Fungsi ini digunakan untuk menmpilkan data laporan penerimaan IMB di kantor BPPTPM ciamis
		 */
		function index(){
			$lap_penerimaan = $this->m_laporan->lap_penerimaan();
			$this->load->view('laporan/v_lap_penerimaan',array('lap_penerimaan'=>$lap_penerimaan));
		}
		/**
		 * Fungsi ini digunakan untuk mencetak laporan penerimaan
		 */
		function cetak_lap_penerimaan(){
			$this->load->library('PHPWord');

			$data = $this->m_laporan->lap_penerimaan();
			$document = $this->phpword->loadTemplate('application/docs/temp/LaporanPenerimaan.docx');

				 $a = array();
				 $b = array();
				 $c = array();
				 $d = array();
			     $e = array();
				 $f = array();
				 $g = array();
				 $h = array();
				 $i = array();
				 
				 $index = 0;
				 foreach($data as $row){
						$a[$index] = ($index+1);
						$b[$index] = $row->id_perm;
						$c[$index] = $row->no_pendaftaran;
						$d[$index] = $row->tgl_permohonan;
						$e[$index] = $row->jenis_permohonan;
						$f[$index] = $row->no_identitas;
						$g[$index] = $row->nama_pemohon;
						$h[$index] = $row->nilai_ret;
						$i[$index] = $row->status;
					
						$index++;
				 }
				$data = array(
					'a' =>$a,
					'b' =>$b,
					'c' =>$c,
					'd' =>$d,
					'e' =>$e,
					'f' =>$f,
					'g' =>$g,
					'h' =>$h,
					'i' =>$i
				);

				$document->cloneRow('data', $data);
				$filename = 'LaporanPenerimaan.docx';
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