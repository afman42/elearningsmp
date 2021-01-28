<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_siswa_model extends CI_Model {

    public function kelas_siswa()
    {
        $this->db->select('*, kelas.nama as kelas_nama, siswa.nama as siswa_nama, kelas_siswa.id as kelas_siswa_id');
        $this->db->from('kelas_siswa');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id');
        $this->db->join('siswa', 'siswa.id = kelas_siswa.siswa_id');
        return $this->db->get();
    }

    public function kelas_siswa_persiswa($siswa_id)
    {
        $this->db->select('*, kelas.nama as kelas_nama, siswa.nama as siswa_nama');
        $this->db->from('kelas_siswa');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id');
        $this->db->join('siswa', 'siswa.id = kelas_siswa.siswa_id');
        $this->db->where('kelas_siswa.siswa_id',$siswa_id);
        return $this->db->get();
    }    

    public function tambah_kelas_siswa($data)
    {
        return $this->db->insert('kelas_siswa',$data);
    }

    public function edit_kelas_siswa($id)
    {
        return $this->db->get_where('kelas_siswa',['id' => $id]);
    }

    public function hapus_kelas_siswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas_siswa');
    }

    public function update_kelas_siswa($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('kelas_siswa', $data);
    }
}