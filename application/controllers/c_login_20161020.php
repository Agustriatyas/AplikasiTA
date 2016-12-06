<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_login extends CI_Controller
{
       function __construct()
 {
         session_start(); //mengadakan session
  parent::__construct();
 } 
  
        public function index()
        {
              if ( isset($_SESSION['username']) ) { //cek apakah session ada
                 redirect('c_home'); //redirect controller c_home
              }
               
              $this->load->library('form_validation'); //load library form_validation
              $this->form_validation->set_rules('username', 'Username', 'required'); //cek, validasi username
              $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]'); //cek, validasi password
              if ( $this->form_validation->run() == TRUE ) { //apabila validasi true(benar semua)
                 $this->load->model('m_user'); // load model m_user
                 $result = $this->m_user->cek_user_login( //jalankan fungsi cek_user_login dari model m_user
                             $this->input->post('username'),  //menangkap username dari form
                             $this->input->post('password') //menangkap password dari form
                          );
                  
                             
                        if ( $result == TRUE) { //apabila result = true(ada data)
                                $_SESSION['username'] = $this->input->post('username'); //create session
                                redirect('c_home'); // redirect controller c_home
                        }
              }  
               
                $this->load->view('login/v_form'); //apabila session kosong load login/v_form
        }
         
        public function logout() //fungsi logout
        {
             session_destroy(); //session destroy
             $this->index();//redirect function index()
        }
}