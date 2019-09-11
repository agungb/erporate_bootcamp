<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_karyawan extends CI_Model {

    /**
     * Get Jabatan
     */
    public function get_jabatan()
    {
       return $this->db->get('jabatan')->result();
    }
    /**
     *
     */
    public function save_karyawan($data)
    {
        return $this->db->insert('karyawan', $data);
    }


    public function delete_karyawan($id_karyawan)
    {
       return $this->db->delete('karyawan', array('id_karyawan'=> $id_karyawan));
    }

}

/* End of file Model_karyawan.php */
/* Location: ./application/modules/karyawan/models/Model_karyawan.php */
