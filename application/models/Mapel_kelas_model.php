<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_kelas_model extends CI_Model {

    public function mapel_ajar()
    {
        $this->db->select('*, kelas.nama as kelas_nama, mapel.nama as mapel_nama, mapel_kelas.id as mapel_kelas_id');
        $this->db->from('mapel_kelas');
        $this->db->join('kelas', 'kelas.id = mapel_kelas.kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        return $this->db->get();
    }

    public function cek_pengajar_mata_pelajaran($mapel_id,$kelas_id,$pengajar_id)
    {
        $this->db->select('*, kelas.nama as kelas_nama, mapel.nama as mapel_nama,');
        $this->db->from('mapel_kelas');
        $this->db->join('pengajar', 'pengajar.id = mapel_kelas.pengajar_id');
        $this->db->join('kelas', 'kelas.id = mapel_kelas.kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->where('mapel_kelas.kelas_id',$kelas_id);
        $this->db->where('mapel_kelas.mapel_id',$mapel_id);
        $this->db->where('mapel_kelas.pengajar_id',$pengajar_id);
        return $this->db->get();
    }


    public function tambah_mapel_ajar($data)
    {
        return $this->db->insert('mapel_kelas',$data);
    }

    public function edit_mapel_ajar($id)
    {
        return $this->db->get_where('mapel_kelas',['id' => $id]);
    }

    public function hapus_mapel_ajar($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mapel_kelas');
    }

    public function update_mapel_ajar($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('mapel_kelas', $data);
    }
}