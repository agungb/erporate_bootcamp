<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->module('layout');
    $this->load->file('assets/lib/datatable/ssp.class.customize.php');
    $this->load->model('model_jabatan');
  }

  public function index()
  {
    $data = array();
    $data['title']       = 'Manajemen Jabatan';
    $data['font_awesome']= 'fa fa-building';
    $data['heading']     = 'Halaman Manajemen Jabatan';
    $data['sub_heading'] = 'Halaman untuk mengelola data Jabatan';
    $data['breadcrumb']  = 'Jabatan';

    $this->layout->header($data);
    $this->layout->sidebar();
    $this->load->view('v_jabatan', $data);
    $this->layout->footer();
  }

  /**
   * Data Tabel
   */

  public function tabel()
  {
    $table       = "jabatan";
    $primary_key = "id_jabatan";

    $columns     = array(
      array( 'db' => 'id_jabatan', 'dt' => 0 , 'field' => 'id_jabatan'),
      array( 'db' => 'n_jabatan', 'dt' => 1 , 'field' => 'n_jabatan'),
      array( 'db' => 'id_jabatan', 'dt' => 2 , 'field' => 'id_jabatan'),
    );

    $sql_details  = $this->config->item('db_table');
    $where = NULL;

    $order_by     = "id_jabatan ASC";

    echo json_encode(
      SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,NULL,$where,$order_by)
    );

  }


  /**
   * Form validation
   */
  private function _validation_add()
  {
    $val  = $this->form_validation;
    $val->set_rules('n_jabatan', 'Nama Jabatan', 'trim|required');

    return $val->run();
  }
  private function _validation_edit()
  {
    $val  = $this->form_validation;
    $val->set_rules('id_jabatan', 'ID Jabatan', 'trim|required');
    $val->set_rules('e_nama_jabatan', 'Nama Jabatan', 'trim|required');

    return $val->run();
  }
  private function _validation_delete()
  {
    $val = $this->form_validation;
    $val->set_rules('id_jabatan', 'ID Jabatan', 'trim|required');

    return $val->run();
  }


  /**
   * Proses CRUD data Jabatan
   */
  public function proses()
  {
    $path   = $this->uri->segment(3);

    // Proses Add
    if ( $path == "add" ) {
      $n_jabatan  = $this->input->post('n_jabatan');

      if ($this->_validation_add() == FALSE) {
        $msg  = array('status' => false, 'data'=> str_replace(array("\r", "\n"), "\n", strip_tags(validation_errors())));

      } else {

        $data_jabatan = array('n_jabatan'=> $n_jabatan);
        $simpan       = $this->model_jabatan->add_jabatan($data_jabatan);

        if ($simpan) {
          $msg = array('status'=> true, 'data'=> ''.$n_jabatan.' Berhasil ditambahkan.');
        } else {
          $msg = array('status'=> false, 'data'=> 'Gagal menambahkan ke database!');
        }

      }
      // Output Json
      $this->output
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($msg))
      ->_display();exit;

  // Proses Edit
    } else if ( $path == "edit" ) {
      $id_jabatan = $this->input->post('id_jabatan');

      if ($id_jabatan == "") {
        $msg = array();
      } else {
       $data_jabatan = $this->model_jabatan->detail_edit($id_jabatan);
       $msg        = array(
        'id_jabatan' => $data_jabatan->id_jabatan,
        'n_jabatan'  => $data_jabatan->n_jabatan,
      );
     }
  // Output Json
     $this->output
     ->set_content_type('application/json', 'utf-8')
     ->set_output(json_encode($msg))
     ->_display();exit;

  // Proses Save Edit
   } else if ( $path  == "save_edit" ) {

    $id_jabatan = $this->input->post('id_jabatan');
    $n_jabatan  = $this->input->post('e_n_jabatan');

    $data_id     = array('id_jabatan'=> $id_jabatan);
    $data_update = array(
      'n_jabatan'   => $n_jabatan
    );

    $update      = $this->model_jabatan->save_edit($data_update, $data_id);

    if ($update) {
      $msg = array('status'=> true, 'data'=> 'Jabatan Berhasil diubah.');
    } else {
      $msg = array('status'=> false, 'data'=> 'Error System!');

    }
  // Output Json
    $this->output
    ->set_content_type('application/json', 'utf-8')
    ->set_output(json_encode($msg))
    ->_display();exit;

        // Proses Delete
  } else if ( $path == "delete" ) {
    $id_jabatan   = $this->input->post('id_jabatan');

    if ($this->_validation_delete() == FALSE) {
      $msg  = array('status' => false, 'data'=> str_replace(array("\r", "\n"), "\n", strip_tags(validation_errors())));
    } else {
      $delete_data  = $this->model_jabatan->delete_jabatan($id_jabatan);

      if ($delete_data) {
       $msg  = array('status' => true, 'data'=> 'Jabatan berhasil dihapus.');
     } else {
       $msg  = array('status' => false, 'data'=> 'Error System!');
     }

   }
   $this->output
   ->set_content_type('application/json', 'utf-8')
   ->set_output(json_encode($msg))
   ->_display();exit;
 }

}

}

/* End of file Jabatan.php */
/* Location: ./application/modules/jabatan/controllers/Jabatan.php */
