<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban_siswa_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function tampil_siswa_jawaban_perkelas($kelas_id,$mapel_id,$pengajar_id)
	{
		$this->db->select('*,siswa.nama as siswa_nama, mapel_kelas.id as mapel_kelas_id,siswa.id as siswa_id');
        $this->db->from('mapel_kelas');
        $this->db->join('kelas_siswa', 'kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->join('siswa', 'siswa.id = kelas_siswa.siswa_id');
        $this->db->where('mapel_kelas.pengajar_id',$pengajar_id);
        $this->db->where('mapel_kelas.kelas_id',$kelas_id);
        $this->db->where('mapel_kelas.mapel_id',$mapel_id);
        return $this->db->get();
	}

	public function cek_jawaban_siswa_pilganda($id_siswa,$mapel_kelas_id)
	{
		$this->db->select('*');
        $this->db->from('topik_tugas');
        $this->db->join('nilai', 'nilai.topik_tugas_id = topik_tugas.id');
        $this->db->join('quiz_pilganda', 'quiz_pilganda.topik_tugas_id = topik_tugas.id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.mapel_kelas_id',$mapel_kelas_id);
        return $this->db->get();
	}

	public function cek_jawaban_siswa_essay($id_siswa,$mapel_kelas_id)
    {
        // $this->db->select('*,nilai_essay.nilai as nilai_essay_nilai');
        $this->db->select('*');
        $this->db->from('topik_tugas');
        $this->db->join('quiz_essay', 'quiz_essay.topik_tugas_id = topik_tugas.id');
        $this->db->join('jawaban_essay', 'jawaban_essay.id_quiz_essay = quiz_essay.id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.mapel_kelas_id',$mapel_kelas_id);
        return $this->db->get();
    }

    public function nambah_siswa_essay($data)
    {
        $this->db->insert('nilai_essay',$data);
    }

    public function update_siswa_essay($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('nilai_essay',$data);
    }

    public function tampil_nilai_essay_persiswa($id_siswa,$mapel_kelas_id)
    {
        $this->db->select('*');
        $this->db->from('nilai_essay');
        $this->db->join('topik_tugas', 'topik_tugas.id = nilai_essay.topik_tugas_id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.mapel_kelas_id',$mapel_kelas_id);
        return $this->db->get();
    }
}