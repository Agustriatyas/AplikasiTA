<?php 
	class Pembayaran_retribusi extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_kasir');			
    	}
		/**
		 * Fungsi ini digunakan untuk menmpilkan data permohonan yang telah selesai di proses pada bagian Back Office
		 * dan sudah dapat di bayarkan retribusinya di Kasir
		 */
		function index(){
			$pembayaran_retribusi = $this->m_kasir->get_data_pembayaran();
			$this->load->view('kasir/v_pembayaran',array('pembayaran_retribusi'=>$pembayaran_retribusi));
		}
		/**
		 * Fungsi ini digunakan untuk menampilkan form pencatatan pembayaran di Kasir
		 */
		function bayar($id_perm = NULL){
			$id_perm = $id_perm;
			$data_bayar = $this->m_kasir->get_data_bayar($id_perm);
			$this->load->view('kasir/v_form_pembayaran', array('id_perm'=>$id_perm,'data_bayar'=>$data_bayar));
		}

		/**
		 * Fungsi ini digunakan untuk menampilkan form pencatatan pembayaran di Kasir
		 */
		function save_pembayaran(){
			$id_perm = $this->input->post('id_perm');
			$status_bayar = $this->input->post('status_bayar');

			// Update tb_retribusi
			$this->m_kasir->update_retribusi($id_perm,$status_bayar);
			$this->m_kasir->save_tracking($id_perm);
			redirect('kasir/pembayaran_retribusi');
		}
	}
 ?>