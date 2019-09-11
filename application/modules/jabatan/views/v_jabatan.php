<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="<?php echo $font_awesome; ?>"></i> <?php echo $heading; ?></h1>
      <p><?php echo $sub_heading; ?></p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?php echo base_url('jabatan'); ?>"><?php echo $breadcrumb; ?></a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
            <div class="geser-kanan">
              <button class="btn btn-primary" onclick="tambahJabatan()"><i class="fa fa-plus"></i>Tambah</button>
            </div>
            <hr>
            <table class="table table-hover table-bordered" id="tableRuang" width="100%">
              <thead  class="bg-primary text-white">
                <tr>
                  <th><center>No</center></th>
                  <th><center>Nama Jabatan</center></th>
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
</main>
 <!-- Modal Add -->
 <div id="addJabatan" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><span class="fa fa-plus"></span> FORM TAMBAH DATA JABATAN</h5>
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
            <label class="control-label">Nama Jabatan</label>
            <input class="form-control" type="text" placeholder="Nama Jabatan" id="n_jabatan" value="" name="n_jabatan" autofocus>
          </div>
          <?php echo form_close() ?>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-primary hvr-bounce-in" onclick="saveNewJabatan();"><i class="fa fa-save"></i>&nbsp;Simpan&nbsp;&nbsp;</a>
        <a href="javascript:void(0)" class="btn btn-secondary hvr-bounce-in" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit -->
<div id="editJabatan" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><span class="fa fa-edit"></span> FORM EDIT DATA JABATAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-horizontal">
        <?php
        $attb = array('id'=> 'form_edit');
        echo form_open('', $attb);
        ?>
        <div class="form-group">
          <label class="control-label">Nama Jabatan</label>
          <input type="hidden" name="id_jabatan" id="id_jabatan" readonly>
          <input class="form-control" type="text" placeholder="Nama Ruangan" id="e_n_jabatan" name="e_n_jabatan" autofocus>
        </div>
        <?php echo form_close() ?>
      </div>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="btn btn-primary hvr-bounce-in" onclick="saveEditJabatan();"><i class="fa fa-save"></i>&nbsp;Simpan&nbsp;&nbsp;</a>
      <a href="javascript:void(0)" class="btn btn-secondary hvr-bounce-in" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel</a>
    </div>
  </div>
</div>
</div>
<script>
  function tambahJabatan() {
    $('#addJabatan').modal('show');
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
        $('#tableRuang').DataTable({
          "destroy"    : true,
          "ordering"   : true,
          "paging"     : true,
          "processing" : true,
          "serverSide" : true,
          "ajax"       : "jabatan/tabel",
          "createdRow": function ( row, data, index ) {
            $('td', row).eq(1).addClass('text-center');
            $('td', row).eq(2).addClass('text-center');
            $('td', row).eq(2).html(
              "<button class='btn btn-warning text-white' title='Edit Data' onclick='edit(\""+data[2]+"\")'><i class='fa fa-edit'></i></button>&nbsp;"+
              "<button class='btn btn-danger' title='Hapus Data' onclick='hapus(\""+data[2]+"\")'><i class='fa fa-trash-o'></i></button>"
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


  function saveNewJabatan() {

    var form_data   = new FormData($('#form_add')[0]);

    $.ajax({
      type: "POST",
      url: "jabatan/proses/add",
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

        $('#addJabatan').modal('hide');
        $('#form_add')[0].reset();
        createTable();
      },error: function(err) {
        alert('Gagal!')
      }
    })
  }

  function edit(id) {
    $.ajax({
      type: "post",
      url: "jabatan/proses/edit",
      data: { id_jabatan: id},
      dataType: "json",
      success: function (data) {
        $('#editJabatan').modal('show');
        $('#e_n_jabatan').val(data.n_jabatan);
        $('#id_jabatan').val(data.id_jabatan)
      },error: function(err) {
        alert('Gagal!')
      }
    })
  }
  function saveEditJabatan(id) {
    var form_data   = new FormData($('#form_edit')[0]);

    $.ajax({
      type: "POST",
      url: "jabatan/proses/save_edit",
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

        $('#editJabatan').modal('hide');
        $('#form_edit')[0].reset();
        createTable();
      },error: function(err) {
        alert('Gagal!')
      }
    })
  }

  function hapus(id) {
    swal({
      title: "Apakah anda ingin menghapus Jabatan ini?",
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
          url : "jabatan/proses/delete",
          data: {id_jabatan: id},
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
