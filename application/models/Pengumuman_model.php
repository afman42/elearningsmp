<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {

    public function tambah_pengumuman($data)
    {
        return $this->db->insert('pengumuman',$data);
    }

    public function update_pengumuman($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('pengumuman',$data);
    }

    public function hapus_pengumuman($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('pengumuman');
    }

    public function tampil_pengumuman()
    {
        return $this->db->get('pengumuman');
    }
}