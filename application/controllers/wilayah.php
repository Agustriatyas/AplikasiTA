<?php 
 if (!defined('BASEPATH'))exit('No direct script access allowed');

 class Wilayah extends CI_Controller {

  function __construct() {
   parent::__construct();
   
   //$this->load->helper(array('url',''));
   $this->load->model('m_wilayah');
   $this->load->database();
  }

  function index() {
   $data['provinsi']=$this->m_wilayah->get_all_provinsi();
    
   $data['path'] = base_url('assets');
   
   $this->load->view('wilayah', $data);
  }
  
  function add_ajax_kab($id_prov){
      $query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
      $data = "<option value=''>- Select Kabupaten -</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->nama."</option>";
      }
      echo $data;
  }
  
  function add_ajax_kec($id_kab){
      $query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
      $data = "<option value=''> - Pilih Kecamatan - </option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->nama."</option>";
      }
      echo $data;
  }
  
  function add_ajax_des($id_kec){
      $query = $this->db->get_where('wilayah_desa',array('kecamatan_id'=>$id_kec));
      $data = "<option value=''> - Pilih Desa - </option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->nama."</option>";
      }
      echo $data;
  }
 }
?>