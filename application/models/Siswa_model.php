<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function hitung_tugas($id_siswa)
    {
        $this->db->select('COUNT(*) as jumlah');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.kelas_id = mapel_kelas.kelas_id'); 
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        return $this->db->get();
    }

	public function jadwal_siswa($id_siswa)
	{
		$this->db->select('*, mapel.nama as mapel_nama,kelas.nama as kelas_nama, pengajar.nama as nama_pengajar');
        $this->db->from('kelas_siswa');
        $this->db->join('mapel_kelas', 'mapel_kelas.kelas_id = kelas_siswa.kelas_id');
        $this->db->join('pengajar', 'pengajar.id = mapel_kelas.pengajar_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->join('kelas', 'kelas.id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        return $this->db->get();
	}

    public function ujian_siswa($id_siswa)
    {
        $this->db->select('*,mapel.nama as mapel_nama, topik_tugas.id as id_ujian');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.terbit', "Y");
        return $this->db->get();
    }

    public function kerjakan_ujian($id_ujian)
    {
        $this->db->select('*,mapel.nama as mapel_nama, topik_tugas.id as id_ujian');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->where('topik_tugas.id',$id_ujian);
        return $this->db->get();   
    }

    public function kerjakan_soal($id_ujian,$id_siswa)
    {
        $this->db->select('*, soal.id as soal_id');
        $this->db->from('soal');
        $this->db->join('ujian','ujian.id = soal.ujian_id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = ujian.mapel_kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('ujian.id',$id_ujian);
        return $this->db->get();   
    }

    public function nilai_tugas($id_siswa)
    {
        $this->db->select('*,mapel.nama as mapel_nama,topik_tugas.id as id_topik_tugas');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        return $this->db->get();
    }

    public function cek_nilai_pilganda_tugas($id_siswa,$topik)
    {
        $this->db->select('*');
        $this->db->from('topik_tugas');
        $this->db->join('nilai', 'nilai.topik_tugas_id = topik_tugas.id');
        $this->db->join('quiz_pilganda', 'quiz_pilganda.topik_tugas_id = topik_tugas.id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.id',$topik);
        return $this->db->get();
    }

    public function cek_nilai_essay_tugas($id_siswa,$topik)
    {
        $this->db->select('*,nilai_essay.nilai as nilai_essay_nilai');
        $this->db->from('topik_tugas');
        $this->db->join('quiz_essay', 'quiz_essay.topik_tugas_id = topik_tugas.id');
        $this->db->join('nilai_essay', 'nilai_essay.topik_tugas_id = topik_tugas.id');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('mapel', 'mapel.id = mapel_kelas.mapel_id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$id_siswa);
        $this->db->where('topik_tugas.id',$topik);
        return $this->db->get();
    }

    public function update_siswa($id,$data,$data_user)
    {
        //pengajar
        $this->db->where('id', $id);
        $this->db->update('siswa', $data);
        //user
        $this->db->where('is_siswa', $id);
        $this->db->update('user', $data_user);
    }

    public function cek_siswa($id)
    {
        return $this->db->get_where('siswa',['id' => $id]);
    }

    public function nilai_perkelas($mapel_id,$kelas_id,$id_pengajar)
    {
        $this->db->select('*');
        $this->db->from('topik_tugas');
        $this->db->join('mapel_kelas', 'mapel_kelas.id = topik_tugas.mapel_kelas_id');
        $this->db->join('nilai', 'nilai.topik_tugas_id = topik_tugas.id');
        $this->db->join('nilai_essay', 'nilai_essay.topik_tugas_id = topik_tugas.id');
        $this->db->join('kelas_siswa','kelas_siswa.kelas_id = mapel_kelas.kelas_id');
        $this->db->join('siswa', 'siswa.id = kelas_siswa.siswa_id');
        $this->db->where('mapel_kelas.mapel_id',$mapel_id);
        $this->db->where('mapel_kelas.kelas_id',$kelas_id);
        $this->db->where('topik_tugas.pengajar_id',$id_pengajar);
        return $this->db->get();
    }
}