<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_model extends CI_Model {

    public function kelas($pengajar_id)
    {
        $this->db->select('*,kelas.nama as kelas_nama, mapel.nama as mapel_nama, mapel_kelas.id as mapel_kelas_id, mapel_kelas.mapel_id as mapel_idd, mapel_kelas.kelas_id as kelas_idd');
        $this->db->from('mapel_kelas');
        $this->db->join('kelas', 'kelas.id = mapel_kelas.kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->where('mapel_kelas.pengajar_id',$pengajar_id);
        return $this->db->get();
    }

    public function kelas_mapel($pengajar_id,$mapel_id)
    {
        $this->db->select('*,kelas.nama as kelas_nama, mapel.nama as mapel_nama, mapel_kelas.id as mapel_kelas_id, mapel_kelas.mapel_id as mapel_idd, mapel_kelas.kelas_id as kelas_idd');
        $this->db->from('mapel_kelas');
        $this->db->join('kelas', 'kelas.id = mapel_kelas.kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->where('mapel_kelas.pengajar_id',$pengajar_id);
        $this->db->where('mapel_kelas.mapel_id',$mapel_id);
        return $this->db->get();
    }

    public function ujian_hitung($pengajar,$mapel)
    {
        $this->db->select('COUNT(*) as ujian_hitung');
        $this->db->from('ujian');
        $this->db->where('ujian.tipe',1);
        $this->db->where('ujian.pengajar_id',$pengajar);
        $this->db->where('ujian.mapel_kelas_id',$mapel);
        return $this->db->get();
    }

    public function ujian_kuis_hitung($pengajar,$mapel)
    {
        $this->db->select('COUNT(*) as kuis_hitung');
        $this->db->from('ujian');
        $this->db->where('ujian.tipe',1);
        $this->db->where('ujian.pengajar_id',$pengajar);
        $this->db->where('ujian.mapel_kelas_id',$mapel);
        return $this->db->get();
    }

    public function ujian($pengajar,$mapel_id)
    {
        $this->db->select('*, topik_tugas.id as topik_tugas_id, mapel_kelas.mapel_id as mapel_idd, mapel_kelas.kelas_id as kelas_idd');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'topik_tugas.mapel_kelas_id = mapel_kelas.id');
        $this->db->where('topik_tugas.pengajar_id',$pengajar);
        $this->db->where('mapel_kelas.mapel_id',$mapel_id);
        return $this->db->get();
    }

    public function cek_tugas($id)
    {
        return $this->db->get_where('topik_tugas',['id' => $id]);
    }

    public function tambah_tugas($data)
    {
        return $this->db->insert('topik_tugas',$data);
    }

    public function hapus_tugas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('topik_tugas');
    }

    public function update_tugas($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('topik_tugas', $data);
    }
}