<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($email,$password)
    {
        return $this->db->get_where('user',['email' => $email, 'password' => $password]);
    }

    public function cek_pengajar($id)
    {
        return $this->db->get_where('pengajar',['id' => $id]);
    }

    public function cek_siswa($id)
    {
        return $this->db->get_where('siswa',['id' => $id]);
    }
}