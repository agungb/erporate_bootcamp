<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jabatan extends CI_Model {

  public function get_all_jabatan()
  {
    return $this->db->get('jabatan')->result_array();
  }

  /**
   * Simpan Jabatan
   */
  public function add_jabatan($data)
  {
    return $this->db->insert('jabatan', $data);
  }
  /**
   * Detail Edit Jabatan
   */
  public function detail_edit($id_jabatan)
  {
    return $this->db->get_where('jabatan', array('id_jabatan'=> $id_jabatan))->row();
  }
  /**
   * Update Jabatan
   */
  public function save_edit($data, $id)
  {
    return $this->db->update('jabatan', $data, $id);
  }
  /**
   * Delete Jabatan
   */
  public function delete_jabatan($id_jabatan)
  {
    return $this->db->delete('jabatan', array('id_jabatan'=> $id_jabatan));
  }

}

/* End of file Model_jabatan.php */
/* Location: ./application/modules/jabatan/models/Model_jabatan.php */
