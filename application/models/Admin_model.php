<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function hitung_pengajar()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('pengajar');
        return $this->db->get();
    }

    public function hitung_siswa()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('siswa');
        return $this->db->get();
    }

    public function hitung_kelas()
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('kelas');
        return $this->db->get();
    }

    public function pengajar()
    {
        return $this->db->query("SELECT * FROM pengajar");
    }

    public function pengajar_not_in()
    {
        return $this->db->query("SELECT * FROM pengajar WHERE id NOT IN (1)");
    }

    public function tambah_pengajar($data)
    {
        return $this->db->insert('pengajar',$data);
    }

    public function hapus_pengajar($id)
    {
        //pengajar
        $this->db->where('id', $id);
        $this->db->delete('pengajar');
        //user
        $this->db->where('is_pengajar', $id);
        $this->db->delete('user');
    }

    public function update_pengajar($id,$data,$data_user)
    {
        //pengajar
        $this->db->where('id', $id);
        $this->db->update('pengajar', $data);
        //user
        $this->db->where('is_pengajar', $id);
        $this->db->update('user', $data_user);
    }

    public function siswa()
    {
        return $this->db->get('siswa');
    }

    public function tambah_siswa($data)
    {
        return $this->db->insert('siswa',$data);
    }

    public function hapus_siswa($id)
    {
        //siswa
        $this->db->where('id', $id);
        $this->db->delete('siswa');
        //user
        $this->db->where('is_siswa', $id);
        $this->db->delete('user');
    }

    public function update_siswa($id,$data,$data_user)
    {
        //siswa
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);
        //user
        $this->db->where('is_siswa', $id);
        $this->db->update('user', $data_user);
    }
    
    public function tambah_user($data)
    {
        return $this->db->insert('user',$data);
    }
}