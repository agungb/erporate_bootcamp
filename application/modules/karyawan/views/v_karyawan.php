<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="<?php echo $font_awesome; ?>"></i> <?php echo $heading; ?></h1>
      <p>
        <?php echo $sub_heading; ?>
      </p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>">
          <?php echo $breadcrumb; ?>
        </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="geser-kanan">
            <button class="btn btn-primary" onclick="tambahKaryawan()"><i class="fa fa-plus"></i>Tambah</button>
          </div>
          <hr>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="tabelUser" width="100%">
              <thead class="bg-primary text-white">
                <tr>
                  <th><center>No</center></th>
                  <th><center>Nama Karyawan</center></th>
                  <th><center>Jabatan</center></th>
                  <th><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>
                <script>
                  $(document).ready(function() {
                    createTable();
                  });
                </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

  <!-- Modal Add -->
  <div id="addKaryawan" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><span class="fa fa-plus"></span> FORM TAMBAH DATA KARYAWAN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="form-horizontal">
          <?php
          $attb = array('id'=> 'form_add');
          echo form_open('', $attb);
          ?>
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input class="form-control" type="text" placeholder="Nama Karyawan" id="nama" value="" name="nama" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Jenis Kelamin</label>
            <select name="jns_kelamin" id="jns_kelamin" class="form-control">
              <?php echo $opt_jnskelamin; ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Jabatan</label>
            <select name="id_jabatan" id="id_jabatan" class="form-control">
              <?php echo $opt_jabatan ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nomor HP</label>
            <input class="form-control" type="text" name="no_hp" id="no_hp" value="" placeholder="No HP">
          </div>
          <div class="form-group">
            <label class="control-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat"></textarea>
          </div>
          <?php echo form_close() ?>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="saveNewKaryawan();"><i class="fa fa-save"></i>&nbsp;Simpan&nbsp;&nbsp;</a>
        <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel</a>
      </div>
    </div>
  </div>
</div>

<script>

  function tambahKaryawan() {
    $('#addKaryawan').modal('show');
  }

  function saveNewKaryawan() {

    var form_data   = new FormData($('#form_add')[0]);

    $.ajax({
      type: "POST",
      url: "karyawan/proses/add",
      data: form_data,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function(msg) {

        if (msg.status == true) {
          swal(
            'Success',
            (msg.data),
            'success'
            )

        } else {
          swal(
            'Error!',
            (msg.data),
            'error'
            )
        }

        $('#addKaryawan').modal('hide');
        $('#form_add')[0].reset();
        createTable();
      },error: function(err) {
        alert('Gagal!')
      }
    })
  }

  function createTable(){
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    $('#tabelUser').DataTable({
      "destroy" : true,
      "ordering" : true,
      "paging": true,
      "processing": true,
      "serverSide": true,
      "ajax": "karyawan/tabel",
      "createdRow": function ( row, data, index ) {
        $('td', row).eq(1).addClass('text-center');
        $('td', row).eq(2).addClass('text-center');
        $('td', row).eq(3).addClass('text-center');
        $('td', row).eq(3).html(
          "<button class='btn btn-warning text-white' title='Edit Data' onclick='edit(\""+data[3]+"\")'><i class='fa fa-edit'></i></button>&nbsp;"+
          "<button class='btn btn-danger' title='Hapus Data' onclick='hapus(\""+data[3]+"\")'><i class='fa fa-trash-o'></i></button>"
          );

      },
      "order": [],
      "columnDefs":[
      {"targets"  : 0,"orderable": false}
      ],
      "rowCallback": function (row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
      }
    });
  }

  function hapus(id) {
    swal({
      title: "Apakah anda ingin menghapus karyawan ini?",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Tidak",
      confirmButtonText: "Ya",
      closeOnConfirm: false,
      closeOnCancel: true
    }, function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: "post",
          url : "karyawan/proses/delete",
          data: {id_karyawan: id},
          dataType: "json",
          success : function(msg){
            if (msg.status == true) {
              swal(
                'Success',
                (msg.data),
                'success'
                )

            } else {
              swal(
                'Error!',
                (msg.data),
                'error'
                )
            }
            createTable();
          },
          error : function(response){
            alert("GAGAL");
          }
        });
      }else{
        return false;
      }
    });
  }
</script>
