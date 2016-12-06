<?php 
	class Penetapan_izin extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_kabid');			
    	}
		/**
		 * Fungsi ini digunakan untuk menmpilkan data permohonan yang telah di proses pada bagian Back Office
		 * dan sudah dapat di tetapkan oleh kabid
		 */
		function index(){
			$penetapan_izin = $this->m_kabid->get_data_tinjauan();
			$this->load->view('kabid/v_penetapan_izin',array('penetapan_izin'=>$penetapan_izin));
		}
		/**
		 * Fungsi ini digunakan untuk menetapkan izin oleh kabid
		 */
		function penetapan($id_perm = NULL){
			$id_perm = $id_perm;
			$data_penetapan = $this->m_kabid->get_data_penetapan($id_perm);
			$this->load->view('kabid/v_form_penetapan', array('id_perm'=>$id_perm,'data_penetapan'=>$data_penetapan));
		}

		/**
		 *  Fungsi save penetapan izin ke tabel permohonan
		 */
		function save_penetapan(){
			$id_perm = $this->input->post('id_perm');
			$status_izin = $this->input->post('status_izin');

			// Update tb_permohonan
			$this->m_kabid->update_permohonan($id_perm,$status_izin);
			$this->m_kabid->save_tracking($id_perm);
			redirect('kabid/penetapan_izin');
		}
	}
 ?>