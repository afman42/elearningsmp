<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_model extends CI_Model {

    public function mapel()
    {
        return $this->db->get('mapel');
    }

    public function tambah_mapel($data)
    {
        return $this->db->insert('mapel',$data);
    }

    public function edit_mapel($id)
    {
        return $this->db->get_where('mapel',['id' => $id]);
    }

    public function hapus_mapel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mapel');
    }

    public function update_mapel($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('mapel', $data);
    }
}