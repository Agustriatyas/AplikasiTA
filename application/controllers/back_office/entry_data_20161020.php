<?php 
	class Entry_data extends CI_Controller{
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
			$this->load->view('back_office/v_entry_data',array('entry_data'=>$entry_data));
		}
		/**
		 * Fungsi ini digunakan untuk menampilkan view untuk entry data permohonan
		 */
		function entry($id_perm = NULL){
			$id_perm = $id_perm;
			$this->load->view('back_office/v_form_entry', array('id_perm'=>$id_perm));
		}
		/**
		 * Fungsi ini digunakan untuk insert data perizinan ke tabel tb_dataperizinan
		 */
		function insert(){
			if($_POST){
				$data_izin = array(
					'id_perm'=>$this->input->post('id_perm'),
					'pemilik_tanah'=>$this->input->post('pemilik_tanah'),
					'thn_lahir'=>$this->input->post('tahun_lahir'),
					'pekerjaan'=>$this->input->post('pekerjaan'),
					'kewarganegaraan'=>$this->input->post('kewarganegaraan'),
					'luas_tanah'=>$this->input->post('luas_tanah'),
					'status_tanah'=>$this->input->post('status_tanah'),
					'no_hak_milik'=>$this->input->post('no_hak_milik'),
					'gsb'=>$this->input->post('gsb'),
					'gsp'=>$this->input->post('gsp'),
					'luas_bangunan_tutupan'=>$this->input->post('luas_bangunan_tutupan'),
					'fungsi_bangunan'=>$this->input->post('fungsi_bangunan'),
					'jenis_bangunan'=>$this->input->post('jenis_bangunan'),
					'gss'=>$this->input->post('gss'),
					'gsr'=>$this->input->post('gsr'),
					//'id_perm'=>$this->input->post('id_perm'),
				);
				/**
				 * Simpan Data perizinan
				 */
				$this->m_bo->save($data_izin);

				$query = $this->db->query("SELECT * from tb_dataperizinan ORDER BY id_data DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_data;
				}
				$id_data = $row->id_data;

				$id_dataizin = $id_data;
				$id_perm = $this->input->post('id_perm');
				$this->m_bo->save_iddata($id_dataizin,$id_perm);
				$this->m_bo->save_tracking($id_perm);

				redirect('back_office/entry_data');
			}else{
				// $data['action'] = base_url().'/index.php/back_office/entry_data/insert/';
				// $data['data_perizinan'] = '';
				// $this->load->view('back_office/v_form_entry', $data);
				redirect('back_office/entry_data');
			}
		}
		/**
		 * Fungsi ini digunakan untuk menampilkan view untuk edit data permohonan
		 */
		function edit_form($id_perm = NULL){
			$id_perm = $id_perm;
			$this->load->view('back_office/v_form_edit', array('id_perm'=>$id_perm));
		}

		function edit($id_perm = NULL){
			if($_POST){
				// die("IF");
				$data_izin = array(
					'pemilik_tanah'=>$this->input->post('pemilik_tanah'),
					'thn_lahir'=>$this->input->post('tahun_lahir'),
					'pekerjaan'=>$this->input->post('pekerjaan'),
					'kewarganegaraan'=>$this->input->post('kewarganegaraan'),
					'luas_tanah'=>$this->input->post('luas_tanah'),
					'status_tanah'=>$this->input->post('status_tanah'),
					'no_hak_milik'=>$this->input->post('no_hak_milik'),
					'gsb'=>$this->input->post('gsb'),
					'gsp'=>$this->input->post('gsp'),
					'luas_bangunan_tutupan'=>$this->input->post('luas_bangunan_tutupan'),
					'fungsi_bangunan'=>$this->input->post('fungsi_bangunan'),
					'jenis_bangunan'=>$this->input->post('jenis_bangunan'),
					'gss'=>$this->input->post('gss'),
					'gsr'=>$this->input->post('gsr'),
					'id_perm'=>$this->input->post('id_perm')
				);
				// die($data_izin);
				$this->m_bo->edit_data($id_perm,$data_izin);
				redirect('back_office/entry_data');
			}else{
				// $data['action'] = base_url().'index.php/back_office/entry_data/edit/'.$id_perm;
				$data['data_perizinan'] = $this->m_bo->get_perid($id_perm);

				$this->load->view('back_office/v_form_edit', $data);
			}
		}
	}
 ?>