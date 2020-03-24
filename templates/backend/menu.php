<div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
              <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
              <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
              <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
              <i class="ace-icon fa fa-cogs"></i>
            </button>
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
          </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
          <li class="hover">
            <a href="<?= site_url('admin/dashboard'); ?>">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text">
                Master Data
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
              <li class="hover">
                <a href="<?= site_url('admin/masters/pelatihan'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Pelatihan
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/masters/training'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Name of Training
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/masters/operation'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Operation
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/masters/jenis_laporan'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Jenis Laporan
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/masters/kelas'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Kelas
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/naker'); ?>">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-text"> Naker </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/training_plan'); ?>">
              <i class="menu-icon fa fa-calendar"></i>
              <span class="menu-text"> Training Plan </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-bullseye"></i>
              <span class="menu-text">
                Target
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
              <li class="hover">
                <a href="<?= site_url('admin/target/upload'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Upload Data
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/target'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Target Pelatihan
                </a>
                <b class="arrow"></b>
              </li>
              <li class="hover">
                <a href="<?= site_url('admin/penilaian'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Penilaian
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/material'); ?>">
              <i class="menu-icon fa fa-recycle"></i>
              <span class="menu-text"> Stok Material </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/modul'); ?>">
              <i class="menu-icon fa fa-download"></i>
              <span class="menu-text"> Modul </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/monila'); ?>">
              <i class="menu-icon fa fa-desktop"></i>
              <span class="menu-text"> Monila </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="hover">
            <a href="<?= site_url('admin/training_request'); ?>">
              <i class="menu-icon fa fa-play"></i>
              <span class="menu-text"> Training Request </span>
            </a>
            <b class="arrow"></b>
          </li>

        </ul><!-- /.nav-list -->
      </div>
