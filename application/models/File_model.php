<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model {

	public function file_materi($id_pengajar,$id) {
		$this->db->select('*');
        $this->db->from('file_materi');
        $this->db->join('mapel_kelas', 'file_materi.mapel_kelas_id = mapel_kelas.id');
        $this->db->where('mapel_kelas.pengajar_id',$id_pengajar);
        $this->db->where('mapel_kelas.mapel_id',$id);
        return $this->db->get();
	}

	public function file_materi_siswa($siswa_id,$id) {
		$this->db->select('*');
        $this->db->from('file_materi');
        $this->db->join('mapel_kelas', 'file_materi.mapel_kelas_id = mapel_kelas.id');
        $this->db->join('kelas_siswa', 'mapel_kelas.kelas_id = kelas_siswa.kelas_id');
        $this->db->where('kelas_siswa.siswa_id',$siswa_id);
        $this->db->where('mapel_kelas.id',$id);
        return $this->db->get();
	}

	public function tambah_file($data)
	{
		return $this->db->insert('file_materi',$data);
	}

	public function hapus_file($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('file_materi');
	}
}