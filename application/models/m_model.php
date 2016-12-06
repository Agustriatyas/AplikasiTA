<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class M_user extends CI_Model
{
         
        function __construct()
 {
  parent::__construct();
 }
  
        function cek_user_login($username, $password) 
        {
        $query = $this
            ->db
            ->where('username', $username) // kolom username
            //->where('password', md5($password)) // kolom password
            ->where('password', $password) // kolom password
            ->limit(1) // pembatasan jumlah select
            ->get('users'); //table name
 
        if ($query->num_rows() == 1) { // jika data = 1
                return $query->row_array(); // return data dan nilai TRUE
        }
        else
                {
                        return FALSE; // else mengembalikan FALSE
                }
        }
}