<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

    public function pengajar()
    {
        return $this->db->get('pengajar');
    }

    public function kelas()
    {
        return $this->db->get('kelas');
    }

    public function tambah_kelas($data)
    {
        return $this->db->insert('kelas',$data);
    }

    public function edit_kelas($id)
    {
        return $this->db->get_where('kelas',['id' => $id]);
    }

    public function hapus_kelas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas');
    }

    public function update_kelas($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);
    }

    public function kelas_siswa($siswa_id)
    {
        $this->db->select('*,mapel_kelas.id as mapel_kelas_id,mapel.nama as mapel_nama');
        $this->db->from('mapel_kelas');
        $this->db->join('kelas_siswa', 'kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->where('kelas_siswa.siswa_id',$siswa_id);
        return $this->db->get();
    }
}