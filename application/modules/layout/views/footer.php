      <!-- Essential javascripts for application to work-->
      <script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
      <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>

      <!-- The javascript plugin to display page loading on top-->
      <script src="<?= base_url('assets/js/plugins/pace.min.js'); ?>"></script>
      <!-- Tooltip -->
      <script>
        $('.bs-component [data-toggle="tooltip"]').tooltip();
      </script>
      <!-- Sweatalert -->
      <script src="<?= base_url('assets/js/plugins/sweetalert.min.js'); ?>"></script>

      <!-- Page specific javascripts-->
      <!-- Data table plugin-->
      <script src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js'); ?>"></script>
      <script src="<?= base_url('assets/js/plugins/dataTables.bootstrap.min.js'); ?>"></script>
      <script>$('#sampleTable').DataTable();</script>

      <!-- Main JS -->
      <script src="<?= base_url('assets/js/main.js'); ?>"></script>
      <!-- Select2 JS -->
      <script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
      <!-- Logout  -->
      <script>
        function logout(){
          // Sweat alert
          swal({
            title: "Apakah anda ingin keluar aplikasi?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonText: "Ya",
            closeOnConfirm: false,
            closeOnCancel: true
          }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                  url : "<?php echo base_url('user/logout')?>",
                  success : function(data){
                    window.location.href="<?php echo base_url('login')?>";
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
    </body>
    </html>
