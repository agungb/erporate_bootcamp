<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->module('layout');
    $this->load->helper('tgl_indo');
    $this->load->file('assets/lib/datatable/ssp.class.customize.php');
    $this->load->model('model_home');
  }

  public function index()
  {
    $data = array();
    $data['title']       = 'Home';
    $data['font_awesome']= 'fa fa-dashboard';
    $data['heading']     = 'Halaman Dashboard';
    $data['sub_heading'] = 'Halaman Dashboard';
    $data['breadcrumb']  = null;
    //
    $this->layout->header($data);
    $this->layout->sidebar();
    $this->load->view('v_home', $data);
    $this->layout->alert();
    $this->layout->footer();
  }


/**
 * Data Table
 */


    public function tabel()
    {
      $table       = "kehadiran";
      $primary_key = "id_kehadiran";

      $columns     = array(
                        array( 'db' => 'id_kehadiran', 'dt' => 0 , 'field' => 'id_kehadiran'),
                        array( 'db' => 'b.nama', 'dt' => 1 , 'field' => 'nama', 'as' => 'nama'),
                        array( 'db' => 'jam_datang', 'dt' => 2 , 'field' => 'jam_datang'),
                        array( 'db' => 'jam_pulang', 'dt' => 3 , 'field' => 'jam_pulang'),
                        array( 'db' => 'id_kehadiran', 'dt' => 4 , 'field' => 'id_kehadiran'),

                    );

      $sql_details  = $this->config->item('db_table');

      $join         = "FROM kehadiran a
                      LEFT JOIN karyawan b ON (a.id_karyawan=b.id_karyawan)";

      $order_by     = "id_kehadiran ASC";

      echo json_encode(
        SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,$join,NULL,$order_by)
      );

    }


}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */
