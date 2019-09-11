<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MX_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->module('layout');
      $this->load->model('model_karyawan');
      $this->load->file('assets/lib/datatable/ssp.class.customize.php');
    }

    public function index()
    {
      $data = array();
      $data['title']       = 'Manajemen Karyawan';
      $data['font_awesome']= 'fa fa-user';
      $data['heading']     = 'Halaman Manajemen Karyawan';
      $data['sub_heading'] = 'Halaman untuk mengelola data karyawan';
      $data['breadcrumb']  = 'Karyawan';

      $opt_jnskelamin = "<option value=0>Wanita</option>";
      $opt_jnskelamin.= "<option value=1>Pria</option>";
      $data['opt_jnskelamin'] = $opt_jnskelamin;

      $d_jabatan = $this->model_karyawan->get_jabatan();
      $opt_jabatan="";
        foreach($d_jabatan as $dj){
            $opt_jabatan.="<option value='".$dj->id_jabatan."'>".strtoupper($dj->n_jabatan)."</option>";
        }
      $data["opt_jabatan"] = $opt_jabatan;

      $this->layout->header($data);
      $this->layout->sidebar();
      $this->load->view('v_karyawan', $data);
      $this->layout->footer();
    }

    /**
     * Data Tabel
     */

      public function tabel()
      {
        $table       = "karyawan";
        $primary_key = "id_karyawan";

        $columns     = array(
                          array( 'db' => 'id_karyawan', 'dt' => 0 , 'field' => 'id_karyawan'),
                          array( 'db' => 'nama', 'dt' => 1 , 'field' => 'nama'),
                          array( 'db' => 'b.n_jabatan', 'dt' => 2 , 'field' => 'n_jabatan', 'as' => 'n_jabatan'),
                          array( 'db' => 'id_karyawan', 'dt' => 3 , 'field' => 'id_karyawan'),

                      );

        $sql_details  = $this->config->item('db_table');

        $join         = "FROM karyawan a
                        LEFT JOIN jabatan b ON (a.id_jabatan=b.id_jabatan)";

        $order_by     = "id_karyawan ASC";

        echo json_encode(
          SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,$join,NULL,$order_by)
        );

      }

      private function _validation_add()
      {
        $val = $this->form_validation;
        $val->set_rules('nama', 'Nama', 'trim|required');
        $val->set_rules('no_hp', 'No HP', 'trim|required|numeric');
        $val->set_rules('alamat', 'Alamat', 'trim|required');

        return $val->run();
      }

      private function _validation_delete()
      {
        $val = $this->form_validation;
        $val->set_rules('id_karyawan', 'ID Karyawan', 'trim|required');

        return $val->run();
      }

  /**
   * Proses CRUD
   */
    public function proses()
    {
      $path1  = $this->uri->segment(3);

      if ($path1 == "add") {

        $p_nama        = $this->input->post('nama', true);
        $p_jns_kelamin = $this->input->post('jns_kelamin', true);
        $p_id_jabatan  = $this->input->post('id_jabatan', true);
        $p_no_hp       = $this->input->post('no_hp', true);
        $p_alamat      = $this->input->post('alamat', true);

          if ($this->_validation_add() == FALSE) {
            $msg  = array('status' => false, 'data'=> str_replace(array("\r", "\n"), "\n", strip_tags(validation_errors())));
          } else {

              $data_karyawan  = [
                'nama'        => $p_nama,
                'jns_kelamin' => $p_jns_kelamin,
                'id_jabatan'  => $p_id_jabatan,
                'no_hp'       => $p_no_hp,
                'alamat'      => $p_alamat
              ];
              $saved         = $this->model_karyawan->save_karyawan($data_karyawan);

              if ($saved) {
                $msg  = array('status' => true, 'data'=> 'Karyawan '.$p_nama.' berhasil ditambahkan.');
              } else {
                $msg  = array('status' => false, 'data'=> 'Gagal menambahkan Karyawan baru!');
              }


          }

          $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($msg))
          ->_display();exit;

      } else if ($path1 == "delete") {
          $id_karyawan = $this->input->post('id_karyawan', true);

          if ($this->_validation_delete() == FALSE) {
            $msg  = array('status' => false, 'data'=> str_replace(array("\r", "\n"), "\n", strip_tags(validation_errors())));
          } else {
            $delete_data  = $this->model_karyawan->delete_karyawan($id_karyawan);

            if ($delete_data) {
               $msg  = array('status' => true, 'data'=> 'Karyawan berhasil dihapus.');
            } else {
               $msg  = array('status' => false, 'data'=> 'Error System!');
            }

          }
          $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($msg))
          ->_display();exit;
      } else {

         redirect('karyawan','refresh');

      }
    }





}

/* End of file Karyawan.php */
/* Location: ./application/modules/karyawan/controllers/Karyawan.php */
