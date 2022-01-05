<?php

class Produk_model extends CI_Model
{
    public function getproduct($id = null)
    {
        if ($id === null) {
            return $this->db->get('product')->result_array();
        } else {
            return $this->db->get_where('product', ['id' => $id])->result_array();
        }
    }

    public function deleteproduct($id)
    {
        $this->db->delete('product', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createproduct($data)
    {
        $this->db->insert('product', $data);
        return $this->db->affected_rows();
    }

    public function updateproduct($data, $id)
    {
        $this->db->update('product', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}