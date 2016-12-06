<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class C_home extends CI_Controller {
 
        function __construct()
        {
                session_start();
                parent::__construct();
                if ( !isset($_SESSION['username']) ) {
                        redirect('c_login');
                }
        }
 
        public function index()
        {
                $this->load->view('login/v_home'); 
                
                // if($_SESSION['username'] == "tria"){
                //         $this->load->view('login/v_home');  
                // }else{
                //         $this->load->view('login/v_homee');
                // }
        }
 
}