<?php 
	class Entry_retribusi extends CI_Controller{

		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->model('m_entry_retribusi');	
    	}
    	
		function index(){
			$entry_retribusi = $this->m_entry_retribusi->get_data_entry();
			$this->load->view('back_office/v_entry_retribusi',array('entry_retribusi'=>$entry_retribusi));
			// print_r($entry_retribusi);
			// die();
		}
		//begin retribusi
		function detail_perm($id_perm = NULL){
			$id_perm = $id_perm;
			$detail_perm = $this->m_entry_retribusi->get_detail_perm($id_perm);
			$this->load->view('back_office/v_entry_retribusi', array('id_perm'=>$id_perm,'detail_perm'=>$detail_perm));
		}
		// begin insert
		function insert(){
			if($_POST){
				$idxData 		= $_POST["intCounter"];
				$idHdnId_perm 	= $_POST["idHdnId_perm"];
				$txtTotal 		= $_POST["txtTotal"];
				//var_dump($idxData);
				$data_retribusi=array();
				for ($i=0; $i<$idxData; $i++){
					$arrData = array(
						'id_perm'=>$this->input->post('idHdnId_perm'),
						'luas'=>$this->input->post('txtLuas'.$i),
						'harga_satuan'=>$this->input->post('txtHargaSatuan'.$i),
						'jenis_bangunan'=>$this->input->post('selJenisBangunan'.$i),
						'jumlah'=>$this->input->post('txtJumlah'.$i)
					);
					array_push($data_retribusi, $arrData);
				}

				// var_dump($data_retribusi);
				$this->m_entry_retribusi->save($data_retribusi,$txtTotal);

				redirect(base_url().'index.php/back_office/retribusi');
			}else{
				redirect('back_office/retribusi');
			}
	}
}
?>