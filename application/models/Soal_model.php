<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model {

    public function soal($id)
    {
        $this->db->select('*,quiz_pilganda.id as soal_id');
        $this->db->from('quiz_pilganda');
        $this->db->join('topik_tugas', 'topik_tugas.id = quiz_pilganda.topik_tugas_id');
        $this->db->where('quiz_pilganda.topik_tugas_id',$id);
        return $this->db->get();
    }

    public function soal_essay($id)
    {
        $this->db->select('*,quiz_essay.id as soal_id');
        $this->db->from('quiz_essay');
        $this->db->join('topik_tugas', 'topik_tugas.id = quiz_essay.topik_tugas_id');
        $this->db->where('quiz_essay.topik_tugas_id',$id);
        return $this->db->get();
    }

    public function hitung_soal($id,$pengajar)
    {
        $this->db->select('COUNT(*) AS hitung');
        $this->db->from('soal');
        $this->db->join('ujian', 'ujian.id = soal.ujian_id');
        $this->db->where('soal.ujian_id',$id);
        $this->db->where('soal.pengajar_id',$pengajar);
        return $this->db->get();
    }

    public function ujian($pengajar,$mapel)
    {
        $this->db->select('*');
        $this->db->from('ujian');
        $this->db->where('ujian.pengajar_id',$pengajar);
        $this->db->where('ujian.mapel_kelas_id',$mapel);
        return $this->db->get();
    }

    public function cek_soal_pilganda($id)
    {
        return $this->db->get_where('quiz_pilganda',['id' => $id]);
    }

    public function tambah_soal_pilganda($data)
    {
        return $this->db->insert('quiz_pilganda',$data);
    }

    public function hapus_soal_pilganda($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('quiz_pilganda');
    }

    public function update_soal_pilganda($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('quiz_pilganda', $data);
    }

    public function cek_soal_essay($id)
    {
        return $this->db->get_where('quiz_essay',['id' => $id]);
    }

    public function tambah_soal_essay($data)
    {
        return $this->db->insert('quiz_essay',$data);
    }

    public function hapus_soal_essay($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('quiz_essay');
    }

    public function update_soal_essay($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('quiz_essay', $data);
    }
}