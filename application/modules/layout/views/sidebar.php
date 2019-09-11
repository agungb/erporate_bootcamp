<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?php echo base_url('home'); ?>"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Home</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url('jabatan'); ?>"><i class="icon fa fa-circle-o"></i> Data Jabatan</a></li>
            <li><a class="treeview-item" href="<?php echo base_url('karyawan'); ?>"><i class="icon fa fa-circle-o"></i> Data Karyawan</a></li>
          </ul>
        </li>
      </ul>
    </aside>
