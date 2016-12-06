<?php 
	class Kasubid extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_kasubid');		
    	}
    	/**
		 * Fungsi yang akan menampilkan data permohonan di view approval kasubid.
		 */
		function index(){
			$app_kasubid = $this->m_kasubid->get_app_kasubid();
			$this->load->view('kasubid/v_kasubid',array('app_kasubid'=>$app_kasubid));
		}
    	/**
		 * Fungsi ini akan melakukan approval kasubid dengan mengubah c_kasubid 0 menjadi 1 sebagai tanda
		 * bahwa permohonan telah di approve oleh kasubid
		 */
		function approve($id_perm){
			$approve = $this->m_kasubid->approve_kasubid($id_perm);
			redirect('kasubid/kasubid');
		}
		/**
		 * Fungsi untuk menghapus data permohonan oleh Kasubid
		 */
		function delete($id){
			$del = $this->m_kasubid->del($id);
			redirect('kasubid/kasubid');
		}
		
	}
 ?>