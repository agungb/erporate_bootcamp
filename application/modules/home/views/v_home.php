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
          <hr>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="tabelUser" width="100%">
              <thead class="bg-primary text-white">
                <tr>
                  <th><center>No</center></th>
                  <th><center>Nama Karyawan</center></th>
                  <th><center>Jam Datang</center></th>
                  <th><center>Jam Pulang</center></th>
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

<script>

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
      "ajax": "home/tabel",
      "createdRow": function ( row, data, index ) {
        $('td', row).eq(1).addClass('text-center');
        $('td', row).eq(2).addClass('text-center');
        $('td', row).eq(3).addClass('text-center');
        $('td', row).eq(4).addClass('text-center');
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
</script>
