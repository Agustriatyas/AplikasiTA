<?php 
	class Entry_data_tinjauan extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_bo');			
    	}
    	/**
		 * Fungsi ini digunakan untuk menampilkan data permohonan yang telah di approve oleh kasubid
		 * dan telah dijadwalkan untuk tinjauan
		 */
		function index(){
			$entry_data_tinjauan = $this->m_bo->get_data_entry_tinjauan();
			$this->load->view('back_office/v_entry_data_tinjauan',array('entry_data_tinjauan'=>$entry_data_tinjauan));
		}
		/**
		 * Fungsi ini digunakan untuk menampilkan view untuk entry data hasil tinjauan permohonan
		 */
		function entry($id_perm = NULL){
			$id_perm = $id_perm;
			$this->load->view('back_office/v_form_entry_tinjauan', array('id_perm'=>$id_perm));
		}
		/**
		 * Fungsi ini digunakan untuk insert data perizinan hasil tinjauan ke tabel tb_dataperizinan
		 */
		function insert(){
			if($_POST){
				$data_izin = array(
					'pemilik_tanah_v'=>$this->input->post('pemilik_tanah_v'),
					'thn_lahir_v'=>$this->input->post('tahun_lahir_v'),
					'pekerjaan_v'=>$this->input->post('pekerjaan_v'),
					'kewarganegaraan_v'=>$this->input->post('kewarganegaraan_v'),
					'luas_tanah_v'=>$this->input->post('luas_tanah_v'),
					'status_tanah_v'=>$this->input->post('status_tanah_v'),
					'no_hak_milik_v'=>$this->input->post('no_hak_milik_v'),
					'gsb_v'=>$this->input->post('gsb_v'),
					'gsp_v'=>$this->input->post('gsp_v'),
					'luas_bangunan_tutupan_v'=>$this->input->post('luas_bangunan_tutupan_v'),
					'fungsi_bangunan_v'=>$this->input->post('fungsi_bangunan_v'),
					'jenis_bangunan_v'=>$this->input->post('jenis_bangunan_v'),
					'gss_v'=>$this->input->post('gss_v'),
					'gsr_v'=>$this->input->post('gsr_v')
					//'id_perm'=>$this->input->post('id_perm'),
				);

				$id_perm = $this->input->post('id_perm');

				$query = $this->db->query("SELECT * from tb_permohonan WHERE id_perm =$id_perm");
				foreach ($query->result() as $row){
		   			$row->id_dataizin;
				}
				$id_data = $row->id_dataizin;

				/**
				 * Simpan Data perizinan hasil tinjauan
				 */
				$this->m_bo->save_data_tinjauan($id_data,$data_izin);
				$this->m_bo->update_isdisable_tinjauan($id_perm);
				$this->m_bo->save_tracking_data_tinjauan($id_perm);

				redirect('back_office/entry_data_tinjauan');
			}else{
				// $data['action'] = base_url().'/index.php/back_office/entry_data/insert/';
				// $data['data_perizinan'] = '';
				// $this->load->view('back_office/v_form_entry', $data);
				redirect('back_office/entry_data_tinjauan');
			}
		}

		function edit_form_tinjauan($id_perm = NULL){
			$id_perm = $id_perm;
			$this->load->view('back_office/v_form_edit_tinjauan', array('id_perm'=>$id_perm));
		}

		function edit($id_perm = NULL){
				// begin jj
				$idperm = $this->input->post('id_perm');
				// var_dump($idperm);
				// end jj
			if($_POST){
				// die("IF");
				$data_izin = array(
					'pemilik_tanah_v'=>$this->input->post('pemilik_tanah_v'),
					'thn_lahir_v'=>$this->input->post('tahun_lahir_v'),
					'pekerjaan_v'=>$this->input->post('pekerjaan_v'),
					'kewarganegaraan_v'=>$this->input->post('kewarganegaraan_v'),
					'luas_tanah_v'=>$this->input->post('luas_tanah_v'),
					'status_tanah_v'=>$this->input->post('status_tanah_v'),
					'no_hak_milik_v'=>$this->input->post('no_hak_milik_v'),
					'gsb_v'=>$this->input->post('gsb_v'),
					'gsp_v'=>$this->input->post('gsp_v'),
					'luas_bangunan_tutupan_v'=>$this->input->post('luas_bangunan_tutupan_v'),
					'fungsi_bangunan_v'=>$this->input->post('fungsi_bangunan_v'),
					'jenis_bangunan_v'=>$this->input->post('jenis_bangunan_v'),
					'gss_v'=>$this->input->post('gss_v'),
					'gsr_v'=>$this->input->post('gsr_v')
				);

				$this->m_bo->edit_data_tinjauan($idperm, $data_izin);

				redirect('back_office/entry_data_tinjauan');
			}else{
				// $data['action'] = base_url().'index.php/back_office/entry_data/edit/'.$id_perm;
				$data['data_perizinan'] = $this->m_bo->get_perid($id_perm);
				$this->load->view('back_office/v_form_edit_tinjauan', $data);
			}
		}
	}
 ?>