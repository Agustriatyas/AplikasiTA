<?php 
	class Kelola_user extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->helper('captcha');
			$this->load->model('m_user');			
    	}

		/**
		 * Fungsi ini yang digunakan untuk pertama kali mengeksekusi controllers kelola_user/kelola_user
		 */    	
		function index(){
			$data_user = $this->m_user->get_data_user();
			
			$this->load->view('kelola_user/v_kelola_user',array('data_user'=>$data_user));
		}

		function ubah($username){
			if($_POST){
			$data_edit = array("jenis_izin" => $this->input->post('jenis_izin'),
								"jns_peruntukan" => $this->input->post('jns_peruntukan'),
								"source" => $this->input->post('source'),
								"no_referensi" => $this->input->post('no_referensi'),
								"npwp_pemohon" => $this->input->post('npwp_pemohon'),
								"nama_lengkap" => $this->input->post('nama_lengkap'),
								"jenis_kelamin" => $this->input->post('jenis_kelamin'),
								"posisi" => $this->input->post('posisi'),
								"no_telp_pemohon" => $this->input->post('no_telp_pemohon'),
								"email_pemohon" => $this->input->post('email_pemohon'),
								"alamat_pemohon" => $this->input->post('alamat_pemohon'),
								"provinsi_pemohon" => $this->input->post('provinsi_pemohon'),
								"kabupaten_pemohon" => $this->input->post('kabupaten_pemohon'),
								"kecamatan_pemohon" => $this->input->post('kecamatan_pemohon'),
								"kelurahan_pemohon" => $this->input->post('kelurahan_pemohon'),

								"npwp_perusahaan" => $this->input->post('npwp_perusahaan'),
								"n_perusahaan" => $this->input->post('n_perusahaan'),
								"bidang_usaha" => $this->input->post('bidang_usaha'),
								"status_modal" => $this->input->post('status_modal'),
								"badan_hukum" => $this->input->post('badan_hukum'),
								"investasi" => $this->input->post('investasi'),
								"jumlah_tk" => $this->input->post('jumlah_tk'),
								"no_telp_perusahaan" => $this->input->post('no_telp_perusahaan'),
								"email_perusahaan" => $this->input->post('email_perusahaan'),
								"website" => $this->input->post('website'),
								"alamat_perusahaan" => $this->input->post('alamat_perusahaan'),
								"provinsi_perusahaan" => $this->input->post('provinsi_perusahaan'),
								"kabupaten_perusahaan" => $this->input->post('kabupaten_perusahaan'),
								"kecamatan_perusahaan" => $this->input->post('kecamatan_perusahaan'),
								"kelurahan_perusahaan" => $this->input->post('kelurahan_perusahaan'),
				);
			die("KE MODEL");
			$this->m_user->edit_user($id, $data_edit);
			// redirect(base_url().'admin/user_admin');
		}else{
			// $data['action'] = base_url().'admin/user_admin/edituser/'.$id;
			// $data['title'] = 'Edit User';
			$data['data_edit'] = $this->m_fo->get_perid($id);
			// CEK QUERY
			// $aaa =$this->m_fo->get_perid($id);
			// echo $this->db->last_query($aaa);
			$data['combo'] = $this->m_fo->get_jenis_permohonan();
			$data['jenis_izin'] = $this->m_fo->get_jenis_izin($id);

			// $cek = $this->m_fo->get_jenis_izin($id);
			//echo $this->db->last_query($cek);
			$cek = $this->m_fo->get_perid($id);
			echo $this->db->last_query($cek);
			$this->load->view('kelola_user/kelola_user/v_kelola_user',$data);		
		}
		}

		/**
		 * Fungsi untuk menghapus data user
		 */
		function delete($id){
			$del = $this->m_user->del($id);
			redirect('kelola_user/kelola_user');
		}

	}
 ?>